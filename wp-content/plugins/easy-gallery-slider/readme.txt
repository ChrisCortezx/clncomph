=== Easy Gallery Slider ===
Contributors: iNexi
Tags: slider, responsive, gallery, images, pictures, automatic, easy, posts, pages, flexslider, mobile, slideshow, featured, attached
Requires at least: 3.0
Tested up to: 3.4
Stable tag: 0.6.5

Responsive slider uses the images attached to a post or page. Simple to customize and configure.

== Description ==

This slider is easy to use, but powerful. It is designed to be responsive, and works perfectly with mobile devices. It can be automatically displayed on posts and pages, inserted by shortcode or PHP. The slides are pulled on each post from the attached images (gallery). 

= Features =
* Automatically display slider for every post and/or page
* Slides are created from images attached to the post/page it is displayed on (Wordpress Gallery)
* Responsive slider performs the same on every platform (desktop or mobile)
* Fade or slide effects
* Navigation with buttons, "dots", keyboard, scroll-wheel, automatic timer
* Show titles and descriptions with an overlay
* Link individual slides to any URL
* Show a "zoom" button to integrate with a Lightbox plugin
* Many options available through an easy to use admin interface

Please visit my homepage to submit bug reports and feature requests.

Plugin Homepage: [iNexi.com](http://inexi.com/wordpress "iNexi: Wordpress Plugins")

== Installation ==

1. Like any other plugin, upload the easy-gallery-slider folder to your plugin folder, choose to upload the zip through the interface, or install it by searching the WP repository

2. Enter your WordPress Dashboard, go to Plugins, and activate as usual

3. Options in Settings-> Easy Gallery Slider

== Frequently Asked Questions ==

= Help, it's not loading any images?! =

Try toggling the options on the Easy Gallery Slider settings page under "Help". If TimThumb is at fault, see the next question.


= Why isn't TimThumb working? =

* The must host support PHP and the GD image library plugin (check for GD support by creating a phpinfo page)
* Check the permissions on "timthumb.php" inside the easy-gallery-slider plugin folder, it should be 755. 
* Check the permissions on every directory above and including the easy-gallery-slider plugin directory. They should be set to something like 755, not 777.
* Try two different settings on the "cache" directory inside the easy-gallery-slider plugin directory: 775 and 777
* Check the error log for your host, there may be helpful information in there relating to "timthumb.php"
* Ask your host for help and to check your configuration. Also do they block the TimThumb script?


= What third party scripts are included? =

This slider uses the [Flexslider](http://www.woothemes.com/flexslider/) jQuery plugin. As well as [Timthumb](http://www.binarymoon.co.uk/projects/timthumb/).

== Screenshots ==

1. Easy Gallery Slider on a single post page
2. Under Settings > Easy Gallery Slider

== Changelog ==

= 0.6.5 =
* [add]    Link images to self or custom links (and set the class of that link)
* [add]    "Zoom" button linked to original image (and set the class of that link)
* [add]    A new debug settings section under "Help"
* [add]    Image crop position setting (for TimThumb)
* [add]    Image description in caption, below title
* [add]    Option to disable rounded corners
* [fixed]  Conflict with generic class for loading spinner (.loading)
* [fixed]  Added CSS: "list-style: none" to cancel out bullets
* [change] Multiple sliders on one page now possible with different settings (in future releases)
* [change] Don't display caption box of title (or description) if empty
* [change] Admin interface updates

= 0.6.4.1 =
* Missing theme directory
* Some hosts were incompatible with script permissions of 775 (FIXES broken slider with missing images)

= 0.6.4 =
* Added some CSS resets (for issues found)
* [fixed] Firefox wasn't sliding (moved "margin:0 !important" to inline style for ul.slides) 
* Admin interface improvements and additions
* Added JS to handle broken images
* Fixed behavior and added options to "Small images" enlargement option
* Created update mechanism (handles new options and best migration of same)
* Added optional loading spinner
* With update or activation, permissions are updated on "cache" directory and "timthumb.php"
* Updated jquery.flexslider.js, should now be compatible with jQuery 1.3.2 (older)

= 0.6.3 =
* Added option for limiting number of slides
* Added options for sorting slides

= 0.6.2 =
* Fixed conflict with other instances of Flexslider (No longer using class "flexslider")
* Disabled shortcode when it wasn't the main query (Like a recent posts widget)
* Fixed minor CSS issues (captions)

= 0.6.1 =
* CSS change (transparent li)

= 0.6 =
* Fixed bug that wouldn't allow deactivation of automatic insert.

= 0.5 =
* Initial release

== Other Notes ==

= Plans for future releases =
* Add options for style attributes
* Better nav buttons and interface for custom buttons
* Rewrite code in OOP
