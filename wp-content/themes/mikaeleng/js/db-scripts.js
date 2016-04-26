// JavaScript Document
function addTrackEvents(){
	
	var $ = jQuery;
	var _id;

	$(".track-expand").click(function(e) {
	var trackContent = $(this).closest(".track-item").find(".track-content");
	var height = $(trackContent).height();
	
	var button = $(this);
	if(height<=57){
	$(trackContent).animate({
		height:$(trackContent)[0].scrollHeight},"fast",function(){
			$(button).css({backgroundPosition: "0 -52px"} );
			});
	}else{
		$(trackContent).animate({
		height:57},"fast",function(){
			$(button).css({backgroundPosition: "0 -36px"} );
			});
	}
});// end expand

$(".track-delete").click(function(e) {
    var button = this;
	var list= $(this).closest("#widget-content");
	_id = $(this).closest(".track-item").attr('id');

	printer(_id);
	var trackContent = $(this).closest("#tracking-widget").find("#widget-delete");
	$(trackContent).height($("#tracking-widget").height());
	$(list).fadeOut("fast");
	$(trackContent).fadeIn("fast",function(){
		
	});
	
});

$("#cancel-delete").click(function(e) {
	var list= $(this).closest("#tracking-widget").find("#widget-content");
	var trackContent = $(this).closest("#widget-delete");
	
	$(list).fadeIn("fast");
	$(trackContent).fadeOut("fast");
});

// shows the add/update widget
$("#add-track").click(function(e) {
	$("#track_form_title").val('');
	$("#track_form_content").val('');
    $("#widget-content").fadeOut("fast");
	$("#widget-edit").fadeIn("fast");
	_action = 'add';
	//
});

// cancels the add/update widget and shows the list content again
$("#cancel-track-button button").click(function(e) {
    $("#widget-content").fadeIn("fast");
	$("#widget-edit").fadeOut("fast");
});

$("#track_form_submit").click(function(e) {
	
	var _args = {'title':$("#track_form_title").val(), 'content': $("#track_form_content").val()};
	
	sendDbEvent(_action, _id, _args);
	return false;
});

// connects to the server and removes the choosen track post
$("#removeRow").click(function(e) {
	sendDbEvent('delete', _id);
});

$(".track-edit").click(function(e) {
    _id 			= $(this).closest(".track-item").attr('id');
	printer(_id);
	var _title		= $.trim($(this).closest(".track-item").find(".track-title").text());
	var _content	= $.trim($(this).closest(".track-item").find(".track-content").text());
	
	$("#track_form_title").val(_title);
	$("#track_form_content").val(_content);
	
	$("#widget-content").fadeOut("fast");
	$("#widget-edit").fadeIn("fast");
	_action = 'update';
});
}


function sendDbEvent(action, id, args){
	var $ = jQuery;
	
	var _data = {};
	_data['action'] 		= action;
	_data['track_id'] 		= parseInt(id);
	_data['args'] 			= args;
	jQuery.ajax({

	  type: "POST",

	  url: templateDir + "trackingClass.php",

	  data: _data

	}).done(function( msg ) {

		printer(msg);
		jQuery('#track-list').empty();
		jQuery('#widget-content').fadeIn("fast");
		jQuery('#widget-edit').fadeOut("fast");
		jQuery('#widget-delete').fadeOut("fast");
		jQuery(msg).appendTo("#track-list");
		
		addTrackEvents();
		
		
		
		setTimeout(function(){
			toggleExpand();
		}, 500);

	});
}