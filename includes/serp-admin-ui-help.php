<?php
/**	This file is part of the SERIAL POSTS Plugin
*	********************************************
*	Copyright 2008-2010  Ade WALKER  (email : info@studiograsshopper.ch)
*
* 	@package	serial_posts
*	@version	1.3
*
*	These are the functions which produce the Contextual Help
*	in the Settings page pull-down.
*
*	Called by add_filter('contextual_help', )
*
*	@since	1.1
*
*/


/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit( __('Sorry, you are not allowed to access this file directly.', SGR_SERP_DOMAIN) );
}


/** Add help to Admin Contextual Help pull-down
*
*	Hooked to contextual_help
*
*	@uses	serp_admin_help_content()
*
*	@since	1.1
*/
function serp_admin_help($text, $screen) {
	
	// Check we're only on the DCG Settings page
	if (strcmp($screen, SGR_SERP_PAGEHOOK) == 0 ) {
		
		$text = serp_admin_help_content();
		return $text;
	}
	// Let the default WP Dashboard help stuff through on other Admin pages
	return $text;
}


/** Admin Contextual Help content
*
*	Used by serp_admin_help()
*
*	Contains actual content displayed in Contextual Help pull-down
*
*	@since	1.1
*/
function serp_admin_help_content() {
?>

	<div class="help-outer"><h3><?php _e('Serial Posts - Quick Help', SGR_SERP_DOMAIN); ?></h3>
		<p><?php _e('This Quick Help guide highlights some basic points only. Detailed guides to using the plugin can be found here:', SGR_SERP_DOMAIN); ?></p>
		<p>
			<a href="http://www.studiograsshopper.ch/serial-posts/"><?php _e('Serial Posts homepage', SGR_SERP_DOMAIN); ?></a> | 
			<a href="http://www.studiograsshopper.ch/serial-posts/configuration/"><?php _e('Configuration guide', SGR_SERP_DOMAIN); ?></a> | 
			<a href="http://www.studiograsshopper.ch/serial-posts/tutorial/"><?php _e('Tutorial', SGR_SERP_DOMAIN); ?></a> | 
			<a href="http://www.studiograsshopper.ch/serial-posts/faq/"><?php _e('FAQ', SGR_SERP_DOMAIN); ?></a> | 
		</p>
		
		<h4><?php _e('Understanding the basics', SGR_SERP_DOMAIN); ?></h4>
		<p><ul>
			<li><?php _e('Allows you to assign Posts and Pages to a Serial, using custom fields, and then displays a list of all Posts and Pages assigned to the same Serial.', SGR_SERP_DOMAIN); ?></li>
			<li><?php _e('The Serial Posts list can be displayed using either the [serialposts] shortcode in the Write Post/Page Editor, or by using the Serial Posts template tag in your theme template files.', SGR_SERP_DOMAIN); ?></li>
			<li><?php _e('The position of the Serial Posts list on your page is determined by where you insert the shortcode in your post, or where you insert the Serial Posts template tag in your template file.', SGR_SERP_DOMAIN); ?></li>
			<li><?php _e('Designed for authors who wish to group Posts and Pages into series - independently of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serials as you wish, and assign these to any Posts and Pages that you wish to group together, to create a wide variety of "related post" or other Post/Page groupings.', SGR_SERP_DOMAIN); ?></li>
			<li><strong></strong><?php _e('Limitation:', SGR_SERP_DOMAIN); ?></strong> <?php _e('Currently it is not possible to assign more than one Serial name to any one Post or Page.', SGR_SERP_DOMAIN); ?></li>
		</ul></p>
		<p><strong><?php _e('Still a bit lost?', SGR_SERP_DOMAIN); ?></strong> <?php _e('Find out more in the', SGR_SERP_DOMAIN); ?> <a href="http://www.studiograsshopper.ch/serial-posts/configuration/"><?php _e('Configuration guide', SGR_SERP_DOMAIN); ?></a> <?php _e('and', SGR_SERP_DOMAIN); ?> <a href="http://www.studiograsshopper.ch/serial-posts/tutorial/"><?php _e('Tutorial', SGR_SERP_DOMAIN); ?></a>.</p>
	</div>
<?php
}