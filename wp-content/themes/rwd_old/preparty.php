<?php get_header(); ?>

			<div id="event-content">
 <?php global $wpdb;
	$wpdb->show_errors();
?>
<script type='javascript'>
    var clear = true;
    function clear(obj)
    {
        if(clear)
        {
            obj.value = '';
            clear = false;
        }
    }
</script>
<div id="event-container">
<div id="lightbox" class="clearfix">
<div id="login-tab-panel" class="clearfix">
<div id="new-user-tab" class="tab"><h4>Anmäl dig</h4></div>
<div id="update-user-tab" class="tab"><h4>Logga in</h4></div>
</div>

    <div id="lightbox-form-wrapper" class="clearfix">
    <h3>Vad är det hemliga lösenordet?<p>(Det står på inbjudan som ni fick på mailen...)</p></h3>
      <form id="sign-in" action="">
      <label class="headline">Lösenord</label>
          <input type="text" name="user-input" value="" />
          <input type="image" src="<?php  echo get_site_url() ?>/wp-content/uploads/sendBtn_up.png" alt="submit" height="30" width="auto"/>
      </form>
      <p class="error-message">Tyvärr var det inte rätt lösenord. Förök igen.</p>
      </div>
      <div id="lightbox-update-wrapper" class="clearfix">
    <h3>Uppdatera din anmälan<p>Logga in med den e-postadressen eller namnet du anmälde dig med, så kan du göra förändringar och anmäla dig/er igen.</p></h3>
      <form id="log-in" action="">
      <label class="headline">Namn/e-post</label>
          <input type="text" name="user_id" value="" />
          <input type="image" src="<?php  echo get_site_url() ?>/wp-content/uploads/loginbtn_up.png" alt="submit" height="30" width="auto"/>
      </form>
      <p class="error-message">Tyvärr hittades inte dina inloggningsuppgifter. Försök igen. Försök med din e-postadress.</p>
      </div>
</div>
<div id="lightbox-user" class="clearfix">
<h3>Så kommer ni och hur många?<p class="centre">Skriv gärna allergier och annan viktig info osv i kommentarsfältet...</p></h3>
    <div id="lightbox-signupform-wrapper" class="clearfix">
      <form id="upload-user">
      <label class="headline">Ditt namn</label>
      	<input type="text" name="user_name" value="" />
        <label class="headline">Din E-postadress</label>
      	<input type="text" name="user_mail" value="" />
        <label class="headline">Ditt mobilnummer</label>
      	<input type="text" name="user_mobile" value="" />
        <label class="headline">Kommer ni?</label>
        <label class="answer" for="Ja">Ja</label>
        <input type="radio"  name="attending" checked="checked" value="Ja" />
        <label for="Nej">Nej</label>
        <input type="radio" name="attending"  value="Nej" />
        <label class="headline">Hur många av er kommer?</label>
        <select name="amount" form="upload-user">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="mer">fler...</option>
        </select>
        <label class="headline">Har ni något att lägga till, allergier, önskemål osv. skriv ner det här.</label>
        <textarea rows="4" cols="50" name="comment"></textarea>
      <input type="hidden" name="party" value="favoritfredrik40" />
        <input type="image" id="user_name" src="<?php  echo get_site_url() ?>/wp-content/uploads/submitbtn_up.png" alt="submit" height="30" width="auto"/>
        	
      </form>
      </div>
</div>
<div id="lightbox-return" class="clearfix">
	<h3>Er anmälan är nu registrerad. Tack för att ni vill vara med. <p>Eller för ni var snälla och tackade nej.</p></h3>
</div>
<div id="info-panel" class="clearfix">
        <div id="top-image"> <!--<img src="<?php //echo get_site_url();?>/wp-content/uploads/favoritfredrik.jpg" />--></div>
		<div id="info-panel-wrapper">
	<h3>Detta kommer hända under kvällen<p class="centre">Hashtaggen för festen är <b>#favoritfredrik40</b></p></h3>
    <div id="info-box">
        <p><b>Var: </b>Regeringsgatan 20 vån9 (Hiq)</p>
        <p><b>Datum: </b>15 mars</p>
        <p><b>När: </b>Från kl: 18:00-01:00</p>
       	<p><b>kontaktperson: </b>Mikael Eng 0734481220</p>
        <p><b>Kostnad: </b>200 kr (även kallad bagis)</p>
        </div>
    <p>Kvällen börjar kl 18:00. Alla gäster kommer innan födelsedagsbarnet. Fredrik skall komma vid 19:00. Vi kör en överaskningsfest som när Fredrik fyllde 30 år. Det är kul att se han förvånad. Det kommer serveras buffé, vin och öl och snacks på festen. Det finns möjlighet att värma saker om man har med sig barn som det behöver värmas saker till.</p>
        <p>Vi kommer ha olika lekar och upptåg för Fredrik under kvällen. Om det är någon med någon bra idé så berätta gärna för mig. Min man gillar ju att pyssla så vi kör på det temat. Presenter behöver ni inte köpa utan sätt in 200kr/person på följande konto (swedbank) clnr:8105-9 banknr:994 411 738-2. Märk inbetalningen med erat namn eller mobilnummer.</p>
<p>Vill man göra något speciellt eller har man någon bra idé om pyssel/lekar vi kan göra med Fredrik under kvällen är det bara att maila mig eller ringa. Jag fixar allt som behövs för pysslet. Fredrik gillar ju fester där man kan hitta på saker tillsammans och kunna umgås på ett enkelt sätt.</p>
		</div>
    </div>
    <!-- info-panel ends -->
    <div id="download-panel" class="clearfix">
    	<div class="medium-size">
		<h3>Ladda ner inbjudan:</h3>
            <p>
            <a href="<?php echo get_site_url(); ?>/wp-content/themes/mikaeleng/inbjudan.pdf" target="_blank" alt="klicka här"><!--<span class="icon-download clearfix"></span>-->
            <img src="<?php echo get_site_url() ?>/wp-content/uploads/download.png" />
            </a>Denna sida uppdateras kontinueligt så kom gärna tillbaka och se om något ändrats.
            </p>
        </div>
       <div class="medium-size">
		<h3>Lägg till festen i din kalender:</h3>
            <p>
            
            <a href="<?php echo get_site_url(); ?>/wp-content/themes/mikaeleng/ff-fest.ics"><!--<span class="icon-calendar" alt="klicka här"></span>-->
            <img src="<?php echo get_site_url() ?>/wp-content/uploads/calendar.png" />
            </a>Klicka på ikonen för att automatiskt lägga till festen i din kalender. Detta fungerar bra att göra i din mobil också.
            </p>
        </div>
	</div>
<!-- dowload-panel ends -->
  </div>
  <div class="onside"><?php
  $count = 0;
  $scheduled_posts = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix .'user_tracking'); // WHERE user_id = ' . $current_user->ID .' ORDER BY post_date ASC
		foreach($scheduled_posts as $track) {  
		 $amount = $track->amount;
     $_attending = $track->attending;
		 	if($_attending == "Ja"){
					$count = $count + $amount;
			}
		  }?>
            <h3>Det är nu <span><?php echo $count;?></span> anmälda gäster.</h3>
            <p>Ska du bli den <?php echo $count+1; ?>:e?</p>

  <!-- #content --> 
</div><?php // end #content ?>

<?php get_footer(); ?>
