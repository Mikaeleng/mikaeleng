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

// Adds $img content after after first paragraph (!.e. after first `</p>` tag)
add_filter('the_content', function($content)
{
   $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
   //$img = '<img src="'.$url.'" alt="" title=""/>';
   $pre = '<pre>QUOTE</pre>';
   //$content = preg_replace('#(<p>.*?</p>)#','$1'.$pre, $content, 1);
   return $content;
});

/*function getLinkButton($args){
	?><a>Link</a>
<?php
}*/
function get_sitepath(){
	if (strpos(get_site_url(),'localhost') !== true || strpos(get_site_url(),'engbo') !== true) {

    return $sitepath  = str_replace('mikaeleng', '', get_site_url()). "mikaeleng/";
    }else{
      return $sitepath = get_site_url();
    }
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
function bones_related_posts()
{
	$tags = wp_get_post_tags($post->ID);
	if(count($tags)>0){
	?>
	<h2>Related articles</h2>
	<?php
	echo '<ul id="bones-related-posts">';
	global $post;

	if ($tags) {
		foreach ($tags as $tag) {
			$tag_arr .= $tag->term_id . ',';
		}
	}

	$current_post = $post->ID;
	$exclude_arr = array($current_post);
	$popularpost = new WP_Query(array('posts_per_page' => 5, 'tag__and' => array($tag_arr), 'post__not_in' => $exclude_arr, 'meta_key' => 'views', 'orderby' => 'meta_value_num', 'order' => 'DESC'));
	if ($popularpost->have_posts()) :
		while ($popularpost->have_posts()) : $popularpost->the_post();

			?>
			<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>"
										title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li><?php
		endwhile;
		echo '</ul>';
	else:
		return '<span>No posts at this moment</span>';
	endif;
	wp_reset_query();
	wp_reset_postdata();

    }
	?>
	<div class="tags first clearfix">

	<p>Tags: <?php echo get_custom_tag(array('ID' => $post->ID, 'key' => 'name')); ?></p>
	</div><?php
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
		wp_reset_query();
  		wp_reset_postdata();
		echo '</ul>';
		else:
			return '<span>No posts at this moment</span>';
		endif;

} /* end bones related posts function */

/* **********************************
		Get category 
 ********************************** */


function get_custom_categories($args){
	
	$cat = $args['category_name'];
	$categories = get_categories( $args );
	$cats = '<a href="' . get_category_link( $cat[0]->term_id ) . '">@' . $cat[0]->name . '</a>';
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

// Search Form with autocomplete fields
function bones_wpsearchComplete($form) {
	$form = '<form role="search" method="get" id="searchCompleteform" action="#" >
	<!--<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>-->
	<div id="input-container">
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( '', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( '' ) .'" /></div>
	</form>';
	return $form;
}

function get_analytics(){
	?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-25878290-1', 'auto');
	  ga('send', 'pageview');
</script>
<?php
}
// adds css class to post header 
function wpse_134409_current_category_class($classes, $item) {
    if (
        is_single()
        && 'category' === $item->object
        && in_array($item->object_id, wp_get_post_categories($GLOBALS['post']->ID))
    )
        $classes[] = 'current-category';

    return $classes;
} // function wpse_134409_current_category_class

add_filter('nav_menu_css_class', 'wpse_134409_current_category_class', 10, 2);

?>
