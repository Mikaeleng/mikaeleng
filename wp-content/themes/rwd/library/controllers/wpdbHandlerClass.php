<?php
include('../../../wp-load.php');
/********

class for handling communication directly with the database and through the wpdb-class

********/

global $wpdb;
$action 	= strtolower($_POST['action']);
$user_id	= $_POST['user_id'];
$user 		= $_POST['user_name'];
$mail		= $_POST['user_mail'];
$mobile		= $_POST['user_mobile'];
$attend 	= $_POST['attending'];
$amount		= $_POST['amount'];
$comment	= $_POST['comment']; 
$party		= $_POST['party']; 

	
//$wpdb->show_errors();

	switch($action){
		case 'add':
		$wpdb->query( $wpdb->prepare( 
		"INSERT INTO ". $wpdb->prefix ."user_tracking(user_name, user_mail, user_mobile, attending, amount, comment, party) VALUES ( %s, %s, %s, %s, %s, %s, %s )", mysql_real_escape_string($user), 
		mysql_real_escape_string($mail),
		mysql_real_escape_string($mobile),
			mysql_real_escape_string($attend), 
			mysql_real_escape_string($amount),
			 mysql_real_escape_string($comment),
			 mysql_real_escape_string($party)) );
			 ///////
			 $count = 0;
			$scheduled_posts = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix .'user_tracking'); 
			// WHERE user_id = ' . $current_user->ID .' ORDER BY post_date ASC
			 foreach($scheduled_posts as $track) {  
					 $amount = $track->amount;
				     $_attending = $track->attending;
					 	if($_attending == "Ja"){
								$count = $count + $amount;
						}
			 }?>
            <h3>Det är nu <span><?php echo $count;?></span> anmälda gäster.</h3>
            <p>Ska du bli den <?php echo $count+1; ?>:e?</p><?php
		break;
		case 'update':
			 $table = $wpdb->prefix .'user_tracking';
			 $data = array( 'user_name' => stripslashes($user), 'user_mail' => stripslashes($mail), 'user_mobile'=> stripslashes($mobile), 'attending'=>stripslashes($_attending), 'amount'=>stripslashes($amount), 'comment' => stripslashes($comment), 'party'=>stripslashes($party));
			 
			 $wpdb->update( $table, $data, array('user_name'=> stripslashes($user)), $format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s' ), $where_format = array('%s') );
			break;	
		case "login":
			$scheduled_posts = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix .'user_tracking'); 			
			 foreach($scheduled_posts as $track) {
				if( strtolower($user_id) == strtolower($track->user_mail) || strtolower($user_id) == strtolower($track->user_name)){
					?>
                    <form id="update">
                    <label class="headline">Ditt namn</label>
                    <input type="text" name="user_name" value="<?php echo $track->user_name?>" />
                    <label class="headline">Din E-postadress</label>
                    <input type="text" name="user_mail" value="<?php echo $track->user_mail?>" />
                    <label class="headline">Ditt mobilnummer</label>
                    <input type="text" name="user_mobile" value="<?php echo $track->user_mobile?>" />
                    <label class="headline">Kommer ni?</label>
                    <label class="answer" for="Ja">Ja</label>
                    <?php if($track->attending=="Ja"){ ?><input type="radio"  name="attending" checked="checked" value="Ja" /><? }else{?> <input type="radio"  name="attending" value="Ja" /><?php }?>
                    
                    <label for="Nej">Nej</label>
                     <?php if($track->attending=="Nej"){ ?><input type="radio" name="attending" checked="checked"  value="Nej" /><? }else{?> <input type="radio" name="attending"  value="Nej" /><?php }?>
                    
                    <label class="headline">Hur många av er kommer?</label>
                    <select name="amount" form="update">
                     <?php if($track->amount=="1"){ ?> <option value="1" selected="selected">1</option><? }else{?><option value="1">1</option><?php }?>
                     <?php if($track->amount=="2"){ ?> <option value="2" selected="selected">2</option><? }else{?><option value="2">2</option><?php }?>
                     <?php if($track->amount=="3"){ ?> <option value="3" selected="selected">3</option><? }else{?><option value="3">3</option><?php }?>
                     <?php if($track->amount=="4"){ ?> <option value="4" selected="selected">4</option><? }else{?><option value="4">4</option><?php }?>
                     <?php if($track->amount=="5"){ ?> <option value="5" selected="selected">5</option><? }else{?><option value="5">5</option><?php }?>
                     <?php if($track->amount=="fler..."){ ?> <option value="fler..." selected="selected">fler...</option><? }else{?><option value="fler...">fler...</option><?php }?>
                    </select>
                    <label class="headline">Har ni något att lägga till, allergier, önskemål osv. skriv ner det här.</label>
                    <textarea rows="4" cols="50" name="comment"><?php echo $track->comment?></textarea>
                  <input type="hidden" name="party" value="favoritfredrik40" />
                    <input type="image" id="user_name" src="<?php  echo get_site_url() ?>/wp-content/uploads/updatebtn_up.png" alt="submit" height="30" width="auto"/>
                    </form>
					<?php	
				}
			 }
		break;	
	}
?>
