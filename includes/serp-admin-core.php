<?php
/**	This file is part of the SERIAL POSTS Plugin
*	********************************************
*	Copyright 2008-2009  Ade WALKER  (email : info@studiograsshopper.ch)
*
* 	@package	serial_posts
*	@version	1.1
*
*	Core Admin Functions called by various add_filters and add_actions:
*		- Register Settings
*		- Add Settings Page
*		- Plugin action links
*		- Plugin row meta
*		- WP Version check
*		- Admin Notices for Settings reset
*		- Options handling and upgrading
*
*	@since	1.1
*
*/

/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit( __('Sorry, you are not allowed to access this file directly.', SGR_SERP_DOMAIN) );
}



/***** Admin Init *****/

/** Register Settings as per new API, 2.7+
*
*	Hooked to admin_init
*
*	@uses	serp_sanitise() = callback function for sanitising options
*
*	serp_plugin_settings_options 	= Options Group name (do_settings name)
*	serial_posts_settings 			= Option Name in db
*
*	@since	1.1
*/
function serp_init() {

	// Group name, db options name, sanitise callback function
	register_setting( 'serp_plugin_settings_options', 'serial_posts_settings', 'serp_sanitise' );
	
	
	// ID of section, display title (not used), callback function for display, do_settings name
	add_settings_section('serp_general', '', 'serp_general_text', 'serial_posts_settings_sections');
	
	
	// ID of section, display title (not used), callback function for display, do_settings name
	add_settings_section('serp_listoptions', '', 'serp_listoptions_text', 'serial_posts_settings_sections');
	
	// ID of field, field title, callback function for display, do_settings name, ID of related section
	add_settings_field('serp_text_before_serial_name', __('Text before Serial name:', SGR_SERP_DOMAIN), 'serp_text_before_serial_name_field', 'serial_posts_settings_sections', 'serp_listoptions');
	
	// ID of field, field title, callback function for display, do_settings name, ID of related section
	add_settings_field('serp_text_after_serial_name', __('Text after Serial name:', SGR_SERP_DOMAIN), 'serp_text_after_serial_name_field', 'serial_posts_settings_sections', 'serp_listoptions');
	
	// ID of field, field title, callback function for display, do_settings name, ID of related section
	add_settings_field('serp_hide_serial_name', __('Hide Serial name:', SGR_SERP_DOMAIN), 'serp_hide_serial_name_field', 'serial_posts_settings_sections', 'serp_listoptions');
	
	// ID of field, field title, callback function for display, do_settings name, ID of related section
	add_settings_field('serp_list_ul_class', __('List &lt;ul&gt; class:', SGR_SERP_DOMAIN), 'serp_list_ul_class_field', 'serial_posts_settings_sections', 'serp_listoptions');
	
	// ID of field, field title, callback function for display, do_settings name, ID of related section
	add_settings_field('serp_include_current_post', __('Include current post:', SGR_SERP_DOMAIN), 'serp_include_current_post_field', 'serial_posts_settings_sections', 'serp_listoptions');
	
	// ID of field, field title, callback function for display, do_settings name, ID of related section
	add_settings_field('serp_link_current_post', __('Show current post as a link:', SGR_SERP_DOMAIN), 'serp_link_current_post_field', 'serial_posts_settings_sections', 'serp_listoptions');
}



/***** Settings Page and Plugins Page Functions *****/

/**	Create Admin settings page and populate options
*
*	@uses	serp_load_textdomain()
*	@uses	serp_options_page()
*	@uses	serp_set_gallery_options()
*
*	@since	0.9
*/	
function serp_add_page() {
	
	serp_load_textdomain();
	
	// check user credentials
	if ( current_user_can('manage_options') && function_exists('add_options_page') ) {
		
		// Add Settings Page
		$serppage = add_options_page('Serial Posts Options', 'Serial Posts', 'manage_options', SGR_SERP_FILE_HOOK, 'serp_options_page');
		
		// Populate plugin's options
		serp_set_gallery_options();
	}
	
	return $serppage;
}


/**	Display the Settings page
*
*	Used by serp_add_page()
*
*	@since	0.9
*/	
function serp_options_page(){
	global $serp_options;
	include_once( SGR_SERP_DIR . '/includes/serp-admin-ui-screen.php' );
}


/**	Display a Settings link in main Plugin page in Dashboard
*
*	Puts the Settings link in with Deactivate/Activate links in Plugins Settings page
*
*	Hooked to plugin_action_links filter
*
*	@since	0.9
*/	
function serp_filter_plugin_actions($links, $file){
	static $this_plugin;

	if( !$this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if( $file == SGR_SERP_FILE_NAME ) {
		$settings_link = '<a href="admin.php?page=' . SGR_SERP_FILE_HOOK . '">' . __('Settings') . '</a>';
		$links = array_merge( array($settings_link), $links); // before other links
	}
	return $links;
}


/**	Display Plugin Meta Links in main Plugin page in Dashboard
*
*	Adds additional meta links in the plugin's info section in main Plugins Settings page
*
*	Hooked to plugin_row_meta filter, so only works for WP 2.8+
*
*	@since	1.1
*/	
function serp_plugin_meta($links, $file) {
 
	// $file is the main plugin filename
 
	// Check we're only adding links to this plugin
	if( $file == SGR_SERP_FILE_NAME ) {
	
		// Create links
		$settings_link = '<a href="admin.php?page=' . SGR_SERP_FILE_HOOK . '">' . __('Settings') . '</a>';
		$config_link = '<a href="http://www.studiograsshopper.ch/serial-posts/configuration/" target="_blank">' . __('Configuration Guide', SGR_SERP_DOMAIN) . '</a>';
		$faq_link = '<a href="http://www.studiograsshopper.ch/serial-posts/faq/" target="_blank">' . __('FAQ', SGR_SERP_DOMAIN) . '</a>';
		$tut_link = '<a href="http://www.studiograsshopper.ch/serial-posts/tutorial/" target="_blank">' . __('Tutorial', SGR_SERP_DOMAIN) . '</a>';
		$donation_link = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=10131319">' . __('Donate', SGR_SERP_DOMAIN) . '</a>';
		
		return array_merge(
			$links,
			array( $settings_link, $config_link, $faq_link, $tut_link, $donation_link )
			
		);
	}
 
	return $links;
}


/**	Function to do WP Version check
*
*	SP v1.1 requires WP 2.8+ to run. This function prints a warning
*	message in the main Plugins screen and on the Serial Posts Settings page if version is less than 2.8.
*
*	Called by add_filter('after_action_row_$plugin', )
*
*	@since	1.1
*/	
function serp_wp_version_check() {
	
	$wp_valid = version_compare(get_bloginfo("version"), SGR_SERP_WP_VERSION_REQ, '>=');
	
	$current_page = basename($_SERVER['PHP_SELF']);
	
	// Check we are on the right screen
	if( $current_page == "plugins.php" ) {
	
		if( $wp_valid ) {
			// Do nothing
			return;
			
		} elseif( !function_exists('wpmu_create_blog') ) {
			// We're in WP
			$version_message = '<tr class="plugin-update-tr"><td class="plugin-update" colspan="3">';
			$version_message .= '<div class="update-message" style="background:#FFEBE8;border-color:#BB0000;">';
			$version_message .= __('Warning! This version of Serial Posts requires Wordpress', SGR_SERP_DOMAIN) . ' <strong>' . SGR_SERP_WP_VERSION_REQ . '</strong>+ ' . __('Please upgrade Wordpress to run this plugin.', SGR_SERP_DOMAIN);
			$version_message .= '</div></td></tr>';
			echo $version_message;
			
		} else {
			// We're in WPMU
			$version_message = '<tr class="plugin-update-tr"><td class="plugin-update" colspan="3">';
			$version_message .= '<div class="update-message" style="background:#FFEBE8;border-color:#BB0000;">';
			$version_message .= __('Warning! This version of Serial Posts requires WPMU', SGR_SERP_DOMAIN) . ' <strong>' . SGR_SERP_WP_VERSION_REQ . '</strong>+ ' . __('Please contact your Site Administrator.', SGR_SERP_DOMAIN);
			$version_message .= '</div></td></tr>';
			echo $version_message;
		}
	}
	
	// This will also show the version warning message on the SP Settings page and at the top of the Plugins page
	// We only need to check against options-general.php because this part of the function
	// will only be run by the calling function serp_on_load_validation() which is only run when we're on the SP page.
	// TODO: Would be better to match against SP page hook though...
	if( $current_page == "options-general.php" || $current_page == "plugins.php" ) {
		
		$version_msg_start = '<div class="error"><p>';
		$version_msg_end = '</p></div>';
		
		if( wp_valid ) {
			// Do nothing
			return;
			
		} elseif( !function_exists('wpmu_create_blog') ) {
			// We're in WP
			$version_msg .= '<strong>' . __('Warning! This version of Serial Posts requires Wordpress', SGR_SERP_DOMAIN) . ' ' . SGR_SERP_WP_VERSION_REQ . '+ ' . __('Please upgrade Wordpress to run this plugin.', SGR_SERP_DOMAIN) . '</strong>';
			echo $version_msg_start . $version_msg . $version_msg_end;
			
		} else {
			// We're in WPMU
			$version_msg .= '<strong>' . __('Warning! This version of Serial Posts requires WPMU', SGR_SERP_DOMAIN) . ' ' . SGR_SERP_WP_VERSION_REQ . '+ ' . __('Please contact your Site Administrator.', SGR_SERP_DOMAIN) . '</strong>';
			echo $version_msg_start . $version_msg . $version_msg_end;
		}
	}
}


/**	Function to display Admin Notices
*
*	Displays Admin Notices after Settings are reset etc
*
*	Hooked to admin_notices action
*
*	@since	1.1
*/	
function serp_admin_notices() {
	
	global $serp_options;
	
	if( $serp_options['just-reset'] == 'true' ) {
	
		echo '<div id="message" class="updated fade" style="background-color:#ecfcde; border:1px solid #a7c886;"><p><strong>' . __('Serial Posts Settings have been reset to default settings.', SGR_SERP_DOMAIN) . '</strong></p></div>';

		// Reset just-reset to false and update options accordingly
		$serp_options['just-reset'] = 'false';
		update_option('serial_posts_settings', $serp_options);
	}
}



/***** Options handling and upgrading *****/

/**	Function for adding default options
*	
*	Contains the latest version's default options.
*	Populates the options on first install (not upgrade) and
*	when Settings Reset is performed.
*
*	Used by the "upgrader" function serp_set_gallery_options().
*	
*	7 options
*
*	@since	0.9	
*/
function serp_default_options() {
	// Add WP/WPMU options - we'll deal with any differences in the Admin screens
	$serp_default_options = array(
		'pre_text' => 'You are reading',
		'post_text' => 'Read more from this series of articles.',
		'ul_class' => 'serial-posts',
		'list_current' => '1',
		'link_current' => '0',
		'hide_serial_name' => '0',
		'just-reset' => 'false',
	);
	
	// Return options array for use elsewhere
	return $serp_default_options;
}


/**	Function for upgrading options
*	
*	Loads options on admin_menu hook.
*	Includes "upgrader" routine to update existing install.
*
*	Called by serp_add_page() which is hooked to admin_menu
*
*	In 1.0	Settings are stored in serp_plugin_settings
*	In 1.1	serp_plugin_settings is deprecated in favour of serial_posts_settings
*	In 1.1	Added "Hide Serial name" option
*	In 1.1	Added just-reset option
*	In 1.1	"Reset" is deprecated as a stored option (resetting is handled by a button now)
*
*
*	@uses 	serp_default_options()
*	@since	1.1	
*/
function serp_set_gallery_options() {
	
	// Get currently stored options
	$serp_existing = get_option( 'serial_posts_settings' );
	$serp_old = get_option( 'serp_plugin_settings' );
	$serp_version = get_option('serial_posts_version');
	
	
	// We're in the current version already
	if( $serp_existing && $serp_version == SGR_SERP_VER ) {
	
		// Nothing to do here...
		return;
	
	
	// We're upgrading from v0.9 or v1.1
	} elseif( $serp_old && !$serp_prev_version ) {
		
		// Add v1.1 options
		$serp_old['hide_serial_name'] = '0';
		$serp_old['just-reset'] = 'false';
		
		// Delete "reset" option, now deprecated
		unset( $serp_old['reset'] );
		
		// Update settings in db
		update_option('serial_posts_settings', $serp_old);
		
		// Update version no. in the db
		update_option('serial_posts_version', SGR_SERP_VER);
		
		// Remove old settings from db - they're not needed anymore
		delete_option('serp_plugin_settings');
	
	
	// It's a clean install
	} else {
		
		// Add the new options
		$serp_new = serp_default_options();
		add_option('serial_posts_settings', $serp_new );
		
		// Add version to the options db
		add_option('serial_posts_version', SGR_SERP_VER );
	}
}
