<?php

function get_feedItems($args){

  switch ($args['typeOfFeed']) {
    case 'wall':
      get_wall_feed_model($args);
      break;
    case 'create':
      get_create_feed_model($args);
      break;
    case 'work':
      get_work_feed_model($args);
      break;
    case 'live':
      get_live_feed_model($args);
      break;
    case 'header':
      get_header_feed_model($args);
      break;
    
    default:
      
      break;
  }
	
  }
	?>
   