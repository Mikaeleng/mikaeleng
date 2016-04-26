<?php
if (!empty($_POST)){
  include_once ($_SERVER['DOCUMENT_ROOT']. '/mikaeleng/wp-load.php');

}


/*if (!empty($_REQUEST)){
  include_once ($_SERVER['DOCUMENT_ROOT']. '/mikaeleng/wp-load.php');

  $custom_tax= implode(',', (array)$_REQUEST);
  
  

  //  isset($_POST['catid']) ? $cat_ID = $_POST["catid"] : $cat_ID = '6';

  switch ($_REQUEST['term']) {
    case 'create':
      get_create_feed_model($_POST);
      break;
      case 'wall':
      get_wall_feed_model($_POST);
      break;
      case 'header':
      get_header_feed_model($_POST);
      break;

    default:
      
      break;
  }
}*/
/**********************************
      Get Wall page feed model
************************************/
/*function tags_callback($args){
  global $post;
  //isset($_POST['postLimit']) ? $args['postLimit'] = $_POST["postLimit"] : $args['postLimit'] = $args['postLimit'];

  $posts = get_posts( array(
        'tag-term' =>$_REQUEST['tag-term'],
    ) );
    // Initialise suggestions array
    $suggestions=array();
 
    global $post;
    foreach ($posts as $post): setup_postdata($post);
        // Initialise suggestion array
        $suggestion = array();
        $suggestion['mark'] = esc_html($post->post_title);
        $suggestion['id'] = esc_html($post->post_title);
        $suggestion['link'] = get_permalink();
 
        // Add suggestion to suggestions array
        $suggestions[]= $suggestion;
    endforeach;
 
    // JSON encode and echo
//    $response = $_GET["callback"] . "(" . json_encode($suggestions) . ")";
    $response = json_encode($suggestions);
    echo $response;
 
    // Don't forget to exit!
    exit;
  
}*/