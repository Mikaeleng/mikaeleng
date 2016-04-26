// JavaScript Document

var _action;

jQuery( document ).ready(function( $ ) {
  // Code using $ as usual goes here.
  // Handler for .ready() called.

  	// adds a new user to the database
	$("#upload-user").submit(function(e) {
		e.preventDefault();
		_action = "add";
		var data = convertFormToJSON(jQuery("#upload-user"),_action);
		printer(data);
		
		
		sendEvent(data);
	});
	
	// loging in a returning user
	$("#log-in").submit(function(e) {
		e.preventDefault();
		_action = "login";
		var data = convertFormToJSON(jQuery("#log-in"), _action); 
			
		sendEvent(data);
	});
	
	// signs in new users and checks against a client side pw
	$("#sign-in").submit(function(e) {
	
	var userVal = $("#sign-in input[type=text]").val().toLowerCase();
	var pw		= "favoritfredrik";
	
	
	if(userVal == pw){
		$("#lightbox").fadeOut("slow");
		$("#lightbox-user").fadeIn("slow");
		$("#info-panel").fadeIn("slow");
		$("#download-panel").fadeIn("slow");
	}else{
				jQuery("#lightbox-form-wrapper .error-message").css("display","block");
			}
	e.preventDefault();
	});

});

function updateEvent(){
	jQuery("#update").submit(function(e) {
		e.preventDefault();
		_action = "update";
		var data = convertFormToJSON(jQuery("#update"), _action);
			
		sendEvent(data);
	});
}


function sendEvent(args){
	
	
	jQuery.ajax({
	  type: "POST",
	  url: templateDir + "wpdbHandlerClass.php",
	
	  data: args
	}).done(function( msg ) {
		printer(msg);
		switch(_action){
			case "add":
			jQuery("#lightbox-return").fadeIn("slow");
			jQuery(".onside").empty();
			jQuery(".onside").append(msg);
			break;
			
			case "login":
			if(jQuery(msg).length >0){
				jQuery("#lightbox-signupform-wrapper").empty();
				jQuery("#lightbox-signupform-wrapper").append(msg);
				jQuery("#lightbox").fadeOut("slow");
				jQuery("#lightbox-user").fadeIn("slow");
				jQuery("#info-panel").fadeIn("slow");
				jQuery("#download-panel").fadeIn("slow");
				updateEvent();
			}
			case "update":
			if(jQuery(msg).length ==0){
				jQuery("#lightbox .error-message").css("display","block");
			}else{
				
			}
			break;
			
		}
		setInterval(function(){
			if(_action == "add"){
			jQuery("#lightbox-return").fadeOut("slow");
			}
		},7500);
		
		if(_action == "add" || _action == "update"){
		jQuery("#lightbox-user").fadeOut("slow");
		}
	})
	/*.fail(function() {
		printer( "error" );
	  })
	  .always(function() {
		printer( "complete" );
	  });*/
}

function convertFormToJSON(form,action){
    var array = jQuery(form).serializeArray();
	
    var json = {"action":action};
    
    jQuery.each(array, function() {
        json[this.name] = this.value || '';
    });
    printer(json);
    return json;
}
