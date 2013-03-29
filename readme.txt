=== Serial Posts ===

Version: 1.3
Author: Ade Walker, Studiograsshopper
Author page: http://www.studiograsshopper.ch
Plugin page: http://www.studiograsshopper.ch/serial-posts/
Tags: posts,series,serial,related,post listings,custom
Requires at least: 3.3
Tested up to: 3.5.1
Stable tag: 1.2.2

Allows you to assign Posts or Pages to a Serial, using custom fields, and then displays a list of all Posts and Pages assigned to the same Serial. 


== Description ==

The Serial Posts plugin allows you to assign a Serial name to your Posts and Pages, using custom fields, and then displays in the single post/page view a list of all Posts and Pages assigned to the same Serial. Designed for authors who wish to group Posts and Pages into series - independently of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serials as you wish, and assign these to any Posts and Pages that you wish to group together, to create a wide variety of "related post" or other Post/Page groupings. 


**Key Features**
----------------

* The Serial Posts list is displayed with the [serialposts] shortcode in the Post/Page Editor.
* The position of the Serial Posts list on your page is determined by where you insert the shortcode in your post.
* You can create as many different Serials as you wish. Limitation: Currently it is not possible to assign more than one Serial name to any one Post or Page.
* User options for including the currently viewed post in the list, with or without a link.
* Configurable Heading for the Serial Posts list.
* Valid xhtml output.
* Highly customisable CSS styling of the Heading and Serial Posts list.
* A Serial Posts template tag is also available for advanced users.


**Further information**
-----------------------
Comprehensive information on installing, configuring and using the plugin can be found at http://www.studiograsshopper.ch/serial-posts/


== Installation ==

Either use the WordPress Plugin Installer (Dashboard > Plugins > Add New, then search for "serial posts"), or manually as follows:

1. Download the latest version of the plugin to your computer.
2. Extract and upload the folder **serial-posts** and its contents to your **/wp-content/plugins/** directory.  Please ensure that you do not rename any folder or filenames in the process.
3. Activate the plugin in your Dashboard via the **Plugins** menu.
4. Configure the plugin's Settings page in Dashboard **Settings**.

**Upgrading from an older version**
-----------------------------------

You can use the Wordpress Automatic Plugin upgrade link in the Dashboard Plugins menu to automatically upgrade the plugin. 



== Frequently Asked Questions ==

**Why would I want to use this plugin?**
----------------------------------------
* If you are using WordPress to publish online books or tutorials, and you want to present material (ie your posts) in an "oldest first" form, and you want to do this independant of categories, tags, custom taxonomies etc, then this plugin is for you.
* A typical usage would be for a story or article published in several "chapters", each chapter being a separate Post.
* The main feature of teh plugin is that it creates a list of Posts, which belong to the same Serial, on the single post page of relevant Posts.
* If you simply want a list of related posts there are much better solutions than this plugin! :-)


**Can I create more than one Serial?**
--------------------------------------
Yes, you can create as many different Serials as you wish. However, you cannot assign a Post or a Page to more than one Serial. 


**Why is the list of Posts displayed with oldest at the top of the list?**
--------------------------------------------------------------------------
This is intentional so that each post appears like a chapter in a book or a serial - which is the whole point of the plugin in the first place.


**Where can I get Support?**
---------------------------
Further information about setting up and using the plugin can be found in the plugin's [Configuration Guide](http://www.studiograsshopper.ch/serial-posts/configuration/) and a comprehensive [Tutorial](http://www.studiograsshopper.ch/serial-posts/tutorial/).

If, having read the information linked to above, you cannot solve your issue, or if you find a bug, you can post a message on the plugin's [Support Forum](http://wordpress.org/extend/plugins/serial-posts/).

Support is provided in my free time but every effort will be made to respond to support queries as quickly as possible.


**Can I Donate?**
-----------------
Yes, of course you can! You can find a link in the plugin's Settings page. Donations are welcome and much appreciated. Thanks!


**License and Disclaimer**
--------------------------
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License 2 as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

The license for this software can be found here: [http://www.gnu.org/licenses/gpl-2.0.html](http://www.gnu.org/licenses/gpl-2.0.html)

Thanks for downloading the plugin.  Enjoy!



== Using the plugin == 

To illustrate a typical usage of the plugin, let's imagine that you are writing a short novel and publishing it a chapter at a time, each chapter being a separate Post.

In each Post (ie chapter, to use the example above), create a custom field called Serial, with a value of "story" (without the quotes, of course).

Then, insert the shortcode [serialposts] at the bottom of your Post content in the Write Post/Page editor.

Now, when you view any of the "chapters", you will see the list of Serial Posts at the bottom of each "chapter" Post. This gives your readers a great way of navigating from one "chapter" to the next.

The display of the Serial Posts list can be customised in the plugin's Settings page (see the *Configuring the Settings page* section below).

Advanced users who, for whatever reason, prefer to use a Template Tag in their theme templates rather than the shortcode in the Post/Page Editor, can use the Serial Posts Template Tag:

&lt;?php serial_posts(); ?&gt;



== Configuring the Settings page ==
 
In the Dashboard, go to Settings and open the Serial Posts Settings page.

**List Display options**. This is where you can customise the Serial Posts heading and list of posts. The Heading is made up of three elements: "Text before Serial name" "Serial Name" "Text after Serial name". 

**Text before Serial name**: Enter the text that you would like to appear in the Heading BEFORE the Serial name. If you don't want to show any text before the Serial name, just blank out the field before saving your settings.

**Text after Serial name**: Enter the text that you would like to appear in the Heading AFTER the Serial name. If you don't want to show any text after the Serial name, just blank out the field before saving your settings.

**Hide Serial Name**: By default, the Serial Name always appears in the Heading. Check this box to prevent display of the Serial Name in the Heading. Note: checking this option will also hide the "Text after Serial name".

**List type &lt;ul&gt; or &lt;ol&gt;**: Select to display the links as either an unordered or ordered list from the dropdown.

**List &lt;ul&gt;/&lt;ol&gt; class**: To allow even greater control over the styling of the list, you may specify a class name for the list's &lt;ul&gt; or &lt;ol&gt; tag. The default is "serial-posts". Note that the plugin replaces any whitespace with hyphens.

**Include current post**: Check the box if you want to include the currently viewed Post/Page in the list of Serial Posts. Default is CHECKED. If you uncheck this box, the currently viewed Post/Page will not appear in the Serial Posts list.

**Show current post as a link**: If you have checked "Include current post", you may check this box if you want the current viewed Post or Page to be shown as a link. Default is UNCHECKED. If you check this box, the currently viewed Post/Page will appear as a link in the Serial Posts list.

That's it!  The Settings Page is now configured.


Further information about using the plugin can be found in the [Serial Posts Tutorial](http://www.studiograsshopper.ch/serial-posts/tutorial/).


== Serial Posts list XHTML markup ==

Please refer to the plugin's Contextual Help for an overview of the list markup. More detailed information can be found in the plugin's [Configuration Guide](http://www.studiograsshopper.ch/serial-posts/configuration/).



== Changelog ==

= 1.3 =
* Released
* Enhance: Code re-write to improve organisation of functions, etc, updated code docs
* Enhance: Added activation hook to check WP minimum version
* Enhance: Changed textdomain calls to text, rather than constant, in _e() and __() functions
* Enhance: Moved all file includes and add_action/add_filter calls to _init function
* Enhance: Removed the plugin's own admin CSS/JS. It was unnecessary to have this.
* Feature: Detailed Contextual Help now added to the plugin's Settings page.
* Bug fix: Fixed undefined index warnings when outputting list (get_option call missing)
* Bug fix: Added isset() checks to checkbox optiosn when outputting list, to avoid undefined index errors

= 1.2.2 =
* Released 4 January 2012
* Bug fix: Fixed reset notice from appearing when it shouldn't

= 1.2.1 =
* Released 3 January 2012
* Bug fix: Fixed settings not saving/resetting
* Bug fix: Temporarily disabled contextual help due to WP 3.3 incompatibility
* Enhance: Added SGR_SERP_HOME constant

= 1.2 =
* Released 21 January 2010
* Bug fix: li tags now output with class name "serial-posts-list-item"
* Bug fix: Corrected sanitisation of ul_class option
* Feature: Added dropdown option to allow either UL or OL tag for list
* Feature: Added class name "serial-posts-heading" to list's h3 tag

= 1.1 =
* Released 16 December 2009
* Feature: Tidied up Internationalisation
* Feature: Added Settings API functions for admin page
* Bug fix: Improved options sanitisation and db query security
* Feature: Reorganised code into files
* Bug fix: Can now be used with Pages as well as Posts
* Bug fix: Added global $post to main function
* Feature: Added "Hide Serial name" option in Options page
* Feature: Code upgraded, now requires WP 2.8+

= 1.0 =
* Released 31 December 2008
* Feature: Added shortcode [serialposts]
* Bug fix: Fixed xhtml output error

= 0.9 =
* Released 17 December 2008
* Public release