<?php

function get_feedItems($args){
	$count = -1;	
	$divID = $_POST["iteration"];
	$divEnd = $divID + 10;
  $args['count'] = -1;
  $args['div-end'] = 10;
//	print_r($args);
  switch ($args['item_cat']) {
    case 'wall':
      get_wall_feed_model($args);
      break;
      case 'header':
      get_header_feed_model($args);
      break;
    
    default:
      # code...
      break;
  }
  //get_feed_model();
	
  }
	?>
   