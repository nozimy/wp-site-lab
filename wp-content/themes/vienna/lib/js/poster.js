
jQuery(document).ready(function($) {
	"use strict";
	masonryDetect();
	if( $('#page').find('.frontsubmit').length ){
		frontpost();
	} 
	switchlayout();
	$('#postsubmit').mousedown( function() {
		tinyMCE.triggerSave();
    }); 
});
