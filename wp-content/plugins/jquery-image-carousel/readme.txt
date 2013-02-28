=== Plugin Name ===
Contributors: ankurt
Donate link: http://oldmill1.github.com/jquery-image-carousel/
Tags: jquery, carousel, slideshow, images, presentation, graphics
Requires at least: 2.0.2
Tested up to: 3.3.2
Stable tag: 1.0

A WordPress plugin implemented as a shortcode for creating a slideshow right from the posts screen.

== Description ==

<h1>jQuery Image Carousel</h1>

<p>A WordPress plugin implemented as a shortcode for creating a slideshow right from the posts screen. </p>

<p>View my project <a href="http://oldmill1.github.com/jquery-image-carousel/">on Github</a></p>

<h2>How to use</h2>

<p>Using this plugin is as easy as </p>

<ol>
<li>Upload a bunch of images to a post.</li>
<li>Put the word <strong>[carousel]</strong> somewhere in the body of the post.</li>
<li>Publish or preview your post.</li>
</ol>

<h2>Change the size of the carousel</h2>

<p>You can change the size of the carousel display by passing a <em>size</em> argument.</p>

`[carousel size="thumbnail"]`

<p>Supported sizes: <em>thumbnail</em>, <em>medium</em>, <em>large</em>, <em>full</em></p>
<h2>Add some effects!</h2>
<p>You can change the way images transition by passing an <em>effect</em> argument.</p>

`[carousel effect="bouce"]`

<p>Please visit <a href="http://jqueryui.com/docs/show/">this page</a> for a list of supported effects.</p>
== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Put the word <strong>[carousel]</strong> somewhere in the body of the post.

== Frequently Asked Questions ==

= My carousel doesn't work/looks weird/doesn't load =

This may be because your theme doesn't have the template tags `wp_footer()` and `wp_head()`. <strong>Both</strong> are required for this plugin to work. 

= What about jQuery? =

You <strong>don't</strong> have to include a copy of jQuery. If one doesn't exist, the plugin will load WordPress's copy. 

== Screenshots ==

1. Default slider with image titles as captions. 

== Changelog ==

= 1.0 =
* Added effects! 