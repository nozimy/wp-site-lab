jQuery(window).load(function () {
	jQuery('.portfolioContainer').isotope();
});
jQuery(document).ready(function($) {
	"use strict";


	// ISOTOPE PORTFOLIO
	
	
	$('#source a').click(function(e) {
        e.preventDefault();
        $('#source a').removeClass('current');
		$(this).addClass('current');
		var to_filter = $(this).attr('data-filter');
		if(to_filter == '*') {
            $('.portfolioContainer').isotope({filter: '*'});
		} else {
            $('.portfolioContainer').isotope({filter: '.'+ to_filter});
		}
	});


	function paskaload(){
		$('.zl_close_port').click(function(ei){
			ei.preventDefault;
			$('.zl_prtfl_wrap').toggleClass('fadeInDown fadeOutDown', 600).promise().done(function(){
			    setTimeout(function(){
					//$('#zl_ajax_content').slideUp().html('&nbsp;');
					$('#zl_ajax_content').animate({height:0}, 500, function(){
						$('#zl_ajax_content').html('');
					});
					$('html, body').animate({
				        scrollTop: $(".zlisportfolio").offset().top
				    }, 500);
				}, 500);
			});
			
		});
		$('a.zl_closeportodesc').click(function(eiii){
			eiii.preventDefault;
			$('.zl_port_desc').toggleClass('slideInRight slideOutRight');
		});
		/*
		$('.tooltip').tooltipster({
		   animation: 'fade',
		   touchDevices: false,
		   trigger: 'hover',
		   speed: 200,
		   theme: 'tooltipster-light',
		   multiple: true,
		});*/
		if ($('.zl_prtfl_wrap ').find('.portfolioslide').length) {
			$('.zl_prtfl_wrap ').find('.portfolioslide').owlCarousel({
				nav: true,
				dots:false,
				items : 1,
				autoHeight:true,
				smartSpeed:450,
				loop: true,
				video:true,
				animateOut: 'fadeOut',
				animateIn: 'fadeIn',
				navText:	["<span class='dashicons dashicons-arrow-left-alt2'></span>","<span class='dashicons dashicons-arrow-right-alt2'></span>"]
			});
		}
		
	}
	
	function nextprev(){
		jQuery('.zl_open_prev a.ajaxLink, .zl_open_next a.ajaxLink').click(function(ho) {
		    ho.preventDefault();
		    var id = jQuery(this).data('id');

		    $('html, body').animate({
		        scrollTop: $(".zlisportfolio").offset().top
		    }, 500);

		    jQuery.ajax({
				type: 'POST',
				url: AjaxPortfolio.portoajaxurl,
				data: {'action' : 'zl_portfolio', 'id': id},
				dataType: 'json',
				beforeSend: function(data){
					var spinner = '<div class="loader">Loading...</div>';
					
					if( $('.zl_prtfl_wrap').length ){
						var currenheight = $('.zl_prtfl_wrap').outerHeight()+'px';
						$('#zl_ajax_content').css('height',currenheight);
						$('#zl_ajax_content').prepend('<div class="spinover">'+spinner+'</div>');
						$('.zl_prtfl_wrap').toggleClass('fadeInDown fadeOutDown');
					} else {
						$('#zl_ajax_content').html(spinner).slideDown(function(){
							$('#zl_ajax_content').css('height', 'auto');
							var auto = $('#zl_ajax_content').find('.loader').outerHeight();
						});
						
					}
				},
				success: function(data) {
					var $ini = jQuery(this);

					if ($('#zl_ajax_content').find('.zl_prtfl_wrap').length) {
						$('.zl_prtfl_wrap').replaceWith(data['html']).promise().done(function(){
							$('#zl_ajax_content').find('.zl_portimg').waitForImages(function() {
								setTimeout(function(){
									var ini = $('#zl_ajax_content').find('.zl_prtfl_wrap');
									var autoheight = ini.outerHeight()+30+'px';
									$('#zl_ajax_content').animate({height:autoheight}, 500, function(){
										$('.zl_prtfl_wrap').addClass('animated fadeInDown');
									});
								}, 500);
								paskaload();
								letslike();
								$('.loader, .spinover').fadeOut(function(){
									$(this).remove();
								});
							});
						});
						
					} else {

						$('#zl_ajax_content').append(data['html']).promise().done(function(){
							$('#zl_ajax_content').find('.zl_portimg').waitForImages(function() {
								setTimeout(function(){
									var ini = $('#zl_ajax_content').find('.zl_prtfl_wrap');
									var autoheight = ini.outerHeight()+30+'px';
									$('.loader').slideUp(function(){
										$('#zl_ajax_content').animate({height:autoheight}, 500, function(){
											$('.zl_prtfl_wrap').addClass('animated fadeInDown');
											$('.loader').remove();
										});
										$('.spinover').hide().remove();
									});
								}, 500);
								paskaload();
								letslike();
							});
						});
					}
					document.title = data['title'];
					nextprev();
		      	}
		    });  
		    return false;
		});
	}

	
	jQuery('a.ajaxLink').click(function(ee) {
	    ee.preventDefault();
	    var id = jQuery(this).data('id');

	    $('html, body').animate({
	        scrollTop: $(".zlisportfolio").offset().top
	    }, 500);

	    jQuery.ajax({
			type: 'POST',
			url: AjaxPortfolio.portoajaxurl,
			data: {'action' : 'zl_portfolio', 'id': id},
			dataType: 'json',
			beforeSend: function(data){
				var spinner = '<div class="loader">Loading...</div>';
				
				if( $('.zl_prtfl_wrap').length ){
					var currenheight = $('.zl_prtfl_wrap').outerHeight()+'px';
					$('#zl_ajax_content').css('height',currenheight);
					$('#zl_ajax_content').prepend('<div class="spinover">'+spinner+'</div>');
					$('.zl_prtfl_wrap').toggleClass('fadeInDown fadeOutDown');
				} else {
					$('#zl_ajax_content').html(spinner).slideDown(function(){
						$('#zl_ajax_content').css('height', 'auto');
						var auto = $('#zl_ajax_content').find('.loader').outerHeight();
					});
					
				}
			},
			success: function(data) {
				var $ini = jQuery(this);

				if ($('#zl_ajax_content').find('.zl_prtfl_wrap').length) {
					$('.zl_prtfl_wrap').replaceWith(data['html']).promise().done(function(){
						$('#zl_ajax_content').find('.zl_portimg').waitForImages(function() {
							setTimeout(function(){
								var ini = $('#zl_ajax_content').find('.zl_prtfl_wrap');
								var autoheight = ini.outerHeight()+30+'px';
								$('#zl_ajax_content').animate({height:autoheight}, 500, function(){
									$('.zl_prtfl_wrap').addClass('animated fadeInDown');
								});
							}, 500);
							paskaload();
							letslike();
							$('.loader, .spinover').fadeOut(function(){
								$(this).remove();
							});
						});
					});
					
				} else {

					$('#zl_ajax_content').append(data['html']).promise().done(function(){
						$('#zl_ajax_content').find('.zl_portimg').waitForImages(function() {
							setTimeout(function(){
								var ini = $('#zl_ajax_content').find('.zl_prtfl_wrap');
								var autoheight = ini.outerHeight()+30+'px';
								$('.loader').slideUp(function(){
									$('#zl_ajax_content').animate({height:autoheight}, 500, function(){
										$('.zl_prtfl_wrap').addClass('animated fadeInDown');
										$('.loader').remove();
									});
									$('.spinover').hide().remove();
								});
							}, 500);
							paskaload();
							letslike();
						});
					});
				}
				nextprev();
				document.title = data['title'];
	      	}
	    });  
	    return false;
	});

});
