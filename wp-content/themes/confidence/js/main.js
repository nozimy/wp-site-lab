( function ($) {
'use strict';

jQuery(document).ready(function() {


	

	/*

	$(function(){
		var shrinkHeader = 30;
		$(window).scroll(function() {
			var scroll = getCurrentScroll();
			if ( scroll >= shrinkHeader ) {
				$('.navbar').addClass('shrink');
			}
			else {
				$('.navbar').removeClass('shrink');
			}
		});
		
		function getCurrentScroll() {
			return window.pageYOffset || document.documentElement.scrollTop;
		}
	});
	*/

  /* ============== EVENT CAROUSEL ================= */

  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,

    navText: [
    "<span class='nav-arrow left'></i>",
    "<span class='nav-arrow right'></i>"
    ],
    responsive:{
      0:{
        items:1
      },
      550:{
        items:2
      },
      768:{
        items:3
      },
      992:{
        items:3
      }
    }
  });

  $('.owl-carousel2').owlCarousel({
    loop:true,
    margin:70,
    nav:true,
    navText: false,
    responsive:{
      0:{
        items:1
      },
      550:{
        items:2
      },
      768:{
        items:2
      },
      992:{
        items:3
      }
      }
  });

	//MILESTONE
    $('.timer').countTo();
	
	// blog list
	$('.flexslider').flexslider({controlNav:true});;
	$(".video-wrapper").fitVids();
	$(".video-responsive").fitVids();

 });
 
 /*-- WINDOW LOAD --*/
	$(window).load(function() {
		$("#preview-area").delay(200).fadeOut("slow");
	});
	/*-- WINDOW LOAD END --*/

}( jQuery ));