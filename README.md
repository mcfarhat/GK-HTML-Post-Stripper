=== Plugin Name ===

Plugin Name: GK HTML Post Stripper
Contributors: mcfarhat
Donate link:
Tags: wordpress, HTML, tags, posts, cleanup
Requires at least: 4.3
Tested up to: 4.9
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

=== Short Summary ===

The GK HTML Post Stripper is a wordpress plugin that aims at allowing bulk stripping of HTML tags across posts available within your wordpress install, while providing options to keep specific tags but also target only posts up to a certain date.

== Description ==

The plugin aims at adding support from within wordpress, to perform a bulk edit across all posts or ones set up to a certain date to remove all HTML formatting from those tags.

The initial version came out with a standard run across all posts, and skipping <img> and <a> tags since those tags contain additional information, mainly links and references. Yet in the updated version, we decided to allow the user to chose which tags he can keep, if he wants to keep any, but also to specific a specific max date for his cleanup. Our basis for that is since users might have old posts that need cleanup, and he just wants to perform this up to a certain date.  

The idea came to mind as a client of mine needed to perform this functionality, and we wanted to make this available for anyone who ever lands on such a requirement.

Upon installation and activation, a new menu item is created, Gk HTML Post Stripper, which allows chosing your skipped tags, selecting a date, and then running this cleanup.
Of course you could leave both empty, and do the cleanup all across posts and remove all HTML formatting.

The screen is very simplistic, in that is only asks for those fields. The choices are saved for next runs, if needed. Clicking the "Strip Posts" button would popup a confirmation to make sure you didn't just mistakenly click this button. Upon confirmation, cleanup is done, and on screen messages will display confirming ID and title of posts cleaned up.

If you would like some custom work done, or have an idea for a plugin you're ready to fund, check our site at www.greateck.com or contact us at info@greateck.com

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/GK-HTML-Post-Stripper` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Visit the new page by clicking on the HTML Stripper menu link in the backend left menu tab
4. Enter your tags, or just leave the <img><a> default ones, or just clear it up altogether.
5. Select a date if you'd like, or alternatively leave it empty.
6. Click the "Strip Posts" button, confirm, and poof you're done!
7. Now the screen will confirm which posts have been cleaned up.

== Screenshots ==
1. Screenshot showing the HTML Stripper in the Left Menu tab <a href="https://www.dropbox.com/s/c4a78crttpduvlj/gk-class-appender-menu.png?dl=0">https://www.dropbox.com/s/c4a78crttpduvlj/gk-class-appender-menu.png?dl=0</a>
2. Screenshot showing the Stripping Functionality screen <a href="https://www.dropbox.com/s/autshckr6yv9i5z/left_menu.png?dl=0">https://www.dropbox.com/s/autshckr6yv9i5z/left_menu.png?dl=0</a>
3. Screenshot showing the Result Scren after performing the strip tag functionality <a href="https://www.dropbox.com/s/tyjc8gyrgagyvml/result_screen.png?dl=0">https://www.dropbox.com/s/tyjc8gyrgagyvml/result_screen.png?dl=0</a>

== Changelog ==

= 1.1.0 =
* Adding support for user defined tags and custom max date for post inclusion

= 1.0.0 =
* Initial Version *
