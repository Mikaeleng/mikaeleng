<?php
/*
Plugin Name: Easy Featured Image
Plugin URI: http://wordpress.org/extend/plugins/easy-featured-image/
Version: 1.1
Description: This plugin enables editting the featured images on the edit.php in the admin menu. You will need to put this in your functions.php to enable featured images:<?php add_theme_support('post-thumbnails'); ?>
Author: Robert Braam
Author URI: http://randommusicvideos.com
 */
 
function show_featured_image_column( $defaults ) {
       $defaults['featuredimage'] = __('Featured Image') ;
    	return $defaults;
}
add_filter('manage_posts_columns', 'show_featured_image_column');
add_filter('manage_pages_columns', 'show_featured_image_column');


function edit_featured_images($column_name, $id) {
global $post;
    if( $column_name == 'featuredimage' && has_post_thumbnail()) {
        the_post_thumbnail( array(100,100) );
	/*
	$ajax_nonce = wp_create_nonce($post->ID);
        echo "<div class=\"row-actions\"><span class='edit'>";
	echo '<a href="#" id="remove-post-thumbnail" onclick="WPRemoveThumbnail(\''.$ajax_nonce.'\');return false;">Remove featured image</a>';
        echo "</span></div>";
	*/
}
    if( $column_name == 'featuredimage' && !has_post_thumbnail()){
        echo "<div class=\"row-actions\"><span class='edit'>";
        echo '<a href="'. admin_url() . 'media-upload.php?post_id='.$post->ID.'&type=image&TB_iframe=1&width=640&height=500" target="_blank">' . __( 'Add' ) . '</a>';
        echo "</span></div>";
}}
add_action('manage_posts_custom_column', 'edit_featured_images', 10, 2);
add_action('manage_pages_custom_column', 'edit_featured_images', 10, 2);
?>