<?php
/**
 * Display Settings page (echos content)
 *
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2013
 * @package serial_posts
 * @version 1.3
 *
 * Options page
 *
 * All UI functions on this page are defined in serp-admin-ui-functions.php
 * serp_load_textdomain() is defined in serial-posts-plugin.php
 */


/**
 * Prevent direct access to this file
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( _( 'Sorry, you are not allowed to access this file directly.' ) );
}


// Load text domain
serp_load_textdomain();

$serp_options = get_option( 'serial_posts_settings' );

?>

<div class="wrap" id="sgr-style"><a name="top"></a>

	<?php screen_icon( 'options-general' );// Display icon next to title ?>
	
	<h2><?php _e( 'Serial Posts Configuration', 'serial-posts' ); ?></h2>
	
	<div class="metabox-holder">
	
	<form method="post" action="options.php">
	
		<?php // Uses Group name defined in register_settings in serp_options_init()
		settings_fields( 'serp_plugin_settings' ); ?>
		
		<?php // Defines name for all add_settings_section() and add_settings_field()
		do_settings_sections( 'serial_posts' ); ?>
		
		</div>
		</div>
		<p class="submit">
			<input name="serial_posts_settings[just-reset]" id="serp-just-reset" type="hidden" value="<?php echo $serp_options['just-reset']; ?>" />
			<input class="button-primary" name="Submit" type="submit" value="<?php esc_attr_e( 'Save Changes' ); ?>" />
			<input type="submit" class="button-highlighted" name="serial_posts_settings[reset]" value="<?php esc_attr_e( 'Reset Settings', 'serial-posts' ); ?>" />
		</p>
		
	</form>
	
	<div class="sgr-credits">
		<p><?php _e( 'For further information please visit these resources:', 'serial-posts' ); ?></p>
		<p>
			<a href="<?php echo SGR_SERP_HOME; ?>"><?php _e( 'Serial Posts homepage', 'serial-posts' ); ?></a> | 
			<a href="<?php echo SGR_SERP_HOME; ?>/configuration/"><?php _e( 'Configuration guide', 'serial-posts' ); ?></a> | 
			<a href="<?php echo SGR_SERP_HOME; ?>/tutorial/"><?php _e( 'Tutorial', 'serial-posts' ); ?></a> | 
			<a href="<?php echo SGR_SERP_HOME; ?>/faq/"><?php _e( 'FAQ', 'serial-posts' ); ?></a> | 
		</p>
		<p><?php _e( 'With acknowledgements to', 'serial-posts' ); ?> <a href="http://justintadlock.com" title="Justin Tadlock">Justin Tadlock</a> <?php _e( 'whose original code idea inspired this plugin.', 'serial-posts' ); ?></p> 
		<p><?php _e( 'Serial Posts plugin for WordPress by', 'serial-posts' ); ?> <a href="http://www.studiograsshopper.ch/">Ade Walker</a>&nbsp;&nbsp;&nbsp;<strong><?php _e( 'Version: ', 'serial-posts' ); ?><?php echo SGR_SERP_VER; ?></strong></p>      
		
	</div>
	
	</div><!-- end metabox-holder -->
	
</div>