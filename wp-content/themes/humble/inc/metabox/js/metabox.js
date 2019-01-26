jQuery(document).ready(function($) {

// ---------------------------------------------------------
//  	Audio
// ---------------------------------------------------------
	var audioOptions = jQuery('#humble_audio_format_metabox');
	var audioTrigger = jQuery('#post-format-audio');

	audioOptions.css('display', 'none');

// ---------------------------------------------------------
//  	Video
// ---------------------------------------------------------
	var videoOptions = jQuery('#humble_video_format_metabox');
	var videoTrigger = jQuery('#post-format-video');

	videoOptions.css('display', 'none');

// ---------------------------------------------------------
//  	Gallery
// ---------------------------------------------------------
	var galleryOptions = jQuery('#humble_gallery_format_metabox');
	var galleryTrigger = jQuery('#post-format-gallery');

	galleryOptions.css('display', 'none');

// ---------------------------------------------------------
//  	Link
// ---------------------------------------------------------
	var linkOptions = jQuery('#humble_link_format_metabox');
	var linkTrigger = jQuery('#post-format-link');

	linkOptions.css('display', 'none');


// ---------------------------------------------------------
//  	Core
// ---------------------------------------------------------
	var group = jQuery('#post-formats-select input');


	group.change( function() {

		if(jQuery(this).val() == 'audio') {
			audioOptions.css('display', 'block');
			HumbleHideAll(audioOptions);

		} else if(jQuery(this).val() == 'gallery') {
			galleryOptions.css('display', 'block');
			HumbleHideAll(galleryOptions);

		} else if(jQuery(this).val() == 'video') {
			videoOptions.css('display', 'block');
			HumbleHideAll(videoOptions);

		} else if(jQuery(this).val() == 'link') {
			linkOptions.css('display', 'block');
			HumbleHideAll(linkOptions);

		} else {
			videoOptions.css('display', 'none');
			audioOptions.css('display', 'none');
			galleryOptions.css('display', 'none');
			linkOptions.css('display', 'none');
		}

	});

	if(audioTrigger.is(':checked'))
		audioOptions.css('display', 'block');

	if(galleryTrigger.is(':checked'))
		galleryOptions.css('display', 'block');

	if(videoTrigger.is(':checked'))
		videoOptions.css('display', 'block');

	if(linkTrigger.is(':checked'))
		linkOptions.css('display', 'block');

	function HumbleHideAll(notThisOne) {
		videoOptions.css('display', 'none');
		audioOptions.css('display', 'none');
		galleryOptions.css('display', 'none');
		linkOptions.css('display', 'none');
		notThisOne.css('display', 'block');
	}
});
