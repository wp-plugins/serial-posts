<?php
/**
 * Admin Settings page CSS and Javascript
 *
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2013
 * @package serial_posts
 * @version 1.3
 *
 *
 * @since 1.1
 */


/**
 * Prevent direct access to this file
 */
if ( !defined( 'ABSPATH' ) ) {
	exit( __( 'Sorry, you are not allowed to access this file directly.' ) );
}


/**
 * Echo JS and CSS for the Settings Page
 *
 * Code idea from Nathan Rice, Theme Options plugin.
 *
 * @TODO Change to DCG way of dealing with admin CSS/JS
 *
 * @since 1.1
 */
function serp_options_css_js() {
echo <<<CSS

<style type="text/css">


</style>

CSS;
echo <<<JS

<script type="text/javascript">
jQuery(document).ready(function($) {
	$("#setting-error-settings_updated").fadeIn(1000).fadeTo(3000, 1).fadeOut(1000);
});
</script>

JS;
}