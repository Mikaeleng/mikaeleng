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
if (window.console && window.console.log) {
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

    arrangePosts({
        postClass: '.post-item', 
        itemId:'#divID_', 
        leftCol:'#leftCol', 
        rightCol:'#rightCol',
        singleCol:'#singleCol'});
    ////////////////////////////////////
    // mobile nav show/hide handlers
    ///////////////////////////////////
    toggleNavVisible();

     setInterval(function(){ 
       // jQuery("#menu-mainmenu").css("visibility","visible");
        jQuery("#rightCol").css("visibility", "visible");
        jQuery("#leftCol").css("visibility", "visible");
        jQuery("#singleCol").css("visibility", "visible");
 },300);
    

    jQuery("#search-button").click(function(event){
        event.preventDefault();
        showSearch();
    })

    jQuery("#nav-button").click(function(event){
        event.preventDefault();
        showNav();
    })
    $('#menu-button').sidr({
          name: 'sidr-right',
          side: 'right',
          source: '#main-navigation'
    });

    $(window).swipe({
        swipeLeft:function(event, direction, distance, duration, fingerCount, fingerData) {
            if(current_viewport==SMALL || current_viewport==MEDIUM){
                $.sidr('open', 'sidr-right'); 
            } 
        },
        swipeRight:function(event, direction, distance, duration, fingerCount, fingerData) {
            if (current_viewport==SMALL || current_viewport==MEDIUM) {
                $.sidr('close', 'sidr-right');  
            }
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
       threshold:100,
       preventDefaultEvents: false
    });
    
    ///////////////////////////////////
    //  ClickEvent for loading more items to generic feeds
    ///////////////////////////////////

    jQuery(".action-button").click(function(e) {
        
        // startpage feed button
        if(jQuery(e.currentTarget).hasClass('feed')){
            getMorePosts({
                url:'wp-content/themes/eddiemachado-bones-448da9f/feed.php', 
                postClass:'.post-item', 
                categories:'1,3,4'});
        }
       // end if statements
        e.preventDefault();
    });

    ////////////////////////////////////
    //  handler to check when the window is resized
    ///////////////////////////////////
    jQuery(window).resize(function(e) {

        //switchHeadline();
    
    if(hit_breakpoint()== true){
        arrangePosts({
            postClass: '.post-item', 
            itemId:'#divID_', 
            leftCol:'#leftCol', 
            rightCol:'#rightCol',
            singleCol:'#singleCol'});
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

/***********************************
    *
    *       Devide and connect post feed
    *       // args.postClass           = name of the class that holds each post item ( the same class for all items)
    *       // args.leftCol/rightCol    = the id of the two colums that the post items are placed in.
    *       // args.itemId              = the uniqe id for each post item on the page
            ex. {postClass: 'post-item', itemId:'#divID', leftCol:'#leftCol', rightCol:'#rightCol'}
    ************************************/
    function devidePosts(args){ 

    var feedItems = jQuery(args.postClass);
    var colum = 0;
    for(var i=0;i<feedItems.length;i++){
        
        var postItem = jQuery(args.itemId+i);
        switch(colum){
            case 0:
            jQuery(postItem).appendTo(args.leftCol);
            break;
            case 1:
            jQuery(postItem).appendTo(args.rightCol);
            
            break;
        }
        
        jQuery(feedItems[i]).addClass(args.postClass.replace('.',''));
        
        if(colum<1){colum++}else if(colum==1){colum=0};
    }
    
}

////////////////////////////////////////
// args.postClass    = name of the class that holds each post item ( the same class for all items)
// args.itemId       = the uniqe id for each post item on the page
// args.singleCol  = The wrapper div for the list of post divs on the page
// ex. {postClass:'post-item', itemId:'divID', singleCol:'#singleCol'}
////////////////////////////////////////
function connectPosts(args){

    var items = jQuery(args.postClass);
    for(var i=0;i<items.length;i++){
        var postItem = jQuery(args.itemId+i);
        jQuery(postItem).appendTo(args.singleCol);
    }
}

function arrangePosts(args){
    
    if(current_viewport == SMALL){
            connectPosts(args);
        }else{
            devidePosts(args);
        }
}

/***********************************
*
*       Get generic posts from several categories
*
************************************/

function getMorePosts(args){

    /*

    args.url                = name of php file that returns the new posts
    args.postClass          = name of the class that holds each post item ( the same class for all items)
    args.categories         = list string/array of numbers of categories that are returned

    ex.  {url:'more-posts.php', postClass:'post-item', categories:'1,3,4'};

    */

    // hides the "load more" div at the end of the posts and shows the loading feedback div.
    //printer ( "FQ U " + response);
    if(response>1){
        jQuery("#action-wrapper").delay(500).fadeOut("fast");
        jQuery("#loading-wrapper").delay(500).fadeIn("fast");
    
    // Makes the call to the server
    jQuery.ajax({
      type: "POST",
      url: args.url,
      data: { iteration: jQuery(args.postClass).length, catid:args.categories},
      beforeSend: function(){
        //jQuery("#infin").waypoint('destroy');  
      }
    }).done(function( msg ) {
        response = jQuery(msg).length;

        if(response<1){
            jQuery("#action-wrapper").css("display","none");
            jQuery("#finish-button-wrapper").css("display","block");
            return;
        }
            // hides the div that is filled up with post-items before the arrangePosts function is called. 
            //It hides the singleCol when the viewport is set to Large
                //if(viewportSize() == LARGE ){jQuery("#singleCol").css("display", "none");}
                //if(viewportSize() == SMALL ){jQuery("#singleCol").css("display", "block");}
            // timer to handle a delay in the animation sequense so it looks good.
            setTimeout(function(){
                jQuery(msg).appendTo("#singleCol");
           
                arrangePosts({
                postClass: '.post-item', 
                itemId:'#divID_', 
                leftCol:'#leftCol', 
                rightCol:'#rightCol',
                singleCol:'#singleCol'});
            
                jQuery("#action-wrapper").fadeIn("slow");
               jQuery("#loading-wrapper").fadeOut("slow");
                printer( 'response: ' + response );

               /* if(response>0){
                      jQuery('#infin').waypoint({
                      offset: '80%',
                      handler: function(direction){
                        if(direction === "down"){
                            getMorePosts();
                            
                        }
                      }
                    });
                    // waypoint ends
                }*/

            },500);
            // timeOut ends
    });
    // done ends
    }else{
        
    }
}