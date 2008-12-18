<?php
/* This file is part of the SERIAL POSTS Plugin Version 0.9
***********************************************************
Copyright 2008  Ade WALKER  (email : info@studiograsshopper.ch)

Options Page for Wordpress and Mu
*/

serp_load_textdomain();

// Handle the updating of options
	if( isset($_POST['info_update']) ) {
		
		// Is the user allowed to do this?
		if ( function_exists('current_user_can') && !current_user_can('manage_options') )
			die(__('Sorry. You do not have permission to do this.'));
			
		// check the nonce
		check_admin_referer( 'serp-update' );
		
		// build the array from input
		$updated_options = $_POST['serp'];
		
		// trim whitespace within the array values
		foreach( $updated_options as $key => $value ) {
			$updated_options[$key] = trim($value);
		}
		
		// deal with whitespace in CSS classes
		$whitespace_opts = array( 'ul_class' );
		foreach( $whitespace_opts as $key ) {
			//$value = str_replace(" ", "-", $value);
			$updated_options[$key] = str_replace(" ", "-", $updated_options[$key]);
		}
		
		// deal with the LIST_CURRENT checkbox
		$onoff_opts = array( 'list_current', 'link_current' );
		foreach($onoff_opts as $key) {
			$updated_options[$key] = $updated_options[$key] ? '1' : '0';
		}
		
		// deal with the RESET checkbox
		$bool_opts = array( 'reset' );
		foreach($bool_opts as $key) {
			$updated_options[$key] = $updated_options[$key] ? 'true' : 'false';
		}
		
		// If RESET is checked, reset the options
		if ( $updated_options['reset'] == "true" ) {
			serp_unset_options();	// clear out the old ones 
			serp_set_options();		// put back the defaults
			echo '<div id="message" class="updated fade"><p><strong>' . __('Serial Posts Settings reset to defaults.') . '</strong></p></div>';
		} else {
		// Otherwise, update the options
		update_option( 'serp_plugin_settings', $updated_options);
		echo '<div id="message" class="updated fade"><p><strong>' . __('Serial Posts Settings updated and saved.') . '</strong></p></div>';
		}
	}
	// Display the updated options
	$options = get_option('serp_plugin_settings');
?>
<style>
.form-table {margin-bottom:-6px;}
.serpinfo {border:1px solid #CCCCCC;margin:24px 0px 0px 0px;padding:10px 10px 10px 10px;}
.serpsmall {font-size:11px;padding:0px 0px 0px 20px;}
.serpinfo ul {list-style-type:disc;margin-left:30px;font-size:11px;}
.serpopts {background:#F1F1F1;padding:10px 10px 10px 10px;}
.serpcredits {border-top:1px solid #CCCCCC;margin:10px 0px 0px 0px;padding:10px 0px 0px 0px;}
</style>
<div class="wrap" id="serpstyle">

	<h2>Serial Posts Configuration</h2>
	<form method="post">
		<?php
		// put the nonce in
		wp_nonce_field('serp-update');
		?>
		
		<div class="serpinfo">
			<p><em>You are using Serial Posts plugin version <?php echo SERP_VER; ?> for Wordpress.</em></p>
			<p><?php _e('What does this plugin do?', SERP_DOMAIN); ?></p>
			<ul>
				<li>Allows you to assign posts to a Serial, using custom fields, and then displays a list of all posts assigned to the same Serial in your single post page (usually single.php or index.php).</li>
				<li>The position of the Serial Posts list on your page is determined by where you insert the Serial Posts template tag in your single.php or index.php template file.</li>
				<li>Designed for authors who wish to group posts into series - independantly of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serials as you wish, and assign these to any posts that you wish to group together to create a wide variety of "related post" or other post groupings.</li>
			</ul>					
			<p><?php _e("For further information, see the README.txt document supplied with the plugin or visit the", SERP_DOMAIN); ?> <a href="http://www.studiograsshopper.ch/serial-posts-configuration/">Serial Posts configuration</a> page.</p>
		</div>
		
		<div class="serpinfo">
			<h3><?php _e('Assigning a post to a Serial:', SERP_DOMAIN); ?></h3>
			<p><?php _e('In the Write/Edit Post screen add the following Custom Field to each Post that you wish to treat as being part of a Serial:', SERP_DOMAIN); ?></p>
			<ul>
				<li><strong>Custom Field Key = Serial</strong>. This is required for all series that you create. </li>
				<li><strong>Custom Field Value = specific name</strong> for this series or group of posts. For example, "<em>My first series</em>".</li>
			</ul>
			<p>There is no limit to the number of Serials that you can create. However, you can only assign a single Serial to any one post.</p>
		</div>
		
		<div class="serpinfo">
			<h3><?php _e('How to add a list of Serial Posts to your Posts:', SERP_DOMAIN); ?></h3>
			<p><?php _e('Add this template tag to your single post theme template file, typically single.php or index.php, wherever you want to display the list of posts. This tag must appear within the Loop.', SERP_DOMAIN); ?></p>
			<p><code>&lt;?php serial_posts(); ?&gt;</code></p>
		</div>
				
		<fieldset name="serialposts" class="options">
		
			<div class="serpinfo">
				<h3>List Display options:</h3>
				<p>The plugin outputs the list of Serial Posts with the following XHTML and CSS markup:</p>
				<ul>
					<li>The entire list is contained in a &lt;div&gt; which is automatically assigned an ID of the name of the Serial.</li>
					<li>A List Heading in &lt;h3&gt; tags. The Heading is made up of three elements: "Text before" "Serial Name" "Text after". The text for "Text before" and "Text after" is entered in the fields below. If you don't want to use either or both of these, just blank out the field before saving your settings using the Update Options button.</li>
					<li>An unordered list of links for the posts, each link enclosed in &lt;li&gt; tags and assigned a class of the name of the Serial.</li>
					<li>Additionally, to allow even greater control over the styling of the unordered list, you may specify a class name for the list's &lt;ul&gt; tag.</li>
					<li>For full details of the CSS markup automatically added to the XHTML for the Heading and the list of posts please refer to the <a href="http://www.studiograsshopper.ch/serial-posts-configuration/">Serial Posts configuration</a> page.</li>
				</ul>
			
			<table class="optiontable form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">Text before Serial name:</th>
						<td><textarea name="serp[pre_text]" cols="75" rows="2" id="serp-pre_text"><?php echo stripslashes( $options['pre_text'] ); ?></textarea></td>
					</tr>
					<tr valign="top">
						<th scope="row">Text after Serial name:</th>
						<td><textarea name="serp[post_text]" cols="75" rows="2" id="serp-post_text"><?php echo stripslashes( $options['post_text'] ); ?></textarea></td>
					</tr>
					<tr valign="top">
						<th scope="row">List &lt;ul&gt; class:</th>
						<td><input name="serp[ul_class]" id="serp-ul_class" size="10" value="<?php echo $options['ul_class']; ?>" />&nbsp;<em>Default: serial-posts. Note that the plugin replaces any whitespace with hyphens.</em></td>
					</tr>
				</tbody>
			</table>
			</div>
			
			<div class="serpinfo">
			<label for="serp-list_current">
				<input name="serp[list_current]" type="checkbox" id="serp-list_current" value="1" <?php checked('1', $options['list_current']); ?> />
				<?php _e('Include current post in list of Serial Posts') ?></label>
			<p class="serpsmall"><?php _e('Check the box if you want to include the currently viewed post in the list of Serial Posts.'); ?> <em><?php _e('Default is CHECKED.', SERP_DOMAIN); ?></em></p>
			
			<label for="serp-link_current">
				<input name="serp[link_current]" type="checkbox" id="serp-link_current" value="1" <?php checked('1', $options['link_current']); ?> />
				<?php _e('Show current post as a link') ?></label>
			<p class="serpsmall"><?php _e('If you have checked "Include current post in list of Serial Posts", you may check this box if you want the currently viewed post to be shown as a link.'); ?> <em><?php _e('Default is UNCHECKED.', SERP_DOMAIN); ?></em></p>
			</div>
						
			<div class="serpinfo">
			<label for="serp-reset">
				<input type="checkbox" name="serp[reset]" id="serp-reset" value="<?php echo $options['reset']; ?>" />&nbsp;<strong><?php _e('Reset all options to the Default settings')?></strong></label>
			</div>
        
		</fieldset>
		<p class="submit"><input type="submit" name="info_update" value="<?php _e('Update Options') ?>" /></p>
	</form>
	
	<div class="serpcredits">
		<p>For further information please read the README document included in the plugin download, or visit the <a href="http://www.studiograsshopper.ch/serial-posts-configuration/">Serial Posts configuration</a> page.</p>
		<p>With acknowledgements to <a href="http://justintadlock.com" title="Justin Tadlock">Justin Tadlock</a> whose original code idea inspired this plugin.</p> 
		<p>Serial Posts plugin for Wordpress and Wordpress Mu by <a href="http://www.studiograsshopper.ch/">Ade Walker</a>&nbsp;&nbsp;&nbsp;<strong>Version: <?php echo SERP_VER; ?></strong></p>      
		<p>If you have found this plugin useful, please consider making a donation to help support future development. Your support will be much appreciated. Thank you!</p>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
		</form>
	</div>
</div>
