jQuery(document).ready(function($){
	var pconfig=false;
	$( ".rw-plupload-ui" ).each(function() 
	{
		var $this = $( this );
		var uploaderId = $this.attr( "id" );

		pconfig = 
		{
			runtimes           : rwUploaderInit.runtimes,
			browse_button      : uploaderId + '-' + rwUploaderInit.browse_button,
			container          : uploaderId,
			drop_element       : uploaderId + '-' + rwUploaderInit.drop_element,
			file_data_name     : uploaderId + rwUploaderInit.file_data_name,
			multiple_queues    : rwUploaderInit.multiple_queues,
			max_file_size      : rwUploaderInit.max_file_size,
			url                : rwUploaderInit.url,
			flash_swf_url      : rwUploaderInit.flash_swf_url,
			silverlight_xap_url: rwUploaderInit.silverlight_xap_url,
			filters            : rwUploaderInit.filters,
			multipart          : rwUploaderInit.multipart,
			urlstream_upload   : rwUploaderInit.urlstream_upload,
			multi_selection    : rwUploaderInit.multi_selection,
			multipart_params   : 
			{
				_ajax_nonce : $this.find( ".ajaxnonceplu" ).attr( "id" ),
				action      : rwUploaderInit.multipart_params.action,
				imgid       : uploaderId,
				galleryName : $( '#' + uploaderId + '-gallery-name' ).val(),
				parentId    : $( "input#post_ID" ).val() || 0
			}
		};

		if( $this.hasClass( "rw-plupload-multiple" ) ) 
		{
			pconfig.multi_selection = true;
		}

		var uploader = new plupload.Uploader( pconfig );

		uploader.bind( 'Init', function( up ){} );

		uploader.init();

		// a file was added in the queue
		uploader.bind( 'FilesAdded', function( up, files )
		{
			$.each( files, function( i, file ) 
			{
				/* $('.pluploader').find( '.uploader-gallery-inside' ).append(
					'<div class="file" id="' + file.id + '"><div class="filename"><b>' + file.name + '</b> (<span>' + plupload.formatSize(0) + '</span>/' + plupload.formatSize(file.size) + ') ' + '</div><div class="fileprogress"></div></div>'); */
				$('.pluploader').find( '.uploader-gallery-inside' ).append(
					'<div class="file" id="' + file.id + '"><div class="filename"></div><div class="fileprogress"></div></div>');
			});
			
			up.refresh();
			up.start();
		});

		uploader.bind( 'UploadProgress', function( up, file ) 
		{
			$( '#' + file.id + " .fileprogress" ).width( file.percent + "%" );
			$( '#' + file.id + " span" ).html( plupload.formatSize( parseInt( file.size * file.percent / 100 ) ) );
		});

		// a file was uploaded
		uploader.bind( 'FileUploaded', function( up, file, response ) 
		{
			//remove progress
			$( '#' + file.id ).fadeOut();
			response = response["response"];
			var gallery_inside = $('.pluploader').find( '.uploader-gallery-inside' );

			if( $this.hasClass( "rw-plupload-multiple" ) ) 
			{
				$('#gallery').fadeOut(10, function(){
					gallery_inside.append( response );
					var generated = $('.rw-plupload-thumbnail').find('[name="generated"]').val();
					$('[name="the_post_thumbnail"]').val(generated);
				});
				
			} 
			else 
			{
				$('.rw-plupload-ui').fadeOut(10, function(){
					gallery_inside.html( response );
					updateVal();
				});
			}

		});

	});
	
	function updateVal(){
		var generated = $('.rw-plupload-thumbnail').find('[name="generated"]').val();
		$('[name="the_post_thumbnail"]').val(generated);
	}
	// Remove image from gallery
	$( ".remove-gallery-image" ).live( 'click', function()
	{
		$( this ).parents( '.rw-plupload-thumbnail' ).fadeOut( 500, function()
		{
			$( this ).remove();
			$('.rw-plupload-ui').fadeIn(300);
			updateVal();
		});
		return false;
	});

	//
	var obj = $("#gallery-rw-drag-drop");
	obj.on('dragenter', function (e) 
	{
	    e.stopPropagation();
	    e.preventDefault();
	   
	});
	obj.on('dragover', function (e) 
	{
	     e.stopPropagation();
	     e.preventDefault();
	     $(this).addClass('drag-over');
	});
	obj.on('dragleave', function (e) 
	{
	 
	    e.preventDefault();
	 	$(this).removeClass('drag-over');
	});
	obj.on('drop', function (e) 
	{
		$(this).removeClass('drag-over');
		e.preventDefault();
	});
});