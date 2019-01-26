// Fire FastClick
window.addEventListener('load', function () {
	new FastClick(document.body);
}, false);

function ajaxsearch() {
	(function ($) {
		// Get the data from search
		var url = MyAutocomplete.autocomleteurl + "?action=my_search";

		// Run autocomplete plugin
		if ($('body').find('.searchbar').find('#s').length) {
			$( "#s" ).autocomplete({
				source: url,
	    		select: function(event, ui) {
	        		window.location.href=ui.item.link;
	    		},
	    		focus: function() {
		          	return false;
		        },
				delay: 0,
				minLength: 1,
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	            if(item.thumb){
	            return $( "<li class='zlsearchresult'>" ).append( "<a><img src='" + item.thumb + "' class='left align-left'/> <strong>" + item.label + "</strong><br> <span>" + item.desc + "</span> </a>" ).appendTo( ul );
	        	} else {
	        		return $( "<li class='zlsearchresult'>" ).append( "<a><strong>" + item.label + "</strong><br> <span>" + item.desc + "</span> </a>" ).appendTo( ul );
	        	}
	        };
		}
	})( jQuery );
}

/**
 * For Home.js
 * FYI, I wrote this plugin for about 4 months long...
 * Buy my theme instead, don't download from warez sites
 */

//Initialize the Masonry, it's not freemason tho.
var container = document.querySelector('#container');

function msnryInit() {
	var container = document.querySelector('#container');
	var stampElem = container.querySelector('.frontsubmit');
	var msnry = new Masonry(container, {
		itemSelector: '.post',
	/*columnWidth: 456,
		gutter: 48,*/
	});
}

function masonpostmode() {
	var container = document.querySelector('#container');
	var stampElem = container.querySelector('.frontsubmit');
	var msnry = new Masonry(container, {
		itemSelector: '.post',
		columnWidth: 456,
		gutter: 48,
		isResizeBound: false
	});
}
//Destroy the freemasonry. Yes, it's free jQuery plugin called masonry, so we can call it FreeMason-ry. xoxoxo.

function masonrydestroy() { /*container.masonry('destroy');*/
	var container = document.querySelector('#container');
	var msnry = new Masonry(container);
	msnry.destroy();
}

function resetvalues() {
	(function ($) {
		var title = document.getElementById("the_title");
		title.value = '';

		var content = document.getElementById("the_content");
		content.value = '';

		var format = document.getElementById("the_format");
		content.value = '';

		var categories = document.forms['apfform'].elements['apfcategorycheck'];

		var countCheckBoxes = categories.length;
		for (var i = 0; i < countCheckBoxes; i++)
		categories[i].checked = false;
		tinymce.get('the_content').setContent('');

		$('.rw-plupload-ui').show();

		//Clear galery preview images after save
		$('.vp-pfui-gallery-picker div.gallery').empty();

		var audio = document.getElementById("_format_audio_embed");
		audio.value = '';

		var link = document.getElementById("_format_link_url");
		link.value = '';

		var video = document.getElementById("_format_video_embed");
		video.value = '';

		var quoteurl = document.getElementById("_format_quote_source_url");
		quoteurl.value = '';

		var quotename = document.getElementById("_format_quote_source_name");
		quotename.value = '';

		var thumb = document.getElementById("the_post_thumbnail");
		thumb.value = '';

		var tags = document.getElementById("the_tags");
		tags.value = '';

		$('.rw-plupload-thumbnail').remove();
		$('.rw-plupload-ui').show();
	})(jQuery);
}

function frontpost() {
	(function ($) {
		var postform = document.querySelector('.frontsubmit .submit_post #apfform .zl_whatsnew');
		var format = document.querySelector('.zl_post_format_opt');
		var cancel = document.querySelector('#cancel');
		var submit = document.querySelector('#postsubmit');



		eventie.bind(postform, 'click', function (event1) {
			$('.frontsubmit').addClass('postMode');
			if ($("#container").is(".zl_grid")) { /*setTimeout(msnryInit, 700);*/
				masonpostmode();
			}
		});

		eventie.bind(format, 'click', function (event2) {
			$('.frontsubmit').addClass('postMode');
			if ($("#container").is(".zl_grid")) { /*setTimeout(msnryInit, 700);*/
				masonpostmode();
			}
		});
		//Cancel it 
		eventie.bind(cancel, 'click', function (event3) {
			$('.frontsubmit').removeClass('postMode');
			if ($("#container").is(".zl_grid")) { /*setTimeout(msnryInit, 700);*/
				masonpostmode();
			}
			//resetvalues(); //Reset the value
		});
		//When submit clicked
/*eventie.bind( submit, 'click', function(event4) {
		//$('.frontsubmit').removeClass('postMode');
	});
	*/
	})(jQuery);
}



function switchlayout() {
	(function ($) {
		$('.sorter a').on('click', function (e) {
			e.preventDefault();
			var viewType = $(this).attr('data-type'),
				loop = $('.switchable-view'),
				ini = $(this),
				loopView = loop.attr('data-view');

			if (viewType == loopView) return false;
			$('#zl_content_entries').addClass('ilangdulu');
			$(this).addClass('currents').siblings('a').removeClass('currents');

			loop.stop().fadeOut(400, function () {
				if (loopView) loop.removeClass(loopView);

				if (viewType == 'default') {
					masonrydestroy();
				} else {
					setTimeout(msnryInit, 700);
				}
				$('#zl_content_entries').removeClass('ilangdulu');
				setTimeout(carouselInit2, 700);
				$(this).fadeIn().attr('data-view', viewType).addClass(viewType);

			});

			//Create the cookie baby...
			jQuery.cookie('loopview', viewType, {
				path: '/',
				expires: 999
			});
			return false;
		});
	})(jQuery);
}


function masonryDetect() {
	(function ($) {
		if ($("#container").is(".zl_grid")) {
			setTimeout(msnryInit, 500);
		} else {
			masonrydestroy();
		};
	})(jQuery);
}
// END HOME .JS IMPORTANT
/* ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo */

//Flickr Init for Flickr Widget

function flickrInit() {
	(function ($) {
		if ($('body').has('.flickr')) {
			$('.flickr').each(function () {
				var $this = $(this);
				var append = $this.find('.flickrdom');
				var id = append.data('id');
				var fetch = append.data('itemfetch');
				$this.jflickrfeed({
					limit: fetch,
					qstrings: {
						id: id
					},
					itemTemplate: '<a href="{{image_b}}" rel="prettyPhoto[pp_gal_insta]"><img src="{{image_s}}" alt="{{title}}" /></a>'
				}, function (data) {
					$('.flickr a').prettyPhoto(prettOptions);
				});
			});
		}
	})(jQuery);
}

function dribbble() {
	(function ($) {
		if ($('body').has('.dribbleshots')) {
			$('.dribbleshots').each(function () {
				var $this = $(this);
				var append = $this.find('.dribbbledom');
				var id = append.data('id');
				var fetch = append.data('itemfetch');
				$this.ballboy({
					player: id,
					per_page: fetch,
					shotClass: "zl_dribbble-shot",
					showPaginationControls: false,
					showPaginationPages: false,
					paginationPreviousText: '<div class="dashicons dashicons-arrow-left-alt"></div>',
					paginationNextText: '<div class="dashicons dashicons-arrow-right-alt"></div>'
				});
			});
		}
	})(jQuery);

}

/* Owl Carousel, you may call it slider, slideshow or somewhat */

function carouselInits() {
	(function ($) { /* Gallery Post */
		if ($('#container').find('.postgallery').length) {
			$(".mediaplayer").each(function () {
				var $this = $(this);
				var gallery = $this.find('.postgallery');
				gallery.owlCarousel({
					singleItem: true,
					nav: true,
					dots: true,
					items: 1,
					loop: true,
					responsiveClass: true,
					navText: ["<span class='dashicons dashicons-arrow-left-alt2'></span>", "<span class='dashicons dashicons-arrow-right-alt2'></span>"]
				});
				gallery.on('refreshed.owl.carousel', function(event) {
				    setTimeout(masonryDetect, 500);
				});
			});
		}
	})(jQuery);

}

//re-Initialize the carousel.

function carouselInit2() {
	(function ($) { /* Gallery Post */
		$(".mediaplayer").each(function () {
			var $this = $(this);
			var gallery = $this.find('.postgallery');
			gallery.owlCarousel();
			gallery.trigger('refresh.owl.carousel');
		});
	})(jQuery);
}

function albthumb() {
	(function ($) {
		$('.albthumb').owlCarousel({
			nav: true,
			dots: false,
			items: 10,
			itemsScaleUp: true,
			navText: ["<span class='dashicons dashicons-arrow-left-alt2'></span>", "<span class='dashicons dashicons-arrow-right-alt2'></span>"],
			slideBy: 5,
			slideSpeed: 500,
			onInitialized: function (el) {
				$('.albthumb').find(".owl-item a.iscurrent").parent().addClass("current_view center");
				//el.find(".owl-item a.iscurrent").parent().;
			}
		});

		$('.alb_navig .dashicons').click(function () {
			$('.alb_thumbnails').addClass('su');
		});
		$('.close_su').click(function () {
			$('.alb_thumbnails').removeClass('su');
		});

		$('.alb_nextlink a').live('click', function () {
			$('.current_view').next('.owl-item').find('a').click();
		});
		$('.alb_prevlink a').live('click', function () {
			$('.current_view').prev('.owl-item').find('a').click();
		});

		$('.alb_thumbnails .owl-item a').click(function (event) {
			event.preventDefault();
			var id = $(this).data('id');
			$(this).parent().addClass('current_view').siblings().removeClass('current_view');
			jQuery.ajax({
				type: 'POST',
				url: ZlGallery.zlajaxgallery,
				data: {
					'action': 'zl_gallery',
					'id': id
				},
				dataType: 'json',
				success: function (data) {
				/*console.log(data['img_url']);
		        console.log(data['thisurl']);
		        console.log(data['after']);
		        console.log(data['before']);
		        console.log(data['title']);*/

					var ini = $(this);
					// var sebelum = ini.parent().before().find('a').attr();
					// var sesudah = ini.parent().after().find('a').attr();
					$('img.mainimage').fadeOut(200, function () {
						$(this).attr('src', data['img_url']).fadeIn(200);
						$(this).attr('data-id', data['id']);
					});
					$('.zl_photospot > h3').fadeOut(200, function () {
						$(this).text(data['title']).fadeIn(200);
					});
					$('.innner').fadeOut(200, function () {
						//$(this).text(data['title']).fadeIn(300);
						$(this).load(data['thisurl'] + ' .innner', function () {
							$(this).fadeIn();
							letslike();
						});
					});

					// Add Real Environment
					document.title = data['title'];
					window.history.pushState({}, 'bar', data['thisurl']);

				}
			});
			return false;
		});
	})(jQuery);

}


//Live Link Preview
//I don't think this is neccasery. But, hey my english is bad.

function livelink() {
	(function ($) {
		//Trigger Live URL Preview on property's changes
		$('input#_format_link_url').on('input propertychange', function () {
			var cont = $('#linkpreview');
			$('input#_format_link_url').urlive({
				container: '#linkpreview',
				imageSize: 'small',
				callbacks: {
					onStart: function () {
						cont.urlive('remove');
					},
					onSuccess: function (data) {
						cont.urlive('remove');
					},
					noData: function () {
						cont.urlive('remove');
					}
				}
			});
		}).trigger('input');
	})(jQuery);

}

//Ho ho ho... what are tryin' to search?

function searchEffect() {
	(function ($) { /* Search */
		$('#searchtrigger').click(function () {
			$('.searchbar').fadeIn('medium');
			$('.searchbar input#s').focus();
		});

		$('#closesearch').click(function () {
			$('.searchbar').fadeOut('medium');
		});
		$("input#s").focusout(function () {
			$('.searchbar').fadeOut('medium');
		});

		/*Header 2*/

		function searchAppear() {
			$('.hws').css('opacity', 0);
			$('.zl_searchform_2').fadeIn(300);
			$('.zl_searchform_2 input#s').focus();
			$('#hidesearch').show();
		}

		function searchDisAppear() {
			$('.hws').css('opacity', 1);
			$('#searchtrigger2').show();
			$('.zl_searchform_2').fadeOut(300);
			$('.zl_searchform_2 input#s').focus();
		}
		$('#searchtrigger2').on('click', function (ev) {
			ev.preventDefault();
			searchAppear();
			$(this).hide();
			return false;
		});
		$('#hidesearch').click(function (e) {
			e.preventDefault();
			searchDisAppear();
			$(this).hide();
			return false;
		});
		$(".zl_searchform_2 input#s").focusout(function () {
			searchDisAppear();
			$('#searchtrigger2').show();
			$('#hidesearch').hide();
		});
	})(jQuery);

}

//This is magic. You will see the social icons. circle shape. Awesome.

function circlemenu() {
	(function ($) { /* Circle Menu */
		var angel = $('#outer_container').find('.menu_option').data("angle");
		$('#outer_container').PieMenu({
			'starting_angel': 180,
			'angel_difference': angel,
			'radius': 100,
		});
	})(jQuery);

}

//This hero will let us go to the very top of the page.

function backtotop() {
	(function ($) {
		//Back to Top
		$(window).scroll(function () {
			if ($(this).scrollTop() > 0) {
				$('.zl_backtotop').addClass('animated slideInRight').removeClass('slideOutRight');
			} else {
				$('.zl_backtotop').toggleClass('slideInRight slideOutRight');
			}
		});
		$('.zl_backtotop').click(function () {
			$("html,body").animate({
				scrollTop: 0
			}, 700);
			return false;
		});
	})(jQuery);
}

//Share the Artice link to the world :ngakak

function shareit() {
	(function ($) { /* Share it */
		$('#zl_share_it').click(function () {
			$('#zl_share_it').addClass('close');
			$('#share_button').slideDown(300, function () {
				$('#share_button li').eachStep(200, function (i, el, duration) {
					$(el).addClass('bounceIn animated');
				});
			});
		});
	})(jQuery);

}

//Album Effect.

function albumeffect() {
	(function ($) {
		$('#zl_albums .zl_album_parent').eachStep(200, function (i, ai, duration) {
			$(ai).addClass('animated fadeIn');
		});
	})(jQuery);

}

//First Word Selector

function fwselector() {
	(function ($) { /* First Word Selector */
		$('.fword').each(function () {
			var me = $(this),
				t = me.text().split(' ');
			me.html('<span class="fwstyle">' + t.shift() + '</span> ' + t.join(' '));
		});
	})(jQuery);

}

function letslike() {
	(function ($) {
		$(".post-like a").click(function () {
			heart = $(this);
			post_id = heart.data("post_id");

			jQuery.ajax({
				type: "post",
				url: ajax_var.url,
				data: "action=post-like&nonce=" + ajax_var.nonce + "&post_like=&post_id=" + post_id,
				success: function (count) {
					if (count.indexOf("already") !== -1) {
						var lecount = count.replace("already", "");
						if (lecount == 0) {
							var lecount = "Like";
						}
						heart.children(".like").removeClass("pastliked").addClass("disliked").html("<i class='dashicons dashicons-heart'></i>");
						heart.children(".unliker").text("");
						heart.children(".count").removeClass("liked").addClass("disliked").text(lecount);
					} else {
						heart.children(".like").addClass("pastliked").removeClass("disliked").html("<i class='dashicons dashicons-heart'></i>");
						heart.children(".unliker").html("<i class='dashicons dashicons-no-alt'></i>");
						heart.children(".count").addClass("liked").removeClass("disliked").text(count);
					}
				}
			});

			return false;
		});
	})(jQuery);

}
//Function to create the albums

function albumin() {
	(function ($) {
		$(".swipeboxEx").justifiedGallery({
			'sizeRangeSuffixes': {
				'lt100': '',
				'lt240': '',
				'lt320': '',
				'lt500': '',
				'lt640': '',
				'lt1024': ''
			},
			'rowHeight': 200,
			'margins': 10,
			'fixedHeight': false,
			'captions': true,
			'randomize': false
		});
/*
		$('.swipeboxEx img').eachStep(200, function(i, ai, duration){
			$(ai).addClass('animated fadeInUp');
		});
		*/
	})(jQuery);

}

// Options for PrettyPhoto
var prettOptions = {
	animation_speed: 'fast',
	slideshow: true,
	opacity: 0.7,
	show_title: false,
	allow_resize: true,
	theme: 'pp_default',
	social_tools: '',
	deeplinking: false,
	horizontal_padding: 0
}
function lightbox() {
	(function ($) {
		$("a.portozoom, a.thumb_button_zoom, a.plainzoom").prettyPhoto(prettOptions);
		$("a[rel^='prettyPhoto']").prettyPhoto(prettOptions);
		$('.gallery-size-thumbnail a[href$=".gif"], .gallery-size-thumbnail a[href$=".jpg"], .gallery-size-thumbnail a[href$=".png"], .gallery-size-thumbnail a[href$=".bmp"]').prettyPhoto(prettOptions);
		$('a.zl_zoom').click(function (zoom) {
			zoom.preventDefault();
			var targetlink = $(this).attr('href');
			$('body').append('<div class="zl_lightbox"><iframe src="' + targetlink + '" width="100%" height="100%"></iframe></div>');
			$('body').addClass('is_zoomed');
			$('.zl_close_lightbox').show();
		});

		$('div.zl_close_lightbox').click(function () {
			var findlightbox = $('body').find('.zl_lightbox');
			var $this = $(this);
			findlightbox.fadeOut(100, function () {
				findlightbox.remove()
			});
			$this.hide();
			$('body').removeClass('is_zoomed');
		});
		$(document).unbind('keydown.zl_lightbox').bind('keydown.zl_lightbox', function (e) {
			//if (e.keyCode == 13) { $('.save').click(); }     // enter
			if (e.keyCode == 27) {
				$('div.zl_close_lightbox').click();
			}
		});
	})(jQuery);


}

//Tooltip Function

function tooltipz() {
	(function ($) {
		$('.tooltip').tooltipster({
			animation: 'fade',
			touchDevices: false,
			trigger: 'hover',
			speed: 200,
			theme: 'tooltipster-light',
			multiple: true
		});
	})(jQuery);
}

function toggleMenu() {
	(function ($) {
		//Effect when we clicked the Menu Icon
		var anIn = ' bounceInDown ';
		var anOut = ' bounceOutUp ';
		$("a#zl_trigger").stop().funcToggle('click', function (ev) {
			ev.preventDefault();
			$(this).find('.dashicons').removeClass('dashicons-menu').addClass('dashicons-no-alt');
			$('.zl_navigation').slideDown(300);
			$('.zl_mainmenu > li').eachStep(70, function (i, el, duration) {
				$(el).addClass(anIn + 'animated'); //masuk
			});
			return false;
		}, function (ev) {
			ev.preventDefault();
			//Let it Disappear
			$(this).find('.dashicons').removeClass('dashicons-no-alt').addClass('dashicons-menu');
			$('.zl_mainmenu > li').eachStep(70, function (i, el, duration) {
				$(el).toggleClass(anIn + anOut); //tuker masuk
			});

			/*Slideup when the last parent menu disappear.*/
			$('.zl_mainmenu > li:first-child').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
				$('.zl_navigation').slideUp(300, function () {
					$('.zl_mainmenu > li').removeClass('animated ' + anIn + anOut);
				});
			});
			return false;
		}); //End here
		// Make child menu have the special icon
		$('.zl_mainmenu > li > a').each(function () {
			if ($(this).parent('li').children('ul').size() > 0) {
				$(this).append('&nbsp;<span class="zl_m_child_sign">+</span>');
				$(this).addClass('hadchild');
			}
		});
		$('.zl_mainmenu li ul li > a').each(function () {
			if ($(this).parent('li').children('ul').size() > 0) {
				$(this).append('&nbsp;<span>+</span>');
				$(this).addClass('hadchild');
			}
		});

		$('.zl_m_menu_trig').click(function () {
			$('.zl_m_sidebar').addClass('zl_nav_active');
			$('#page, body').addClass('zl_pushed');
			$('.zl_overlay_sidebar').show();
			return false;
		});
		$('.zl_m_cls_wrp, .zl_overlay_sidebar').click(function () {
			$('.zl_m_sidebar').removeClass('zl_nav_active');
			$('#page, body').removeClass('zl_pushed');
			$('.zl_overlay_sidebar').hide();
			return false;
		});
	})(jQuery);

}

function AnimatePosts() {
	(function ($) {
		$('.post').waypoint(function () {
			$(this).addClass("bounceIn animated");
		}, {
			offset: '90%'
		});
	})(jQuery);

}

function oembedGet() {
	(function ($) {
		$('.videothumb').each(function () {
			var ini = $(this);
			var trigger = ini.find('.oembedtrigger');
			var letsembed = ini.find('.letsembed');
			var url = trigger.attr('href');
			var loader = ini.find('.medialoading');
			var mediaappend = ini.find('mediaappend');
			loader.hide();
			ini.click(function () {
				loader.show();
				letsembed.oembed(null, {
					embedMethod: "append",
					maxWidth: 960,
					maxHeight: 400,
					vimeo: {
						autoplay: true,
						maxWidth: 960,
						maxHeight: 400
					},
					youtube: {
						autoplay: true,
						maxWidth: 1000,
						maxHeight: 400
					},
					afterEmbed: function (oembedData) {
						loader.hide();
						trigger.hide();
						ini.addClass('playing');
						//setTimeout(masonryDetect, 500);
					}
				});
			});
		});
	})(jQuery);

}

function footerSlide() {
	(function ($) {
		var widcol = $('.zl_footer').data('col');
		$(".footerslide").owlCarousel({
			singleItem: false,
			dots: true,
			items: widcol,
			mouseDrag: true,
			/*autoHeight:true,*/
			responsive: {
				0: {
					items: 1,
					nav: false
				},
				320: {
					items: 1,
					nav: false,
					autoHeight: true
				},
				768: {
					items: 2,
					nav: false
				},
				800: {
					items: widcol,
					nav: false
				},
			}
		});
	})(jQuery);

}

function instagram() {
	(function ($) {
		var instaID = $('#instafeed');
		var instalink = instaID.find('.zl_alb_wid').find('a');
		var fetch = instaID.data('number');
		var userid = instaID.data('user');
		var accesstoken = instaID.data('actok');
		var feed = new Instafeed({
			get: 'user',
			userId: userid,
			accessToken: accesstoken,
			limit: fetch,
			resolution: 'thumbnail',
			template: '<div class="small-4 column"> <div class="zl_alb_wid" title="{{caption}}"> <div> <a href="{{image}}" class="abs" rel="prettyPhoto[pp_gal_insta]">&nbsp;</a> <img src="{{image}}" alt=""> </div> </div> </div>',
			after: function () {
				$('#instafeed .zl_alb_wid a').prettyPhoto(prettOptions);
			},
			success: function () {
				$('#instafeed .zl_alb_wid a').prettyPhoto(prettOptions);
			}
		});
		feed.run();
	})(jQuery);

}

function forpost_onload(){
	carouselInits();
	oembedGet();
	lightbox();
	carouselInits();
}

function forpost_ready(){
	albumin();
	albthumb();
	letslike();
}

(function ($) {
	$(window).load(function () {
		"use strict";
		flickrInit();
		albumeffect();
		footerSlide();
		tooltipz();
		forpost_onload();
	});

	$(document).ready(function ($) {
		"use strict";
		ajaxsearch();
		toggleMenu();
		dribbble();
		searchEffect();
		circlemenu();
		backtotop();
		shareit();
		fwselector();
		forpost_ready();
		
		if ($('body').find('#instafeed').length) {
			instagram();
		}
		$('input[name="postformatcheck"]').change(function () {
			var postformatval = ($('input[name="postformatcheck"]:checked').val());
			$('#the_format').val(postformatval);
		});
		$('input[name="_format_gallery_type"]').change(function () {
			var galltypeval = ($('input[name="_format_gallery_type"]:checked').val());
			$('#the_galltype').val(galltypeval);
		});

	});
	//$(document).foundation();
})(jQuery);

//new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );