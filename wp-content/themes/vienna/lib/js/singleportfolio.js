jQuery(document).ready(function($) {
	"use strict"; 

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
	
});
