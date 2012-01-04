<?php
/**
 * ********************************************
 * @author Ade WALKER  (email : info@studiograsshopper.ch)
 * @copyright Copyright 2008-2012
 * @package serial_posts
 * @version 1.2.2
 *
 * These are the 'public' functions which produce the Serial Posts lists in the front end
 * Defines template tag		serial_posts()
 * Defines shortcode			serp_shortcode()
 * Defines list constructor	serial_posts_build()
 *
 *	@since	1.1
 */

/* Prevent direct access to this file */
if (!defined('ABSPATH')) {
	exit( __('Sorry, you are not allowed to access this file directly.', SGR_SERP_DOMAIN) );
}



/**	Template tag to display Serial Posts lists in template files
*
*	Do not use in the Loop.
*
*	@uses	serial_posts_build()
*	@since	0.9
*/
function serial_posts() {
	$serp_result = serial_posts_build();
	echo $serp_result;
}


/**	Shortcode tag to display Serial Posts lists in post/page write/edit screens
*
*	Use [serialposts] in post/page edit/write
*	See add_shortcode in serial-posts-plugin.php
*
*	@uses	serial_posts_build()
*	@since	1.0
*/
function serp_shortcode() {
	$serp_result = serial_posts_build();
	return $serp_result;
}


/**	Function to build Serial Posts lists
*
*	Used by	serp_shortcode()
*	Used by	serial_posts()
*
*	Pulls associated posts/pages from db if a Serial name has been assigned to the post/page
*
*	@since	0.9
*/
function serial_posts_build() {
	
	global $id, $post, $serp_options;
	
	/* Check if current post is a member of a series
	and get serial_name of current post */
	/* TO DO: Deal with a post/page being assigned to more than one Serial */
	$serial_name = get_post_meta($id, 'Serial', true);
	
	/* If we have a Serial assigned to this post, let's do our stuff */
	if ( $serial_name ) {
		
		/* Class / ID names for CSS markup */
		$serial_css_div = 'serial-posts-wrapper';
		$serial_css_head = 'serial-posts-heading';
		$serial_css_list = 'serial-posts-list-item';
		$serial_css_type = $serp_options['list-type'];
		
		
		/* Build mySQL query to pull in custom fields */
		/* Instantiate the wpdb object */
		global $wpdb;
	
		if ( $serp_options['list_current'] == "0" ) {
			/* Do the query excluding current post */
			$findposts = $wpdb->get_results(
				$wpdb->prepare(
				"SELECT *
				FROM $wpdb->posts
				LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
				WHERE $wpdb->postmeta.meta_key = %s
				AND $wpdb->postmeta.meta_value = %s
				AND $wpdb->posts.post_status = %s
				AND $wpdb->postmeta.post_id != %d
				ORDER BY $wpdb->posts.post_date ASC",
				'Serial', $serial_name, 'publish', $id
				)
			);
		} else {
			/* Do the query including current post */
			$findposts = $wpdb->get_results(
				$wpdb->prepare(
				"SELECT *
				FROM $wpdb->posts
				LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id)
				WHERE $wpdb->postmeta.meta_key = %s
				AND $wpdb->postmeta.meta_value = %s
				AND $wpdb->posts.post_status = %s
				ORDER BY $wpdb->posts.post_date ASC",
				'Serial', $serial_name, 'publish'
				)
			);
		}
		
		/* Build the list elements */
		if ($findposts):
			
			/* Get the admin defined parts of the list heading and build the
			elements and XHTML markup for the list heading elements */
			/* Reset variable to empty */
			$pre_text = '';
			/* Has any pre-text been defined? */
			if ( $serp_options['pre_text'] !='' ) { // We have pre-text, therefore create a spacer and get the pre-text
				$pre_spacer = '&nbsp;';
				$pre_text = '<span class="serial-pre-text">' . stripslashes($serp_options['pre_text']) . '</span>';
			}
			
			/* Create XHTML markup for the Serial name itself */
			$serial_name = '<span class="serial-name">' . $serial_name . '</span>';
			
			/* Has any post-text been defined? */
			$post_text = '';
			if ( $serp_options['post_text'] !='' ) { // We have post-text, therefore create a spacer and get the post-text
				$post_spacer = '&nbsp;';
				$post_text = '<span class="serial-post-text">' . stripslashes($serp_options['post_text']) . '</span>';
			}
			
			/* Create the div container for the list and give it a CSS ID name of the Serial name */
			$div = '<div id="' . $serial_css_div . '">' . "\n";
						
			/* Create the list heading */
			/* Is the Serial name to be hidden from the list heading ? */
			if ( $serp_options['hide_serial_name'] == "0" ) { // Serial Name is to be displayed
				$heading = '<h3 class="' . $serial_css_head . '">' . $pre_text . $pre_spacer . $serial_name . $post_spacer . $post_text . '</h3>' . "\n";
			} else { // Serial name is to be hidden
				$heading = '<h3>' . $pre_text . '</h3>' . "\n";
			}
			
			/* Create the ul container for the list */
			$list_ul = '<'. $serial_css_type .' class="' . $serp_options['ul_class'] . '">' . "\n";
			
			/* Create the post list as an array */
			$list_li = array();
			
			/* Populate the post list array using the output of the wpdb query */
			foreach ($findposts as $findpost):
				
				if ( ( ( $findpost->ID ) == $id ) && ( $serp_options['link_current'] == "1" ) ) {
					
					// we have the current post and link is to be shown
					$list_li[] = '<li class="' . $serial_css_list . ' current-active"><a href="' . get_permalink($findpost->ID) . '" title="' . $findpost->post_title . '">' . $findpost->post_title . '</a></li>' . "\n";
				
				} elseif ( ( $findpost->ID ) != $id ) {
					// all other posts except the current post
					$list_li[] = '<li class="' . $serial_css_list . '"><a href="' . get_permalink($findpost->ID) . '" title="' . $findpost->post_title . '">' .  $findpost->post_title . '</a></li>' . "\n";
				
				} else {					
					// this must be the current post and link is not to be shown
					$list_li[] = '<li class="' . $serial_css_list . ' current-inactive">' . $findpost->post_title . '</li>' . "\n";
				}
				
    		endforeach;
			
			/* Create the list of posts from the array */
			$list_li = implode('', $list_li);
			
			/* Create the closing ul tag for the list */
			$list_ul_end = '</' . $serial_css_type . '>' . "\n";
			
			/* Create the closing div tag to end the XHTML */
			$div_end = '</div>' . "\n";
			
			/* Put all the elements together and construct the output array */
			$serp_output = array ($div, $heading, $list_ul, $list_li, $list_ul_end, $div_end);
			$serp_output = implode('', $serp_output);
			
			/* Final output ready for use */
			return $serp_output;
			
		endif;
	}
}