<?php get_header(); ?>
	<div id="content" class="first clearfix">
		<div id="main" class="tvelvecol first clearfix" role="main">
					<div id="work-container">
						<div id="page-filter" class=" first"> <?php //echo bones_wpsearchComplete($form); ?>

					<?php //echo bones_tagsearch($form); ?>
					<!--<input type="text" value="" name="tag-term" id="tag-term" placeholder="" />
						<div id="selection" style="position:absolute;"></div> -->
						</div>
						<div id="work-item-container">
								<h1><?php
								//$category = get_the_category();
								//echo $category[0]->cat_name;
								?></h1>
							<?php 
							get_feedItems($args = array(
								'posts_per_page' => -1,
								'orderby' => 'date',
								'order' => 'DESC',
								'category_name' => 'work',
								'typeOfFeed' => 'work',
								'postLimit' =>3,
								'currentYear' => (string)get_the_time('Y'),
								'pointer' => -1
							)); ?>
						</div> <!-- end item-container-->
						<div id="load-more-container">
						<?php
					    get_button($arg = array(
					    	'typeOfAction' => 'work-page-feed-button',
			                'typeOfButton' => 'feed_button',
			                'button_text' => 'Load more posts',
			                'size' => 'large'
			                ));
					  	?>
					  	</div>
					</div> <!-- end create-container -->
				</div> <?php // end #main ?>

				<?php //get_sidebar(); ?>

				</div> <?php // end #inner-content ?>

			</div> <?php // end #content ?>
<script type="text/javascript">


</script>
<?php get_footer(); ?>
