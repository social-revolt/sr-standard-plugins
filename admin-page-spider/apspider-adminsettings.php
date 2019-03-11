<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




// Create admin settings page and settings fields
add_action( 'admin_menu', 'apspider_plugin_settings_page' );


//Create Admin Page
function apspider_plugin_settings_page()
{
	$page_title = __( 'Admin Page Spider' , 'admin-page-spider' );
	$menu_title = __( 'Admin Page Spider Free' , 'admin-page-spider' );
	$capability = 'manage_options';
	$slug = 'apspider_fields';
	$callback = 'apspider_plugin_settings_page_content';
	add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback);
}


// Create the layout of the settings page
function apspider_plugin_settings_page_content()
{

	//js for the toggling of menu fields
	echo ' <style type="text/css">form h2 {	background-color: lightblue ; padding: 20px; cursor: pointer;} </style>
	<script>(function($){
		$(document).ready(function(){
			$("h2:not(:first)").each(function(){
				$(this).nextUntil("h2, p.submit").toggle();
			});
			$("h2").on("click", function(){
				$(this).nextUntil("h2, p.submit").toggle("slideIn");
			});
		});
	})(jQuery);</script>
	<div class= "wrap" style="width: 60%;">
		<h1>Admin Page Spider FREE </h1>
		<form method="post" action="options.php">';

			settings_fields( "apspider_fields" );
			do_settings_sections( "apspider_fields" );
			submit_button();

			echo '</form>';

		// Create the message which appears at the bottom of the settings page
			echo '<div style="padding: 30px; background-color: lightblue; margin: 50px 0; text-align: center;">
				<h1><span style="color: purple;">Get Admin Page Spider Pro Pack!!</span></h1>
				<br>
				<h1>THE PRO PACK FEATURES!</h1>
				<ul>
					<li>+ In-Menu Search Filters!</li>
					<li>+ Wordpress Pages!</li>
					<li>+ Wordpress Posts!</li>
					<li>+ Beaver Builder Pages!</li>
					<li>+ Beaver Builder Templates!</li>
					<li>+ CSS Hero CSS Editor!</li>
					<li>+ Microthemer CSS Editor!</li>
					<li>+ Easy Digital Downloads!</li>
					<li>+ Woocommerce Products!</li>
					<li>+ Elementor Page Builder!</li>
					<li>+ Yellow Pencil CSS Editor!</li>
					<li>+ Much More!</li>
				</ul>
				<br/>
				<a target="_blank" href="https://j7digital.com/downloads/admin-page-spider-pro-pack/" style="text-decoration: none;"><h3 style="background-color: darkslateblue; color: white; max-width: 300px; text-decoration: none; margin: auto; padding: 10px 20px; border-radius: 15px;">Check It Out Now</h3></a></div>';

			echo '</div><div style="clear: both;"></br></div>';
		}


//Run the setup fields after the section has been created
		add_action( 'admin_init', 'apspider_setup_fields' );






// Create a 'section' for the settings page (Called by each post type)
		function apspider_setup_sections($section_id, $section_title, $section_callback)
		{
			require_once( ABSPATH . 'wp-admin/includes/template.php' );
			add_settings_section( $section_id, $section_title, $section_callback, 'apspider_fields' );

		}


// Callback for a list of 'settings' for the sections
		function apspider_setup_fields()
		{
			global $fields;
			include_once('apspider-adminfieldsarray.php');

		// Cycle through the settings, create the field and register the setting
			foreach( $fields as $field ){
				add_settings_field( $field['uid'], $field['label'], 'apspider_field_callback', 'apspider_fields', $field['section'], $field );
				register_setting( 'apspider_fields', $field['uid'] );

				$uid = $field['uid'];
				$value = get_option($uid);
				if ( $value === false){
					update_option($field['uid'], $field['default']);
				}
			}
		}

// Callback to handle each scenario of each settings field created and passed to it.
		function apspider_field_callback( $arguments )
		{
			$value = get_option( $arguments['uid'] );

			if( ! $value ) {
				$value = $arguments['default'];
			}

			if ( ! empty ( $arguments['placeholder'] )){
				$placeholder = $arguments['placeholder'];
			} else {
				$placeholder = false ;
			}

			printf('<div style="background-color: #DFDFDF; padding: 5px;">');


			switch( $arguments['type'] ){
				case 'text':
				case 'password':
				case 'number':
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $placeholder, $value );
				break;
				case 'textarea':
				printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $placeholder, $value );
				break;
				case 'select':
				case 'multiselect':
				if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
					$attributes = '';
					$options_markup = '';
					foreach( $arguments['options'] as $key => $label ){

						if ( isset($arguments['default'][0]) && $label == $arguments['default'][0])
						{
							$options_markup .= sprintf( '<option value="%1s" selected>%2s</option>', $key, $label);
						}
						else
						{
							$options_markup .= sprintf( '<option value="%1s">%2s</option>', $key, $label);
						}

					}
					if( $arguments['type'] === 'multiselect' ){
						$attributes = ' multiple="multiple" ';
					}
					printf( '<select name="%1$s" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
				}


				break;
				case 'radio':
				case 'checkbox':
				if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
					$options_markup = '';
					$iterator = 0;
					foreach( $arguments['options'] as $key => $label ){
						$iterator++;
						$options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
					}
					printf( '<fieldset>%s</fieldset>', $options_markup );
				}

				break;
			}

			if( ! empty ( $arguments['helper'] )) {
				printf( '<span class="helper"> %s</span>', $arguments['helper'] );
			}

		// Add a supplemental text field if you ever want to display an additional field
			if( ! empty ( $arguments['supplemental'] )) {
				printf( '<p class="description">%s</p>', $arguments['supplemental'] );
			}

			printf('</div>');

		}

