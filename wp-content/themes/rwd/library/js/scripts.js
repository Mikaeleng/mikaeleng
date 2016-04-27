/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/
var winH;
var winW;
var LARGE               = "large";
var MEDIUM              = "medium";
var SMALL               = "small";
var XL                  = "extraLarge";
var response            = 11;
var current_viewport    = null;

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
    window.getComputedStyle = function(el, pseudo) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop == 'float') prop = 'styleFloat';
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        }
        return this;
    }
}

function printer(data){
if (window.console && window.console.log && data!= null) {
    window.console.log(data); 
    }
}

function responsive_viewport(){
    var responsive_viewport = jQuery(window).width();
    return responsive_viewport;
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

    /*
    Responsive jQuery is a tricky thing.
    There's a bunch of different ways to handle
    it, so be sure to research and find the one
    that works for you best.
    */
    
    /* getting viewport width */
    
     
    /* if is below 481px */
    if (responsive_viewport() < 481) {
    
    } /* end smallest screen */
    
    /* if is larger than 481px */
    if (responsive_viewport() > 481) {
        
    } /* end larger than 481px */
    
    /* if is above or equal to 768px */
    if (responsive_viewport() >= 768) {
    
        /* load gravatars */
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });
        
    }
    
    /* off the bat large screen actions */
    if (responsive_viewport() > 1030) {
        
    }
    

    //////////////////////////////
    //
    //      Handlers for layout changes when hitting breakpoints
    //
    /////////////////////////////
    current_viewport = viewportSize();

    switchHeadline();

    

    jQuery("#search-button").click(function(event){
        event.preventDefault();
        showSearch();
    })

    jQuery("#nav-button").click(function(event){
        event.preventDefault();
        showNav();
    })
    // makes the drawer menu show and hide:

   /* $('#menu-button').sidr({
          name: 'sidr-right',
          side: 'right',
          source: '#main-navigation',
          onOpen: function(){
            jQuery("#mobile-menu-wrapper").animate({right:"85%"},"fast", "linear")
        },
          onClose: function(){
            jQuery("#mobile-menu-wrapper").animate({right:"0"},"fast", "linear")
          }
    });*/

    $(window).swipe({
        swipeLeft:function(event, direction, distance, duration, fingerCount, fingerData) {
            if(current_viewport==SMALL && direction == "left"){
                $.sidr('open', 'sidr-right'); 
            } 
        },
        swipeRight:function(event, direction, distance, duration, fingerCount, fingerData) {
            if (current_viewport==SMALL && direction == "right") {
                $.sidr('close', 'sidr-right');  
            }
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
       threshold:125,
       preventDefaultEvents: false
    });
    

    ////////////////////////////////////
    //  handler to check when the window is resized
    ///////////////////////////////////
    jQuery(window).resize(function(e) {

        //switchHeadline();
    
    if(hit_breakpoint()== true){
        if (current_viewport!=SMALL){
            $.sidr('close', 'sidr-right'); 
        }
    }

    switchHeadline();
    toggleNavVisible();
    });
}); /* end of as page load scripts */


    function toggleNavVisible(){
     /*   if(responsive_viewport() <1030){
            jQuery("#menu-mainmenu").hide(0);
            jQuery(".nav").removeClass("wrap");
            jQuery("#nav-button").show(0);
        }else{
            jQuery("#menu-mainmenu").show(0);
            jQuery("#nav-button").hide(0);
            jQuery(".nav").addClass("wrap");
            jQuery("#searchbox").show(0);
        }*/
    }
    // Moves the headline in small .vs medium size viewport 
    // from the .top-header to .entry-content
    function switchHeadline(){
        switch(current_viewport){
            case SMALL:
                jQuery("#top-header span:nth-child(2)").append(jQuery(".page-title").html());
                jQuery(".article-header").css("display", "none");
                jQuery(".page-title").text("");
            break;
            case MEDIUM:
                jQuery(".page-title").append(jQuery("#top-header span:nth-child(2)").html());
                jQuery(".article-header").css("display", "block");
                jQuery("#top-header span:nth-child(2)").text("");
            break;
        }
        // to make sure the H1 is not visible on pageload if the page is SMALL. it is set to hidden in the css
         jQuery(".article-header").css("visibility", "visible");
    }

    // the buttonevent that shows the main navigation in small view
    function showNav(){


       /* if ( jQuery( "#menu-mainmenu" ).is( ":hidden" ) ) {
            jQuery("#searchbox").slideUp( "fast", function(){; 
                jQuery("#menu-mainmenu").slideDown( "fast"); 
                });       
             } else {
                jQuery("#menu-mainmenu").slideUp( "fast");   
            }*/

    }
    // the buttonevent that shows the search field in small view
    function showSearch(){
        //var target = jQuery("#searchbox");
       // var old_target = jQuery("#hmenu-mainmenu");


      /* if ( jQuery( "#searchbox" ).is( ":hidden" ) ) {
          if(viewportSize() != XL){  
            jQuery("#menu-mainmenu").slideUp( "fast");   
          }
            jQuery("#searchbox").slideDown( "fast");    
            jQuery("#searchbox").css("display","table");          
         } else {
            jQuery("#searchbox").slideUp( "fast");   
        }*/
    }
/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );

/***********************************
*
*   Handlers for checking and viewport sizes and breakpoints
*
************************************/
function viewportSize(){
    if(responsive_viewport() < 481){
            return SMALL; // mobile view
    }else if(responsive_viewport() >481 && responsive_viewport() <= 768 ){
            return MEDIUM; // tweeners( phones in between tablet and phone)
    }else if(responsive_viewport() > 768 && responsive_viewport() <= 1030 ){
            return LARGE; // ipads and larger tablets
    }else if(responsive_viewport() > 1030){
        return XL; // Desktop
    }
    return null;
}

function hit_breakpoint(){
    if(viewportSize() != current_viewport){
        current_viewport = viewportSize();
        return true;
    }
    return false;
}


