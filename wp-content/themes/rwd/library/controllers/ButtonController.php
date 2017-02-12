<?php
function get_button($args){ 
//  To set a default value of the buttons size
  isset($args['size']) ? $args['size'] = $args["size"] : $args['size'] = 'medium';
// defines all the different buttons that is used over the whole site. just add a case statement for a new button and go to 
//  Controllers/ButtonController.php to edit the interaction and build the model for the button
  switch ($args['typeOfButton']) {
    case 'link_button':
      get_link_button($args);
      break;
    case 'feed_button':
      get_feed_button($args);
      break;
    case 'mobile-menu-button':
      get_mobile_menu_button($args);
      break;
    default:
      
      break;
  }
}
function get_link_button($args){
?>
	<a href="<?php echo $args['link']; ?>" title="<?php echo esc_attr( $args['title'] ); ?>"> 
   <div class="button <?php echo $args['size']; ?>">
              <span><?php echo $args['button_text']; ?></span>
            </div>
   </a><?php
}
function get_mobile_menu_button($args){
  ?>
  <div id="mobile-menu-wrapper">
    <a id="menu-button" href="#menu-button"><?php echo $args['button_text'] ?></a>
  </div>
    <?php
}
function get_feed_button($args){
?>
  <div id="buttonContainer">
    <div class="<?php echo $args['typeOfAction']; ?> button-wrapper button <?php echo $args['size']; ?>">
              <span><?php echo $args['button_text']; ?></span>
            </div>
            <div id="loading-wrapper">
                <div class="spinner"></div>
        <span>Loading...</span>
    </div>
     <div id="finish-button-wrapper">
              <h2>No more posts</h2> 
      </div>
  </div>
  <?php
}
// get_feed_button ends
?>