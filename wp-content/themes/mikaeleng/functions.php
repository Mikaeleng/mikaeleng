<?php

 //replace the standard doctype declaration and html tag opening...
function html5_create_doctype($content) {
 $content = "<!DOCTYPE html>";
 $content .= "\n";
 $content .= "<html";
 return $content;
}
add_filter('thematic_create_doctype', 'html5_create_doctype');

//replace the lang attribute in the opening <html> tag...
function new_language_attributes($content) {
	$country = get_bloginfo('language');
	//$content = 'manifest="' . get_site_url() . '/wp-content/themes/turbo2/cache.manifest" lang="' . $country . '"';
	return $content;
}
add_filter('language_attributes', 'new_language_attributes');

//replace the <head> tag opening to remove the now defunct profile attribute and add the <meta charset="utf-8"> tag...
function html5_head($content) {
 $content = "<head>";
 $content .= "\n";
 $content .= "<meta charset=\"utf-8\">";
 $content .= "\n";
 return $content;
}
add_filter('thematic_head_profile', 'html5_head');
 
 function write_cat_id(){
	global $cat;
	echo '<script type="text/javascript">';
		//if(isset($cat)) { echo 'var catid =' . $cat .'"'; }else{ echo 'var catid=""';}
		echo 'var templateDir ="' .  get_stylesheet_directory_uri() . '/";
		</script>';
}

//remove the now defunct <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> tag...
function html5_create_charset($content) {
 $content = "";
 return $content;
}
add_filter('thematic_create_contenttype', 'html5_create_charset');

function childtheme_create_stylesheet() {
    $templatedir = get_bloginfo('template_directory');
    $stylesheetdir = get_bloginfo('stylesheet_directory');
    if (strpos(get_site_url(),'localhost') !== true) {

    $sitepath  = str_replace('mikaeleng', '', get_site_url()). "mikaeleng/" . get_stylesheet_directory_uri();
    }else{
      $sitepath = get_site_url();
    }
    
    ?>
    <link rel="apple-touch-icon" href="http://www.me-design.se/blog/wp-content/uploads/apple-touch-icon.png">
    <link rel="stylesheet" type="text/css" href="<?php  echo $sitepath ?>/library/styles/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $sitepath ?>/library/styles/typography.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $sitepath ?>/library/styles/images.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $sitepath ?>/library/layouts/2c-l-fixed.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $sitepath ?>/library/styles/18px.css" />
    <?php if(!is_page(306)){ ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $sitepath ?>/style.css" />
    <?php }
	if(is_page(306)){
		?>
        <link rel="stylesheet" type="text/css" href="<?php echo $sitepath ?>/mobile.css" media="handheld, only screen and (max-device-width:480px)"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $sitepath ?>/style.css" media="handheld, only screen and (min-device-width:481px)"/>
        <!--[if lte IE 7]> 
        <link rel="stylesheet" type="text/css" href="<?php echo $stylesheetdir ?>/style.css" />
         <![endif]-->
	<?php }
  if (is_page(388 || 333)) {
    ?>
    
    <?php
  }
	?>
<?php
}


function child_meta_keywords($description) {
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes">
<?php
/*$keywords_meta = "\t" . '<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no">' . "\n\n";
$description_meta = "\t" . '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n\n";
$child_meta = $description . $keywords_meta . $description_meta;
return $child_meta;
return $description;*/
}
add_filter ('thematic_create_description','child_meta_keywords');

add_filter('thematic_create_stylesheet', 'childtheme_create_stylesheet');
 
 function childtheme_posttitle($posttitle) {
    return '<div class="containing">' . $posttitle . '</div>';
}
//add_filter('thematic_postheader_posttitle','childtheme_posttitle');

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

function add_to_head(){
	write_cat_id();
 	echo '<script src="wp-content/themes/mikaeleng/js/me-script.js" type="text/javascript">  </script>';
	echo '<script src="wp-content/themes/mikaeleng/js/timer.js" type="text/javascript">  </script>';
	if (is_page(388 || 333)) {
    ?>
   	<script src="wp-content/themes/mikaeleng/js/db-script.js" type="text/javascript">  </script>
    <?php
  }
	/*if(is_front_page()){
	 echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
	}*/
}
add_action('wp_head', 'add_to_head');

// We Register the a new menu for the theme called "Primary Menu"
function register_primary_menu() {
register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
}
add_action( 'init', 'register_primary_menu' );
 
function change_menu_type() {
return 'wp_nav_menu';
}
add_filter( 'thematic_menu_type', 'change_menu_type' );

add_filter( 'gform_validation_message', 'sw_gf_validation_message', 10, 2 );

function sw_gf_validation_message( $validation_message ) {
	return '<div class="validation_error">De rödmarkerade fälten här under är obligatoriska, vänligen försök igen.</div>';
}

function add_new_content(){
	if(is_front_page()){
	?> 
    <div id="top-header">
    <h1>Mikael Eng</h1> 
    <div id="start-form-wrapper"><div id="header-link"><a href="/?page_id=169&firstname=mig&contactmail=mikael@mikaeleng.se" class="fancybox-iframe {width:470,height:620}">Kontakta mig</a></div>
    <?php if(function_exists("transposh_widget")) { transposh_widget(array(), array('title' => '', 'widget_file' => 'flags/tpw_flags.php')); }?>
	 <?php /* if(function_exists("gltr_build_flags_bar")) { gltr_build_flags_bar(); } */ ?></div>
    </div>
    <div id="slideshow">
    
      <ul class="slides">
        <?php
        // add dynamicly images and post info to the slideshow orderby=rand&
        $custom_query = new WP_Query('posts_per_page=7&orderby=rand&cat=11'); 
                    while($custom_query->have_posts()) : $custom_query->the_post();
         echo  '<li>'; 
         if ( has_post_thumbnail($custom_query ->ID)) {
          echo '<a href="' . get_permalink( $custom_query ->ID ) . '" title="' . esc_attr( $custom_query ->post_title ) . '">';
         echo get_the_post_thumbnail($custom_query ->ID, 'startimage');
          echo '</a>';
        }
     echo '</li>';
      endwhile; // End the loop.
	
	?>
    </ul>

	</div>
    <div id="pagination-wrapper">
    <ul>
    </ul>
    </div>
    <div id="control-wrapper">
    <span class="arrow previous"></span>
    <span class="arrow next"></span>
    </div>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    
   <!-- <script src="<?php echo site_url(); ?>/wp-content/themes/mikaeleng/js/me-slidescript.js"></script>
    <script src="<?php echo site_url(); ?>/wp-content/themes/mikaeleng/js/me-autoadvance.js"></script>-->
    <?php
	}else if(is_single() || is_page() && !is_page(8)){
		if(function_exists("transposh_widget")) { transposh_widget(array(), array('title' => '', 'widget_file' => 'flags/tpw_flags.php')); }
	}
}

add_action('thematic_header','add_new_content',8);

add_filter('thematic_postheader','htv_postheader');

function htv_postheader() {
   $postheader = thematic_postheader_posttitle();
   return $postheader;
}  // end postheader

function childtheme_access(){

if ( is_front_page() ) {?>
   <div id="access">
  <div class="skip-link"><a href="#content" title="<?php _e('Skip navigation to the content', 'thematic'); ?>">
    <?php _e('Skip to content', 'thematic'); ?>
    </a></div>
  <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container_class' => 'menu', 'menu_class' => 'sf-menu','before' =>'<div class="menu-div">','after' => '</div>') );  ?>
</div>
<!-- #access -->
<?php
	} else {
		// This is not a homepage
		if(is_single() && in_category(3) || is_page()){
			 wp_nav_menu( array( 'menu' => 'postmenu', 'container_class' => 'footer-menu', 'menu_class' => 'foot-menu','before' =>'<div class="footer-button"><div class="footer-div">','after' => '</div></div>') );
		// if(function_exists("transposh_widget")) { transposh_widget(); }
		}
	}
}

add_action('thematic_header','childtheme_access',9);

function remove_menu() {
	remove_action('thematic_header','thematic_access',9);
}
add_action('init', 'remove_menu');

function remove_title() {
	remove_action('thematic_header','thematic_blogtitle',3);
	remove_action('thematic_header','thematic_blogdescription',5);
}
add_action('init', 'remove_title');

function my_blogtitle() { ?>
	<div id="blog-title"><span><hr /><h1><?php echo get_the_title($ID)?></h1><hr /></span></div>
<?php }
//add_action('thematic_header','my_blogtitle',3);

function toughbubbles_postheader_posttitle() {
    global $id, $post, $authordata;

        $posttitle = '';
}
add_filter('thematic_postheader_posttitle','toughbubbles_postheader_posttitle');

add_action( 'init', 'mytheme_setup' );

function mytheme_setup() {
//set_post_thumbnail_size( 100, 100, true );
add_image_size( 'cases-thumb', 208, 188 );
add_image_size( 'startimage', 940, 410 );
add_image_size( 'post-thumb', 218, 218, true );
add_image_size( 'startpage-postitem', 300, 300,true);
add_image_size( 'startpage-micropostitem', 140, 140, true );
add_image_size( 'startpage-feedpostitem', 57, 57, true );
}

function all_excerpts_get_more_link($post_excerpt) { 
	global $post;
	 $siteUrl = get_site_url();
	$metaData = get_post_meta($post->ID, 'readmore_link', true);
$child_excerpt = '<div class=case-excerpt>' . $post_excerpt . '' . '</div>';
	 if($metaData=="no"){
			
		}else if($metaData=="yes" || is_page(array(11,8))){
				$child_excerpt .= '<div class="case-more"><p class="readmore"><a href="'. get_permalink($post->ID) . '">' . 'L&auml;s mer' . '</a></p><div class="more-arrow"></div></div>';
		}
    return $child_excerpt;
}
add_filter('wp_trim_excerpt', 'all_excerpts_get_more_link');

function new_excerpt_more($excerpt) {
	return str_replace('[...]', '...', $excerpt);
}
add_filter('wp_trim_excerpt', 'new_excerpt_more');

//change length of excerpt
function new_excerpt_length($length) {
	if(is_page()){
		return 40;
	}else{
		return;
	}
}
add_filter('excerpt_length', 'new_excerpt_length');
?>