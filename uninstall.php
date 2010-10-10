<?php
/**	This file is part of the SERIAL POSTS Plugin
*	********************************************
*	Copyright 2008-2010  Ade WALKER  (email : info@studiograsshopper.ch)
*
* 	@package	serial_posts
*	@version	1.3
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