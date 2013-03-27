<?php
/**
 * Settings page contents - Settings API callbacks
 *
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2013
 * @package serial_posts
 * @version 1.3
 *
 * These are the functions which produce the UI postboxes for the Settings page.
 * These functions are called by Settings API add_settings_section() and add_settings_field()
 * which are defined in serp_admin_init() in serp-admin-core.php, hooked to admin_init.
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
 * Settings Callback - Display Options section
 *
 *
 */
function serp_display_settings() {
?>
	<div class="postbox">
	<h3><?php _e('Settings', 'serial-posts' ); ?></h3>
		<div class="inside">
		
			<p><?php _e('Note: the below settings apply to ALL Serials and therefore are common to all lists of Serial Posts displayed on your site.', 'serial-posts' ); ?></p>
			<p><?php _e('The Heading is made up of three text elements: "Text before" "Serial Name" "Text after". The text for "Text before" and "Text after" is entered in the fields below. If you do not want to use either or both of these, just blank out the field before saving your settings using the Save Changes button. You can also choose to hide the "Serial Name" by checking the "Hide Serial name" checkbox below.', 'serial-posts' ); ?></p>
	
<?php }


function serp_text_before_serial_name_field() {
	global $serp_options;
?>
	<textarea name="serial_posts_settings[pre-text]" cols="75" rows="2" id="serp-pre-text"><?php echo stripslashes( $serp_options['pre-text'] ); ?></textarea>
<?php }


function serp_text_after_serial_name_field() {
	global $serp_options;
?>
	<textarea name="serial_posts_settings[post-text]" cols="75" rows="2" id="serp-post-text"><?php echo stripslashes( $serp_options['post-text'] ); ?></textarea>
<?php }


function serp_hide_serial_name_field() {
	global $serp_options;
?>
	<input name="serial_posts_settings[hide-serial-name]" type="checkbox" id="serp-hide-serial-name" value="1" <?php checked('1', $serp_options['hide-serial-name']); ?> />&nbsp;<em><?php _e('Check the box if you want to hide the Serial name from the list title. Note that this will also hide the Text after Serial name.'); ?> <?php _e('Default is UNCHECKED.', 'serial-posts' ); ?></em>
<?php }


function serp_list_type_field() {
	global $serp_options;
?>
	<select name="serial_posts_settings[list-type]">
	<option style="padding-right:10px;" value="ul" <?php selected('ul', $serp_options['list-type']); ?>>ul</option>
	<option style="padding-right:10px;" value="ol" <?php selected('ol', $serp_options['list-type']); ?>>ol</option>
	</select>&nbsp;<em><?php _e('Select either unordered list &lt;ul&gt; or ordered list &lt;ol&gt;.', 'serial-posts' ); ?> <em><?php _e('Default is &lt;ul&gt;.', 'serial-posts' ); ?></em>
<?php }


function serp_list_ul_class_field() {
	global $serp_options;
?>
	<input name="serial_posts_settings[ul-class]" id="serp-ul-class" size="20" value="<?php echo $serp_options['ul-class']; ?>" />&nbsp;<em><?php _e('Alphanumeric and hyphens only. Note that the plugin replaces any whitespace with hyphens. Default is "serial-posts".', 'serial-posts' ); ?></em>
<?php }


function serp_include_current_post_field() {
	global $serp_options;
?>
	<input name="serial_posts_settings[list-current]" type="checkbox" id="serp-list-current" value="1" <?php checked('1', $serp_options['list-current']); ?> />&nbsp;<em><?php _e('Check the box if you want to include the currently viewed Post/Page in the list of Serial Posts.', 'serial-posts' ); ?> <?php _e('Default is CHECKED.', 'serial-posts' ); ?></em>
<?php }


function serp_link_current_post_field() {
	global $serp_options;
?>
	<input name="serial_posts_settings[link-current]" type="checkbox" id="serp-link-current" value="1" <?php checked('1', $serp_options['link-current']); ?> />&nbsp;<em><?php _e('If you have checked "Include current post", check this box if you want the current Post/Page to be shown as a link.', 'serial-posts' ); ?> <?php _e('Default is UNCHECKED.', 'serial-posts' ); ?></em>
	
<?php }