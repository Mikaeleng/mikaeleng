<?php
/*
Template Name: StartPage
*/

?>

<?php get_header(); ?>
	
			<div id="content" class="first clearfix">

				<div id="intro" class="tvelvecol first clearfix">
					<h1><?php the_title(); ?></h1>
					
				</div>

				<div id="main" class="tvelvecol first clearfix" role="main">
					<?php 
					get_feedItems($args = array(
						'posts_per_page' => '10',
						'orderby' => 'date',
						'order' => 'DESC',
						'item_cat' => 'wall'
					)); ?>
				</div> <?php // end #main ?>

				<?php get_sidebar(); ?>

				</div> <?php // end #inner-content ?>

			</div> <?php // end #content ?>

<?php get_footer(); ?>
