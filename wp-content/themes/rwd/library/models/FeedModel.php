<?php

  $local = stripos($_SERVER['SERVER_NAME'], "engbo");

if((strpos($_SERVER['HTTP_HOST'], 'engbo') === false)){
  if (!empty($_POST)){
    include_once ($_SERVER['DOCUMENT_ROOT']. '/wp-load.php');
    set_feed();
  }
}else if((strpos($_SERVER['HTTP_HOST'], 'engbo')!== false)){
  if (!empty($_POST)){
    include_once ($_SERVER['DOCUMENT_ROOT']. '/mikaeleng/wp-load.php');
    set_feed();
  }
}

function set_feed(){
  switch ($_POST['TypeOfFeed']) {
      case 'create':
      get_create_feed_model($_POST);
      break;

      case 'wall':
      get_wall_feed_model($_POST);
      break;

      case 'work':
      get_work_feed_model($_POST);
      break;
      case 'live':
      get_live_feed_model($_POST);
      break;

      case 'header':
      get_header_feed_model($_POST);
      break;
  }
}
/**********************************
      Get Wall page feed model
************************************/
function get_wall_feed_model($args){
  global $post;
  isset($_POST['postLimit']) ? $args['postLimit'] = $_POST["postLimit"] : $args['postLimit'] = $args['postLimit'];
  isset($_POST['pointer']) ? $args['pointer'] = $_POST["pointer"] : $args['pointer'] = $args['pointer'];

  
  $custom_query = new WP_Query($args); 

  $total_posts = $custom_query->found_posts;

    while($custom_query->have_posts()) : $custom_query->the_post();
   
   if($custom_query->current_post > $args['pointer'] && $custom_query->current_post < $args['postLimit']){

    $post_type = get_post_meta( $post ->ID, '_post_feed_image_position', true );
      ?>
      <!-- // START feed-item -->
        <div class="feed-item <?php echo $post_type;?> first clearfix" id="divID_<?php echo $post ->ID;?>">
          <?php if ( has_post_thumbnail($custom_query ->ID)) {
            echo '<div class="img-container">';
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
         echo '</div>';
        }?>
          <div class="<?php if ( !has_post_thumbnail($custom_query ->ID)) {echo 'expand-info';}else{ echo 'feed-info';}?>">
            <a href="<?php echo get_permalink( $custom_query ->ID )?>" title="<?php echo esc_attr( $custom_query ->post_title ) ?>"><h2><?php the_title();?></h2></a>
            <?php print_excerpt(200);
            echo get_custom_tag(array('ID'=>$post->ID, 'key'=>'name'));?>
            <div class="tags first clearfix">

              <p><?php  ?></p>
            </div>
          </div>
        </div>
        <!-- // end feed-item -->
      <?php
    } // End if count --
  endwhile; // End the loop.
  // if there is no more posts then this will send a message and put it at the end of the current feed
 if($args['postLimit'] >= $total_posts){
    ?><div id="end-of-posts" hidden><h2>No more posts</h2></div><?php 
  }
  wp_reset_query();
  wp_reset_postdata(); // Ends --	
}

/**********************************
      Get Create page feed model 
************************************/

function get_create_feed_model($args){
  global $post;
  
  isset($_POST['postLimit']) ? $args['postLimit'] = $_POST["postLimit"] : $args['postLimit'] = $args['postLimit'];
  isset($_POST['pointer']) ? $args['pointer'] = $_POST["pointer"] : $args['pointer'] = $args['pointer'];
  isset($_POST['currentYear']) ? $args['currentYear'] = $_POST["currentYear"] : $args['currentYear'] = (string)get_the_time('Y');
  

  $current_year = $args['currentYear'];
  
  if (empty($_POST)){
    ?><div class="year-devider">NOW</div><?php
  }

  $custom_query = new WP_Query($args); 

  $total_posts = $custom_query->found_posts;
  
    while($custom_query->have_posts()) : $custom_query->the_post();

    if($custom_query->current_post > $args['pointer'] && $custom_query->current_post < $args['postLimit']){

      $post_year = (string)get_the_time('Y');
      
      if($current_year != $post_year){
        ?><div class="year-devider"><?php echo $post_year; 
          $current_year = $post_year;
        ?></div><?php
      }
        
      $post_workplace = get_post_meta( $post ->ID, '_post_workplace', true ); 
      $post_challange = get_post_meta( $post ->ID, '_post_challange', true ); 
      $post_experience = get_post_meta( $post ->ID, '_post_experience', true );
       ?>
      <!-- <a href="<?php echo get_permalink( $custom_query ->ID )?>" title="<?php echo esc_attr( $custom_query ->post_title ) ?>">-->
        <div class="feed-item first clearfix" id="divID_<?php echo $post ->ID;?>">
         <div class="year-tag"><?php echo the_time('Y');?></div>
        <div class="create-header">
       <a href="<?php echo get_permalink( $custom_query ->ID )?>" title="<?php echo esc_attr( $custom_query ->post_title ) ?>"> <h2><?php the_title();?></h2></a>
          <h3><?php echo $post_workplace; ?></h3>
        </div>

          <div class="create-content">
           <div class="create-info">
            <?php if (strlen($post_workplace)>0 && strlen($post_challange)>0 && strlen($post_experience)>0){ ?>
            <a href="<?php echo get_permalink( $custom_query ->ID )?>" title="<?php echo esc_attr( $custom_query ->post_title ) ?>">
            <h3>Challanges</h3>
            <p><?php echo $post_challange; ?></p>
            <h3>Experiences</h3>
            <p><?php echo $post_experience; ?></p>
            <?php }else{ 
              print_excerpt(300);
            }
              ?>
              </a>
          </div>
          <div class="create-metadata">
            <div class="tags first clearfix">
                <p>Tags: <?php echo get_custom_tag(array('ID'=>$post->ID, 'key'=>'name')); ?></p>
            </div>
            </div>
          </div>
        </div>
        <!-- </a> -->
        <!-- // end feed-item -->
      <?php
    } // ends if the count is between pointer and postLimit vars
  endwhile; // End the loop.

    // if there is no more posts then this will send a message and put it at the end of the current feed
 if($args['postLimit'] >= $total_posts){
    ?><div id="end-of-posts" hidden><h2>No more posts</h2></div><?php 
  }

  wp_reset_query();
  wp_reset_postdata(); // Ends -- 
  
}

/**********************************
      Get Work page feed model 
************************************/

function get_work_feed_model($args){
  
  global $post;
  
  isset($_POST['postLimit']) ? $args['postLimit'] = $_POST["postLimit"] : $args['postLimit'] = $args['postLimit'];
  isset($_POST['pointer']) ? $args['pointer'] = $_POST["pointer"] : $args['pointer'] = $args['pointer'];
  isset($_POST['currentYear']) ? $args['currentYear'] = $_POST["currentYear"] : $args['currentYear'] = (string)get_the_time('Y');
  
  
  if (empty($_POST)){
    ?><div class="year-devider">NOW</div><?php
  }

  $custom_query = new WP_Query( $args); 

  $total_posts = $custom_query->found_posts;
  
    while($custom_query->have_posts()) : $custom_query->the_post();

    if($custom_query->current_post > $args['pointer'] && $custom_query->current_post < $args['postLimit'] && $custom_query->current_post < $total_posts ){
     
      $post_workplace_ended = get_post_meta( $post ->ID, '_post_year_ended', true ); 
      $post_challange           = get_post_meta( $post ->ID, '_post_challange', true ); 
      $post_experience          = get_post_meta( $post ->ID, '_post_experience', true );
      $_cases                   = get_post_meta( $post ->ID, '_post_cases', true );
      $post_connected_cases     = explode(",", $_cases);
      $post_year = $post_workplace_ended;
      
      if($current_year != $post_workplace_ended && $post_workplace_ended != 'Now' && isset($current_year)){
        ?><div class="year-devider"><?php echo $post_year; 
          
        ?></div><?php
      }
        $current_year = $post_year;
       ?>
        <div class="feed-item first clearfix" id="divID_<?php echo $post ->ID;?>">
        
         <div class="year-tag"><?php echo the_time('Y') . ' - ' . $post_workplace_ended;?></div>
        <div class="work-header">
          <h2><?php the_title();?></h2>
        </div>
          <div class="work-content first clearfix">
           <div class="work-info">
            <?php 
              print_excerpt(300);
              ?>
          </div>
          <div class="work-metadata">
            <div class="tags first clearfix">
                <h3>Connected cases:</h3> <p><?php get_connected_cases($post_connected_cases); ?></p>
            </div>
            </div>
          </div>
        </div> <!-- // end feed-item -->
      <?php
    } // ends if the count is between pointer and postLimit vars
  endwhile; // End the loop.
  wp_reset_query();
  wp_reset_postdata(); // Ends -- 

 // if there is no more posts then this will send a message and put it at the end of the current feed
 if($args['postLimit'] >= $total_posts){
    ?><div id="end-of-posts" hidden><h2>No more posts</h2></div><?php 
  }

}

/**********************************
      Get LIVE page feed model 
************************************/

function get_live_feed_model($args){
  
  global $post;
  isset($_POST['postLimit']) ? $args['postLimit'] = $_POST["postLimit"] : $args['postLimit'] = $args['postLimit'];
  isset($_POST['pointer']) ? $args['pointer'] = $_POST["pointer"] : $args['pointer'] = $args['pointer'];


  $custom_query = new WP_Query($args);

  $total_posts = $custom_query->found_posts;

    while($custom_query->have_posts()) : $custom_query->the_post();

   if($custom_query->current_post > $args['pointer'] && $custom_query->current_post < $args['postLimit']){

    $post_type = get_post_meta( $post ->ID, '_post_feed_image_position', true );
      ?>
      <!-- // START feed-item -->
        <div class="feed-item <?php echo $post_type;?> first clearfix" id="divID_<?php echo $post ->ID;?>">

          <?php if ( has_post_thumbnail($custom_query ->ID)) {
            echo '<div class="img-container">';
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
             case 'auto':
             echo get_the_post_thumbnail($custom_query ->ID, 'feed-thumb-side', array('class' => 'feed-thumb-side'));
             break;
           default:
             echo get_the_post_thumbnail($custom_query ->ID, 'feed-thumb-large', array('class' => 'feed-thumb-large'));
             break;
         }

          echo '</a>';
          echo '</div>';
        }?>
          <div class="<?php if ( !has_post_thumbnail($custom_query ->ID)) {echo 'expand-info';}else{ echo 'feed-info';}?>">
            <a href="<?php echo get_permalink( $custom_query ->ID )?>" title="<?php echo esc_attr( $custom_query ->post_title ) ?>"><h2><?php the_title();?></h2></a>
            <a href="<?php echo get_permalink( $custom_query ->ID )?>" title="<?php echo esc_attr( $custom_query ->post_title ) ?>"><p><?php print_excerpt(200);

            echo get_custom_tag(array('ID'=>$post->ID, 'key'=>'name'));?></p></a>
           <?php /*echo get_custom_categories(array(
                    'orderby' => 'name',
                    'parent' => 0,
                    'category_name' => get_the_category($post->ID)
                    ));*/
              ?>
            <div class="tags first clearfix">

              <p><?php  ?></p>
            </div>
          </div>
        </div>
        <!-- // END feed-item -->
      <?php
    } // End if count --
  endwhile; // End the loop.
  // if there is no more posts then this will send a message and put it at the end of the current feed
 if($args['postLimit'] >= $total_posts){
    ?><div id="end-of-posts" hidden><h2>No more posts</h2></div><?php
  }
  wp_reset_query();
  wp_reset_postdata(); // Ends --


}

/**********************************
    Get Header item feed model
************************************/

function get_header_feed_model($args){
  global $post;
  isset($_POST['postLimit']) ? $args['postLimit'] = $_POST["postLimit"] : $args['postLimit'] = $args['postLimit'];
  isset($_POST['pointer']) ? $args['pointer'] = $_POST["pointer"] : $args['pointer'] = $args['pointer'];
  $total_posts = $custom_query->found_posts;

  $custom_query = new WP_Query($args); 
    while($custom_query->have_posts()) : $custom_query->the_post();
    if($custom_query->current_post > $args['pointer'] && $custom_query->current_post < $args['postLimit']){
  ?>
  <div id="top-item">

  <?php   if ( has_post_thumbnail($custom_query ->ID)) {
        echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
        echo get_the_post_thumbnail($custom_query ->ID, 'feed-thumb-large', array('class' => 'feed-thumb-large')); 
        echo '</a>';
     echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
        }?>
      <div id="<?php if ( !has_post_thumbnail($custom_query ->ID)) {echo 'expand-top-info';}else{echo 'top-info';}?>">
        <h2><?php the_title(); ?></h2>
        <p><?php get_excerpt(200,'',false); ?> ...</p>
       
         <div id="tag-cloud"><span></span><?php echo get_custom_tag(array('ID'=>$post->ID, 'key'=>'name')); ?></div>
        </div>
        <?php echo '</a>'; ?>
      </div>
    </div>
    <?php
  }
   endwhile; // End the loop.
  wp_reset_query();
  wp_reset_postdata();
}

function get_connected_cases($arr){  
   
    $max = sizeof($arr);
    $count = 0;
     foreach ($arr as &$value) {
      if(isset($value)){
        $_post = get_post($value);
        $count++;
        if($count<$max){
        ?><a href="<?php echo esc_url( get_permalink( $value ) ); ?>"><?php echo $_post->post_title; ?></a>,&nbsp;<?php
        }else if($count===$max){
          ?><a href="<?php echo esc_url( get_permalink( $value ) ); ?>"><?php echo $_post->post_title; ?></a><?php
        }
      }
    }
}
?>