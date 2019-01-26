function apfaddpost(title,content,tags,thumb,format,gallery,galltype,audio,link,video,quotename,quoteurl,postcategory)
{

	var postCatergoryArray = new Array();
	
	for (var i=0; i <postcategory.length; i++)
	{
		if (postcategory[i].checked)
		{
			postCatergoryArray[postCatergoryArray.length] = postcategory[i].value;
		}
	}
	
	jQuery.ajax({

		type: 'POST',

		url: apfajax.ajaxurl,

		data: {
			action: 'apf_addpost',
			the_title: title,
			the_content: content,
			the_tags: tags,
			the_post_thumbnail: thumb,
			_format_gallery_images: gallery,
			the_galltype: galltype,
			_format_audio_embed: audio,
			_format_link_url: link,
			_format_video_embed: video,
			_format_quote_source_url: quoteurl,
			_format_quote_source_name: quotename,
			the_format: format,
			apfcategory:postCatergoryArray
		},
		beforeSend: function(){
			jQuery('#container').before('<div class="alertbox loadering animated fadeIn">Loading</div>');
		},
		success:function(data, textStatus, XMLHttpRequest){
			//var el = jQuery(data);
            //jQuery(id).after(data).masonry( 'prepended', data).masonry('reloadItems');
			
			/* var dataAdded = data; */
			
			var id = '.frontsubmit';
			var my_editor_id = 'the_content';
			
			if(data){
				jQuery(id).after(data);
				
				jQuery(id).next().addClass('justadded');
				jQuery('.alertbox').toggleClass('loadering success').html('Post has been submitted');
				jQuery('.frontsubmit').removeClass('postMode');
				
				// Reinit Slider back
				if ( jQuery(".format-gallery").is(".justadded") ) {
					jQuery('.justadded').find('.postgallery').waitForImages(function() {
						var gallery = jQuery('.justadded').find('.postgallery');
						gallery.owlCarousel({
							singleItem:true,
							nav: true,
							dots:true,
							items : 1,
							itemsScaleUp: true,
							autoHeight:true,
							transitionStyle : "fadeUp",
							navText:	["<span class='dashicons dashicons-arrow-left-alt2'></span>","<span class='dashicons dashicons-arrow-right-alt2'></span>"]
							
						});
						gallery.trigger('refresh.owl.carousel');
					});
					
				} 

				
				// Delete Loading
				setTimeout(function(){
					jQuery('.loadering').fadeOut(function(){
						jQuery(this).remove();
					});
					jQuery('a.thumb_button_zoom').prettyPhoto({
						animation_speed: 'fast',
						slideshow: true,
						opacity: 0.3,
						show_title:false,
						allow_resize: true,
						theme: 'pp_default',
						social_tools:'',
						deeplinking: false,
						horizontal_padding: 0
					});
				}, 300);
			} else {
				jQuery('.alertbox').toggleClass('loadering fail').html('An Error Occured');
			}

			if ( jQuery("#container").is(".zl_grid") ) {
				setTimeout(msnryInit, 700);
			} 
			setTimeout(function(){
				jQuery('.justadded').removeClass('justadded');
			}, 2000);

			
			setTimeout(function(){
				jQuery('.alertbox').fadeOut(function(){
					jQuery(this).remove();
					if(data){
						jQuery('.frontsubmit').removeClass('postMode');
					}
				});
			}, 1000);

			resetvalues();
		},

		error: function(MLHttpRequest, textStatus, errorThrown){
			alert(errorThrown);
		}

	});
}
