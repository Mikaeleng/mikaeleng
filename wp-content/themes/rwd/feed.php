<?php
include('../../../wp-load.php');
/**
 * Template Name: Feed
 *
 * This template allows you to display the latest posts on any page of the site.
 *
 */
	$count = -1;	
	$divID = $_POST["iteration"];
	$cat_ID;
	isset($_POST['catid']) ? $cat_ID = $_POST["catid"] : $cat_ID = '6';
	$divEnd = $divID + 5;
	
	$args = array(
	'posts_per_page' => '-1',
	'orderby' => 'date',
	'order' => 'DESC',
	'cat' => $cat_ID
);
	$custom_query = new WP_Query($args); 
		while($custom_query->have_posts()) : $custom_query->the_post();
		$count++;		 
		if($count >=$divID && $count <= $divEnd){
         ?>
     <div class="post-item" id="divID_<?php echo $divID++;?>">
        <div class="post-image">
          <?php
         if ( has_post_thumbnail($custom_query ->ID)) {
          echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
         echo get_the_post_thumbnail($custom_query ->ID, 'cases-thumb', array('class' => 'wallfeed-imagesize')); 
          echo '</a>';
        }
    ?>
        </div>
        <i></i><a href="<?php echo get_permalink( $custom_query ->ID ) ?>"><h2>
          <?php the_title(); ?>
          </h2></a>
        <!-- end of post_image -->
        <div class="post-copy">
         <a href="<?php echo get_permalink( $custom_query ->ID ) ?>"> <p>
            <?php print_excerpt(200);//get_excerpt("auto") ?>
          </p>
        </div></a>
        <div class="post-footer">
          <p>
            <?php the_time('jS F Y')?>
          </p>
        </div>
      </div>
      <!-- end of post-item -->
    
    <?php
		}
    endwhile; // End the loop.
	wp_reset_query();
   	wp_reset_postdata();
	

	?>
   