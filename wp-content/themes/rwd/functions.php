<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* PHP SCRIPT TAGS TO SAVE ***************/
//		Makes a drop down list of all the categories good for admin quick new post template

//		wp_dropdown_categories(array('hide_empty' => 0, 'name' => 'select_name', 'hierarchical' => true));




/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break

/*

*/
//require_once('library/Mobile_Detect.php');
require_once( 'library/core.php' ); // if you remove this, bones will break
require_once('library/models/FeedModel.php');
require_once('library/models/MetaboxesModel.php');
require_once('library/controllers/FeedController.php');
require_once('library/controllers/ButtonController.php');
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
 require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
add_image_size( 'feed-thumb-side', 441, 359, true );
add_image_size( 'feed-thumb-large', 970, 340, true );
add_image_size( 'feed-thumb-header', 672, 590, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/


class Child_Wrap extends Walker_Nav_Menu
{
    function end_el(&$output, $item, $depth)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</li>\n";
    }
}

function add_last_nav_item($items) {
  return $items .= bones_wpsearch($form);
}

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

// Add a Custom CSS file to WP Admin Area
function admin_theme_style() {
    wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/library/css/_admin.css');
}
add_action('admin_enqueue_scripts', 'admin_theme_style');
/************* CUSTOM SINGLE POST TEMPLATE ********************/

function get_custom_post_type_template($single_template) {
     global $post;
	$category = get_the_category(); 
	
	foreach ($category as &$value) {
		$str = strtolower($value->cat_name);
	   if ( file_exists(dirname( __FILE__ ) . '/single-' . $str . '.php') ) {
		   
	   return dirname( __FILE__ ) . '/single-' . $str . '.php'; 
	   }
	}
     return $single_template;
}
add_filter( "single_template", "get_custom_post_type_template" ) ;



/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/******* CUSTOM DINAMIC EXCERPT ********/

function add_to_head(){
 	//echo '<script src="wp-content/themes/mikaeleng/js/me-script.js" type="text/javascript">  </script>';
	//echo '<script src="wp-content/themes/mikaeleng/js/timer.js" type="text/javascript">  </script>';
	if (is_page(388 || 333)) {
    ?>
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo get_sitepath(); ?>wp-content/themes/eddiemachado-bones-448da9f/library/css/event.css" />-->
   	<script src="<?php echo get_sitepath(); ?>wp-content/themes/rwd/library/js/db-script.js" type="text/javascript">  </script>
    <?php
  }
	/*if(is_front_page()){
	 echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
	}*/
}
add_action('wp_head', 'add_to_head');

// Variable & intelligent excerpt length.
function get_excerpt($count, $class,$show_button){
	global $post;
	if($class==NULL){ $class='';}
	if($show_button==NULL){ $show_button='';}
	$postid =  get_post($post);
	$readmore = get_post_meta($postid->ID, 'readmore_link', true);
	
	$permalink = get_permalink($post->ID);
	$excerpt = get_the_excerpt(); //get_post_meta($postid->ID, 'excerpt_text', true);
	$excerpt = strip_tags($excerpt, '<a>,<img>, <p>,<span>');
	
 	$str = strlen($excerpt);
	if($count != 'auto'){
	  $excerpt = substr($excerpt, 0, $count);
	 $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	}
	if($show_button){
		if( $count!= 'auto'){
			$excerpt = '<p class="excerpt-wrapper">' . $excerpt. '</p><div class="case-more"><p class="readmore"><a href="'.$permalink.'" class="' . $class .'">L&auml;s mer</a></p></div>'; 
		}else if( $count== 'auto' && $readmore=="yes"){
		$excerpt = '<p class="excerpt-wrapper">' . $excerpt. '</p><div class="case-more"><p class="readmore"><a href="'.$permalink.'">L&auml;s mer</a></p></div>'; 
		}/*else if($str <= $count && $count!="auto"){
			$excerpt = '<p class="excerpt-wrapper">' . $excerpt.'</p>';
		}*/
	}
	echo $excerpt;
}
function print_excerpt($length) { // Max excerpt length. Length is set in characters

	global $post;

	$text = $post->post_excerpt;

	if ( '' == $text ) {

		$text = get_the_content('');

		$text = apply_filters('the_content', $text);

		$text = str_replace(']]>', ']]>', $text);

	}

	$text = strip_shortcodes($text); // optional, recommended

	$text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags



	$text = substr($text,0,$length);

	$excerpt = reverse_strrchr($text, '.', 1);

	if( $excerpt ) {

		echo apply_filters('the_excerpt',$excerpt);

	} else {

		echo apply_filters('the_excerpt',$text);

	}

}
function reverse_strrchr($haystack, $needle, $trail) {
    return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}



function twitter_aside(){
	?>
		<div id="twitter-aside" class="wrap">
			<div id="twitter-top">
				<h2>Twitter</h2>
				<span class="twitter"></span>
			</div>
			<div id="twitter-content">
				<?php my_twitter_feed(my_twitter_feed_config('MikaelEng',3)); ?>
				<div class="action-button"><a>Läs mer Twitter</a></div>
			</div>
		</div>
	<?php
}

/*******************************************
*
*		Get my twitter feed 
*
********************************************/

function my_twitter_feed_config($username = 'MikaelEng', $count=3, $cachehours=3,$clearcache='no'){
	$feed_config = array(
	'user'                      => $username, // String: Any valid Twitter username
	'count'                     => $count,       // String: ("yes" or "no") Load the bundled stylesheet
	'cache_hours'               => $cachehours,       // String: ("yes" or "no") Only display tweets that aren't replies
	'default_styling'           => 'yes',            // Int:    Number of hours to cache the output
	'clear_cache'               => $clearcache
);
	return $feed_config;
}
function my_twitter_feed( $feed_config = NULL ) {

	/* Configuration validity checks are performed on initialisation
	   so you don't have to worry your (presumably) pretty little head */
	$the_feed = new DB_Twitter_Feed( $feed_config );

	

	if ( ! $the_feed->is_cached ) {
		// We only want to talk to Twitter when our cache is on empty
		$the_feed->retrieve_feed_data();

		// After attempting data retrieval, check for errors
		if ( $the_feed->has_errors() ) {
			$the_feed->output .= '<p>Your own error message here. Otherwise you can loop through the <code>$errors</code> (array) property to view the errors returned.</p>';

		// Then check for an empty timeline
		} elseif( $the_feed->is_empty() ) {
			$the_feed->output .= '<p>Your own &ldquo;timeline empty&rdquo; message here.</p>';

		// With the checks done we can get to HTML renderin'
		} else {

			/* Below is the default HTML layout. Tweak to taste
			*********************************************************/
			$the_feed->output .= '<div class="tweets">'; // START The Tweet list

			foreach ( $the_feed->feed_data as $tweet ) {
				/* parse_tweet_data() takes the raw data, gets what's useful, formats it,
				   and returns it as a nice, neat array */
				$t = $the_feed->parse_tweet_data( $tweet );


				// START Rendering the Tweet's HTML (outer tweet wrapper)
				$the_feed->output .= '<article class="tweet">';

				// START tweet_content (inner tweet wrapper)
				$the_feed->output .= '<div class="tweet_content">';

				// START Display pic
				$the_feed->output .= '<figure class="tweet_profile_img">';
				$the_feed->output .= '<a href="'.$the_feed->tw.$t['user_screen_name'].'" target="_blank" title="'.$t['user_display_name'].'"><img src="'.$t['profile_img_url'].'" alt="'.$t['user_display_name'].'" /></a>';
				$the_feed->output .= '</figure>';
				// END Display pic

				// START Twitter username/@screen name
				$the_feed->output .= '<header class="tweet_header">';
				$the_feed->output .= '<a href="'.$the_feed->tw.$t['user_screen_name'].'" target="_blank" class="tweet_user" title="'.$t['user_description'].'">'.$t['user_display_name'].'</a>';
				$the_feed->output .= ' <span class="tweet_screen_name">@'.$t['user_screen_name'].'</span>';
				$the_feed->output .= '</header>';
				// END Twitter username/@screen name

				// START The Tweet text
				$the_feed->output .= '<div class="tweet_text">'.$t['text'].'</div>';
				// END The Tweet text

				// START Tweet footer
				$the_feed->output .= '<div class="tweet_footer">';

				// START Tweet date
				$the_feed->output .= '<a href="'.$the_feed->tw.$t['user_screen_name'].'/status/'.$t['id'].'" target="_blank" title="View this tweet in Twitter" class="tweet_date">'.$t['date'].'</a>';
				// END Tweet date

				// START "Retweeted by"
				if ( $t['is_retweet'] ) {
					$the_feed->output .= '<span class="tweet_retweet">';
					$the_feed->output .= '<span class="tweet_icon tweet_icon_retweet"></span>';
					$the_feed->output .= 'Retweeted by ';
					$the_feed->output .= '<a href="'.$the_feed->tw.$t['retweeter_screen_name'].'" target="_blank" title="'.$t['retweeter_display_name'].'">'.$t['retweeter_display_name'].'</a>';
					$the_feed->output .= '</span>';
				}
				// END "Retweeted by"

				// START Tweet intents
				$the_feed->output .= '<div class="tweet_intents">';

				// START Reply intent
				$the_feed->output .= '<a href="'.$the_feed->intent.'tweet?in_reply_to='.$t['id'].'" title="Reply to this tweet" target="_blank" class="tweet_intent_reply">';
				$the_feed->output .= '<span class="tweet_icon tweet_icon_reply"></span>';
				$the_feed->output .= '<b>Reply</b></a>';
				// END Reply intent

				// START Retweet intent
				$the_feed->output .= '<a href="'.$the_feed->intent.'retweet?tweet_id='.$t['id'].'" title="Retweet this tweet" target="_blank" class="tweet_intent_retweet">';
				$the_feed->output .= '<span class="tweet_icon tweet_icon_retweet"></span>';
				$the_feed->output .= '<b>Retweet</b></a>';
				// END Retweet intent

				// START Favourite intent
				$the_feed->output .= '<a href="'.$the_feed->intent.'favorite?tweet_id='.$t['id'].'" title="Favourite this tweet" target="_blank" class="tweet_intent_favourite">';
				$the_feed->output .= '<span class="tweet_icon tweet_icon_favourite"></span>';
				$the_feed->output .= '<b>Favourite</b></a>';
				// END Favourite intent

				$the_feed->output .= '</div>';     // END Tweet intents
				$the_feed->output .= '</div>';     // END Tweet footer
				$the_feed->output .= '</div>';     // END Tweet content
				$the_feed->output .= '</article>'; // END Rendering Tweet's HTML
			}

			$the_feed->output .= '</div>'; // END The Tweet list

			$the_feed->cache_output( $the_feed->options['cache_hours'] );

		}

	}

	/* WP needs shortcode called content to be returned
	   rather than echoed, which is where the
	   $is_shortcode_called property comes in */
	if ( $the_feed->is_shortcode_called ) {
		return $the_feed->output;
	} else {
		echo $the_feed->output;
	}

}

/************************************
*
*	Adds custom information to the top inner header for each page
*	checks which kind of page it is and runs the apropriate wp_query to retrive random post from that part of the site
*************************************/
function add_inner_header(){
	if(is_front_page()){
		showFrontPageTop();
	}
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function showFrontPageTop(){
		get_feedItems($args = array(
						'posts_per_page' => 1,
						'orderby' => 'date',
						'order' => 'DESC',
						'typeOfFeed' => 'header',
						'postLimit' =>1,
						'pointer' => -1
					));
}
	

/************************************
*
*	render a custom feed button with loading css animation and noscript version
*
*************************************/
function add_feed_button($args = NULL){
	?>
	<div id="feed-button">
		<div id="no-script-wrapper">
    <noscript>
    	<ul>
        <?php for ($i=0; $i<$postDivide;$i++){
			?>
            <li><a href="<?php get_site_url(); ?>" . $args.url . "?pagination=<?php echo $i+1 ?>"><?php echo $i+1 ?></a></li>
            <?php
		}
			?>
        </ul>
    </noscript>
    </div>
	<div id="loading-wrapper">
        <div id="floatingBarsG">
            <div class="blockG" id="rotateG_01">
            </div>
            <div class="blockG" id="rotateG_02">
            </div>
            <div class="blockG" id="rotateG_03">
            </div>
            <div class="blockG" id="rotateG_04">
            </div>
            <div class="blockG" id="rotateG_05">
            </div>
            <div class="blockG" id="rotateG_06">
            </div>
            <div class="blockG" id="rotateG_07">
            </div>
            <div class="blockG" id="rotateG_08">
            </div>
        </div>
        <span>Laddar...</span>
    </div>
    <div id="action-wrapper">
           <!-- <img src="<?= get_site_url(); ?>/wp-content/uploads/arrow_dotted.png"/>-->
            <div class="action-button feed"><a>Visa fler inlägg</a></div>
            <!-- <img src="<?= get_site_url(); ?>/wp-content/uploads/arrow_dotted.png"/>-->
    </div>
    <div id="finish-button-wrapper">
            <span>Det finns inga fler inlägg</span> 
    </div>
    
</div>
	<?php
}

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/search.php' ) . '" >
	<!--<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>-->
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( '', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( '' ) .'" />
	</form>';
	
	return $form;
} // don't remove this bracket!

function bones_tagsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="" >
	<!--<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>-->
	<input type="text" value="" name="s" id="#tag-term" placeholder="' . esc_attr__( '', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( '' ) .'" />
	</form>';
	
	return $form;
} 



?>
