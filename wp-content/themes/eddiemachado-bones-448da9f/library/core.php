<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Mikael Eng
URL: http://www.mikaeleng.se
*/

/*********************
LAUNCH Mikaeleng.se core functions 
Let's fire off all the functions
and tools. I put it up here so it's
right up top and clean.
*********************/

function get_button($text='Read more'){
	?>
	<div class="button medium">
            <span>Read more</span>
          </div><?php
}
function get_site_bookmarks(){
$bookmarks = get_bookmarks( array(
	'orderby'        => 'name',
	'order'          => 'ASC',
	'limit'          => 5
));
	// Loop through each bookmark and print formatted output
	foreach ( $bookmarks as $bookmark ) { 
	   $links .= '<li><a class="relatedlink" href="' . $bookmark->link_url . '">' . $bookmark->link_name . '</a></li>';
	}
	return $links;
}
/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts() {
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) { 
			$tag_arr .= $tag->term_id . ',';
		}
	}

	$current_post = $post->ID;
	$exclude_arr = array($current_post );
	$popularpost = new WP_Query( array( 'posts_per_page' => 5, 'tag__and' => array($tag_arr), 'post__not_in' => $exclude_arr, 'meta_key' => 'views', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
	if ( $popularpost->have_posts() ) :
	while ( $popularpost->have_posts() ) : $popularpost->the_post();

	?><li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li><?php
	endwhile;
	echo '</ul>';
	else:
		return '<span>No posts at this moment</span>';
	endif;
} /* end bones related posts function */


/***********************/
function bones_popular_category_posts($args) {
	$count = $args['count'];
	$cat = $args['cat'];
	$popularpost = new WP_Query( array( 'posts_per_page' => $count, 'category__in' => $cat, 'meta_key' => 'views', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
		if ( $popularpost->have_posts() ) :
		echo '<ul id="bones-related-posts">';
		while ( $popularpost->have_posts() ) : $popularpost->the_post();
		?><li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li><?php
		endwhile;
		echo '</ul>';
		else:
			return '<span>No posts at this moment</span>';
		endif;
} /* end bones related posts function */

/* **********************************
		Get category 
 ********************************** */


function get_custom_categories($args){
	
	
	$categories = get_categories( $args );
	foreach ( $categories as $category ) {
	  $cats .= '<a href="' . get_category_link( $category->term_id ) . '">@' . $category->name . '</a>';
	}
	return $cats;
}


function get_custom_tag($args){
	global $post;
	$terms;
	$tags =  wp_get_post_tags($post->ID, $args->key);
	$count =0;

	foreach ( $tags as $tag ) {
	  if($count==0){
	  	$terms .= '<a href="' . get_tag_link( $tag->term_id ) . '">#' . $tag->name . '</a>';
	  }	else{
	  	$terms .= ', <a href="' . get_tag_link( $tag->term_id ) . '"> #' . $tag->name . '</a>';
	  }	
	  $count = $count +1;
	}
	return $terms;
}

// Add the  Meta Boxes

 

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function myplugin_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'myplugin_sectionid',
			__( 'Image position', 'myplugin_textdomain' ),
			'myplugin_meta_box_callback',
			$screen,'side', 'high'
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_my_meta_value_key', true );

	echo '<label for="myplugin_new_field">';
	_e( 'Choose the layout for the image in the feed', 'myplugin_textdomain' );
	echo '</label> ';
	?>
		<select id="myplugin_new_field" name="myplugin_new_field" style="display:block; width:100%;">
		  <option value="left-item"<?php selected( $value, 'left-item' ); ?> <?php if ($value == 'left-item'){echo ' selected';}?>>To the left</option>
		  <option value="large-item" <?php selected( $value, 'large-item' ); ?> <?php if ($value == 'large-item'){echo ' selected';}?> >In the top</option>
		  <option value="right-item" <?php selected( $value, 'right-item' ); ?> <?php if ($value == 'right-item'){echo ' selected';}?> >To the right</option>
		</select>
	<?php
	//echo '<input type="dropdown" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['myplugin_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['myplugin_new_field'] );
	
	// Update the meta field in the database.
	add_post_meta( $post_id, '_my_meta_value_key', $my_data, true ) or update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}
add_action( 'save_post', 'myplugin_save_meta_box_data' );

/*
add_action( 'load-edit.php', 'wpse34956_persistent_posts_list_mode' );
function wpse34956_persistent_posts_list_mode() {
    if ( isset( $_REQUEST['mode'] ) ) {
        // save the list mode
        update_user_meta( get_current_user_id(), 'posts_list_mode', $_REQUEST['mode'] );
        return;
    }
    // retrieve the list mode
    if ( $mode = get_user_meta( get_current_user_id(), 'posts_list_mode', true ) )
        $_REQUEST['mode'] = $mode;
}*/

?>
