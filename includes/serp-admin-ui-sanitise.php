<?php
/**	This file is part of the SERIAL POSTS Plugin
*	********************************************
*	Copyright 2008-2009  Ade WALKER  (email : info@studiograsshopper.ch)
*
* 	@package	serial_posts
*	@version	1.1
*
*	Sanitise Settings screen Options input.
*	register_settings() callback function.
*
*	@since 1.1
*/

/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit( __('Sorry, you are not allowed to access this file directly.') );
}


// Callback function for register_settings()
function serp_sanitise($input) {
	
	global $serp_options;
	
	// Is the user allowed to do this? Probably not needed...
	if ( function_exists('current_user_can') && !current_user_can('manage_options') ) {
		die( __('Sorry. You do not have permission to do this.', SGR_SERP_DOMAIN) );
	}
	
	
	
	/* If RESET button has been clicked, reset the options, and don't bother sanitising */
	
	if ( $input['reset'] ) {
		
		// put back the defaults
		$input = serp_default_options();
		
		// we need this for use in add_action('admin_notices', 'serp_notice_reset')
		$input['just-reset'] = esc_attr('true');
		
		return $input;
	}
	
	
	/***** Some error messages for later *****/
	
	// Generic error message - triggered by wp_die
	$sanitise_error = esc_attr__('An error has occurred. Go back and try again.', SGR_SERP_DOMAIN);
	
	
	/***** Now correct certain options *****/
	
	// trim whitespace - all options
	foreach( $input as $key => $value ) {
		$input[$key] = trim($value);
	}
	
	// deal with just-reset option, overwrite it in case it's 'true'
	$input['just-reset'] = '0';
	
	
	/***** Organise the options by type etc, into arrays, then sanitise / validate / format correct *****/
	
	//	On-off options														(3)
	//	Bool options														(1)
	//	String options - no XHTML allowed									(3)
	
	
	
	/***** On-off options (3) *****/
	
	$onoff_opts = array( 'list_current', 'link_current', 'hide_serial_name' );
	
	// sanitise, cast as 1 or 0, eg checkboxes
	foreach( $onoff_opts as $key ) {
		$input[$key] = $input[$key] ? '1' : '0';
	}
	
	
	/***** Bool options (1) *****/
	
	$bool_opts = array( 'just-reset' );
	
	// sanitise, eg RESET checkbox
	foreach( $bool_opts as $key ) {
		$input[$key] = $input[$key] ? 'true' : 'false';
	}
	
	
	/***** String options - no XHTML allowed (3) *****/
	
	$str_opts_no_html = array( 'pre_text', 'post_text' );
	
	// sanitise
	foreach( $str_opts_no_html as $key ) {
		$input[$key] = wp_filter_nohtml_kses( $input[$key] );
	}
	
	
	// Return sanitised options array ready for db
	return $input;
}
