<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Create the Section
apspider_setup_sections(
	$section_id = 'first_section',
	$section_title = __( '+ Wordpress Pages' , 'admin-page-spider' ),
	$section_callback = 'apspider_sections_callback'
	);

	// Create the Section
apspider_setup_sections(
	$section_id = 'posts_section',
	$section_title = __( '+ Wordpress Blog/Posts' , 'admin-page-spider' ),
	$section_callback = 'apspider_sections_callback'
	);

// Create the Section
apspider_setup_sections(
	$section_id = 'beaverbuilder_section',
	$section_title = __( '+ Beaver Builder' , 'admin-page-spider' ),
	$section_callback = 'apspider_sections_callback'
	);
		// Create the Section
apspider_setup_sections(
	$section_id = 'csshero_section',
	$section_title = __( '+ CSS Hero' , 'admin-page-spider' ),
	$section_callback = 'apspider_sections_callback'
	);

		// Create the Section
apspider_setup_sections(
	$section_id = 'edd_downloads_section',
	$section_title = __( '+ Easy Digital Downloads' , 'admin-page-spider' ),
	$section_callback = 'apspider_sections_callback'
	);

		// Create the Section
apspider_setup_sections(
	$section_id = 'microthemer_section',
	$section_title = __( '+ Microthemer' , 'admin-page-spider' ),
	$section_callback = 'apspider_sections_callback'
	);

		// Create the Section
apspider_setup_sections(
	$section_id = 'woo_section',
	$section_title = __( '+ WooCommerce' , 'admin-page-spider' ),
	$section_callback = 'apspider_sections_callback'
	);


		// Create the Section
apspider_setup_sections(
	$section_id = 'elementor_section',
	$section_title = __( '+ Elementor Page Builder' , 'admin-page-spider' ),
	$section_callback = 'apspider_sections_callback'
	);

		// Create the Section
apspider_setup_sections(
	$section_id = 'yellowpencil_section',
	$section_title = __( '+ Yellow Pencil CSS' , 'admin-page-spider' ),
	$section_callback = 'apspider_sections_callback'
	);


// Callback to handle each scenario of each section creation.
function apspider_sections_callback( $arguments ) {
	switch( $arguments['id'] ){

		case 'first_section':
		echo __( '<p>The options for the Wordpress menus, allowing you to quickly view and edit any page.</p>' , 'admin-page-spider' );
		break;

		case 'posts_section':
			//check there is more than 1 post so that the user actually blogs.
		$count_posts = wp_count_posts();
		$published_posts = $count_posts->publish;
		if ( $published_posts > 0 ){
			echo __( '<p>Control the settings for the "Posts" menu.</p>' , 'admin-page-spider' );
		}
		else {
			echo __( '<p style="color: red;">You may need to add a blog/post first before this will display!</p>' , 'admin-page-spider' );
		}

		break;

		case 'beaverbuilder_section':
		echo __( '<p style="font-size: 30px; color: purple;">Get Pro To Enable!</p> <a target="_blank" href="https://j7digital.com/downloads/admin-page-spider-pro-pack/" style="text-decoration: none; display: inline;"><h3 style="background-color: darkslateblue; color: white; max-width: 300px; text-decoration: none; margin: auto; padding: 10px 20px; border-radius: 15px;">Check It Out Now</h3></a>' , 'admin-page-spider' );
		break;

		case 'csshero_section':
		echo __( '<p style="font-size: 30px; color: purple;">Get Pro To Enable!</p> <a target="_blank" href="https://j7digital.com/downloads/admin-page-spider-pro-pack/" style="text-decoration: none; display: inline;"><h3 style="background-color: darkslateblue; color: white; max-width: 300px; text-decoration: none; margin: auto; padding: 10px 20px; border-radius: 15px;">Check It Out Now</h3></a>' , 'admin-page-spider' );
		break;

		case 'edd_downloads_section':
		echo __( '<p style="font-size: 30px; color: purple;">Get Pro To Enable!</p> <a target="_blank" href="https://j7digital.com/downloads/admin-page-spider-pro-pack/" style="text-decoration: none; display: inline;"><h3 style="background-color: darkslateblue; color: white; max-width: 300px; text-decoration: none; margin: auto; padding: 10px 20px; border-radius: 15px;">Check It Out Now</h3></a>' , 'admin-page-spider' );
		break;


		case 'microthemer_section':
		echo __( '<p style="font-size: 30px; color: purple;">Get Pro To Enable!</p> <a target="_blank" href="https://j7digital.com/downloads/admin-page-spider-pro-pack/" style="text-decoration: none; display: inline;"><h3 style="background-color: darkslateblue; color: white; max-width: 300px; text-decoration: none; margin: auto; padding: 10px 20px; border-radius: 15px;">Check It Out Now</h3></a>' , 'admin-page-spider' );
		break;

		case 'woo_section':
		echo __( '<p style="font-size: 30px; color: purple;">Get Pro To Enable!</p> <a target="_blank" href="https://j7digital.com/downloads/admin-page-spider-pro-pack/" style="text-decoration: none; display: inline;"><h3 style="background-color: darkslateblue; color: white; max-width: 300px; text-decoration: none; margin: auto; padding: 10px 20px; border-radius: 15px;">Check It Out Now</h3></a>' , 'admin-page-spider' );
		break;

		case 'elementor_section':
		echo __( '<p style="font-size: 30px; color: purple;">Get Pro To Enable!</p> <a target="_blank" href="https://j7digital.com/downloads/admin-page-spider-pro-pack/" style="text-decoration: none; display: inline;"><h3 style="background-color: darkslateblue; color: white; max-width: 300px; text-decoration: none; margin: auto; padding: 10px 20px; border-radius: 15px;">Check It Out Now</h3></a>' , 'admin-page-spider' );
		break;

		case 'yellowpencil_section':
		echo __( '<p style="font-size: 30px; color: purple;">Get Pro To Enable!</p> <a target="_blank" href="https://j7digital.com/downloads/admin-page-spider-pro-pack/" style="text-decoration: none; display: inline;"><h3 style="background-color: darkslateblue; color: white; max-width: 300px; text-decoration: none; margin: auto; padding: 10px 20px; border-radius: 15px;">Check It Out Now</h3></a>' , 'admin-page-spider' );
		break;

	}
}



global $fields;
//Settings fields array containing all settings used in the plugin
$fields = array(

// Wordpress Pages
	array(
		'uid' => 'apspider_editmenu_name',
		'label' => __( 'Name for the Wordpress Pages Menu?', 'admin-page-spider'),
		'section' => 'first_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item in the Admin Bar', 'admin-page-spider'),
		'default' => 'Edit Page'
		),

	array(
		'uid' => 'apspider_radio_editmenu',
		'label' => __( 'Display The Wordpress Pages Menu?' , 'admin-page-spider' ),
		'section' => 'first_section',
		'type' => 'radio',
		'supplemental' => __( 'Easy access to edit each page.', 'admin-page-spider'),
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),




//Wordpress section:  display POSTS
	//The name of the Posts Menu
	array(
		'uid' => 'apspp_posts_name',
		'label' => __( 'Name for the Posts Menu?', 'admin-page-spider' ),
		'section' => 'posts_section',
		'type' => 'text',
		'supplemental' => __( 'The name of the menu item.', 'admin-page-spider' ),
		'default' => 'Edit Post'
		),
	array(
		'uid' => 'apspp_radio_viewposts',
		'label' => __( 'Display The "Posts" Menu?' , 'admin-page-spider' ),
		'section' => 'posts_section',
		'type' => 'radio',
		'supplemental' => __('Lists all your posts with edit links', 'admin-page-spider' ),
		'options' => array(
			'option1' => __( 'Display' , 'admin-page-spider' ),
			'option2' => __( 'Hide' , 'admin-page-spider' ),
			),
		'default' => array('option1')
		),

	);

return $fields;