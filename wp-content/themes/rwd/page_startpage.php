<?php
/*
Template Name: StartPage
*/

?>

<?php get_header(); ?>
	
			<div id="content" class="first clearfix">

				<!--<div id="intro" class="tvelvecol first clearfix">
					<h1><?php //the_title(); ?></h1>
					
				</div>-->

				<div id="main" class="tvelvecol first clearfix" role="main">
				<?php 					
					get_feedItems($args = array(
						'posts_per_page' => -1,
						'orderby' => 'date',
						'order' => 'DESC',
						'typeOfFeed' => 'wall',
						'postLimit' =>9,
						'pointer' => 0
					)); ?>
				</div> <?php // end #main ?>
				<div id="load-more-container">
				<?php
				    get_button($arg = array(
					    'typeOfAction' => 'startpage-feed-button',
		                'typeOfButton' => 'feed_button',
		                'button_text' => 'Load more posts',
		                'size' => 'large'
		                ));
				  	?>
				</div>
				</div> <?php // end #inner-content ?>

			</div> <?php // end #content ?>

<?php get_footer(); ?>