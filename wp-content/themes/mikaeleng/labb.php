<?php
/**
 * Template Name: labb
 *
 * This template allows you to display the latest posts on any page of the site.
 *
 */
    // calling the header.php
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>
<!--<div id="top-shadow"> </div>-->
<?php
 // creating the post header
 
     thematic_postheader();
	 
?>
<div id="slideshow">
    
      <ul class="slides">
      <li><img class="attachment-startimage wp-post-image" src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/images/om-mig2004.jpg"/></li>
      <li><img class="attachment-startimage wp-post-image" src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/images/om-mig20042.jpg"/></li>
      <li><img class="attachment-startimage wp-post-image" src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/images/om-mig2005.jpg"/></li>
        <?php /*
        // add dynamicly images and post info to the slideshow orderby=rand&
        $custom_query = new WP_Query('posts_per_page=7&orderby=rand&cat=11'); 
                    while($custom_query->have_posts()) : $custom_query->the_post();
         echo  '<li>'; 
         if ( has_post_thumbnail($custom_query ->ID)) {
          echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
         echo get_the_post_thumbnail($custom_query ->ID, 'startimage');
          echo '</a>';
        }
     echo '</li>';
      endwhile; // End the loop.
	*/
	?>
    </ul>

	</div>
   <!-- <div id="pagination-wrapper">
    <ul>
    </ul>
    </div>
    <div id="control-wrapper">
    <span class="arrow previous"></span>
    <span class="arrow next"></span>
    </div>-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    
<div id="container">
  <div id="content">
   <?php
			/* Run the loop to output the posts.*/
			
	echo '<script type="text/javascript" src="wp-content/themes/mikaeleng/js/infinite-rotator.js"></script>';
			?>
 <!-- <div id="head-image-wrapper">
                	<?php 
					if ( has_post_thumbnail($custom_query ->ID)) {
						//echo get_the_post_thumbnail($custom_query ->ID, 'single-arbeten');
					}
					?>
                </div>-->
  <h1 class="entry-title">
				  <?php the_title(); ?>
				  </h1>
    <?php
	the_content();
        // calling the widget area 'page-top'
            get_sidebar('page-top');
            ?>
    <div id="post-<?php //the_ID(); ?>" class="<?php //thematic_post_class() ?>">
     
      <div class="entry-content">
        <?php
                    wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'thematic'), "</div>\n", 'number');
                    
                    edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>
      </div>
    </div>
    <!-- .post -->
    
    <?php
        
        if ( get_post_custom_values('comments') ) 
            thematic_comments_template(); // Add a key/value of "comments" to enable comments on pages!
        
        // calling the widget area 'page-bottom'
        get_sidebar('page-bottom');
        
        ?>
  </div>
  <!-- #content --> 
</div>
<!-- #container -->

<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();

?>
