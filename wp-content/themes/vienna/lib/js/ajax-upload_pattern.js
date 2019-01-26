jQuery(document).ready(function($){
 
	//Interfaces
	$("[name=postformatcheck]").change(function(){
		$(".zl_"+$(this).val()).show();
		$(this).parent().addClass('checked');
		$(this).parent().parent().siblings('li').find('.checked').removeClass('checked');
		$(".zl_"+$(this).val()).siblings('.vp-pfui-elm-block').hide();
		
		if($(this).val() == 'status'){
			$('[name=the_title]').hide();
		} else if($(this).val() == 'quote'){
			$('[name=the_title]').hide();
		} else {
			$('[name=the_title]').show();
		}
		//$('.closebutton').show();
	});
	$(".closebutton").click(function(){
		$(this).hide();
		$('.vp-pfui-elm-block').hide();
		$("#default").attr('checked',true);
	});
	
    // Gallery Management
	var $gallery = $('.vp-pfui-gallery-picker .gallery');

	VPPFUIMediaControl = {

		// Init a new media manager or returns existing frame
		frame: function() {
			if( this._frame )
				return this._frame;

			this._frame = wp.media({
				title: vp_pfui_post_format.media_title,
				library: {
					type: 'image'
				},
				button: {
					text: vp_pfui_post_format.media_button
				},
				multiple: true
			});

			this._frame.on('open', this.updateFrame).state('library').on('select', this.select);

			return this._frame;
		},

		select: function() {
			var selection = this.get('selection');

			selection.each(function(model) {
				var thumbnail = model.attributes.url;
				if( model.attributes.sizes !== undefined && model.attributes.sizes.thumbnail !== undefined )
					thumbnail = model.attributes.sizes.thumbnail.url;
				$gallery.append('<span data-id="' + model.id + '" title="' + model.attributes.title + '"><img src="' + thumbnail + '" alt="" /><span class="close">x</span></span>');
				$gallery.trigger('update');
			});
		},

		updateFrame: function() {
		},

		init: function() {
			$('#page').on('click', '.vp-pfui-gallery-button', function(e){
				e.preventDefault();
				VPPFUIMediaControl.frame().open();
			});
		}
	}
	VPPFUIMediaControl.init();

	$gallery.on('update', function(){
		var ids = [];
		$(this).find('> span').each(function(){
			ids.push($(this).data('id'));
		});
		$('[name="_format_gallery_images"]').val(ids.join(','));
	});

	$gallery.sortable({
		placeholder: "vp-pfui-ui-state-highlight",
		revert: 200,
		tolerance: 'pointer',
		stop: function () {
			$gallery.trigger('update');
		}
	});

	$gallery.on('click', 'span.close', function(e){
		$(this).parent().fadeOut(200, function(){
			$(this).remove();
			$gallery.trigger('update');
		});
	});
 
});