<?php
/*
Template Name: Category Live
*/

?>

<?php get_header();?>
	


	<div id="content" class="first clearfix">
		<div id="main" class="tvelvecol first clearfix" role="main">
					<div id="live-container">
						<!-- <div id="page-filter" class=" first"> <?php //echo bones_wpsearchComplete($form); ?>-->

					<?php //echo bones_tagsearch($form); ?>
					<!--<input type="text" value="" name="tag-term" id="tag-term" placeholder="" />
						<div id="selection" style="position:absolute;"></div> -->

						<div id="live-item-container">
								<!--<h1 ><?php
									//$category = get_the_category();
									//echo $category[0]->cat_name;
									?></h1>-->
							<?php 
							get_feedItems($args = array(
								'posts_per_page' => -1,
								'orderby' => 'date',
								'order' => 'DESC',
								'typeOfFeed' => 'live',
								'postLimit' =>9,
								'category_name' => 'live',
								'pointer' => -1
							)); ?>
						</div> <!-- end item-container-->
						<div id="load-more-container">
						<?php
//						if($hide_button!=true){
						    get_button($arg = array(
						    	'typeOfAction' => 'live-page-feed-button',
				                'typeOfButton' => 'feed_button',
				                'button_text' => 'Load more posts',
				                'size' => 'large'
				                ));
//						}
					  	?>
						</div>
					  	</div>
					</div> <!-- end create-container -->
				</div> <?php // end #main ?>

				<?php //get_sidebar(); ?>

				</div> <?php // end #inner-content ?>

			</div> <?php // end #content ?>
<script type="text/javascript">


</script>
<?php get_footer(); ?>
