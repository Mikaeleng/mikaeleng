<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

/*********************
LAUNCH BONES
Let's fire off all the functions
and tools. I put it up here so it's
right up top and clean.
*********************/


// we're firing all out initial functions at the start
add_action( 'after_setup_theme', 'bones_ahoy', 16 );

function bones_ahoy() {

    // launching operation cleanup
    add_action( 'init', 'bones_head_cleanup' );
    // remove WP version from RSS
    add_filter( 'the_generator', 'bones_rss_version' );
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
    // clean up gallery output in wp
    add_filter( 'gallery_style', 'bones_gallery_style' );
    
    // enqueue base scripts and styles
    add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
    // ie conditional wrapper

    // launching this stuff after theme setup
    bones_theme_support();

    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'bones_register_sidebars' );
    // adding the bones search form (created in functions.php)
    add_filter( 'get_search_form', 'bones_wpsearch' );

    // cleaning up random code around images
    add_filter( 'the_content', 'bones_filter_ptags_on_images' );
    // cleaning up excerpt
    add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
   if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
      remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}




/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles() {
  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
  if (!is_admin()) {

    // modernizr (without media query polyfill)
    wp_register_script( 'bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

   

    // register main stylesheet
    wp_register_style( 'bones-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );
    wp_register_style( 'sindr-stylesheet', get_stylesheet_directory_uri() . '/library/css/jquery.sidr.dark.css', array(), '', 'all' );
    

    // ie-only style sheet
    wp_register_style( 'bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
		wp_enqueue_script( 'comment-reply' );
    }

    //adding scripts file in the footer
    wp_register_script( 'swipe', get_stylesheet_directory_uri() . '/library/js/libs/jquery.touchSwipe.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'sidr', get_stylesheet_directory_uri() . '/library/js/libs/jquery.sidr.min.js', array( 'jquery' ), null, true );
    //wp_register_script( 'autocomplete', get_stylesheet_directory_uri() . '/library/js/libs/jquery.autocomplete-min.js', array( 'jquery' ), null, true );
      //wp_register_script( 'jQuery.headroom-js', get_stylesheet_directory_uri() . '/library/js/jQuery.headroom.js', array( 'jquery' ), '', true );
      //wp_register_script( 'headroom-js', get_stylesheet_directory_uri() . '/library/js/Headroom.js', array( 'jquery' ), '', true );
      wp_register_script( 'cd-nav', get_stylesheet_directory_uri() . '/library/js/cd-nav.js', array( 'jquery' ), '', true );
    wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );
    wp_register_script( 'core-js', get_stylesheet_directory_uri() . '/library/js/core.js', array( 'jquery' ), '', true );
    //wp_register_script( 'my_acsearch', get_stylesheet_directory_uri() . '/library/js/myacsearch.js', array( 'jquery', 'core-js', 'autocomplete' ), '', true );
    //wp_localize_script( 'my_acsearch', 'MyAcSearch', array('url' => admin_url( 'admin-ajax.php' )));
    // enqueue styles and scripts
    //wp_register_script( 'my_acsearch', get_stylesheet_directory_uri() . '/library/js/myacsearch.js', array('jquery','jquery-ui-autocomplete', 'core-js'),null,true);
 	//wp_register_script( 'autocomplete', get_stylesheet_directory_uri() . '/library/js/libs/jquery.autocomplete-min.js', array( 'jquery' ), null, true );
 	
    wp_enqueue_style( 'sindr-stylesheet' );
    wp_enqueue_script( 'bones-modernizr' );
    wp_enqueue_style( 'bones-stylesheet' );
    wp_enqueue_style( 'bones-ie-only' );

    $wp_styles->add_data( 'bones-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

    /*
    I recommend using a plugin to call jQuery
    using the google cdn. That way it stays cached
    and your site will load faster.
    */
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'swipe' );
      wp_enqueue_script( 'sidr' );
     // wp_enqueue_script( 'jQuery.headroom-js' );
     // wp_enqueue_script( 'headroom-js' );
      wp_enqueue_script( 'cd-nav' );
      wp_enqueue_script( 'bones-js' );
     wp_enqueue_script( 'core-js' );

  }
}

add_action( 'init', 'myprefix_autocomplete_init' );
function myprefix_autocomplete_init() {
    // Register our jQuery UI style and our custom javascript file
    wp_register_style('myprefix-jquery-ui','http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
    //wp_register_script( 'my_acsearch', get_stylesheet_directory_uri() . '/library/js/myacsearch.js', array('jquery','jquery-ui-autocomplete', 'core-js'),null,true);
 	wp_register_script( 'autocomplete', get_stylesheet_directory_uri() . '/library/js/libs/jquery.autocomplete-min.js', array( 'jquery' ), null, true );
 	wp_register_script( 'my_acsearch', get_stylesheet_directory_uri() . '/library/js/myacsearch.js', array('jquery','autocomplete', 'core-js'),null,true);
    wp_localize_script( 'my_acsearch', 'MyAcSearch', array('url' => admin_url( 'admin-ajax.php' )));
    // Function to fire whenever search form is displayed
    
    /*wp_enqueue_script( 'autocomplete' );
    wp_enqueue_script( 'my_acsearch' );*/

    //add_action( 'bones_tagsearch', 'myprefix_autocomplete_search_form' );
 
    // Functions to deal with the AJAX request - one for logged in users, the other for non-logged in users.
   // add_action( 'wp_ajax_myprefix_autocompletesearch', 'myprefix_autocomplete_suggestions' );
   // add_action( 'wp_ajax_nopriv_myprefix_autocompletesearch', 'myprefix_autocomplete_suggestions' );
}

/*function myprefix_autocomplete_search_form(){
    wp_enqueue_script( 'my_acsearch' );
   	wp_enqueue_script( 'autocomplete' );
    //wp_enqueue_style( 'myprefix-jquery-ui' );
}

function myprefix_autocomplete_suggestions(){
    // Query for suggestions
    $posts = get_posts( array(
        'tag-term' =>$_REQUEST['tag-term'],
    ) );
 
    // Initialise suggestions array
    $suggestions=array();
 
    global $post;
    foreach ($posts as $post): setup_postdata($post);
        // Initialise suggestion array
        $suggestion = array();
        $suggestion['label'] = esc_html($post->post_title);
        $suggestion['link'] = get_permalink();
 
        // Add suggestion to suggestions array
        $suggestions[]= $suggestion;
    endforeach;
    
    // JSON encode and echo
    $response = json_encode($suggestions);
    //$response = $test;
    echo $response;
 
    // Don't forget to exit!
    exit;
}*/

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
	    array(
	    'default-image' => '',  // background image default
	    'default-color' => '', // background color default (dont add the #)
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'bonestheme' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'bonestheme' ) // secondary nav in footer
		)
	);
} /* end bones theme support */


/*********************
MENUS & NAVIGATION
*********************/
class Child_Wrap extends Walker_Nav_Menu {

	var $number = 1;

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		// add span with number here
		if ( $depth == 0 ) { // remove if statement if depth check is not required
			$output .= sprintf( '', $this->number++ );
		}

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

}
// the main menu
function bones_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => __( 'The Main Menu', 'bonestheme' ),  // nav name
    	'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '<i class="icon-char"></i>',       	// before the menu
    	'walker' => new Child_Wrap,                     // before the menu
        'after' => '',					                                
        'link_before' => '',							// before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                  // limit the depth of the nav
    	'fallback_cb' => 'bones_main_nav_fallback'					// fallback function
	));
} /* end bones main nav */

// the footer menu (should you choose to use one)
function bones_footer_links() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    	'menu_class' => 'nav footer-nav clearfix',      // adding custom nav class
    	'theme_location' => 'footer-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',	                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
	));
} /* end bones footer link */

// this is the fallback for header menu
function bones_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => 'nav top-nav clearfix',      // adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // before each link
        'link_after' => ''                             // after each link
	) );
}

// this is the fallback for footer menu
function bones_footer_links_fallback() {
	/* you can put a default here if you like */
}


/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
	return;
	
	echo '<nav class="pagination">';
	
		echo paginate_links( array(
			'base' 			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
			'format' 		=> '',
			'current' 		=> max( 1, get_query_var('paged') ),
			'total' 		=> $wp_query->max_num_pages,
			'prev_text' 	=> '&larr;',
			'next_text' 	=> '&rarr;',
			'type'			=> 'list',
			'end_size'		=> 3,
			'mid_size'		=> 3
		) );
	
	echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function bones_excerpt_more($more) {
	global $post;
	// edit here if you like
return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read', 'bonestheme' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'bonestheme' ) .'</a>';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function bones_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}

?>
