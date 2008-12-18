=== Serial Posts ===

Version: 0.9
Author: Ade Walker, Studiograsshopper
Author page: http://www.studiograsshopper.ch
Plugin page: http://www.studiograsshopper.ch/wordpress-plugins/serial-posts-plugin/
Tags: posts,series,serial,related,post listings,custom
Requires at least: 2.5
Tested up to: 2.7 (WP) and 2.6.5 (WPMU)
Stable tag: 0.9

Allows you to assign posts to a Serial, using custom fields, and then displays a list of all posts assigned to the same Serial in your single post page (usually single.php or index.php).


== Description==

This plugin allows you to assign a Serial name, using custom fields, to your posts and then automatically displays a list of other posts which have the same Serial name when viewing this post. You can create as many Serials as you need, therefore allowing you to create multiple groupings of posts. Designed for authors who wish to group posts into series - independantly of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serials as you wish, and assign these to any posts that you wish to group together to create a wide variety of "related post" or other post groupings. 


**Key Features**
----------------

* Allows you to assign posts to a Serial, using custom fields, and then displays a list of all posts assigned to the same Serial in your single post page (usually single.php or index.php).
* The position of the Serial Posts list on your page is determined by where you insert the Serial Posts template tag in your single.php or index.php template file.
* You can create as many different Serials as you wish.
* User options for including the currently viewed post in the list, with or without a link.
* Configurable Heading for the Serial Posts list.
* Valid xhtml output.
* Highly customisable CSS styling of the Heading and Serial Posts list. 
* Tested to be compatible with Wordpress 2.5 to 2.7
* Tested to be compatible with Wordpress Mu to 2.6.5

**Further information**
-----------------------
Comprehensive information on installing, configuring and using the plugin can be found at http://www.studiograsshopper.ch


== Installation ==

1. Download the latest version of the plugin to your computer.
2. Extract and upload the folder **serialposts** and its contents to your **/wp-content/plugins/** directory.  Please ensure that you do not rename any folder or filenames in the process.
3. Activate the plugin in your Dashboard via the Admin **Plugins** menu.
4. Configure the plugin's Settings page in Admin **Settings**.

**Upgrading from an older version**
-----------------------------------

You can use the Wordpress Automatic Plugin upgrade link in the Admin Plugins menu to automatically upgrade the plugin. 


== Instructions for use ==


== Using the plugin == 

Add this template tag to your single post theme template file, typically single.php or index.php, wherever you want to display the list of posts. This tag must appear within the Loop.

&lt;?php serial_posts(); ?&gt;


== Configuration and set-up ==


Further information can be found at http://www.studiograsshopper.ch/serial-posts-configuration/


**Configuring the Options page**
--------------------------------
 
1. In the Dashboard, go to Settings and open the Serial Posts Configuration page.

2. List Display options. This is where you can customise the Serial Posts heading and list of posts. The Heading is made up of three elements: "Text before Serial name" "Serial Name" "Text after Serial name". 

2.1 Text before Serial name: Enter the text that you would like to appear in the Heading BEFORE the Serial name. If you don't want to show any text before the Serial name, just blank out the field before saving your settings.

2.2 Text after Serial name: Enter the text that you would like to appear in the Heading AFTER the Serial name. If you don't want to show any text after the Serial name, just blank out the field before saving your settings.

2.3 List &lt;ul&gt; class: To allow even greater control over the styling of the unordered list, you may specify a class name for the list's &lt;ul&gt; tag. The default is serial-posts. Note that the plugin replaces any whitespace with hyphens.

3. Include current post in list of Serial Posts: Check the box if you want to include the currently viewed post in the list of Serial Posts. Default is CHECKED. If you uncheck this box, the currently viewed post will not appear in the Serial Posts list.

4. Show current post as a link: If you have checked "Include current post in list of Serial Posts", you may check this box if you want the currently viewed post to be shown as a link. Default is UNCHECKED. If you check this box, the currently viewed post will appear as a link in the Serial Posts list.

5. Reset all options to the Default settings: Check this box if you want to rest all the options to their default settings.

That's it!  The Settings Page is now configured.


== Frequently Asked Questions ==

**So, what does it do?**
------------------------
*Allows you to assign posts to a Serial, using custom fields, and then displays a list of all posts assigned to the same Serial in your single post page (usually single.php or index.php).
*The position of the Serial Posts list on your page is determined by where you insert the Serial Posts template tag in your single.php or index.php template file.
*Designed for authors who wish to group posts into series - independantly of the usual Wordpress Category and Tag structure - its usage does not have to be limited to this. You can create as many different Serials as you wish, and assign these to any posts that you wish to group together to create a wide variety of "related post" or other post groupings.


**Download**
------------

Latest stable version is version 0.9 available from http://wordpress.org/extend/plugins/serial-posts-plugin/ 


**Troubleshooting**
-------------------

The following points should be noted:

1. Although you can create as many different Serials as you wish, do not assign a post to more than one Serial. 

2. The list of posts is displayed in ascending order, ie oldest post at the top of the list. This cannot currently be changed by the user without hacking the plugin code. I may add a user Option for the post order in a future release.


**Support**
-----------

This plugin is provided free of charge without warranty.  In the event you experience problems you should visit the dedicated FAQ at http://www.studiograsshopper.ch/serial-posts-faq/.

If you cannot find a solution to a problem in the FAQ visit the support pageforum at http://www.studiograsshopper.ch/forum/.  Support is provided in my free time but every effort will be made to respond to support queries as quickly as possible.

Thanks for downloading the plugin.  Enjoy!


== Release History ==

Version 0.9	17/12/2008	Public release


== Technical Notes ==

* The plugin has been tested for compatibility with Wordpress 2.7 and Wordpress Mu 2.6.5. 
* Language Support: This is not yet fully implemented in this version but is scheduled for a future release. (Sorry, ran out of time for this release!)  


== Acknowledgements ==

With acknowledgements to <a href="http://justintadlock.com" title="Justin Tadlock">Justin Tadlock</a> whose original code idea inspired this plugin.