# WP Lock Plugins #
Contributors: Luiz Calderaro <lzcalderaro@gmail.com>, Licínio Sousa <licinio@wakeup.pt>  
Tags: Plugin, management, activate, deactivate, prevent, allow  
Requires at least:  4.5.6  
Tested up to: 4.7  
Stable tag:  4.7  
License: GPL-2.0 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

Locks the plugin status to prevent users from activating or deactivating plugins.

== Description ==

Allow or prevent users from activating or deactivating installed plugins.

On a multisite instalation, management is done per site.

Simply click the checkbox to prevent user management of plugin.

The plug-in is “capabilities aware” – only users with the ability to activate plugins (editors and administrators) will be able to edit plugin management.

Users with no authorization will not be able to activacte or deactivate installed plugins.

== Installation ==
1. Upload wp-lock-plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Settings" -> Lock Plugin
4. Select the plugins you want to prevent users from activating or deactivating.
5. Click "Save"

== CONTRIBUTING ==\
We’d love to have you join in on development over on [GitHub Pages](https://github.com/lzcalderaro/wp-lock-plugins).

== Changelog ==

= 1.0 =
* First Release.
