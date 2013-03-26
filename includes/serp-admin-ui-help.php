<?php
/**
 * Contextual Help for SP admin page
 *
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2013
 * @package serial_posts
 * @version 1.3
 *
 * @info Uses new Screens API introduced in WP 3.3
 *
 * @since 1.3
 */


/* Prevent direct access to this file */
if ( !defined( 'ABSPATH' ) ) {
	exit( _( 'Sorry, you are not allowed to access this file directly.' ) );
}


/**
 * Only load the help screens if WP version is OK, > WP 3.3
 */
if ( serp_wp_version_check() ) {
	add_action( 'load-' . SGR_SERP_PAGEHOOK, 'serp_plugin_help' );
}


/**
 * Add contextual help to Admin Bar the new 3.3 way
 *
 * Hooked to 'load-$pagehook', therefore only runs on the SP Settings page!
 *
 * Requires WP 3.3+
 *
 * @since 1.3
 *
 * @global $current_screen object global Screen object
 */
function serp_plugin_help() {
	
	global $current_screen;
	
	$sidebar = serp_help_sidebar();
	
	$current_screen->set_help_sidebar( $sidebar );
	
	$current_screen->add_help_tab( array(
		'id'      => 'serp-help-general',
		'title'   => __( 'General info', 'serial-posts' ),
		'callback' => 'serp_help_general'
	));
	
	$current_screen->add_help_tab( array(
		'id'      => 'serp-help-assigning-posts',
		'title'   => __( 'Assigning Posts', 'serial-posts' ),
		'callback' => 'serp_help_assigning_posts'
	));

	$current_screen->add_help_tab( array(
		'id'      => 'serp-help-displaying-list',
		'title'   => __( 'Displaying List', 'serial-posts' ),
		'callback' => 'serp_help_displaying_list'
	));
	
	$current_screen->add_help_tab( array(
		'id'      => 'serp-help-template-tag',
		'title'   => __( 'Template Tag', 'serial-posts' ),
		'callback' => 'serp_help_template_tag'
	));

	$current_screen->add_help_tab( array(
		'id'      => 'serp-help-styling-list',
		'title'   => __( 'Styling the List', 'serial-posts' ),
		'callback' => 'serp_help_styling_list'
	));

}


/**
 * add_help_sidebar() callback
 * See serp_plugin_help()
 *
 * @since 1.3
 */
function serp_help_sidebar() {

	$sidebar = '<h3>'.__( 'Serial Posts Resources', 'serial-posts' ) . '</h3>';
	
	$sidebar .= 'Version: ' . SGR_SERP_VER;
	
	$sidebar .= '<ul>';
	$sidebar .= '<li><a target="_blank" href="'.SGR_SERP_HOME .'/">'. __( 'Plugin Homepage', 'serial-posts' ) .'</a></li>'; 
	$sidebar .= '<li><a target="_blank" href="'.SGR_SERP_HOME .'/configuration/">'. __( 'Configuration Guide', 'serial-posts' ) . '</a></li>';
	$sidebar .= '<li><a target="_blank" href="'.SGR_SERP_HOME .'/tutorial/">'. __( 'Tutorial', 'serial-posts' ) . '</a></li>';
	$sidebar .= '<li><a target="_blank" href="'.SGR_SERP_HOME .'/faq/">'. __( 'FAQ', 'serial-posts' ) . '</a></li>';
	$sidebar .= '<li><a target="_blank" href="'.SGR_SERP_HOME .'/changelog/">'. __( 'Change Log', 'serial-posts' ) . '</a></li>';
	$sidebar .= '<li><a target="_blank" href="'.SGR_SUPPORT_URL.'">'. __( 'Support Forum', 'serial-posts' ) . '</a></li>';
	$sidebar .= '</ul>';
	
	$sidebar .= '<p> 
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="7415216">
			<input type="image" src="https://www.paypal.com/en_US/CH/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
		</form>
	</p>';
	

	return $sidebar;
}


/**
 * General Info - add_help_tab() callback
 * See rdcg_plugin_help()
 *
 * @since 0.5
 */
function serp_help_general() {
?>
	<h3><?php _e( 'Serial Posts - General Info', 'serial-posts' ); ?></h3>
	
	<ul>
	
	<li><?php _e( 'Allows you to assign Posts and Pages to a Serial, using custom fields, and then displays a list of all Posts and Pages assigned to the same Serial.', 'serial-posts' ); ?></li>
	
	<li><?php _e( 'Designed for authors who wish to group Posts and Pages into series - independently of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serials as you wish, and assign these to any Posts and Pages that you wish to group together, to create a wide variety of "related post" or other Post/Page groupings.', 'serial-posts' ); ?></li>
	<li><strong><?php _e( 'Limitation:', 'serial-posts' ); ?></strong> <?php _e( 'Currently it is not possible to assign more than one Serial name to any one Post or Page.', 'serial-posts' ); ?></li>
	
	</ul>
	
	<p><strong><?php _e('If you have found this plugin useful, please consider making a donation to help support future development. Your support will be much appreciated. Thank you!', 'serial-posts' ); ?></strong></p>

<?php
}


/**
 * General Info - add_help_tab() callback
 * See rdcg_plugin_help()
 *
 * @since 0.5
 */
function serp_help_assigning_posts() {
?>
	<h3><?php _e( 'Serial Posts - Assigning Posts', 'serial-posts' ); ?></h3>
	
	<p><?php _e('In the Write/Edit Post/Page screen add the following Custom Field to each Post/Page that you wish to treat as being part of a Serial:', 'serial-posts' ); ?></p>
	<ul>
		<li><strong><?php _e('Custom Field Key', 'serial-posts' ); ?> = Serial</strong>. <?php _e('This is required for all series that you create.', 'serial-posts' ); ?></li>
		<li><strong><?php _e('Custom Field Value = specific name', 'serial-posts' ); ?></strong> <?php _e('for this series or group of Posts/Pages. For example, "<em>My first series</em>".', 'serial-posts' ); ?></li>
	</ul>
	<p><?php _e('There is no limit to the number of Serials that you can create. However, you can only assign a single Serial to any one Post or Page.', 'serial-posts' ); ?></p>
	
	

<?php
}


/**
 * General Info - add_help_tab() callback
 * See rdcg_plugin_help()
 *
 * @since 0.5
 */
function serp_help_displaying_list() {
?>
	<h3><?php _e( 'Serial Posts - Displaying List', 'serial-posts' ); ?></h3>
	
	<p><?php _e('To display the list of Posts belonging to the same Serial, add the shortcode directly into the post editor when writing or editing a Post or Page. Normally, this will be placed at the bottom, after all the other content, though you can place the shortcode anywhere within the Post content - wherever makes sense to you.', 'serial-posts' ); ?></p>
	
	<p><code>[serialposts]</code></p>

<?php
}


/**
 * Theme Integration - add_help_tab() callback
 * See serp_plugin_help()
 *
 * @since 0.5
 */
function serp_help_template_tag() {
?>
	<h3><?php _e( 'Serial Posts - Template Tag', 'serial-posts' ); ?></h3>
	
	<p><?php _e( 'Most users will want to display the Serial posts list using the plugin\'s shortcode inserted in the Post content. However, for advanced users, there is also a Template Tag which can be used in your theme templates instead of using the shortcode:', 'serial-posts' ); ?></p>
	
	<code>&lt;php serial_posts(); ?&gt;</code><br /><br />
	
	<p><?php _e( 'Note: the Template Tag is provided for advanced users who know what they are doing. The recommended method of displaying the Serial Posts list is to use the shortcode in relevant Posts as described in the Assigning Posts section of this Help.', 'serial-posts' ); ?></p>

<?php
}


/**
 * General Info - add_help_tab() callback
 * See rdcg_plugin_help()
 *
 * @since 0.5
 */
function serp_help_styling_list() {
?>
	<h3><?php _e( 'Serial Posts - Styling List', 'serial-posts' ); ?></h3>
	
	<p><?php _e('The plugin outputs the list of Serial Posts with the following XHTML and CSS markup:', 'serial-posts' ); ?></p>
			<ul>
				<li><?php _e('The entire list is contained in a &lt;div&gt; which is automatically assigned an ID of "serial-posts-wrapper".', 'serial-posts' ); ?></li>
				<li><?php _e('A List Heading in &lt;h3&gt; tags assigned a class of "serial-posts-heading".', 'serial-posts' ); ?></li>
				
				<li><?php _e('You can choose whether to display the list as an unordered list &lt;ul&gt; or ordered list &lt;ol&gt;.', 'serial-posts' ); ?></li>
				<li><?php _e('Additionally, to allow even greater control over the styling of the list, you may specify a class name for the &lt;ul&gt; or &lt;ol&gt; tag.', 'serial-posts' ); ?></li>
				<li><?php _e('The &lt;li&gt; tags are automatically assigned a class of "serial-posts-list-item".', 'serial-posts' ); ?></li>
				<li><?php _e('For full details of the CSS markup automatically added to the XHTML for the Heading and the list of posts please refer to the', 'serial-posts' ); ?> <a href="<?php echo SGR_SERP_HOME; ?>configuration/"><?php _e('Serial Posts Configuration', 'serial-posts' ); ?></a> <?php _e('page', 'serial-posts' ); ?>.</li>
			</ul>

<?php
}