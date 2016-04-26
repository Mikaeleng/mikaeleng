

<?php get_header(); 
$divID = 0;
	$postLength;
	$countDivide = 10;
	$pagination = $_GET['pagination'];
	if(isset($pagination)!=1){
		$postStart=0;
	}else{
		$postStart = $pagination *10-10;
	}
	$postDivide;
?>

			<div id="content" class="wrap">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="twelvecol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
									<!--<p class="byline vcard"><?php
										//printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'bonestheme' ) ), bones_get_the_author_posts_link());
									?></p>-->


								</header> <?php // end article header ?>

								<section class="entry-content clearfix" itemprop="articleBody">
									<!--<?php the_content(); ?>-->

									<?php


									?> <!-- end of main query -->
									<div id="singleCol">
									<?php
										$custom_query = new WP_Query('posts_per_page=3&orderby=date&order=DESC&cat=3'); 
									                    while($custom_query->have_posts()) : $custom_query->the_post();
									         ?>
									      <div class="post-item" id="divID_<?php echo $divID++;?>">
									        <div class="post-image">
									          <?php
									         if ( has_post_thumbnail($custom_query ->ID)) {
									          echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
									         echo get_the_post_thumbnail($custom_query ->ID, 'cases-thumb', array('class' => 'wallfeed-imagesize')); 
									          echo '</a>';
									        }
											?>
									        </div>
									        <i></i><a href="<?php echo get_permalink( $custom_query ->ID ) ?>"><h2>
									          <?php the_title(); ?>
									          </h2>
									          </a>
									        <!-- end of post_image -->
									       <a href="<?php echo get_permalink( $custom_query ->ID ) ?>"> <div class="post-copy">
									          <p>
									            <?php print_excerpt(200);//get_excerpt("auto") ?>
									          </p>
									        </div></a>
									        <div class="post-footer">
									          <p>
									            <?php the_time('jS F Y')?>
									          </p>
									        </div>
									      </div>
									      <!-- end of post-item -->
									      <?php
									      endwhile; // End the loop.
										wp_reset_query();
									   	wp_reset_postdata();
										?>
									    </div>
									    
									<div id="leftCol"></div>
									<div id="rightCol"></div>
										<!--<div class="post-item">
											<i></i><h2>Axure 7 är en stor förbättring</h2>
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
											Morbi commodo, ipsum sed pharetra gravida, orci magna 
											rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit 
											amet enim.
											</p>
										</div>
										<div class="post-item">
											<img src="<?php echo get_site_url(); ?>/wp-content/uploads/woods.jpg" />
											<i></i><h2>Cambios nya webbplats</h2>
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
											Morbi commodo, ipsum sed pharetra gravida, orci magna 
											rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit 
											amet enim.
											</p>
										</div>
										<div class="post-item">
											<i></i><h2>Varför måste man betala per månad för datorprogram?</h2>
											<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
											Morbi commodo, ipsum sed pharetra gravida, orci magna 
											rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit 
											amet enim.
											</p>
										</div>-->
									</div>
								</section>
								<?php // end article section ?>
								

								<footer class="article-footer">
									<?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?>
										<?php add_feed_button(); ?>
								</footer> <?php // end article footer ?>

								<?php comments_template(); ?>

							</article> <?php // end article ?>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div> <?php // end #main ?>

						<?php get_sidebar(); ?>

				</div> <?php // end #inner-content ?>

			</div> <?php // end #content ?>

<?php get_footer(); ?>
