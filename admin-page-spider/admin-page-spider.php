<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: Admin Page Spider
Plugin URI: https://wordpress.org/plugins/admin-page-spider/
Description: Adds a list of your pages & posts to the admin bar so you have quick access instead of going into multiple dashboard pages.
Author: J7Digital
Author URI: https://profiles.wordpress.org/jatacid/
Text Domain: admin-page-spider
Domain Path: /languages
Version: 3.13
License: GPLv2 or later

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/



add_action ( 'init' , 'page_spider_init');
register_activation_hook( __FILE__, 'apspider_plugin_activate' );
register_deactivation_hook( __FILE__, 'apspider_plugin_deactivate' );


function page_spider_init () {
	if ( current_user_can( 'administrator' ))
	{
		if ( !class_exists('Apspp') || floatval(EDD_APSPP_VERSION) <  "3.00"){

		global $admin_url;
		$admin_url = admin_url();

	//textdomain
			load_plugin_textdomain( 'admin-page-spider', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

	// Load settings page
			include_once 'apspider-adminsettings.php';
	// Loads functions & menus
			include_once 'apspider-functions.php';
	// Builds the Pages menu
			include_once 'apspider-wordpresspages.php';
	// Builds the Posts menu
			include_once 'apspider-wordpressposts.php';
			add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'apspider_pluginaction_links' );
		}
		else //Apspp exists
		{
			add_action( 'admin_head', 'propack_is_active');
		}
	}

}


// Deletes all settings upon plugin deactivation
function apspider_plugin_deactivate(){
	if ( ! current_user_can( 'activate_plugins' ) )
		return;

	global $fields;
	// Cycle through the array & delete all options
	foreach( $fields as $field ){
		delete_option($field['uid'] );
	}
}

//Adds all settings upon plugin activation
function apspider_plugin_activate(){
	if ( ! current_user_can( 'activate_plugins' ) )
		return;

}



function apspider_pluginaction_links( $links ) {
	$links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=apspider_fields') ) .'">Settings</a>';

	$links[] = '<a style="border: 1px solid green; border-radius: 10px; padding: 0px 20px;"  href="https://j7digital.com/downloads/admin-page-spider-pro-pack/" target="_blank">Get Pro</a>';

	return $links;
}



// Adds an alert to plugin page if Admin Page Spider is missing.
function propack_is_active() {
	?>
	<script type="text/javascript">
		(function($) {
			$(function() {
				$('[data-slug=admin-page-spider] td.column-description.desc').append('<div style="background-color: #68ab7f; color: #ffffff; padding: 5px 20px; font-weight: 900;">You have the Pro Pack! You can deactivate and delete this plugin :) Thank you!</div>');
			});
		})(jQuery);
	</script>
	<?php
}
