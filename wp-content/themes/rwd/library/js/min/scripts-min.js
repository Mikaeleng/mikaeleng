function printer(e){window.console&&window.console.log&&null!=e&&window.console.log(e)}function responsive_viewport(){var e=jQuery(window).width();return e}function toggleNavVisible(){}function switchHeadline(){switch(current_viewport){case SMALL:jQuery("#top-header span:nth-child(2)").append(jQuery(".page-title").html()),jQuery(".article-header").css("display","none"),jQuery(".page-title").text("");break;case MEDIUM:jQuery(".page-title").append(jQuery("#top-header span:nth-child(2)").html()),jQuery(".article-header").css("display","block"),jQuery("#top-header span:nth-child(2)").text("")}jQuery(".article-header").css("visibility","visible")}function showNav(){}function showSearch(){}function viewportSize(){return responsive_viewport()<481?SMALL:responsive_viewport()>481&&responsive_viewport()<=768?MEDIUM:responsive_viewport()>768&&responsive_viewport()<=1030?LARGE:responsive_viewport()>1030?XL:null}function hit_breakpoint(){return viewportSize()!=current_viewport?(current_viewport=viewportSize(),!0):!1}var winH,winW,LARGE="large",MEDIUM="medium",SMALL="small",XL="extraLarge",response=11,current_viewport=null,_winHeight=0;window.getComputedStyle||(window.getComputedStyle=function(e,t){return this.el=e,this.getPropertyValue=function(t){var i=/(\-([a-z]){1})/g;return"float"==t&&(t="styleFloat"),i.test(t)&&(t=t.replace(i,function(){return arguments[2].toUpperCase()})),e.currentStyle[t]?e.currentStyle[t]:null},this}),jQuery(document).ready(function($){responsive_viewport()<481,responsive_viewport()>481,responsive_viewport()>=768&&$(".comment img[data-gravatar]").each(function(){$(this).attr("src",$(this).attr("data-gravatar"))}),responsive_viewport()>1030,current_viewport=viewportSize(),_winHeight=$(window).height(),switchHeadline(),jQuery("#search-button").click(function(e){e.preventDefault(),showSearch()}),jQuery("#nav-button").click(function(e){e.preventDefault(),showNav()}),jQuery(window).resize(function(e){_winHeight=$(window).height(),$("#cinema-mode").css("height",_winHeight),printer(_winHeight),1==hit_breakpoint()&&current_viewport!=SMALL&&$.sidr("close","sidr-right"),switchHeadline(),toggleNavVisible()})}),function(e){function t(){o.setAttribute("content",c),u=!0}function i(){o.setAttribute("content",s),u=!1}function n(n){v=n.accelerationIncludingGravity,p=Math.abs(v.x),l=Math.abs(v.y),w=Math.abs(v.z),!e.orientation&&(p>7||(w>6&&8>l||8>w&&l>6)&&p>5)?u&&i():u||t()}if(/iPhone|iPad|iPod/.test(navigator.platform)&&navigator.userAgent.indexOf("AppleWebKit")>-1){var r=e.document;if(r.querySelector){var o=r.querySelector("meta[name=viewport]"),a=o&&o.getAttribute("content"),s=a+",maximum-scale=1",c=a+",maximum-scale=10",u=!0,p,l,w,v;o&&(e.addEventListener("orientationchange",t,!1),e.addEventListener("devicemotion",n,!1))}}}(this);