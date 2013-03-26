<?php
/**
 * Admin Core functions - this is the parent file that handles all the backend
 *
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2013
 * @package serial_posts
 * @version 1.3
 *
 * Core Admin Functions called by various add_filters and add_actions:
 * - Load textdomain
 * - Register Settings
 * - Add Settings Page
 * - Plugin action links
 * - Plugin row meta
 * - WP Version check
 * - Admin Notices for Settings reset
 * - Options handling and upgrading
 *
 * @since 1.1
 */


/**
 * Prevent direct access to this file
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( _( 'Sorry, you are not allowed to access this file directly.' ) );
}



/**	
 * Load textdomain for Internationalisation functionality
 *
 *
 * Called by serp_add_page() in serp-wp-ui.php
 *
 * Loads textdomain if $serp_text_loaded (global variable) is false
 *
 * Note: .mo file should be named dynamic_content_gallery-xx_XX.mo and placed in the DCG plugin's languages folder.
 * xx_XX is the language code
 * For example, for French, file should be named: dynamic_content_gallery-fr_FR.mo
 *
 * WP_LANG constant must also be defined correctly in wp-config.php.
 *
 * @since 1.0
 * @updated 1.3
 */
function serp_load_textdomain() {
	
	global $serp_text_loaded;
   	
	// If textdomain is already loaded, do nothing
	if ( $serp_text_loaded )
		return;
	
	// Textdomain isn't already loaded, let's load it
	// $domain = serial-posts, $abs_rel_path = false, $plugin_rel_path = SGR_SERP_LANG_DIR_REL )
   	load_plugin_textdomain( 'serial-posts', false, SGR_SERP_LANG_DIR_REL );
   	
	// Change variable to prevent loading textdomain again
	$serp_text_loaded = true;
}



/***** Admin Init *****/

/** 
 * Register Settings as per new API, 2.7+
 *
 * Hooked to 'admin_init'
 *
 * Note: This function ws previously named serp_init()
 *
 * settings_fields() serp_plugin_settings = Options Group name (do_settings name)
 * serial_posts_settings = Option Name in db
 *
 * @since 1.1
 * @updated 1.3
 */
function serp_admin_init() {

	// $page, the slug of the settings page as per its URL (also used by do_settings_section)
	$page = 'serial_posts';
	
	
	// Group name, db options name, sanitise callback function
	register_setting( 'serp_plugin_settings', 'serial_posts_settings', 'serp_sanitise' );
	
	
	// ID of section, display title (not used), callback function for display, $page(do_settings_section name)
	//add_settings_section('serp_general', '', 'serp_general_text', 'serial_posts');
	
	// ID of section, display title (not used), callback function for display, $page(do_settings_section name)
	add_settings_section('serp_display_settings', '', 'serp_display_settings', $page);
	
	
	// ID of field, field title, callback for display, $page(do_settings_section name), ID of related section, $args(not used)
	add_settings_field('serp_text_before_serial_name', __('Text before Serial name:', 'serial-posts'), 'serp_text_before_serial_name_field', 'serial_posts', 'serp_display_settings');
	
	// ID of field, field title, callback for display, $page(do_settings_section name), ID of related section, $args(not used)
	add_settings_field('serp_text_after_serial_name', __('Text after Serial name:', 'serial-posts'), 'serp_text_after_serial_name_field', 'serial_posts', 'serp_display_settings');
	
	// ID of field, field title, callback for display, $page(do_settings_section name), ID of related section, $args(not used)
	add_settings_field('serp_hide_serial_name', __('Hide Serial name:', 'serial-posts'), 'serp_hide_serial_name_field', $page, 'serp_display_settings');
	
	// ID of field, field title, callback for display, $page(do_settings_section name), ID of related section, $args(not used)
	add_settings_field('serp_list_type', __('List type &lt;ul&gt; or &lt;ol&gt;:', 'serial-posts'), 'serp_list_type_field', $page, 'serp_display_settings');
	
	// ID of field, field title, callback for display, $page(do_settings_section name), ID of related section, $args(not used)
	add_settings_field('serp_list_ul_class', __('List &lt;ul&gt;/&lt;ol&gt; class:', 'serial-posts'), 'serp_list_ul_class_field', $page, 'serp_display_settings');
	
	// ID of field, field title, callback for display, $page(do_settings_section name), ID of related section, $args(not used)
	add_settings_field('serp_include_current_post', __('Include current post:', 'serial-posts'), 'serp_include_current_post_field', $page, 'serp_display_settings');
	
	// ID of field, field title, callback for display, $page(do_settings_section name), ID of related section, $args(not used)
	add_settings_field('serp_link_current_post', __('Show current post as a link:', 'serial-posts'), 'serp_link_current_post_field', $page, 'serp_display_settings');
}



/***** Settings Page and Plugins Page Functions *****/

/**
 * Create Admin settings page and populate options
 *
 * Hooked to 'admin_menu'
 *
 * @uses serp_options_page() - add_options_page callback
 * @uses serp_load_options()
 *
 * @since 0.9
 * @updated 1.3
 */	
function serp_add_page() {
	
	global $serp_page_hook;
	
	// Populate plugin's options - now runs before Settings Page is loaded. Duh!
	serp_load_options();
	
	// Add Settings Page
	$serp_page_hook = add_options_page( 'Serial Posts Options', 'Serial Posts', 'manage_options', SGR_SERP_FILE_HOOK, 'serp_options_page' );
}


/**	
 * Display the Settings page
 *
 * This is the callback for add_options_page in serp_add_page()
 *
 * @since 0.9
 *
 * @global array $serp_options, plugin options from db
 */	
function serp_options_page(){
	global $serp_options;
	include_once( SGR_SERP_DIR . '/includes/serp-admin-ui-screen.php' );
}


/**
 * Filter callback to display a Settings link in main Plugin page in Dashboard
 *
 * Hooked to 'plugin_action_links' filter
 *
 * Puts the 'Settings' link in with Deactivate link in Plugins page
 *
 * @since 0.9
 *
 * @param array $links Default links shown in first column, main Dashboard Plugins page
 * @param string $file File name of main plugin file
 * @return array $links Modified array of links to be shown in first column, main Dashboard Plugins page
 */	
function serp_filter_plugin_actions( $links, $file ) {
	static $this_plugin;

	if( !$this_plugin ) $this_plugin = plugin_basename( __FILE__ );

	if( $file == SGR_SERP_FILE_NAME ) {
		$settings_link = sprintf( '<a href="admin.php?page=%s">%s</a>', SGR_SERP_FILE_HOOK, __( 'Settings' ) );
		$links = array_merge( $links, array( $settings_link ) ); // after other links
	}
	return $links;
}


/**
 * Filter callback to display Plugin Meta Links in main Plugin page in Dashboard
 *
 * Hooked to 'plugin_row_meta filter' so only works for WP 2.8+
 *
 * Adds additional meta links in the plugin's info section in main Plugins Settings page
 * Note: these links will only appear if plugin is activated
 *
 * @since 1.1
 *
 * @param array $links Default links for each plugin row
 * @param string $file Plugins.php filehook, ie the plugin's file name
 * @return array $links Modified array of links for Serial Posts Plugin's plugin row
 */	
function serp_plugin_meta( $links, $file ) {
 
	// Check we're only adding links to this plugin
	if( $file == SGR_SERP_FILE_NAME ) {
	
		// Create links
		$settings_link = sprintf( '<a href="admin.php?page=%s">%s</a>', SGR_SERP_FILE_HOOK, __('Settings') );
		
		$config_link = sprintf( '<a href="%s" target="_blank">%s</a>', SGR_SERP_HOME . 'configuration/', __( 'Configuration Guide', 'serial-posts' ) );
		
		$faq_link = sprintf( '<a href="%s" target="_blank">%s</a>', SGR_SERP_HOME . 'faq/', __( 'FAQ', 'serial-posts' ) );
		
		$tut_link = sprintf( '<a href="%s" target="_blank">%s</a>', SGR_SERP_HOME . 'tutorial/', __( 'Tutorial', 'serial-posts' ) );
		
		$donation_link = sprintf( '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=10131319">%s</a>', __( 'Donate', 'serial-posts' ) );
		
		return array_merge(
			$links,
			array( $settings_link, $config_link, $faq_link, $tut_link, $donation_link )
		);
	}
 
	return $links;
}


/**
 * Display Admin Notice when Settings are Reset
 *
 * Hooked to 'admin_notices'
 *
 * @since 1.1
 *
 * @global array $serp_options, plugin options from db
 * @global object $current_screen, WP Screen object
 */	
function serp_admin_notices() {
	
	global $serp_options, $current_screen;
	
	if( SGR_SERP_PAGEHOOK !== $current_screen->id )
		return;
	
	if( $serp_options['just-reset'] == 'true' ) {
	
		printf( '<div id="message" class="updated fade" style="background-color:#ecfcde; border:1px solid #a7c886;"><p><strong>%s</strong></p></div>', __( 'Serial Posts Settings have been reset to default settings.', 'serial-posts' ) );

		// Reset just-reset to false and update options accordingly
		$serp_options['just-reset'] = 'false';
		update_option( 'serial_posts_settings', $serp_options );
	}
}


/**
 * Check if required WP version is installed
 * 
 * Used by dfcg_checks_plugins_page() and dfcg_checks_settings_page()
 *
 * @since 1.3
 * @return bool Returns true if WP minimum required version is installed
 */
function serp_wp_version_check() {

	$version_ok = version_compare( get_bloginfo( "version" ), SGR_SERP_WP_VERSION_REQ, '>=' );
	
	if( $version_ok )
		return true;
	else
		return false;
}



/***** Options handling and upgrading *****/

/**
 * Default plugin options
 *	
 * Contains the latest version's default options.
 * Populates the options on first install (not upgrade) and
 * when Settings Reset is performed.
 *
 * Note: 'reset' option is not set by default as it is initialised
 * by the user when the Settings page Reset button is clicked.
 * @see serp_admin_notices()
 *
 * Used by the "upgrader" function serp_load_options().
 *	
 * 8 options
 *
 * @since 0.9
 * 
 * @return array $defaults, array of default settings for use by the plugin.
 */
function serp_default_options() {
	
	$defaults = array(
		'pre_text' => 'You are reading',
		'post_text' => 'Read more from this series of articles.',
		'ul_class' => 'serial-posts',
		'list_current' => '1',
		'link_current' => '0',
		'hide_serial_name' => '0',
		'just-reset' => 'false',
		'list-type' => 'ul'	// Options are ul or ol
	);
	
	// Return options array for use elsewhere
	return $defaults;
}


/**
 * Plugin upgrader
 *
 * Called by serp_add_page() which is hooked to 'admin_menu'
 *
 * ver 1.0 - settings are stored in serp_plugin_settings
 *
 * ver 1.1 - serp_plugin_settings is deprecated in favour of serial_posts_settings
 * ver 1.1 - added 'hide_serial_name' option
 * ver 1.1 - added 'just-reset' option
 * ver 1.1 - "Reset" is deprecated as a stored option (resetting is handled by a button now)
 *
 * ver 1.2 - added "list-type"
 * ver 1.2 - No change
 *
 * ver 1.2.1 - No change 
 *
 * ver 1.2.2 - No change
 *
 * ver 1.3 - No change
 *
 * @since 1.1
 *
 * @uses serp_default_options()
 */
function serp_load_options() {
	
	// Get current version number
	$version = get_option( 'serial_posts_version' );
	
	// Existing version is same as this version - nothing to do here...
	if( $version == SGR_SERP_VER )
		return;

	
	/***** Ok, we need to do stuff now, let's prepare *****/

	// See what we have currently stored
	$existing = get_option( 'serial_posts_settings' ); 	// v1.1+
	$legacy = get_option( 'serp_plugin_settings' );		// v0.9 and v1.0
	

	
	/***** Clean install - it's a wasteland here *****/
	
	if( empty( $existing ) && empty( $legacy ) ) {

		$new = serp_default_options();

		add_option( 'serial_posts_settings', $new );
		add_option( 'serial_posts_version', SGR_SERP_VER );

		return;
	}

	
	/***** Logic check in case old $version exists but there are no $existing - eg bad uninstall *****/
	
	if( $version && empty( $existing ) ) {
		
		$new_opts = serp_default_options(); // Clean reinstall
		
		add_option( 'serial_posts_settings', $new_opts );
		update_option( 'serial_posts_version', SGR_SERP_VER );
		
		return;
	}
	

	/***** Logic check in case $version doesn't exist but there are $existing *****/
	
	if( empty( $version ) && $existing ) {
		$existing_version = '1.0'; // Force upgrades to be run
	}


	/***** Now do upgrade routines *****/

	
	/***** Upgrade to 1.1 from 1.0 *****/
	if ( version_compare( $version, '1.1', '<' ) ) {
		
		// Move old options to new options array
		if( $legacy ) {

			$existing = array();
			
			foreach( $legacy as $key => $value ) {

				$existing[$key] = $value;
			}
		}

		// Add new options
		$new_opts['hide_serial_name'] = '0';
		$new_opts['just-reset'] = 'false';
		
		// Delete "reset" option, now deprecated
		unset( $existing['reset'] );

		// Total options = 6 + 2 - 1 = 7
		$updated = wp_parse_args( $existing, $new_opts );

		update_option( 'serial_posts_settings', $updated );
	}


	/***** Upgrade to 1.2 from 1.1 *****/
	if ( version_compare( $version, '1.2', '<' ) ) {

		$existing = get_option( 'serial_posts_settings' );		

		$new_opts['list-type'] = 'ul';

		// Total options = 7 + 1 = 8
		$updated = wp_parse_args( $existing, $new_opts );

		update_option( 'serial_posts_settings', $updated );

	}


	/***** Upgrade to 1.2.1 from 1.2 *****/
	if ( version_compare( $version, '1.2.1', '<' ) ) {

		// No changes
	}


	/***** Upgrade to 1.2.2 from 1.2.1 *****/
	if ( version_compare( $version, '1.2.2', '<' ) ) {

		// No changes
	}


	/***** Upgrade to 1.2.3 from 1.2.2 *****/
	if ( version_compare( $version, '1.2.3', '<' ) ) {

		$existing = get_option( 'serial_posts_settings' );
		$legacy = get_option( 'serp_plugin_settings' );

		// Clear old old options, if any
		if( $legacy && $existing ) 
			delete_option( 'serp_plugin_settings' );


		// Rename options
		$new_opts['pre-text'] = $existing['pre_text'];
		$new_opts['post-text'] = $existing['post_text'];
		$new_opts['ul-class'] = $existing['ul_class'];
		$new_opts['list-current'] = $existing['list_current'];
		$new_opts['link-current'] = $existing['link_current'];
		$new_opts['hide-serial-name'] = $existing['hide_serial_name'];

		// Delete old
		unset( $existing['pre_text'] );
		unset( $existing['post_text'] );
		unset( $existing['ul_class'] );
		unset( $existing['list_current'] );
		unset( $existing['link_current'] );
		unset( $existing['hide_serial_name'] );

		// Total options = 8
		$updated = wp_parse_args( $existing, $new_opts );

		update_option( 'serial_posts_settings', $updated );
	}
	
	
	/***** Upgrade to 1.3 from 1.2.3 *****/
	if ( version_compare( $version, '1.3', '<' ) ) {

		// No changes
	}

	// FINALLY, Update version no. in the db
	update_option( 'serial_posts_version', SGR_SERP_VER );
}