<?php
/**
 * ********************************************
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2012
 * @package serial_posts
 * @version 1.2.2
 *
 * Sanitise Settings screen Options input.
 * register_settings() callback function.
 *
 * @since 1.1
 */

/* Prevent direct access to this file */
if ( ! defined( 'ABSPATH' ) ) {
	exit( _( 'Sorry, you are not allowed to access this file directly.' ) );
}


// Callback function for register_settings()
function serp_sanitise($input) {
	
	global $serp_options;
	
	// Is the user allowed to do this? Probably not needed...
	if ( function_exists('current_user_can') && !current_user_can('manage_options') ) {
		die( __('Sorry. You do not have permission to do this.', SGR_SERP_DOMAIN) );
	}
	
	
	
	/* If RESET button has been clicked, reset the options, and don't bother sanitising */
	
	if ( isset( $input['reset'] ) ) {
		
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
	
	//	Whitelist options													(1)
	//	On-off options														(3)
	//	Bool options														(1)
	//	String options - no XHTML allowed									(2)
	//	String options - no invalid CSS class characters					(1)
	
	
	/***** Whitelist options (1) *****/
	
	$whitelist_opts = array( 'list-type' );
	
	// Define whitelist of known values
	$serp_whitelist = array( 'ul', 'ol' );
	
	// sanitise
	foreach( $whitelist_opts as $key ) {
		// If option value is not in whitelist
		if( !in_array( $input[$key], $serp_whitelist ) ) {
			wp_die( "Serial Posts Message #20: " . $sanitise_error );
		}
	}
	
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
	
	
	/***** String options - no XHTML allowed (2) *****/
	
	$str_opts_no_html = array( 'pre_text', 'post_text' );
	
	// sanitise
	foreach( $str_opts_no_html as $key ) {
		$input[$key] = wp_filter_nohtml_kses( $input[$key] );
	}
	
	
	/***** String options - no invalid CSS class characters (1) *****/
	
	$str_opts_css = array( 'ul_class' );
	
	// sanitise
	foreach( $str_opts_css as $key ) {
		$input[$key] = strtolower( $input[$key] ); // convert to lowercase
		$input[$key] = preg_replace( '/^\W+/', '', $input[$key] ); // delete all leading ('/^.../') non-alphanumeric characters
		$input[$key] = preg_replace( '/\W+$/', '', $input[$key] ); // delete all trailing ('/...$/') non-alphanumeric characters
		$input[$key] = preg_replace( '/\W+/', '-', $input[$key] ); // replace remaining non-alphanumeric characters with single hyphen
		$input[$key] = preg_replace( '/\s+/', '-', $input[$key] ); // replace single or multiple spaces with a hyphen
	}
	
	
	// Return sanitised options array ready for db
	return $input;
}
