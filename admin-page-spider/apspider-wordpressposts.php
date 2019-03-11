<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

apspider_posts_init();

function apspider_posts_init(){

//check there is more than 1 post so that the user actually blogs.
	$count_posts = wp_count_posts();
	$published_posts = $count_posts->publish;
	if ( $published_posts > 0 ){

	//Adds a "Posts" menu to adminbar
		$apspider_which_option_is_selected = get_option('apspp_radio_viewposts');
		if ( ! empty ( $apspider_which_option_is_selected[0] )){
			if ( $apspider_which_option_is_selected[0] == 'option1'){
				add_action( 'admin_bar_menu', 'apspider_view_posts', 998 );
				add_action('apspider_extra_styles', 'apspider_posts_extra_styles', 10);
			}
		}
	}
}

function apspider_view_posts($wp_admin_bar) {

		global $admin_url;


	if (!isset($post_list))
	{
		global $post_list;
		global $newquery;
		$post_list = apspider_get_list_of_pages(
						$post_type_slug = 'post',
						$order_by = 'post_date',
						$sort = 'DESC',
						$parent_heirarchy = 'false');
		$newquery = null;
	}



	apspider_create_menu(
		$wp_admin_bar,
		$post_list,
		$menu_name = 'Posts',
		$menu_href = $admin_url . 'post.php?post=adminpagespiderID&action=edit',
		$menu_hover = __('Edit Current Post', 'admin_page_spider'),

		$view_all_item_name = __( 'View All Posts' , 'admin-page-spider' ),
		$view_all_item_href = $admin_url . 'edit.php?post_type=post',

		$unique_slug = 'view_wp_posts',
		$option_name = 'apspp_posts_name',

		$post_title_suffix = 'date',
		$post_href_uselinktype = null,
		$post_href_beforeid = null,
		$post_href_afterid = $admin_url . 'post.php?post='. 'adminpgspiderID'. '&action=edit'
		);
}


//Adds an edit pencil to the Edit Page menu item
function apspider_posts_extra_styles(){
	echo '#wp-admin-bar-apspider_view_wp_posts>a:before{content: "\f109"; top: 2px;}' ;
}