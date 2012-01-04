<?php
/*
Plugin Name: Serial Posts Plugin
Plugin URI: http://www.studiograsshopper.ch/serial-posts/
Version: 1.2.2
Author: Ade Walker, Studiograsshopper
Author URI: http://www.studiograsshopper.ch
Description: Allows you to assign Posts and Pages to a Serial, using custom fields, and then displays a list of all Posts/Pages assigned to the same Serial.
*/

/*  Copyright 2008-2012  Ade WALKER  (email : info@studiograsshopper.ch)

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

	1.2.2		- Bug fix:	Fixed reset notice from appearing when it shouldn't
	
	1.2.1		- Bug fix:	Fixed settings not saving/resetting
				- Bug fix:	Temporarily disabled contextual help due to WP 3.3 incompatibility
				- Enhance:	Added SGR_SERP_HOME constant
	
	1.2			- Bug fix:	Removed dynamic id name for main div due to problems with non-valid CSS characters. Now hardcoded as "serial-posts-wrapper"
				- Bug fix:	li tags now output with class name "serial-posts-list-item"
				- Bug fix:	Corrected sanitisation of ul_class option
				- Feature:	Added dropdown option to allow either UL or OL tag for list
				- Feature:	Added class name "serial-posts-heading" to list's h3 tag
	
	1.1			- Feature:	Tidied up Internationalisation
				- Feature:	Added Settings API functions for admin page
				- Bug fix:	Improved options sanitisation and db query security
				- Feature:	Reorganised code into files
				- Bug fix:	Can now be used with Pages as well as Posts
				- Bug fix:	Added global $post to main function
				- Feature:	Added "Hide Serial name" option in Options page
	
	1.0			- Feature:	Added shortcode for use in posts
				- Bug fix:	Fixed xhtml error cauased by rogue closing </a> tag in list.
	
	0.9			- Public release
	
	0.2			- Feature:	Added more options for the list title
				- Feature:	Added automatic CSS classes to list elements
	
	0.1			- Bug fix:	Added global $id in order for get_post_meta to work.
				- Feature:	First attempt
	
*/

/* Dev Notes 
* Plugin folder:		serial-posts
* Plugin file:	 		serial-posts-plugin.php
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


/* Set constants for plugin */
define( 'SGR_SERP_URL', WP_PLUGIN_URL.'/serial-posts' );
define( 'SGR_SERP_DIR', WP_PLUGIN_DIR.'/serial-posts' );
define( 'SGR_SERP_VER', '1.2.2' );
define( 'SGR_SERP_DOMAIN', 'serial-posts' );
define( 'SGR_SERP_WP_VERSION_REQ', '2.8' );
define( 'SGR_SERP_FILE_NAME', 'serial-posts/serial-posts-plugin.php' );
define( 'SGR_SERP_FILE_HOOK', 'serial_posts' );
define( 'SGR_SERP_PAGEHOOK', 'settings_page_'.SGR_SERP_FILE_HOOK );
define( 'SGR_SERP_HOME', 'http://www.studiograsshopper.ch/serial-posts/' );


/***** Set up variables needed throughout the plugin *****/

// Internationalisation functionality
$serp_text_loaded = false;

// Load plugin options
$serp_options = get_option('serial_posts_settings');



/***** Load files needed for plugin to run ********************/

/* 	Load files needed for plugin to run
*
*	Required for Serial Posts list display
*	serp-public-core.php				Template tag, shortcode functions
*
*	Required for Admin
*	serp-admin-core.php					Main Admin Functions: add page and related functions, options handling/upgrading
*	serp-admin-ui-functions.php			Functions for outputting Settings Page elements
*	serp-admin-ui-css-js.php			Settings page CSS and JS
*	serp-admin-ui-help.php				Functions for Settings Page contextual help
*	serp-admin-ui-sanitise.php			Sanitisation callback function for register_settings
*
*	@since	1.0
*/ 
// Public files
if( !is_admin() ) {
	include_once( SGR_SERP_DIR . '/includes/serp-public-core.php');
}

// Admin-only files
if( is_admin() ) {
	require_once( SGR_SERP_DIR . '/includes/serp-admin-core.php');
	require_once( SGR_SERP_DIR . '/includes/serp-admin-ui-functions.php');
	require_once( SGR_SERP_DIR . '/includes/serp-admin-ui-css-js.php');
	require_once( SGR_SERP_DIR . '/includes/serp-admin-ui-help.php');
	require_once( SGR_SERP_DIR . '/includes/serp-admin-ui-sanitise.php');
}



/***** Add filters and actions ********************/

/* Add shortcode for post/page editor use [serialposts] */
add_shortcode('serialposts', 'serp_shortcode');

/* Admin - Register Settings as per new API */
// Function defined in serp-admin-core.php
add_action('admin_init', 'serp_init' );

/* Admin - Adds Settings page */
// Function defined in serp-admin-core.php
add_action('admin_menu', 'serp_add_page');

/* Admin - Contextual Help to Settings page */
// Function defined in serp-admin-ui-help.php
//add_filter('contextual_help', 'serp_admin_help', 10, 2);

/* Admin - Adds WP version warning on main Plugins screen */
// Function defined in serp-admin-core.php
add_action('after_plugin_row_serial-posts/serial-posts-plugin.php', 'serp_wp_version_check');

/* Admin - Adds Admin Notices when updating Settings */
// Function defined in serp-admin-core.php
add_action('admin_notices', 'serp_admin_notices');

/* Admin - Adds additional links in main Plugins page */
// Function defined in serp-admin-core.php
add_filter( 'plugin_row_meta', 'serp_plugin_meta', 10, 2 );

/* Admin - Adds additional Settings link in main Plugin page */
// Function defined in serp-admin-core.php
add_filter( 'plugin_action_links', 'serp_filter_plugin_actions', 10, 2 );



/***** Functions used by both public and admin *****/

/**	Function to load textdomain for Internationalisation functionality
*
*	Loads textdomain if $serp_text_loaded is false
*
*	Called by serp_add_page()
*	Called by serp-wp-ui.php
*	@uses	variable	$dfcg_text_loaded
*
*	@since	1.0
*/
// TODO: Is this really a public function too? Probably not.
function serp_load_textdomain() {
	
	global $serp_text_loaded;
   	
	// If domain is already loaded, do nothing
	if($serp_text_loaded) return;

   	load_plugin_textdomain(SGR_SERP_DOMAIN, false, dirname(plugin_basename(__FILE__)). '/lang');
   	
	// Set variable to prevent re-loading of domain
	$serp_text_loaded = true;
}