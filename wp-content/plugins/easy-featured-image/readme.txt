=== Plugin Name ===
Contributors: RPG84 
Tags: featured image, admin, easy, edit
Requires at least: 3.0
Tested up to: 3.0.4
Stable tag: 1.1

Easily edit and see featured images on your post edit screen.

== Description ==
On edit.php you will be able to see the currently used featured image for a post. Now you don't have to open a post to add a featured image. You can do this from the edit.php screen.

== Installation ==

1. Add the following in your functions.php to enable featured images:<?php add_theme_support('post-thumbnails'); ?>
1. Place easy_featured_images into your plugin directoy, and activate it.
1. Goto your post edit screen to see your featured images

== Frequently Asked Questions ==
= I don't see the tumbnails in my theme =
You need to put `<?php the_post_thumbnail(array( 100,100 )); ?>` somewhere in your theme

== Changelog ==
= 1.1 =
Fixed a minor error 
Added it for pages too

= 1.0 =
First Release
