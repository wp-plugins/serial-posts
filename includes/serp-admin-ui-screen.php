<?php
/**
 * Display Settings page (echos content)
 *
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2012
 * @package serial_posts
 * @version 1.2.2
 *
 * Options page for Wordpress and Wordpress Mu.
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

// Load Settings Page JS and CSS
serp_options_css_js();
?>

<div class="wrap" id="sgr-style"><a name="top"></a>

	<?php screen_icon( 'options-general' );// Display icon next to title ?>
	
	<h2><?php _e( 'Serial Posts Configuration', SGR_SERP_DOMAIN ); ?></h2>
	
	<div class="metabox-holder">
	
	<?php serp_general_text(); ?>
	
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
			<input type="submit" class="button-highlighted" name="serial_posts_settings[reset]" value="<?php esc_attr_e( 'Reset Settings', SGR_SERP_DOMAIN ); ?>" />
		</p>
		
	</form>
	
	<div class="sgr-credits">
		<p><?php _e( 'For further information please read the README document included in the plugin download, or visit these resources:', SGR_SERP_DOMAIN ); ?></p>
		<p>
			<a href="http://www.studiograsshopper.ch/serial-posts/"><?php _e( 'Serial Posts homepage', SGR_SERP_DOMAIN ); ?></a> | 
			<a href="http://www.studiograsshopper.ch/serial-posts/configuration/"><?php _e( 'Configuration guide', SGR_SERP_DOMAIN ); ?></a> | 
			<a href="http://www.studiograsshopper.ch/serial-posts/tutorial/"><?php _e( 'Tutorial', SGR_SERP_DOMAIN ); ?></a> | 
			<a href="http://www.studiograsshopper.ch/serial-posts/faq/"><?php _e( 'FAQ', SGR_SERP_DOMAIN ); ?></a> | 
		</p>
		<p><?php _e( 'With acknowledgements to', SGR_SERP_DOMAIN ); ?> <a href="http://justintadlock.com" title="Justin Tadlock">Justin Tadlock</a> <?php _e( 'whose original code idea inspired this plugin.', SGR_SERP_DOMAIN ); ?></p> 
		<p><?php _e( 'Serial Posts plugin for WordPress by', SGR_SERP_DOMAIN ); ?> <a href="http://www.studiograsshopper.ch/">Ade Walker</a>&nbsp;&nbsp;&nbsp;<strong><?php _e( 'Version: ', SGR_SERP_DOMAIN ); ?><?php echo SGR_SERP_VER; ?></strong></p>      
		
	</div>
	
	</div><!-- end metabox-holder -->
	
</div>