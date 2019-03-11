=== Admin Page Spider ===
Contributors: jatacid
Donate link: https://j7digital.com/downloads/admin-page-spider-pro-pack/
Tags: usability, admin, developer, beaver builder, woocommerce, edd, easy digital downloads, posts
Requires at least: 4.3.0
Tested up to: 4.9.5
Stable tag: 4.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add a menu of all your website's pages in the Admin Bar. So you can view, edit & jump to any page instantly without going to the dashboard!

== Description ==

Get a menu of all your website's pages in your Admin Bar! Jump to any page from any location without having to jump back and forth between the dashboard. Have easy access to edit links and every page without having to search for it. Save HOURS of time clicking and waiting unnecessarily!

Now with Admin Page Spider you can crawl all over your pages directly from your Admin bar! See a convenient list of all your pages on your website and an instant link to edit them directly! This works no matter where you are in your dashboard or on your website too! You can instantly start editing or viewing any page without clicking and waiting multiple times.

See the [screenshots tab](http://wordpress.org/extend/plugins/admin-page-spider/screenshots/) for more details.

**You can save up to 20-30% of your editing time!**
- Tested on a membership site with multiple, hidden pages, beaver builder and CSS hero -


== Installation ==

You can either install it automatically from the WordPress admin, or do it manually:

Unzip the archive and put the admin-page-spider folder into your plugins folder (/wp-content/plugins/).
Activate the plugin from the Plugins menu.

= Usage =

In your dashboard go to the Settings -> Admin Page Spider.  Set the desired menus to 'Display' and hit save. Now they will display in your admin bar and allow you to jump around between your pages easily.

== Frequently Asked Questions ==

= Is it free? =

Yes, the base plugin which gives you a wordpress page navigation and edit menu is completely free and hosted on the wordpress plugin directory.

= Is there a paid version? =

Yes, the Pro Pack simply adds support for additional plugins and their custom post types. For example Woocommerce products. You only need the pro pack if you want to use those plugins a lot.

[Read More Here](https://j7digital.com/downloads/admin-page-spider-pro-pack/)

== Screenshots ==

1. screenshot-2.png

2. screenshot-3.png

3. screenshot-4.png

== Changelog ==

= 3.13 =
* Fixed CSS declarations on menus overriding Wordpress admin profile skin

= 3.12=
* Fixed count() errors for PHP 7+ servers
* Tested with Wordpress 4.95

= 3.12 =
* Tested with Wordpress 4.9

= 3.11 =
* Tested with Wordpress 4.8

= 3.10 =
* Updated all functions to use ProPack's recursive array.
* A single database call means it's faster & lightweight!
* Improved various other code sections & Styling.

= 3.00 =
* NEW - Wordpress Posts now in Admin Page Spider!
* Added some conditionals to initial load so only loads assets if needed
* Highlights current page/post in menu
* Made separate from Pro version so version inconsistencies don't occur. (Can delete if you have the ProPack!)

= 2.32 =
* Previously Declared variable fix.
* Removed now defunct settings link.

= 2.31 =
* NEW!: Added recursive heirarchy for menus. Now will correctly display any nested levels of pages with the correct menu heirarchy.
* Added alternating pipe & increasing level of indentation for subsequent nested levels

= 2.30 =
* Added 'order' to the sorting parameter so users can customise the menu list heirarchy. Can be set by editing the page -> and setting the 'order' value. Pages will order by date if no order value is set.

= 2.22 =
* Fixed uninstall errors

= 2.21 =
* Fixed activation/deactivation logic & cleanup of old database settings

= 2.20 =
* Moved all settings fields & sections to a single unified file.
* Fixed pro/not-pro messages displaying properly
* Added settings sections to better communicate new features.

= 2.10 =
* Fixed issue of array_search variable error and not displaying default value.

= 2.00 =
* Changed classname to V2 Suffix to avoid installation issues with earlier versions of pro-pack
* Added sorting functionality to code base - will possibly add a way you can choose how to sort your pages (alphabetically etc)

= 1.11 =
* Huge refactoring of code for more re-usability and future wordpress transient usage.
* Updated Author urls to reflect domain change.
* Removed affiliate links due to wordpress rules & continued support
* Improved loading of styles
* Fixed some comments and readmetxt


= 1.10 =
* Added quick access item to settings for people who don't realise there are settings.
* Added an icon to make it more apparent that the primary menu is clickable.
* Added a hook for additional styles to be added by each individual plugin without adding more bloat to the css.


= 1.09 =
* Made default min width a little larger
* Added a slight transparency so you can see underneath
* Removed String Length code which was causing weird characters
* Issues occuring with browsers and scroll bar hiding the submenu items so have moved all submenus into the main menu heirarchy with padding indentation. Should now work on all browsers.
* Added 'view' icons to simply view the page instead of edit.
* Added 'Title' tags to almost every menu item to provide more explanation.

= 1.08 =
* Critical fix of submenu edit links for wordpress pages taking you to edit for the primary page.

= 1.07 =
* Added hooks for adding support & new features.
* Moved various features around for code sustainability
* Cleaned up Admin Pages & added checks for administrator rights so non users don't see a weird thing in their menubar.
* Added link to settings in the plugin page
* Added activation/Deactivation & uninstall cleanup

= 1.06 =
* Fixed syntax error with get_option array variable

= 1.05 =
* Added CSS to handle really long lists of pages
* Added filter to remove now redundant edit links from menu
* Merged Pull request for handling urls which already have a parameter added (credit: badabingbreda)

= 1.04 =
* Added basic localisation (thanks badabingbreda) , updated readme a bunch of times and made code less conflict-risky with bbPress

= 1.00 =
* Initial Launch

== Upgrade Notice ==

= 2.23 =
New This Version: Fixed uninstallation errors, Faster codebase and even smaller filesize!