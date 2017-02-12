<?php get_header();
$garmin_activity = get_post_meta( $post ->ID, '_post_garmin', true );
if($garmin_activity != null){
?>
    <div id="running-top" class="row">
        <div id="post_iframe_container">
            <iframe src='https://connect.garmin.com/activity/embed/<?php echo $garmin_activity ?>' frameborder='0'></iframe>

        </div>
        <?php if ( has_post_thumbnail($post ->ID)) {
        ?>
        <div id="img_thumb_container">
            <?php
            echo get_the_post_thumbnail($post ->ID, 'feed-thumb-large');
            ?></div><?php
        }?></div>
<?php } ?>

			<div id="content" class="first clearfix">

					<div id="main" class="eightcol first clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                            <?php
                            if($garmin_activity == null){
                            if ( has_post_thumbnail($post ->ID)) {
                                ?>
                                <div class="single-img-container">
                                <?php
                                echo get_the_post_thumbnail($post ->ID, 'feed-thumb-header');
                            }?>
                            </div>
                            <?php } ?>
							<div class="nav-links"> <?php 
								echo previous_post_link('%link', 'Previous', $in_same_cat = true);
								echo next_post_link('%link', 'Next', $in_same_cat = true);
								?></div>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                                <h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content();  ?>
								</section> <?php // end article section ?>

								<?php // end article footer ?>
                                <header class="article-header">

                                </header> <?php // end article header ?>

							</article>
							<div class="nav-links"> <?php // end article 
							echo previous_post_link('%link', 'Previous', $in_same_cat = true);
								echo next_post_link('%link', 'Next', $in_same_cat = true);?>
							</div> <!-- end of nav links -->

									<?php echo bones_related_posts(); ?>

						<?php endwhile; ?>
						<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Oops, I lost something', 'liveworkcreate' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Please go back.', 'liveworkcreate' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'Oops I lost my footing', 'liveworkcreate' ); ?></p>
									</footer>

							</article>

						<?php endif; ?>

					</div> <?php // end #main ?>
					<?php get_sidebar(); ?>
<?php // end #inner-content ?>

			</div>
<div id="cinema-mode"><p>X</p></div> <?php // end #content ?>

<?php get_footer(); ?>
