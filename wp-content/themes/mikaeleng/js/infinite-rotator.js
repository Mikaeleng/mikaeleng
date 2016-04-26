// Copyright (c) 2010 TrendMedia Technologies, Inc., Brian McNitt. 
// All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

var timer = new Timer();

var infiniteLoop;
var direction = "forward";
var currentItem = 0;
var paginateNum;
var $ = jQuery.noConflict(true);
//count number of items
var numberOfItems;
//initial fade-in time (in milliseconds)
var initialFadeIn = 2500;

//interval between items (in milliseconds)
var itemInterval = 2000;

//cross-fade time (in milliseconds)
var fadeTime = 2500;
// button fade time
var buttonfadeTime = 500;
	
function rotateSlides(simulated){
	console.log("rotateSlides");
	//count number of items
	
		//$("span.next").unbind("click");
		//$("span.previous").unbind("click");
		//$("#pagination-wrapper li").unbind("click");
		
		$("#pagination-wrapper li").removeClass("currentpaginate");
		
		if(simulated == true){
			fadeTime = buttonfadeTime;
		}else{
			fadeTime = initialFadeIn;
		}
		
		numberOfItems = $('.slides .wp-post-image').length;
		$('.slides .wp-post-image').eq(currentItem).fadeOut(fadeTime,resumeTimer);

			//show first item
	switch(direction){
		case "forward":
		if(currentItem == numberOfItems -1){
			currentItem = 0;
		}else{
			currentItem++;
		}
		break;
		case "backward":
		if(currentItem == 0){
			currentItem = numberOfItems -1;
		}else{
			currentItem--;
		}
		direction = "forward";
		break;
		case "paginate":
		currentItem = paginateNum;
		direction = "forward";
		break;
	}
	$('.slides .wp-post-image').eq(currentItem).fadeIn(fadeTime);
	$('.slides .wp-post-image').eq(currentItem).addClass("slideActive");
	$("#pagination-wrapper li").eq(currentItem).addClass("currentpaginate");
	console.log(direction + " " + currentItem);
	timer.stop();
	
}

function resumeTimer(){
	console.log("restart timer");
		timer.restart();
	//	$("span.next").bind("click", moveForward);
	//	$("span.previous").bind("click",moveBackward);
	//	$("#pagination-wrapper li").bind("click", paginate);
}

function moveForward(e){
	direction = "forward";
	console.log("moveForward");	
	rotateSlides(true);
}

function moveBackward(e){
	direction = "backward";
	console.log("moveBackward");
	rotateSlides(true);	
}
function paginate(e){
	$("#pagination-wrapper li").bind("click", paginate);
	
	//console.log("paginate:  " + typeof $(e.currentTarget).attr("id").substr(6));
	
	paginateNum = parseInt($(e.currentTarget).attr("id").substr(6));
	direction = "paginate";
	
	$("#pagination-wrapper li").removeClass("currentpaginate");
	$(e.target).addClass("currentpaginate");
	rotateSlides(true);
}

$(window).load(function() {	
	
	$("span.next").bind("click", moveForward);
	$("span.previous").bind("click",moveBackward);
	
	
	numberOfItems = $('.slides .wp-post-image').length;
	
	var wrapper = $("#pagination-wrapper ul");
	
	for(var i =0;i<numberOfItems;i++){
		var li = document.createElement("li");
		$(li).attr("id", "button"+i);
		if(i == currentItem){
			$(li).addClass("currentpaginate");
		}
		$(wrapper).append($(li));
	}
	
	$('.slides .wp-post-image').eq(currentItem).fadeIn(fadeTime);
	$('.slides .wp-post-image').eq(currentItem).addClass("slideActive");
	$("#pagination-wrapper li").eq(currentItem).addClass("currentpaginate");
	
	$("#pagination-wrapper li").bind("click", paginate);
	
	setTimeout(init,2000)
});

function init(){
	timer.interval(itemInterval).addCallback(rotateSlides).runOnce(false).start();	
}