<?php
/**
 * /* Template Name Posts: arbeten
 *
 * This template allows you to display the latest posts on any page of the site.
 *
 */
    // calling the header.php
	global $wp_query;
	
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
<div id="single-arbeten-image">
			 <?php 
			 global $wp_query;
			$postid = $wp_query->post->ID;
			$xLink = get_post_meta($postid, 'external_link', true);
			 if ( has_post_thumbnail($custom_query ->ID)) {
       if($xLink!=NULL){?><a href="<?php echo $xLink?>" title="<?php esc_attr( $custom_query ->post_title ) ?>"><?php }
     echo get_the_post_thumbnail($custom_query ->ID, 'single-arbeten');
	 if($xLink!=NULL){?></a><?php }
    }?>
    </div>
    <div id="page-wrapper">
    	<div id="introtext-wrapper">
        <h1 class="entry-title">
				  <?php the_title(); ?>
				  </h1>
                 <?php if($xLink!=NULL){?> <h3><a href="<?php echo $xLink ?>" target="_blank">Se produkten här</a></h3><?php }?>
				<?php
				the_content();
		 ?>
        </div>
        <div id="below-navigation">
        <div class="nav-back">
        <?php  // create the navigation below the content
				previous_post_smart(
	$format = '<div class="more-back-arrow"></div> %link',
	$title = '%title',
	$fallback = true,
	$in_same_cat = true,
	$excluded_categories = '12,1,11,16,14,17,15,13'
);
?></div>
<div class="nav-forward"><?php
next_post_smart(
	$format = '%link <div class="more-arrow"></div>',
	$title = '%title',
	$fallback = true,
	$in_same_cat = true,
	$excluded_categories = '12,1,11,16,14,17,15,13'
);
				?></div>
                </div>
      </div>
        <!-- end of page-wrapper div -->
    
    
	 <?php
	 
            // calling the widget area 'page-top'
            get_sidebar('page-top');

           // the_post();
        
            
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