<?php
/**
 * Contextual Help for SP admin page
 *
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2013
 * @package serial_posts
 * @version 1.3.1
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
	
	<li><?php _e( 'The Serial Posts plugin allows you to assign a Serial name to your Posts and Pages, using custom fields, and then displays in the single post/page view a list of all Posts and Pages assigned to the same Serial. Designed for authors who wish to group Posts and Pages into series - independently of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serials as you wish, and assign these to any Posts and Pages that you wish to group together, to create a wide variety of "related post" or other Post/Page groupings.', 'serial-posts' ); ?></li>
	
	<li><?php _e( 'The Serial Posts list is displayed using the [serialposts] shortcode in the Write Post/Page Editor.', 'serial-posts' ); ?></li>
	<li><?php _e( 'The position of the Serial Posts list on your page is determined by where you insert the shortcode in your post.', 'serial-posts' ); ?></li>
	<li><?php _e( 'You can create as many different Serials as you wish. Limitation: Currently it is not possible to assign more than one Serial name to any one Post or Page.', 'serial-posts' ); ?></li>
	<li><?php _e( 'User options for including the currently viewed post in the list, with or without a link.', 'serial-posts' ); ?></li>
	<li><?php _e( 'Configurable Heading for the Serial Posts list.', 'serial-posts' ); ?></li>
	<li><?php _e( 'Valid xhtml output.', 'serial-posts' ); ?></li>
	<li><?php _e( 'Highly customisable CSS styling of the Heading and Serial Posts list.', 'serial-posts' ); ?></li>
	<li><?php _e( 'A Serial Posts template tag is also available for advanced users.', 'serial-posts' ); ?></li>
	
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
	
	<p><?php _e('In the Post/Page Editor screen add the following Custom Field to each Post/Page that you wish to treat as being part of a Serial:', 'serial-posts' ); ?></p>
	<ul>
		<li><strong><?php _e('Custom Field Key', 'serial-posts' ); ?> = Serial</strong>. <?php _e('You must always use this Custom Field key name for all Serials that you create.', 'serial-posts' ); ?></li>
		<li><strong><?php _e('Custom Field Value = specific name', 'serial-posts' ); ?></strong> <?php _e('for this particular Serial or group of Posts/Pages. For example, "<em>My first series</em>".', 'serial-posts' ); ?></li>
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
	
	<p><?php _e('To display the list of Posts belonging to the same Serial, add the shortcode directly into the Post/Page Editor when writing or editing a Post or Page. Normally, this will be placed at the bottom, after all the other content, though you can place the shortcode anywhere within the Post content - wherever makes sense to you.', 'serial-posts' ); ?></p>
	
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
	
	<p><?php _e('The plugin outputs the list of Serial Posts with the following XHTML markup:', 'serial-posts' ); ?></p>
	
	<ul>
		<li><?php _e('The entire list is contained in a &lt;div&gt; which is automatically assigned an ID of "serial-posts-wrapper".', 'serial-posts' ); ?></li>
		<li><?php _e('The List Heading is output in &lt;h3&gt; tags assigned a class of "serial-posts-heading".', 'serial-posts' ); ?></li>
		<li><?php _e('Each of the three strings which comprise the heading is wrapped in span tags.', 'serial-posts'); ?></li>
				
		<li><?php _e('The list of links to the other post/pages in the Serial are displayed as an unordered or ordered list, depending on the plugin Settings.', 'serial-posts' ); ?></li>
		<li><?php _e('Additionally, to allow even greater control over the styling of the list, you may specify a class name for the &lt;ul&gt; or &lt;ol&gt; tag.', 'serial-posts' ); ?></li>
		<li><?php _e('The &lt;li&gt; tags are automatically assigned a class of "serial-posts-list-item".', 'serial-posts' ); ?></li>
		<li><?php _e('Full details of the XHTML markup can be found in the', 'serial-posts' ); ?> <a href="<?php echo SGR_SERP_HOME; ?>/configuration/"><?php _e('Configuration Guide', 'serial-posts' ); ?></a>.</li>
	</ul>

<?php
}