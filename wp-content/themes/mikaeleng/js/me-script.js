// JavaScript Document
//var $ = jQuery.noConflict(true);
function printer(data){
if (window.console && window.console.log) window.console.log(data);	
}

//$(window).load(function() {	
//var footFlags = $('.widget_transposh').appendTo('#header');
//});
/*jQuery(window).load(function() {	
printer("adfasd fas dfasd fasdf asdf");
jQuery("#start-form-wrapper").html('<a href="/?page_id=169&firstname=mig&contactmail=mikael@mikaeleng.se" class="fancybox-iframe {width:470,height:620}">Kontakta mig</a>');
});*/

jQuery( document ).ready(function( $ ) {
	$(".tab").click(function(e) {
		var target = $(e.currentTarget);
		printer($(target).attr("id"));
		switch($(target).attr("id")){
			case "new-user-tab":
				setPanelToSignUp();
			break;
			case "update-user-tab":
				setPanelToLogin();
			break;
		}
    });
});

function setPanelToSignUp(){
	jQuery("#lightbox-form-wrapper").fadeIn("fast");
	jQuery("#lightbox-update-wrapper").fadeOut("fast");
	jQuery("#new-user-tab").css("background-color","#FFF");
	jQuery("#update-user-tab").css({"background-color":"#929292","opacity":"0.3"});
	jQuery("#new-user-tab h4").css("font-style","normal");
	jQuery("#update-user-tab h4").css("font-style","italic");
	jQuery("#lightbox").animate({"height":"310px"},"fast");
	
}

function setPanelToLogin(){
	jQuery("#lightbox-update-wrapper").fadeIn("fast");
	jQuery("#lightbox-form-wrapper").fadeOut("fast");
	jQuery("#update-user-tab").css("background-color","#FFF");
	jQuery("#new-user-tab").css({"background-color":"#929292","opacity":"0.3"});
	jQuery("#update-user-tab h4").css("font-style","normal");
	jQuery("#new-user-tab h4 ").css("font-style","italic");
	jQuery("#lightbox").animate({"height":"370px"},"fast");
}