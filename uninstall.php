<?php
/**
 * Uninstalls plugin's options when the plugin is deleted
 *
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2013
 * @package serial_posts
 * @version 1.3
 *
 *
 * Removes options from db when plugin is deleted in Dashboard>Plugins
 *
 * @since 0.9
 */

/** 
 * Prevent direct access to this file
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( _( "Sorry, you are not allowed to access this file directly." ) );
}


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

// Delete options from database
delete_option( 'serial_posts_settings' );
delete_option( 'serial_posts_version' );

// Just in case legacy options are present
delete_option( 'serp_plugin_settings' );