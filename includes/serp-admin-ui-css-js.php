<?php
/**
 *	********************************************
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2012
 * @package serial_posts
 * @version 1.2.2
 *
 * Admin Settings page CSS and Javascript
 *
 * @since 1.1
 *
 */

/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit( __('Sorry, you are not allowed to access this file directly.', SGR_DOMAIN_DOMAIN) );
}


/**	Function for loading JS and CSS for Settings Page
*
* Code idea from Nathan Rice, Theme Options plugin.
*
* @since 1.1
*/
function serp_options_css_js() {
echo <<<CSS

<style type="text/css">
.form-table th {font-size:11px;}
.metabox-holder {float:left;}
.sgr-credits {border-top:1px solid #CCCCCC;margin:10px 0px 0px 0px;padding:10px 0px 0px 0px;}
.sgr-credits p {font-size:11px;}
#sgr-info {float:right;width:260px;background:#f9f9f9;padding:0px 20px 10px 20px;margin:20px 10px 10px 10px;border:1px solid #DFDFDF;}
#sgr-info ul {list-style-type:none;margin-left:0px;}
#sgr-info img {float:left;margin:0px 10px 10px 0px;border:none;}
#sgr-info input {float:right;margin:0px 0px 10px 10px;}
#sgr-info h4 {font-size:12px;border:none;padding:0;}
div.inside {padding: 0px 10px 10px 10px;margin:0px;}
.inside p {font-size:11px;padding:0px 0px 0px 0px;line-height:20px;}
.inside ul {list-style-type:disc;margin-left:30px;font-size:11px;}
.inside h4 {font-size:11px;margin:1em 0;border-top:1px solid #e6e6e6;padding-top:10px;color:#005170;}
.postbox-sgr {padding:0px 10px;margin:0px;}
.error p, .updated p {font-size:11px;line-height:20px;}
.sgr-tip {margin:0px;padding:10px 0px 0px 0px;}
.key_settings {color:#D53131;}
.help-outer p, .help-outer ul, .help-outer li {font-size:11px;padding:0px 0px 0px 0px;line-height:15px;}
.help-outer h4 {margin:0px 0px 10px 0px;}
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