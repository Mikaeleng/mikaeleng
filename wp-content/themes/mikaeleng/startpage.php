<?php
/**
 * Template Name: Startpage
 *
 * This template allows you to display the latest posts on any page of the site.
 *
 */

    // calling the header.php
	
    get_header();

    // action hook for placing content above #container
    thematic_abovecontainer();

?>
	<div id="container">
		<div id="content">

			  <?php
			/* Run the loop to output the posts.*/
			
	echo '<script type="text/javascript" src="wp-content/themes/mikaeleng/js/infinite-rotator.js"></script>';
			?>
           
    <div id="portfolio-holder">
    
      <?php $custom_query = new WP_Query('posts_per_page=6&order=ACS&orderby=date&category_name=arbeten'); 
				while($custom_query->have_posts()) : $custom_query->the_post(); ?>
      <div class="portfolio-item"> 
      <?php if ( has_post_thumbnail($custom_query ->ID)) {
      echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
     echo get_the_post_thumbnail($custom_query ->ID, 'startpage-arbeten');
      echo '</a>';
    }?>
    <h4 ><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h4>
      <!--	<div class="case-date">
        	<?php the_time('jS F Y') ?>
        </div>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h2>
        <?php  the_excerpt();?>
     --> </div>
      <!-- .entry-summary -->
      <?php endwhile; // End the loop. ?>
    </div>
     <!-- 
   <TA BORT DENNA KOMMENTAREN>
     <hr />
    <div id="recept-holder">
    	 <?php $custom_query = new WP_Query('orderby=rand&posts_per_page=2&category_name=recept'); 
				while($custom_query->have_posts()) : $custom_query->the_post(); ?>
      <div class="recept-item"> 
      <?php if ( has_post_thumbnail($custom_query ->ID)) {
      echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
     echo get_the_post_thumbnail($custom_query ->ID, 'startpage-postitem');
      echo '</a>';
    }?>
   
   <div class="recept-except"><h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
          <?php the_title(); ?></h2></a>
          <?php  //the_excerpt();?>
    	</div>
    </div>
    
      <?php endwhile; // End the loop. ?>
      
    <?php wp_reset_postdata(); // reset the query ?>
    
       <?php $custom_query = new WP_Query('orderby=rand&posts_per_page=8&category_name=recept'); 
				while($custom_query->have_posts()) : $custom_query->the_post(); ?>
      <div class="recept-microitem"> 
      <?php if ( has_post_thumbnail($custom_query ->ID)) {
      echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
     echo get_the_post_thumbnail($custom_query ->ID, 'startpage-micropostitem');
      echo '</a>';
    }?>
    <div class="recept-except"><h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
          <?php the_title(); ?></h2></a>
          <?php  //the_excerpt();?>
    	</div>
    </div>
      <?php endwhile; // End the loop. ?>
      
    </div>
    <TA BORT DENNA KOMMENTAREN>
    -->
    <!-- loop for small thumbs in feed loop -->
  <!--   Ta bort denna kommentar ...
  
  <div id="feed-holder">
    <div id="feed-head"><h3>Poster</h3></div>
    <?php $custom_query = new WP_Query('orderby=rand&posts_per_page=8'); 
				while($custom_query->have_posts()) : $custom_query->the_post(); ?>
      <div class="recept-feeditem"> 
      <?php if ( has_post_thumbnail($custom_query ->ID)) {
      echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
     echo get_the_post_thumbnail($custom_query ->ID, 'startpage-feedpostitem');
     echo '</a>';
    }?>
   		<div class="feed-except"><h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
          <?php the_title(); ?></h2></a>
          <?php  the_excerpt();?>
    	</div>
    </div>
      <?php endwhile; // End the loop. ?>
    </div>
    < Ta bort denna kommentaren>
    -->
    
    <?php wp_reset_postdata(); // reset the query ?>
    
            <?php
        
            // calling the widget area 'page-top'
            get_sidebar('page-top');

           // the_post();
        
            ?>
            
			<div id="post-<?php //the_ID(); ?>" class="<?php //thematic_post_class() ?>">
            
                <?php 
                
               
                
                ?>
                
				<div class="entry-content">

                    <?php
                    
                   // the_content();
                    
                    wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'thematic'), "</div>\n", 'number');
                    
                    edit_post_link(__('Edit', 'thematic'),'<span class="edit-link">','</span>') ?>

				</div>
			</div><!-- .post -->

        <?php
        
        if ( get_post_custom_values('comments') ) 
            thematic_comments_template(); // Add a key/value of "comments" to enable comments on pages!
        
        // calling the widget area 'page-bottom'
        get_sidebar('page-bottom');
        
        ?>

		</div><!-- #content -->
	</div><!-- #container -->

<?php 

    // action hook for placing content below #container
    thematic_belowcontainer();

    // calling the standard sidebar 
    thematic_sidebar();
    
    // calling footer.php
    get_footer();

?>