<?php
function get_wall_feed_model($args){
  global $post;
  
  $custom_query = new WP_Query($args); 
    while($custom_query->have_posts()) : $custom_query->the_post();
    $count++;    
    if($custom_query->current_post !=0){
    $post_type = get_post_meta( $post ->ID, '_my_meta_value_key', true );
      ?>
        <div class="feed-item <?php echo $post_type;?> first clearfix" id="divID_<?php echo $custom_query ->ID;?>">
          <?php if ( has_post_thumbnail($custom_query ->ID)) {
         echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
         switch ($post_type) {
           case 'right-item':
              echo get_the_post_thumbnail($custom_query ->ID, 'feed-thumb-side', array('class' => 'feed-thumb-side')); 
             break;
           case 'large-item':
            echo get_the_post_thumbnail($custom_query ->ID, 'feed-thumb-large', array('class' => 'feed-thumb-large')); 
           break;
           case 'left-item':
             echo get_the_post_thumbnail($custom_query ->ID, 'feed-thumb-side', array('class' => 'feed-thumb-side')); 
             break;
           default:
             echo get_the_post_thumbnail($custom_query ->ID, 'feed-thumb-large', array('class' => 'feed-thumb-large')); 
             break;
         }
         
          echo '</a>';
        }?>
          <div class="feed-info">
            <a href="<?php echo get_permalink( $custom_query ->ID )?>" title="<?php echo esc_attr( $custom_query ->post_title ) ?>"><h2><?php the_title();?></h2></a>
            <p><?php print_excerpt(200); ?></p>
            <div class="category first clearfix">
              <span>Category</span>
              <p><?php echo get_custom_categories(array(
                    'orderby' => 'name',
                    'parent' => 0
                    ));
              ?></p>

            </div>
            <div class="tags first clearfix">
              
              <p>Tags: <?php echo get_custom_tag(array('ID'=>$post->ID, 'key'=>'name')); ?></p>
            </div>
          </div>
        </div> <!-- // end feed-item -->
      <?php
    } // End if count --
  endwhile; // End the loop.
  wp_reset_query();
  wp_reset_postdata(); // Ends --	
}

function get_header_feed_model($args){
   global $post;
  
  $custom_query = new WP_Query($args); 
    while($custom_query->have_posts()) : $custom_query->the_post();
  ?>
  <div id="top-item">

<?php   if ( has_post_thumbnail($custom_query ->ID)) {
        echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
        echo get_the_post_thumbnail($custom_query ->ID, 'feed-thumb-large', array('class' => 'feed-thumb-large')); 
        echo '</a>';
     echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
        }?>
      <div id="top-info">
        <h2><?php the_title(); ?></h2>
        <p><?php get_excerpt(200,'',false); ?> ...</p>
       
         <div id="tag-cloud"><span>Tags: </span><?php echo get_custom_tag(array('ID'=>$post->ID, 'key'=>'name')); ?></div>
        </div>
        <?php echo '</a>'; ?>
      </div>
    </div>
    <?php
   endwhile; // End the loop.
  wp_reset_query();
  wp_reset_postdata();
}
?>
   