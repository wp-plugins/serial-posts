<?php
/*
Plugin Name: Serial Posts Plugin
Plugin URI: http://www.studiograsshopper.ch/wordpress-plugins/serial-posts-plugin/
Version: 0.9
Author: Ade Walker, Studiograsshopper
Author URI: http://www.studiograsshopper.ch
Description: Allows you to assign posts to a Serial, using custom fields, and then displays a list of all posts assigned to the same Serial in your single post page (usually single.php or index.php).
*/

/*  Copyright 2008  Ade WALKER  (email : info@studiograsshopper.ch)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License 2 as published by
    the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can be found here: 
    http://www.gnu.org/licenses/gpl-2.0.html
	
*/

/* Version History

	0.9			- Public release
	
	0.2			- Added more options for the list title
				- Added automatic CSS classes to list elements
	
	0.1			- Added global $id in order for get_post_meta to work.
				- First attempt
	
*/

/* Dev Notes 
* Plugin folder:		serialposts-plugin
* Plugin file:	 		serialposts-plugin.php
* Var prefix: 			$serp
* Function prefix:		$serp


/* ******************** DO NOT edit below this line! ******************** */

/* Prevent direct access to the plugin */
if (!defined('ABSPATH')) {
	exit("Sorry, you are not allowed to access this page directly.");
}


/* Pre-2.6 compatibility to find directories */
if ( ! defined( 'WP_CONTENT_URL' ) )
	define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );


/* Set constant for plugin directory */
define( 'SERP_URL', WP_PLUGIN_URL.'/serialposts-plugin' );


/* Set constant for plugin version number */
define ( 'SERP_VER', '0.9' );


/* Internationalization functionality */
define('SERP_DOMAIN', 'Serial Posts Wordpress plugin');
$serp_text_loaded = false;

function serp_load_textdomain() {
	global $serp_text_loaded;
   	if($serp_text_loaded) return;

   	load_plugin_textdomain(SERPDOMAIN, WP_PLUGIN_DIR.'/'.dirname(plugin_basename(__FILE__)), dirname(plugin_basename(__FILE__)));
   	$serp_text_loaded = true;
}


/* Function to create serial posts lists */
function serial_posts() {
	
	global $id;
	
	/* Check if current post is a member of a series
	and get serial_name of current post */
	$serial_value = get_post_meta($id, 'Serial', true);
	
	/* Replace whitespace to use Serial Name as CSS class name */
	$serial_value_css = str_replace( " ", "-", $serial_value );
	
	
	if ( $serial_value ) {
	
		/* Get plugin options */
		$options = get_option('serp_plugin_settings');
	
		/* Build mySQL query to pull in custom images */
		/* Instantiate the wpdb object */
		global $wpdb;
	
		if ( $options['list_current'] == "0" ) {
			/* Do the query excluding current post */
			$findposts = $wpdb->get_results(
				"SELECT *
				FROM $wpdb->posts
				LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
				WHERE $wpdb->postmeta.meta_key = 'Serial'
				AND $wpdb->postmeta.meta_value = '$serial_value'
				AND $wpdb->posts.post_status = 'publish'
				AND $wpdb->posts.post_type = 'post'
				AND $wpdb->postmeta.post_id != $id
				ORDER BY $wpdb->posts.post_date ASC"
			);
		} else {
			/* Do the query including current post */
			$findposts = $wpdb->get_results(
				"SELECT *
				FROM $wpdb->posts
				LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
				WHERE $wpdb->postmeta.meta_key = 'Serial'
				AND $wpdb->postmeta.meta_value = '$serial_value'
				AND $wpdb->posts.post_status = 'publish'
				AND $wpdb->posts.post_type = 'post'
				ORDER BY $wpdb->posts.post_date ASC"
			);
		}

		/* Print out the results */
		if ($findposts):
			/* Output the div container for the list */
			echo '<div id="' . $serial_value_css . '">' . "\n";
			
			/* Get the admin defined parts of the list heading */
			$serp_pre_text = '';
			if ( $options['pre_text'] !='' ) {
				$serp_pre_text = '<span class="serial-pre-text">' . stripslashes($options['pre_text']) . '</span>&nbsp;';
			}
			
			$serp_serial_value = '<span class="serial-name">' . $serial_value . '</span>';
			
			$serp_post_text = '';
			if ( $options['post_text'] !='' ) {
				$serp_serial_value = '<span class="serial-name">' . $serial_value . '</span>&nbsp;';
				$serp_post_text = '<span class="serial-post-text">' . stripslashes($options['post_text']) . '</span>';
			}
			
			/* Output the list heading */
			echo '<h3>' . $serp_pre_text . $serp_serial_value . $serp_post_text . '</h3>' . "\n";
			
			/* Output the ul container for the list */
			echo '<ul class="' . $options['ul_class'] . '">' . "\n";
			
			foreach ($findposts as $findpost):
				if ( ( ( $findpost->ID ) == $id ) && ( $options['link_current'] == "1" ) ) {
					// we have the current post and link is to be shown
					echo '<li class="' . $serial_value_css . ' current-active"><a href="' . get_permalink($findpost->ID) . '" title="' . $findpost->post_title . '">';
					echo $findpost->post_title;
					echo '</a></li>' . "\n";
				} elseif ( ( $findpost->ID ) != $id ) {
					// all other posts except the current post
					echo '<li class="' . $serial_value_css . '"><a href="' . get_permalink($findpost->ID) . '" title="' . $findpost->post_title . '">';
					echo $findpost->post_title;
					echo '</a></li>' . "\n";
				} else {					
					// this must be the current post and link is not to be shown
					echo '<li class="' . $serial_value_css . ' current-inactive">' . $findpost->post_title . '</a></li>' . "\n";
				}
    		endforeach;
			/* Finish off the XHTML */
			echo '</ul>' . "\n";
			echo '</div>' . "\n";
		endif;
	}
}


/* Function to create action called in a template file
NOT CURRENTLY USED */
function serp_show_list() {
	/* Print gallery HTML */
	serial_posts();
}
add_action('list_serialposts', 'serp_show_list');


/* Setup the plugin and create Admin settings page */
function serp_setup() {
	serp_load_textdomain();
	if ( current_user_can('manage_options') && function_exists('add_options_page') ) {
		add_options_page('Serial Posts Options', 'Serial Posts', 'manage_options', 'serialposts-plugin.php', 'serp_options_page');
		add_filter( 'plugin_action_links', 'serp_filter_plugin_actions', 10, 2 );
		serp_set_options();
	}
}
add_action('admin_menu', 'serp_setup');


/* serp_filter_plugin_actions() - Adds a "Settings" action link to the plugins page */
function serp_filter_plugin_actions($links, $file){
	static $this_plugin;

	if( !$this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if( $file == $this_plugin ){
		$settings_link = '<a href="admin.php?page=serialposts-plugin.php">' . __('Settings') . '</a>';
		$links = array_merge( array($settings_link), $links); // before other links
	}
	return $links;
}


/* Create the options and provide some defaults */
function serp_set_options() {
	// Provide some defaults
	$serp_new_options = array(
		'pre_text' => 'You are reading',
		'post_text' => 'Read more from this series of articles.',
		'ul_class' => 'serial-posts',
		'list_current' => '1',
		'link_current' => '0',
		'reset' => 'false',
	);
	
	add_option('serp_plugin_settings', $serp_new_options );
}


/* Only for WP versions less than 2.7
Delete the options when plugin is deactivated */
function serp_unset_options() {
	delete_option('serp_plugin_settings');
}

/* Determine whether to register deactivation hook
if installed on pre 2.7 WP. */
// Are we in WP 2.7+ ?
if ( function_exists('register_uninstall_hook') ) {
     // We are in 2.7+, so do nothing
} else {
	// we're in < 2.7 so register the deactivation hook
     register_deactivation_hook(__FILE__, 'serp_unset_options');
}	


/* Display and handle the options page */
function serp_options_page(){
	// Are we in WPMU?
	if ( function_exists('wpmu_create_blog') ) {
		// Yes, load the WPMU options page
		include_once('serp-wpmu-ui.php');
		// No, load the WP options page
		} else { include_once('serp-wp-ui.php');
	}
}
