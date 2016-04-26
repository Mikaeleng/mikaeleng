<?php

/*****************************************************************************************************************************

Adds the iframe gramin connect widget in the edit live post

 ******************************************************************************************************************************/
function add_create_garmin_box() {
	global $post;
	$screens = array( 'post' );

	foreach ( $screens as $screen ) {
		if(in_category( 'live', $post )){
			add_meta_box(
				'garmin_sectionid',
				__( 'Garmin', 'garmin_textdomain' ),
				'add_create_garmin_box_callback',
				$screen,'normal', 'high'
			);
		}
	}
}
add_action( 'add_meta_boxes', 'add_create_garmin_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function add_create_garmin_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_live_garmin_box', 'myplugin_live_garmin_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$garmin 	= get_post_meta( $post->ID, '_post_garmin', true );


	echo '<label for="garmin_id">';
	_e( 'Add the link to the garmin activity', 'garmin_textdomain' );
	echo '</label> ';
	?>

	<input type="text" id="garmin_data" name="garmin_data" value="<?php echo $garmin; ?>"></input>
	<?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_create_garmin_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_live_garmin_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_live_garmin_box_nonce'], 'myplugin_live_garmin_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */

	// Make sure that it is set.
	if ( ! isset( $_POST['garmin_data'])  ) { //&& ! isset( $_POST['challange_data']) && ! isset( $_POST['experience_data'] )
		return;
	}

	// Sanitize user input.
	$my_garmin = sanitize_text_field( $_POST['garmin_data'] );
	// Update the meta field in the database.
	add_post_meta( $post_id, '_post_garmin', $my_garmin, true ) or update_post_meta( $post_id, '_post_garmin', $my_garmin );
}
add_action( 'save_post', 'myplugin_save_create_garmin_box_data' );

/*****************************************************************************************************************************

								Adds the worplace widget in the edit post page

 ******************************************************************************************************************************/
function add_create_post_box() {
	global $post;
	$screens = array( 'post' );

	foreach ( $screens as $screen ) {
		if(in_category( 'create', $post )){
			add_meta_box(
				'workplace_sectionid',
				__( 'Workplace', 'workplace_textdomain' ),
				'add_create_post_box_callback',
				$screen,'normal', 'high'
			);
		}
	}
}
add_action( 'add_meta_boxes', 'add_create_post_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function add_create_post_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_create_post_box', 'myplugin_create_post_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$workplace 	= get_post_meta( $post->ID, '_post_workplace', true );
	$challange 	= get_post_meta( $post->ID, '_post_challange', true );
	$experience = get_post_meta( $post->ID, '_post_experience', true );


	echo '<label for="workplace_id">';
	_e( 'Add info about the workplace', 'workplace_textdomain' );
	echo '</label> ';
	?>
	<div id="create-labels">
		<label>Workplace</label>
		<label>Challanges</label>
		<label>Experiences</label>
	</div>
		<input type="text" id="workplace_data" name="workplace_data" value="<?php echo $workplace; ?>"></input>
		<textarea id="challange_data" name="challange_data"><?php echo $challange; ?></textarea>
		<textarea id="experience_data" name="experience_data"><?php echo $experience; ?></textarea>
	<?php
	//echo '<input type="dropdown" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_create_post_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_create_post_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_create_post_box_nonce'], 'myplugin_create_post_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['workplace_data'])  ) { //&& ! isset( $_POST['challange_data']) && ! isset( $_POST['experience_data'] )
		return;
	}

	// Sanitize user input.
	$my_workplace = sanitize_text_field( $_POST['workplace_data'] );
	$my_challange = sanitize_text_field( $_POST['challange_data'] );
	$my_experince = sanitize_text_field( $_POST['experience_data'] );
	// Update the meta field in the database.
	add_post_meta( $post_id, '_post_workplace', $my_workplace, true ) or update_post_meta( $post_id, '_post_workplace', $my_workplace );
	add_post_meta( $post_id, '_post_challange', $my_challange, true ) or update_post_meta( $post_id, '_post_challange', $my_challange );
	add_post_meta( $post_id, '_post_experience', $my_experince, true ) or update_post_meta( $post_id, '_post_experience', $my_experince );
}
add_action( 'save_post', 'myplugin_save_create_post_box_data' );



/*****************************************************************************************************************************

								Adds the wall feed items position in the edit post page

 ******************************************************************************************************************************/
function myplugin_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'myplugin_sectionid',
			__( 'Image position', 'myplugin_textdomain' ),
			'myplugin_meta_box_callback',
			$screen,'side', 'high'
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function myplugin_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'myplugin_meta_box', 'myplugin_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_post_feed_image_position', true );

	echo '<label for="myplugin_new_field">';
	_e( 'Choose the layout for the image in the feed', 'myplugin_textdomain' );
	echo '</label> ';
	?>
		<select id="myplugin_new_field" name="myplugin_new_field" style="display:block; width:100%;">
		  <option value="auto"<?php selected( $value, 'auto' ); ?> <?php if ($value == 'auto'){echo ' selected';}?>>auto</option>
		  <option value="left-item"<?php selected( $value, 'left-item' ); ?> <?php if ($value == 'left-item'){echo ' selected';}?>>To the left</option>
		  <option value="large-item" <?php selected( $value, 'large-item' ); ?> <?php if ($value == 'large-item'){echo ' selected';}?> >In the top</option>
		  <option value="right-item" <?php selected( $value, 'right-item' ); ?> <?php if ($value == 'right-item'){echo ' selected';}?> >To the right</option>
		</select>
	<?php
	//echo '<input type="dropdown" id="myplugin_new_field" name="myplugin_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function _save_imgpos_meta_box( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['myplugin_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['myplugin_new_field'] );
	
	// Update the meta field in the database.
	add_post_meta( $post_id, '_post_feed_image_position', $my_data, true ) or update_post_meta( $post_id, '_post_feed_image_position', $my_data );
}
add_action( 'save_post', '_save_imgpos_meta_box' );


/*****************************************************************************************************************************

								Adds the cases widget in the edit post page

 ******************************************************************************************************************************/


function myplugin_add_cases_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {
		if(in_category( 'work', $post )){
			add_meta_box(
				'cases_sectionid',
				__( 'Connected cases', 'myplugin_textdomain' ),
				'connected_cases',
				$screen,'side', 'high'
			);
		}
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_cases_box' );



// The Event Location Metabox

 

function connected_cases() {

     global $post;

 

    // Noncename needed to verify where the data originated

    echo '<input type="hidden" name="casesmeta_noncename" id="casesmeta_noncename" value="' .

    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';


            //here you add the dropdown as value if already set so you add something like

            $_post_cases_meta = get_post_meta($post->ID, '_post_cases', true);
            $_post_year_ended_meta = get_post_meta($post->ID, '_post_year_ended', true);
			
			
			?>
			<div><p>Add year that employment ended:</p></div>
			<input type="text" value="<?php echo $_post_year_ended_meta; ?>" name="_post_year_ended" />
			<div><p>Connect the cases to the employment:</p></div>
           <div style="margin:0 auto;">
		   <select name="_post_cases[]" class="widefat" multiple="multiple"  style="width:100%; height:300px; display:inline-block; margin-right:20px;" >
				<?php get_cases_instances(explode(",", $_post_cases_meta)); ?>
            
           	</select>
			</div>
<?php
}



// Save the Metabox Data

 

function txpbs_save_events_meta($post_id, $post) {

 

    // verify this came from the our screen and with proper authorization,

    // because save_post can be triggered at other times

    if ( !wp_verify_nonce( $_POST['casesmeta_noncename'], plugin_basename(__FILE__) )) {

    return $post->ID;

    }

 

    // Is the user allowed to edit the post or page?

    if ( !current_user_can( 'edit_post', $post->ID ))

        return $post->ID;

 

    // OK, we're authenticated: we need to find and save the data

    // We'll put it into an array to make it easier to loop though.


	

            //here just add the dropdown field to the $station_meta array from the $_POST
			$tempID = array();
			foreach ($_POST['_post_cases'] as $names)
			{
					//print "You are selected $names<br/>";
					array_push($tempID,$names);
			}

            $station_meta['_post_cases'] = $tempID;

            // year ended metadata
            $station_meta['_post_year_ended'] = $_POST['_post_year_ended'];

 			
    // Add values of $station_meta as custom fields

 

    foreach ($station_meta as $key => $value) { // Cycle through the $station_meta array!

        if( $post->post_type == 'revision' ) return; // Don't store custom data twice

        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)

        if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value

            update_post_meta($post->ID, $key, $value);

        } else { // If the custom field doesn't have a value

            add_post_meta($post->ID, $key, $value);

        }

        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank

    }

 

}

 

add_action('save_post', 'txpbs_save_events_meta', 1, 2); // save the custom fields


function get_cases_instances($section){
	global $post;
		$args = array(
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_status' => 'publish',
		'category_name' => 'create'
	);
	$current_playlist_IDs = explode(",", get_post_meta($post->ID, $section, true));
	$selectedID = false;
	
	$custom_query = new WP_Query( $args );
	  while($custom_query->have_posts()) : $custom_query->the_post();
	  		foreach ($section as &$value) {
				if($post->ID == $value){ $selected = true;}
				$wp = get_post_meta($post->ID, '_post_workplace', true);
			}
			?><option value="<?php echo $post->ID; ?>" <?php if ($selected){?> selected="selected"<?php } ?>><?php echo the_title(); ?></option><?php
			$selected = false;
		endwhile; // End the loop.
		wp_reset_query();
		wp_reset_postdata();
}
?>
   