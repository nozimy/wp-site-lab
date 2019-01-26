jQuery(document).ready(function($) {
    "use strict";


    /*=================== Sticky Header ===================*/
    var nav_stick;
    if ($("nav").hasClass('stick')) {
        var nav_stick = $("nav").offset().top;
    }
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll > nav_stick) {
            $("nav.stick").addClass("sticky");
            var nav_height = $("nav.stick").innerHeight();
            $(".nav-height").css({
                "height": nav_height
            });
        } else {
            $("nav.stick").removeClass("sticky");
            $(".nav-height").css({
                "height": 0
            });
        }
    });


    /*================== Search =====================*/
    $(".open-search").on("click", function() {
        $(this).parent().toggleClass("active");
        return false;
    });
    $("html").on("click", function() {
        $(".top-search").removeClass("active");
    });
    $(".open-search, .top-search form").on("click", function(e) {
        e.stopPropagation();
    });


    /*================== Responsive Sidemenu =====================*/
    $(".sidemenu-btn").on("click", function() {
        $(".wrapper").toggleClass("stop");
        $(".sidemenu").toggleClass("slidein");
        return false;
    });
    $(".close-menu").on("click", function() {
        $(".wrapper").removeClass("stop");
        $(".sidemenu").removeClass("slidein");
        return false;
    });

    /*================== Menu Dropdown =====================*/
    $(".sidemenu ul ul,.widget_nav_menu ul ul").parent().addClass("menu-item-has-children");
    $(".sidemenu ul li.menu-item-has-children > a,.widget_nav_menu ul li.menu-item-has-children > a").on("click", function() {
        $(this).parent().toggleClass("active").siblings().removeClass("active");
        $(this).next("ul").slideToggle();
        $(this).parent().siblings().find("ul").slideUp();
        return false;
    });

    /*================== SCROLLBAR =====================*/
    $('.sidemenu').enscroll({
        showOnHover: true,
        verticalTrackClass: 'track3',
        verticalHandleClass: 'handle3'
    });

    $(".sidebar").stick_in_parent();

    /*================== Back to top =====================*/
    $(window).on("scroll",function(){
        if ($(this).scrollTop() > 200) {
            $('.scroll-up').fadeIn();
        } else {
            $('.scroll-up').fadeOut();
        }
    });
    $(".scroll-up a").on("click",function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });

    /* ============ Humble Slider ================*/
    $('.humble-slider.style2').owlCarousel({
        autoplay:true,
        loop:true,
        smartSpeed:1000,
        dots:false,
        nav:true,
        margin:0,
        mouseDrag:true,
        autoHeight:false,
        items:3,
        responsive:{
            1200:{items:3},
            980:{items:3},
            767:{items:2},
            480:{items:1},
            0:{items:1}
        }
    });

    /* ============ Humble Slider ================*/
    $('.humble-slider').owlCarousel({
        autoplay:true,
        loop:true,
        smartSpeed:1000,
        dots:false,
        nav:true,
        margin:0,
        mouseDrag:true,
        autoHeight:false,
        items:1,
        singleItem:true,
        animateIn:"fadeIn",
        animateOut:"fadeOut"
    });

    /* ============ Single post page gallery ================*/
    $('.single-post-slider').owlCarousel({
        autoplay:true,
        loop:true,
        smartSpeed:1000,
        dots:false,
        nav:true,
        margin:0,
        mouseDrag:true,
        autoHeight:false,
        items:1,
        singleItem:true,
        animateIn:"fadeIn",
        animateOut:"fadeOut"
    });

    /* ============ Fitvids ================*/
    $(".post").fitVids();


    /*============= Masonary Initializer ===============*/
    var $grid = $('.masonary').masonry({
      itemSelector: '.masonary > .grid-post'
    });

    // layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
      $grid.masonry('layout');
    });


}); /*=== Document.Ready Ends Here ===*/
