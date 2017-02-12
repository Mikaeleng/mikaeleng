/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/
var response = 11;
var complete;
var _winHeight          = 0;

/***********************************
 *
 *       Get generic posts from several categories
 *
 ************************************/


function getMorePosts(args){
    //printer("targetConatiner" + args.targetContainer);
    /*

     args.url                = name of php file that returns the new posts
     args.postClass          = name of the class that holds each post item ( the same class for all items)
     args.categories         = list string/array of numbers of categories that are returned

     ex.  {url:'more-posts.php', postClass:'post-item', categories:'1,3,4'};

     args.postLimit          = The end posts_per_page of the items retrived. ex (35)
     args.init               = default = false, if the call is when the page is being initizated this will be set to true
     args.TypeOfFeed         = ex 'wall', 'create', 'live' 'header'
     */
    // hides the "load more" div at the end of the posts and shows the loading feedback div.
    if(response>1){
        jQuery(".button-wrapper").fadeOut(500);
        jQuery("#loading-wrapper").delay(500).fadeIn("fast");
        //printer(args);
        // Makes the call to the server
        jQuery.ajax({
            type: "POST",
            url: args.url,
            data: args,
            beforeSend: function(){
            }
        }).done(function( msg ) {

            response = jQuery(msg).length;
            complete = msg.indexOf("end-of-posts");

            // if there is no more posts to displays the information that there is no more posts

            setTimeout(function(){
                jQuery(msg).appendTo(args.targetContainer);
                if(complete > -1){
                    jQuery("#loading-wrapper").css("display","none");
                    jQuery("#finish-button-wrapper").css("display","block");
                }else if(complete <= -1){
                    jQuery(".button-wrapper").fadeIn("slow");
                    jQuery("#loading-wrapper").fadeOut("slow");
                }
            },1000);// timeOut ends
        });// done ends
    }else{
        jQuery(".button-wrapper").css("display","none");
        jQuery("#loading-wrapper").css("display","none");
        jQuery("#finish-button-wrapper").css("display","block");
    }
}

/***********************************
 *
 *       ready function
 *
 ************************************/
jQuery(document).ready(function($) {
 var user = $('#wpadminbar').val();
//removes wp_navbar for logind user in non-admin view
  if(user !== "undefined"){
    //$('#content').css('margin', '41px auto 0 auto');
  }
    // height is also set in scripts.js onResize function
    jQuery( "#cinema-mode" ).appendTo( "body" );
    var _img = jQuery(".single-img-container img").attr("src");

    jQuery("#cinema-mode").css("background-image", 'url(' + _img + ')');
    jQuery("#cinema-mode").css('height',_winHeight);

  // event for geting more post on the startpage.php page
  jQuery(".startpage-feed-button").click(function(e){
    var currentCount = jQuery(".feed-item").length;
    var newTotal = currentCount + 10;
    var kneedle   = currentCount;
    
      getMorePosts({
          url: 'wp-content/themes/rwd/library/models/FeedModel.php', 
          postLimit: newTotal,
          pointer:  kneedle,
          orderby: 'date',
          order: 'DESC',
          item_cat: 'wall',
          TypeOfFeed: 'wall',
          posts_per_page: -1,
          targetContainer: '#main'
      });

      e.preventDefault();
    });

// event for showing the image in cinema mode
    jQuery(".single-img-container").click(function(e){
        jQuery("#cinema-mode").css("display","block");

        e.preventDefault();
    });

// event for hiding the ciema mode
    jQuery("#cinema-mode").click(function(e){
        jQuery("#cinema-mode").css("display","none");

        e.preventDefault();
    });


    // event for geting more post on the create.php page
    jQuery(".create-page-feed-button").click(function(e){
        var currentCount  = jQuery(".feed-item").length;
        var newTotal      = currentCount + 10;
        var kneedle       = currentCount -1;
        var year          = jQuery(".year-tag").filter( ":last" ).text();

        getMorePosts({
            url: '../wp-content/themes/rwd/library/models/FeedModel.php',
            orderby: 'date',
            order: 'DESC',
            posts_per_page: '-1',
            category_name: 'create',
            postLimit: newTotal,
            pointer:  kneedle,
            currentYear: year,
            TypeOfFeed: 'create',
            targetContainer: '#create-item-container'
        });

        e.preventDefault();
    }); // end of create fetch


    /////////////////////////////////////////////////

    //          Old scripts

    /////////////////////////////////////////////////
  // event for geting more post on the create.php page
  jQuery(".work-page-feed-button").click(function(e){
    var currentCount  = jQuery(".feed-item").length;
    var newTotal      = currentCount + 10;
    var kneedle       = currentCount -1;
    var year          = jQuery(".year-tag").filter( ":last" ).text();

    getMorePosts({
        url: '../wp-content/themes/rwd/library/models/FeedModel.php', 
        orderby: 'date',
        order: 'DESC', 
        posts_per_page: '-1', 
        category_name: 'work',
        postLimit: newTotal,
        pointer:  kneedle,
        currentYear: year,
        TypeOfFeed: 'work',
        targetContainer: '#work-item-container'
    });

    e.preventDefault();
  }); // end of work fetch

// event for geting more post on the live.php page
    jQuery(".live-page-feed-button").click(function(e){
        var currentCount = jQuery(".feed-item").length;
        var newTotal = currentCount + 10;
        var kneedle   = currentCount;

        getMorePosts({
            url: '../wp-content/themes/rwd/library/models/FeedModel.php',
            postLimit: newTotal,
            pointer:  kneedle,
            orderby: 'date',
            order: 'DESC',
            item_cat: 'live',
            category_name: 'live',
            TypeOfFeed: 'live',
            posts_per_page: -1,
            targetContainer: '#live-item-container'
        });

        e.preventDefault();
    });
});


 
