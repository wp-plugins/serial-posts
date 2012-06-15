=== Serial Posts ===

Version: 1.2.2
Author: Ade Walker, Studiograsshopper
Author page: http://www.studiograsshopper.ch
Plugin page: http://www.studiograsshopper.ch/serial-posts/
Tags: posts,series,serial,related,post listings,custom
Requires at least: 2.8
Tested up to: 3.4
Stable tag: 1.2.2

Allows you to assign Posts or Pages to a Serial, using custom fields, and then displays a list of all Posts and Pages assigned to the same Serial. 


== Description ==

This plugin allows you to assign a Serial name, using custom fields, to your Posts and Pages and then automatically displays a list of other Posts/Pages which have the same Serial name when viewing a Post or Page which belongs to the same Serial name. You can create as many Serials as you need, therefore allowing you to create multiple groupings of Posts/Pages. Designed for authors who wish to group Posts and Pages into series - independently of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serials as you wish, and assign these to any Posts and Pages that you wish to group together, to create a wide variety of "related post" or other Post/Page groupings. 


**Key Features**
----------------

* The Serial Posts list can be displayed using either the [serialposts] shortcode in the Write Post/Page Editor, or by using the Serial Posts template tag in your theme template files.
* The position of the Serial Posts list on your page is determined by where you insert the shortcode in your post, or where you insert the Serial Posts template tag in your template file.
* You can create as many different Serials as you wish. Limitation: Currently it is not possible to assign more than one Serial name to any one Post or Page.
* User options for including the currently viewed post in the list, with or without a link.
* Configurable Heading for the Serial Posts list.
* Valid xhtml output.
* Highly customisable CSS styling of the Heading and Serial Posts list.


**Further information**
-----------------------
Comprehensive information on installing, configuring and using the plugin can be found at http://www.studiograsshopper.ch


== Installation ==

1. Download the latest version of the plugin to your computer.
2. Extract and upload the folder **serial-posts** and its contents to your **/wp-content/plugins/** directory.  Please ensure that you do not rename any folder or filenames in the process.
3. Activate the plugin in your Dashboard via the Admin **Plugins** menu.
4. Configure the plugin's Settings page in Admin **Settings**.

**Upgrading from an older version**
-----------------------------------

You can use the Wordpress Automatic Plugin upgrade link in the Admin Plugins menu to automatically upgrade the plugin. 


== Instructions for use ==


== Using the plugin == 

The plugin provides two methods for inserting the list of Serial Posts in a page: a shortcode and a template tag, either of which may be used. It is recommended that you use one or the other, but not both, in accordance with your needs and preferences.

**Template tag:** Add this template tag to, typically, your single post theme template file, usually single.php or index.php, wherever you want to display the list of Posts/Pages. This tag must appear within the Loop.

&lt;?php serial_posts(); ?&gt;

**Shortcode:** Add this shortcode directly into the post editor when writing or editing a Post or Page.

[serialposts]


== Configuration and set-up ==


Further information can be found at http://www.studiograsshopper.ch/serial-posts/configuration/ and a comprehensive "how to" at http://www.studiograsshopper.ch/serial-posts/tutorial/


**Configuring the Options page**
--------------------------------
 
In the Dashboard, go to Settings and open the Serial Posts Configuration page.

**List Display options**. This is where you can customise the Serial Posts heading and list of posts. The Heading is made up of three elements: "Text before Serial name" "Serial Name" "Text after Serial name". 

**Text before Serial name**: Enter the text that you would like to appear in the Heading BEFORE the Serial name. If you don't want to show any text before the Serial name, just blank out the field before saving your settings.

**Text after Serial name**: Enter the text that you would like to appear in the Heading AFTER the Serial name. If you don't want to show any text after the Serial name, just blank out the field before saving your settings.

**Hide Serial Name**: By default, the Serial Name always appears in the Heading. Check this box to prevent display of the Serial Name in the Heading. Note: checking this option will also hide the "Text after Serial name".

**List type &lt;ul&gt; or &lt;ol&gt;**: Select either unordered list &lt;ul&gt; or ordered list &lt;ol&gt; from the dropdown.

**List &lt;ul&gt;/&lt;ol&gt; class**: To allow even greater control over the styling of the list, you may specify a class name for the list's &lt;ul&gt; or &lt;ol&gt; tag. The default is "serial-posts". Note that the plugin replaces any whitespace with hyphens.

**Include current post**: Check the box if you want to include the currently viewed Post/Page in the list of Serial Posts. Default is CHECKED. If you uncheck this box, the currently viewed Post/Page will not appear in the Serial Posts list.

**Show current post as a link**: If you have checked "Include current post", you may check this box if you want the current viewed Post or Page to be shown as a link. Default is UNCHECKED. If you check this box, the currently viewed Post/Page will appear as a link in the Serial Posts list.

That's it!  The Settings Page is now configured.


== Frequently Asked Questions ==

**So, what does it do?**
------------------------
* Allows you to assign posts to a Serial, using custom fields, and then displays a list of all posts assigned to the same Serial in your single post page (usually single.php or index.php).
* The position of the Serial Posts list on your page is determined by where you insert the shortcode in your Post/Page, or where you insert the Serial Posts template tag in your theme template files.


**Download**
------------

Latest stable version is available from http://wordpress.org/extend/plugins/serial-posts/ 


**Known Issues**
-------------------

The following points should be noted:

1. Although you can create as many different Serials as you wish, do not assign a Post or a Page to more than one Serial. 

2. The list of Posts/Pages is displayed in ascending order, ie oldest post at the top of the list. This cannot currently be changed by the user without hacking the plugin code. I may add a user Option for the post order in a future release.


**Support**
-----------

This plugin is provided free of charge without warranty.  In the event you experience problems you should visit the dedicated FAQ at http://www.studiograsshopper.ch/serial-posts/faq/.

If you cannot find a solution to a problem in the FAQ visit the support forum at http://www.studiograsshopper.ch/forum/.  Support is provided in my free time but every effort will be made to respond to support queries as quickly as possible. I don't have time to monitor the wordpress.org forums, so if you need support, use my site.

Thanks for downloading the plugin.  Enjoy!


== Changelog ==

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



== Acknowledgements ==

With acknowledgements to <a href="http://justintadlock.com" title="Justin Tadlock">Justin Tadlock</a> whose original code idea inspired this plugin.