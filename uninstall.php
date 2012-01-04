<?php
/**
 * ********************************************
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2012
 * @package serial_posts
 * @version 1.2.2
 *
 *
 *	Removes options from db when plugin is deleted in Dashboard>Plugins
 *
 *	@since	0.9
 */

/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit("Sorry, you are not allowed to access this file directly.");
}


if ( !defined('WP_UNINSTALL_PLUGIN') ) {
    exit();
}
// Delete options from database
delete_option('serial_posts_settings');
delete_option('serial_posts_version');
?>