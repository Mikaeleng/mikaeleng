<?php get_header(); ?>

			<div id="content" class="first clearfix">

					<div id="main" class="eightcol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php if ( has_post_thumbnail($post ->ID)) {
								?>
							<div id="img_thumb_container">
								<?php
							echo get_the_post_thumbnail($post ->ID, 'feed-thumb-large');
							}?>
							</div>
							<div class="nav-links"> <?php 
								echo previous_post_link('%link', 'Previous', $in_same_cat = true);
								echo next_post_link('%link', 'Next', $in_same_cat = true);
								?></div>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<header class="article-header">

									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
									<p class="byline vcard">
										<span><?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> ', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format'))); ?></span>

										<span><?php printf( __( '<p>Category</p> %1$s' ),  get_the_category_list(', ') );?></span>

									</p>

								
								</header> <?php // end article header ?>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content();  ?>
								</section> <?php // end article section ?>

								<?php // end article footer ?>


							</article>
							<div class="nav-links"> <?php // end article 
							echo previous_post_link('%link', 'Previous', $in_same_cat = true);
								echo next_post_link('%link', 'Next', $in_same_cat = true);?>
							</div> <!-- end of nav links -->
							<footer class="article-footer">
									<?php echo bones_related_posts(); ?>
								</footer> 
						<?php endwhile; ?>
						<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>

							</article>

						<?php endif; ?>

					</div> <?php // end #main ?>
					<?php get_sidebar(); ?>
<?php // end #inner-content ?>

			</div> <?php // end #content ?>

<?php get_footer(); ?>
