=== Speed Up - Translation Cache ===
Contributors: nigro.simone + thomas.weyn
Tags: performance, speed, translation, fast, gettext, i18n, internationalization, l10n, language, languages, localization, localize, mo, Optimization, optimize, performance, speed, translate, translation, tuning, cache, caching, web performance optimization, wordpress optimization tool, wp-cache
Requires at least: 3.0
Tested up to: 5.9
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The translations reduces speed of Wordpress. This plugin offers a caching solution that reduces this effects on performance.

== Description ==

The translations reduces speed of Wordpress.

For localized WordPress the loading time of translation files accounts for 30% of the entire processing time (less or more 40 milliseconds per page).

For each translation file, WordPress unpacks it and then everyone will be converted in an "Translation_Entry" object. This process, repeated at each page view, is a waste time and resource.

You can make this process 3 times faster by just installing this plugin. This plugin offers a caching solution using the WordPress standard cache mechanism that reduces this effects on performance.

Configurations are not required! You just have to install it and after the plugin does it all, none further action it's required.

This plugin is very light: only 5 kB.

== Features ==

* No configuration
* Supports multiple languages
* Supports plugin's translation files caching
* Supports WordPress Network/Multisite installation
* Cache automatically expire when translation file is updated

== Installation ==

1. Upload the complete `speed-up-translation` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Recommended Installation ==

For better performance, verify that `/wp-content/object-cache.php` is installed (see https://codex.wordpress.org/Class_Reference/WP_Object_Cache#Persistent_Cache_Plugins).

== Changelog ==

= 1.1.0 =
* Further improved speed

= 1.0.15 =
* Tested up to Wordpress 5.9

= 1.0.14 =
* Tested up to Wordpress 5.7

= 1.0.13 =
* Tested up to Wordpress 5.5

= 1.0.12 =
* Tested up to Wordpress 5.3

= 1.0.11 =
* Just update the name of plugin from "Speed Up - Translation" to "Speed Up - Translation Cache"

= 1.0.10 =
* Tested up to Wordpress 5.2

= 1.0.9 =
* Tested up to Wordpress 4.9

= 1.0.8 =
* Tested up to Wordpress 4.7

= 1.0.7 =
* Little fix

= 1.0.6 =
* Fix readme.txt tag list

= 1.0.5 =
* Added cache statistics in the bottom of page (with html comment)

= 1.0.4 =
* Improve readme.txt

= 1.0.3 =
* Improve readme.txt

= 1.0.2 =
* Fix readme.txt

= 1.0.1 =
* Improve readme.txt

= 1.0.0 =
* Initial release.