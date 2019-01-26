/**
    * @package Ecobox Responsive HTML Template
    * 
    * Template Scripts
    * Created by Dan Fisher

    Custom JS
    
    1. Main Navigation
    2. Isotope
    3. Flickr
    4. FitVid (responsive video)
    5. Carousel
    -- Misc
*/

jQuery(function($){

	/* ----------------------------------------------------------- */
	/*  1. Navigation
	/* ----------------------------------------------------------- */
	$(".flexnav").flexNav({
		'buttonSelector': '.navbar-toggle',  // default menu button class name
		'animationSpeed' : 250,              // default for drop down animation speed
		'hoverIntent':        true,          // Change to true for use with hoverIntent plugin
  	'hoverIntentTimeout': 100            // hoverIntent default timeout
	});


	/* ----------------------------------------------------------- */
	/*  2. Isotope
	/* ----------------------------------------------------------- */

    (function() {

      // Portfolio settings
      var $container          = $('.gallery-list');
      var $filter             = $('.gallery-filter');

      $(window).smartresize(function(){
          $container.isotope({
              filter              : '*',
              resizable           : true,
              layoutMode          : 'sloppyMasonry',
              itemSelector        : '.gallery-item'
          });
      });

      $container.imagesLoaded( function(){
          $(window).smartresize();
      });

      // Filter items when filter link is clicked
      $filter.find('a').click(function() {
          var selector = $(this).attr('data-filter');
          $filter.find('a').removeClass('current');
          $(this).addClass('current');
          $container.isotope({ 
              filter             : selector,
              animationOptions   : {
              animationDuration  : 750,
              easing             : 'linear',
              queue              : false
              }
          });
          return false;
      });
       
    })();


    /* ----------------------------------------------------------- */
    /*  4. FitVid
    /* ----------------------------------------------------------- */
    $("iframe[src*='vimeo'], iframe[src*='youtube']").each(function(){
        $(this).wrap("<figure class='video alignnone'/>");
    });
    $(".screen-inner, .video").fitVids();



    /* ----------------------------------------------------------- */
    /*  -- Misc
    /* ----------------------------------------------------------- */

    $('.title-bordered h2').append('<span class="line line__right"></span>').prepend('<span class="line line__left"></span>');

    // Animation on scroll
    var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if (isMobile === false) {
        $('*[data-animation]').addClass('animated');

        $('.animated').appear(function() {
            var elem = $(this);
            var animation = elem.data('animation');
            if ( !elem.hasClass('visible') ) {
                var animationDelay = elem.data('animation-delay');
                if ( animationDelay ) {

                    setTimeout(function(){
                        elem.addClass( animation + " visible" );
                    }, animationDelay);

                } else {
                    elem.addClass( animation + " visible" );
                }
            }
        });
    }

    // Magnific Popup
    $('.magnific-img').magnificPopup({
        removalDelay: 300,
        type:'image',
        mainClass: 'mfp-fade'
    });


    // Comment Form Button
    $('#respond #submit').addClass('btn btn-primary btn-lg');
	
});


jQuery(function($){
  // Triangles (Categories)
  var titleWidth = $('.cat-title').width();
  $(".cat-title .triangle-top, .cat-title .triangle-bottom").css({
      "border-right": titleWidth / 2 + 'px solid transparent'
  });
   $(".cat-title .triangle-top, .cat-title .triangle-bottom").css({
      "border-left": titleWidth / 2 + 'px solid transparent'
  });
});

jQuery(function($){
$(window).resize(function () {
  var titleWidthR = $('.cat-title').width();
  $(".cat-title .triangle-top, .cat-title .triangle-bottom").css({
      "border-right": titleWidthR / 2 + 'px solid transparent'
  });
  $(".cat-title .triangle-top, .cat-title .triangle-bottom").css({
      "border-left": titleWidthR / 2 + 'px solid transparent'
  });
});
});


// Triangles (Icoboxes)
jQuery(function($){
  var icoboxWidth = $('.icobox-holder').width();
  $(".icobox-holder .triangle-top").css({
      "border-top": icoboxWidth / 3 + 'px solid rgba(255,255,255,.1)'
  });
  $(".icobox-holder .triangle-bottom").css({
      "border-bottom": icoboxWidth / 3 + 'px solid rgba(0,0,0,.02)'
  });
  $(".icobox-holder .triangle-top, .icobox-holder .triangle-bottom").css({
      "border-right": icoboxWidth / 2 + 'px solid transparent'
  });
   $(".icobox-holder .triangle-top, .icobox-holder .triangle-bottom").css({
      "border-left": icoboxWidth / 2 + 'px solid transparent'
  });
});

jQuery(function($){
  $(window).resize(function () {
    var icoboxWidthR = $('.icobox-holder').width();
    $(".icobox-holder .triangle-top").css({
        "border-top": icoboxWidthR / 3 + 'px solid rgba(255,255,255,.1)'
    });
    $(".icobox-holder .triangle-bottom").css({
        "border-bottom": icoboxWidthR / 3 + 'px solid rgba(0,0,0,.02)'
    });
    $(".icobox-holder .triangle-top, .icobox-holder .triangle-bottom").css({
        "border-right": icoboxWidthR / 2 + 'px solid transparent'
    });
    $(".icobox-holder .triangle-top, .icobox-holder .triangle-bottom").css({
        "border-left": icoboxWidthR / 2 + 'px solid transparent'
    });
  });
});