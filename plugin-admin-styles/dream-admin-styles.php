<?php 
/*
Plugin Name: Dreams Admin Styles
Plugin URI: http://thetwosents.com
Description: Admin styling for Wordpress
Author: Jon Senterfitt
Version: 1.0
Author URI: http://thetwosents.com
*/


function activate_styles() {
  wp_enqueue_style( 'custom_wp_admin_css', plugins_url('/styles/styles.css', __FILE__) );
}

function remove_menus() {
    remove_menu_page( 'edit-comments.php' );
    remove_menu_page( 'tools.php' );
}

add_action( 'admin_enqueue_scripts', 'activate_styles' );
add_action( 'admin_menu', 'remove_menus' );

?>