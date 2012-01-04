<?php
/**
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2012
 * @package serial_posts
 * @version 1.2.2
 *
 * These are the functions which produce the UI postboxes
 * for the Settings page.
 * These functions are called by Settings API add_settings_section() and add_settings_field()
 * which are defined in serp_init() in serp-admin-core.php. Hooked by admin_init.
 *
 * @since 1.1
 */


/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit( __('Sorry, you are not allowed to access this file directly.', SGR_SERP_DOMAIN) );
}

/* settings_section and settings_field callback functions called by serp_init(), hooked to admin_init() */

function serp_general_text() {
?>
	<div class="postbox">
	<h3><?php _e('General Information', SGR_SERP_DOMAIN); ?></h3>
		<div class="inside">
			<div style="float:left;width:690px;">
				<p><?php _e("Please read through this page and configure the plugin.", SGR_SERP_DOMAIN); ?><br />
				
				
				<h4><?php _e('How to assign Posts/Pages to a Serial', SGR_SERP_DOMAIN); ?></h4>
				<p><?php _e('In the Write/Edit Post/Page screen add the following Custom Field to each Post/Page that you wish to treat as being part of a Serial:', SGR_SERP_DOMAIN); ?></p>
				<ul>
					<li><strong><?php _e('Custom Field Key', SGR_SERP_DOMAIN); ?> = Serial</strong>. <?php _e('This is required for all series that you create.', SGR_SERP_DOMAIN); ?></li>
					<li><strong><?php _e('Custom Field Value = specific name', SGR_SERP_DOMAIN); ?></strong> <?php _e('for this series or group of Posts/Pages. For example, "<em>My first series</em>".', SGR_SERP_DOMAIN); ?></li>
				</ul>
				<p><?php _e('There is no limit to the number of Serials that you can create. However, you can only assign a single Serial to any one Post or Page.', SGR_SERP_DOMAIN); ?></p>
			
				<h4><?php _e('How to display the Serial list in Posts/Pages', SGR_SERP_DOMAIN); ?></h4>
				<p><?php _e('The plugin provides two methods: a shortcode and a template tag, either of which may be used. It is recommended that you use one or the other, but not both, in accordance with your needs and preferences.', SGR_SERP_DOMAIN); ?></p>
				<p><strong><?php _e('Template tag: ', SGR_SERP_DOMAIN); ?></strong><?php _e('Add this template tag to your single post theme template file, usually single.php or index.php, depending on your theme, wherever you want to display the list of Posts/Pages. This tag must appear within the Loop.', SGR_SERP_DOMAIN); ?></p>
				<p><code>&lt;?php serial_posts(); ?&gt;</code></p>
				<p><strong><?php _e('Shortcode: ', SGR_SERP_DOMAIN); ?></strong><?php _e('Add this shortcode directly into the post editor when writing or editing a Post or Page.', SGR_SERP_DOMAIN); ?></p>
				<p><code>[serialposts]</code></p>
			</div>
		
			<?php serp_ui_sgr_info(); ?>
		
			<div style="clear:both;"></div>
		</div>
	</div>
<?php }


function serp_listoptions_text() {
?>
	<div class="postbox">
	<h3><?php _e('List Display options', SGR_SERP_DOMAIN); ?></h3>
		<div class="inside">
			<p><?php _e('The plugin outputs the list of Serial Posts with the following XHTML and CSS markup:', SGR_SERP_DOMAIN); ?></p>
			<ul>
				<li><?php _e('The entire list is contained in a &lt;div&gt; which is automatically assigned an ID of "serial-posts-wrapper".', SGR_SERP_DOMAIN); ?></li>
				<li><?php _e('A List Heading in &lt;h3&gt; tags assigned a class of "serial-posts-heading".', SGR_SERP_DOMAIN); ?></li>
				<li><?php _e('The Heading is made up of three text elements: "Text before" "Serial Name" "Text after". The text for "Text before" and "Text after" is entered in the fields below. If you do not want to use either or both of these, just blank out the field before saving your settings using the Save Changes button. You can also choose to hide the "Serial Name" by checking the "Hide Serial name" checkbox below.', SGR_SERP_DOMAIN); ?></li>
				<li><?php _e('You can choose whether to display the list as an unordered list &lt;ul&gt; or ordered list &lt;ol&gt;.', SGR_SERP_DOMAIN); ?></li>
				<li><?php _e('Additionally, to allow even greater control over the styling of the list, you may specify a class name for the &lt;ul&gt; or &lt;ol&gt; tag.', SGR_SERP_DOMAIN); ?></li>
				<li><?php _e('The &lt;li&gt; tags are automatically assigned a class of "serial-posts-list-item".', SGR_SERP_DOMAIN); ?></li>
				<li><?php _e('For full details of the CSS markup automatically added to the XHTML for the Heading and the list of posts please refer to the', SGR_SERP_DOMAIN); ?> <a href="http://www.studiograsshopper.ch/serial-posts/configuration/"><?php _e('Serial Posts configuration', SGR_SERP_DOMAIN); ?></a> <?php _e('page', SGR_SERP_DOMAIN); ?>.</li>
			</ul>
	
<?php }


function serp_text_before_serial_name_field() {
	global $serp_options;
?>
	<textarea name="serial_posts_settings[pre_text]" cols="75" rows="2" id="serp-pre_text"><?php echo stripslashes( $serp_options['pre_text'] ); ?></textarea>
<?php }


function serp_text_after_serial_name_field() {
	global $serp_options;
?>
	<textarea name="serial_posts_settings[post_text]" cols="75" rows="2" id="serp-post_text"><?php echo stripslashes( $serp_options['post_text'] ); ?></textarea>
<?php }


function serp_hide_serial_name_field() {
	global $serp_options;
?>
	<input name="serial_posts_settings[hide_serial_name]" type="checkbox" id="serp-hide_serial_name" value="1" <?php checked('1', $serp_options['hide_serial_name']); ?> />&nbsp;<em><?php _e('Check the box if you want to hide the Serial name from the list title. Note that this will also hide the Text after Serial name.'); ?> <?php _e('Default is UNCHECKED.', SGR_SERP_DOMAIN); ?></em>
<?php }


function serp_list_type_field() {
	global $serp_options;
?>
	<select name="serial_posts_settings[list-type]">
	<option style="padding-right:10px;" value="ul" <?php selected('ul', $serp_options['list-type']); ?>>ul</option>
	<option style="padding-right:10px;" value="ol" <?php selected('ol', $serp_options['list-type']); ?>>ol</option>
	</select>&nbsp;<em><?php _e('Select either unordered list &lt;ul&gt; or ordered list &lt;ol&gt;.', SGR_SERP_DOMAIN); ?> <em><?php _e('Default is &lt;ul&gt;.', SGR_SERP_DOMAIN); ?></em>
<?php }


function serp_list_ul_class_field() {
	global $serp_options;
?>
	<input name="serial_posts_settings[ul_class]" id="serp-ul_class" size="20" value="<?php echo $serp_options['ul_class']; ?>" />&nbsp;<em><?php _e('Alphanumeric and hyphens only. Note that the plugin replaces any whitespace with hyphens. Default is "serial-posts".', SGR_SERP_DOMAIN); ?></em>
<?php }


function serp_include_current_post_field() {
	global $serp_options;
?>
	<input name="serial_posts_settings[list_current]" type="checkbox" id="serp-list_current" value="1" <?php checked('1', $serp_options['list_current']); ?> />&nbsp;<em><?php _e('Check the box if you want to include the currently viewed Post/Page in the list of Serial Posts.', SGR_SERP_DOMAIN); ?> <?php _e('Default is CHECKED.', SGR_SERP_DOMAIN); ?></em>
<?php }


function serp_link_current_post_field() {
	global $serp_options;
?>
	<input name="serial_posts_settings[link_current]" type="checkbox" id="serp-link_current" value="1" <?php checked('1', $serp_options['link_current']); ?> />&nbsp;<em><?php _e('If you have checked "Include current post", check this box if you want the current Post/Page to be shown as a link.', SGR_SERP_DOMAIN); ?> <?php _e('Default is UNCHECKED.', SGR_SERP_DOMAIN); ?></em>
	
<?php }


// Resources inner box: content
function serp_ui_sgr_info() {
?>
	<div class="postbox" id="sgr-info">
	<h4><?php _e('Resources & Support', SGR_SERP_DOMAIN); ?></h4>
	<p><a href="http://www.studiograsshopper.ch"><img src="<?php echo SGR_SERP_URL . '/admin-assets/sgr_icon_75.jpg'; ?>" alt="studiograsshopper" /></a><strong><?php _e('Serial Posts plugin for WordPress', SGR_SERP_DOMAIN); ?></strong>.<br /><?php _e('Version ', SGR_SERP_DOMAIN); ?><?php echo SGR_SERP_VER; ?><br /><?php _e('Author: ', SGR_SERP_DOMAIN); ?><a href="http://www.studiograsshopper.ch/">Ade Walker</a></p>
	<p><?php _e('For further information, or in case of configuration problems, please consult these comprehensive resources:', SGR_SERP_DOMAIN); ?></p>
	<ul>
		<li><a href="http://www.studiograsshopper.ch/serial-posts/"><?php _e('Plugin Home page', SGR_SERP_DOMAIN); ?></a></li>
		<li><a href="http://www.studiograsshopper.ch/serial-posts/configuration/"><?php _e('Configuration guide', SGR_SERP_DOMAIN); ?></a></li>
		<li><a href="http://www.studiograsshopper.ch/serial-posts/tutorial/"><?php _e('Tutorial', SGR_SERP_DOMAIN); ?></a></li>
		<li><a href="http://www.studiograsshopper.ch/serial-posts/faq/"><?php _e('FAQ', SGR_SERP_DOMAIN); ?></a></li>
		<li><a href="http://www.studiograsshopper.ch/forum/"><?php _e('Support Forum', SGR_SERP_DOMAIN); ?></a></li>
	</ul>
	<p><?php _e('If you have found this plugin useful, please consider making a donation to help support future development. Your support will be much appreciated. Thank you!', SGR_SERP_DOMAIN); ?> 
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="7415216">
			<input type="image" src="https://www.paypal.com/en_US/CH/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
	</p>
	</div>
<?php }
