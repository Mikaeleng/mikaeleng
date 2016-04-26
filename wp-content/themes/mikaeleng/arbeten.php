<?php
/**
 * Template Name: arbeten
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

<div id="container">
  <div id="content">
  <h1 class="entry-title">
				  <?php the_title(); ?>
				  </h1>
    <?php
			/* Run the loop to output the posts.*/
			?>
    <div id="work-holder">
        <?php  echo get_the_post_thumbnail($thumbnail->ID, 'startpage-arbeten'); ?>
          <?php $custom_query = new WP_Query('posts_per_page=-1&category_name=arbeten'); 
                    while($custom_query->have_posts()) : $custom_query->the_post(); 
		?>			
        <div class="work-item">
        <div class="work-image"> 
		<?php
                    if ( has_post_thumbnail($custom_query ->ID)) {
						?><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php
                     echo get_the_post_thumbnail($custom_query->ID, 'startpage-arbeten'); 
                    }?>
                    </a>
          </div>
      <div class="work-info">
        <div class="button-div">
          <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_title(); ?>
            </a></h2>
            <?php the_excerpt() ?>
        </div>
       </div>
      </div>
      <!-- .entry-summary -->
      <?php endwhile; // End the loop. ?>
    </div>
    <?php wp_reset_postdata(); // reset the query ?>
    <?php
        
            // calling the widget area 'page-top'
            get_sidebar('page-top');

           // the_post();
        
            ?>
    <div id="post-<?php //the_ID(); ?>" class="<?php //thematic_post_class() ?>">
      <?php 
 
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
