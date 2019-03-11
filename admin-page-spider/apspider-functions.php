<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Adds custom styling css for the admin bar
function apspider_add_custom_admin_styles() {
	echo '<style type="text/css">

	/* Main Menu div*/
	.apspider_menu_class>.ab-sub-wrapper {
		max-height: 90vh !important ;
		min-width: 300px !important;
		opacity: 0.94;
		overflow-x:  hidden;
		overflow-y: auto;
	}

	/* Give placeholder colour a set value for all browsers */

	body .apspider_menu_class ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		color: #777777;
	}
	body .apspider_menu_class ::-moz-placeholder { /* Firefox 19+ */
		color: #777777;
	}
	body .apspider_menu_class :-ms-input-placeholder { /* IE 10+ */
		color: #777777;
	}
	body .apspider_menu_class :-moz-placeholder { /* Firefox 18- */
		color: #777777;
	}



	/* Highlight Grey Item */
	.apspider_highlighted a{
		text-decoration: underline !important;
		color: #848484 !important;
	}

	/* Search */
	#wpadminbar input.apspider_search{
	width: 100%;
	height: 25px;
	border: none;
	padding: 0px 5px;
	box-sizing: border-box;
	background-color: rgba(0, 0, 0, 0.28);
	color: white;
}
/* Current Page Highlighted Item */
.blueselected a{
	color: #00b9eb !important;
}

/* Search Button */
.apspider_highlighted_search{
	position: absolute !important;
	text-align: right;
	left: auto;
	right: 0;
}


/* Make the wrapping submenu come within the right place */
.apspider_menu_class>.ab-sub-wrapper .hover .ab-sub-wrapper
{
	right: 0 !important;
	margin-left: 0 !important;
	padding: 0 !important;
	margin-top:  -28px !important;
	box-shadow: none !important;

}

.apspider_menu_class>.ab-sub-wrapper .ab-sub-wrapper *
{
	line-height: 0 !important;
}
.apspider_menu_class>.ab-sub-wrapper .ab-sub-wrapper ul
{
	padding:  0 !important;
}



/* Set submenu buttons to some defaults */
.apspider_highlighted_view, .apspider_highlighted_view *{
	background-color: inherit;
	max-width: 18px !important;
	margin:0 !important;
	padding:0 !important;
	text-align: center;
	position: relative !important;
}

/* Make them inline on the same item */
.apspider_highlighted_view{
	display:inline-block;
	float:right;
	padding: 0 5px !important;
	border-left: 1px dotted #808080;
}

/* View Button Icon */
.apspider_highlighted_view a:before{
	content: "\f179";
}

/* Other Button Icon */
.icon2 a:before{
	content: "\f464";
}

/* Other Button Icon */
.icon3 a:before{
	content: "\f309";
}


/* Hide default arrow for submenu items */
	#wpadminbar .apspider_menu_class .menupop>.ab-item:before{
content: "";
}
/* give a white text color */
li.apspider_menu_class>a, li.apspider_menu_class>div.ab-empty-item{
	color: #f1fcff !important;}
';
do_action('apspider_extra_styles');
echo '</style>';
}
add_action('admin_head', 'apspider_add_custom_admin_styles', 10);
add_action('wp_head', 'apspider_add_custom_admin_styles', 10);




function apspider_get_wpdb_query(
	$post_type_slug,
	$order_by,
	$sort = 'ASC',
	$post_parent = 0){
	global $wpdb;

	$sql = "SELECT ID, post_title, post_parent, menu_order, post_date, post_type, post_status
	FROM $wpdb->posts
	WHERE (post_type = '$post_type_slug') AND
	(post_status = 'publish' OR
	post_status = 'future' OR
	post_status = 'draft' OR
	post_status = 'pending' OR
	post_status = 'private')
	ORDER BY $order_by $sort
	";

	$globalquery = $wpdb->get_results($sql);
	// var_dump($sql);
	// var_dump('<br><br>');

	return $globalquery;
}

function apspp_pagearray_cycle($globalquery, $parent){
	global $globalquery;
	global $newquery;
	global $lvl;
	$lvl = 0;
	foreach($globalquery as $key => $row)
	{
		if ($row->post_parent == $parent)
		{
			$row->lvl = $lvl;
			$newquery[] = $row;
			apspp_getchilditems($globalquery,$row->ID);
		}

	}
	return $newquery;
}

function apspp_getchildscount($query,$parent){
	global $lvl;
	$childcounter = false;
	foreach($query as $key => $row)
	{
		if ($row->post_parent == $parent)
		{
			$childcounter[] = $row;
		}
	}

	if ( is_array($childcounter) || $childcounter !== false ) {
		return count($childcounter);
	}
	else {
		return 1;
	}

}

function apspp_getchilditems($query,$parent){
	global $globalquery;
	global $lvl;
	global $newquery;
	$children = array();
	foreach($query as $key => $row)
	{
		if ($row->post_parent == $parent)
		{
			if (apspp_getchildscount($query,$row->ID) > 0)
			{
				$lvl++;
				$row->lvl = $lvl;
				$newquery[] = $row;
				apspp_getchilditems($query,$row->ID);
			}
			else
			{
				$newquery[] = $row;

			}
			$lvl = $lvl - 1;
		}
	}
	return $children;
}







function apspider_get_list_of_pages(
	$post_type_slug,
	$order_by,
	$sort = 'ASC',
	$parent_heirarchy = 'true',
	$post_parent = 0,
	$lvl =0){

	global $globalquery;
	global $newquery;
	$globalquery = apspider_get_wpdb_query($post_type_slug, $order_by, $sort, $post_parent);

	$newquery = apspp_pagearray_cycle($globalquery, $post_parent);
	return $newquery;
}


//Creates the menu
function apspider_create_menu(
	$wp_admin_bar,
	$this_list,

	$menu_name,
	$menu_href,
	$menu_hover,

	$view_all_item_name,
	$view_all_item_href,

	$unique_slug,
	$option_name,

	$post_title_suffix,
	$post_href_uselinktype,
	$post_href_beforeid,
	$post_href_afterid
	)
{


	//Create the menu
	if (is_array($this_list) && count($this_list) > 0)
	{
		global $admin_url;
	//Gets Menu name settings or Sets it to default.
		$apspider_which_option_is_selected = get_site_option($option_name);


		if ( empty( $apspider_which_option_is_selected[0]) OR $apspider_which_option_is_selected[0] == ''){
			$apspider_which_option_is_selected = $menu_name;
		}

		$prefix = '';
		$extraclass = '';
		$this_pg_id = get_the_ID();




	//Create Main Menu Node (edits current post)
		$args = array(
			'id'    => 'apspider_'. $unique_slug,
			'title' => __($apspider_which_option_is_selected , 'admin-page-spider'),
			'href'  => str_replace('adminpagespiderID', $this_pg_id, $menu_href),
			'meta'  => array( 'class' => 'apspider_menu_class','title' => isset($menu_hover) ? $menu_hover = $menu_hover :  $menu_hover = false)
			);
		$wp_admin_bar->add_node( $args );


		if ( isset($view_all_item_name)){
	//Create 'View All' Menu Node
			$args = array(
				'id'    => 'viewapspider_' . $unique_slug,
				'title' => $view_all_item_name,
				'href'  => $view_all_item_href,
				'parent' => 'apspider_'. $unique_slug,
				'meta'  => array( 'class' => 'apspider_highlighted')
				);
			$wp_admin_bar->add_node( $args );




		}

		foreach( $this_list as $post )
		{

			$view_link = get_permalink($post->ID);

			if (count(explode('?', $view_link)) > 1 )
			{
				$adminpagespiderparam_marker_type = '&';
			}
			else
			{
				$adminpagespiderparam_marker_type = '?';
			}

			$edit_link = str_replace('adminpgspiderurl', $view_link , $post_href_afterid);

			$edit_link = str_replace('adminpagespiderparam_marker_type', $adminpagespiderparam_marker_type, $edit_link);

			$edit_link = str_replace('adminpgspiderID', $post->ID, $edit_link);



			if ($post_title_suffix == 'date'){
				$suffix = ' ['. get_post_time('j M', false, $post->ID, false).']';
			} else{
				$suffix = $post_title_suffix;
			}

		//Right grey flag text
			 if ($post->post_status == 'draft')
			{
				$suffix .= ' <span style="font-size: 10px; color: #888888; position: absolute; right: 20px;">(Draft)</span>';

			}

			if ($post->lvl == 0)
			{
				$prefix = '';
			}
			else
			{
				if ($post->lvl == 3 || $post->lvl == 5 || $post->lvl == 7)
				{
					$spacer= '| ';
				}
				else
				{
					$spacer = '';
				}

				$prefix = '<span style="padding: 0 0 0 '.(($post->lvl*4)*3).'px;">'.$spacer.'</span>';
			}

			if ($this_pg_id == $post->ID)
			{
				$extraclass = ' blueselected';
			}







			$args = array(
				'id'    => $post->ID . $unique_slug.'wppg',
				'title' => $prefix . $post->post_title . $suffix,
				'href'  => $edit_link,
				'parent' => 'apspider_'. $unique_slug,
				'meta'  => array( 'class'=> $extraclass, 'title' => __('Edit: ', 'admin_page_spider') . $post->post_title )
				);
			$wp_admin_bar->add_node( $args );

		//Clear the blue now that it's used up
			$extraclass = '';





		//Create View Link
				$args = array(
					'id'    => $post->ID . $unique_slug. 'wppg1',
					'title' => '',
					'href'  => $view_link,
					'parent' => $post->ID . $unique_slug.'wppg',
					'meta'  => array( 'class' => 'apspider_highlighted_view'. $extraclass, 'title' => __('View: ', 'admin_page_spider') . $post->post_title)
					);
				$wp_admin_bar->add_node( $args );





		}
	}

}
