<?php 
	function rw_upload_form( $id = 'gallery', $gallery_name = 'gallery_image', $multiple = false )
	{
	    if ( empty( $id ) )
	        return;
	    ?>
<div class="pluploader">
	<div class="rw-plupload-thumbs plupload-thumbs plupload-thumbs-multiple" id="gallery-plupload-thumbs">
		<div class="uploader-gallery-inside"></div>
		<div class="clear"></div>
	</div>
	<div class="rw-plupload-ui hide-if-no-js <?php if ( $multiple ): ?>rw-plupload-multiple<?php endif; ?>"
		id="<?php echo $id; ?>">
		<span class="ajaxnonceplu" id="<?php echo wp_create_nonce( $id . 'gestplupload' ); ?>"></span>
		<div id="<?php echo $id; ?>-rw-drag-drop" class="rw-drag-drop drag-drop">
			<div class="drag-drop-inside">
				<p class="drag-drop-info"><?php echo zl_option('lang_dropimage', __( 'Drop Image Here', 'zatolab' )); ?></p>
				<p><?php echo zl_option('lang_or', __( 'or', 'zatolab' )); ?></p>
				<input id="<?php echo $id; ?>-plupload-browse-button" type="button" value="<?php echo zl_option('lang_uploadfiles', __( 'Upload Files', 'zatolab' )); ?>" class="btn" />
			</div>
		</div>
	</div>
</div>
<?php
	}
	
	add_action( 'wp_enqueue_scripts', 'hf_load_custom_script' );
	function hf_load_custom_script() {
		global $post;
		global $page;
		$show_frontendpost = zl_option('show_frontendpost');
		if(is_user_logged_in() && ! is_singular() &&  $show_frontendpost == 1 ){
	        	wp_enqueue_script( 'rw-uploader', get_template_directory_uri() . '/lib/js/pl.uploader.js', array( 'jquery' ), '1.0.0', true );
	       
	        $plupload_init = array(
	            'runtimes'            => 'html5,silverlight,flash,html4',
	            'browse_button'       => 'plupload-browse-button',
	            'container'           => 'gallery',
	            'drop_element'        => 'rw-drag-drop',
	            'file_data_name'      => 'async-upload',
	            'multiple_queues'     => true,
	            'max_file_size'       => wp_max_upload_size() . 'b',
	            'url'                 => admin_url( 'admin-ajax.php' ),
	            'flash_swf_url'       => includes_url( 'js/plupload/plupload.flash.swf' ),
	            'silverlight_xap_url' => includes_url( 'js/plupload/plupload.silverlight.xap' ),
	            'filters'             => array(
	                array(
	                    'title'      => zl_option('lang_allowedfiles', __( 'Allowed Files', 'zatolab' ) ),
	                    'extensions' => 'jpg,gif,png'
	                )
	            ),
	            'multipart'           => true,
	            'urlstream_upload'    => true,
	            'multi_selection'     => false,
	            'multipart_params'    => array(
	                '_ajax_nonce' => '',
	                'action'      => 'photo_gallery_upload',
	                'imgid'       => 0,
	            )
	        );
	        $plupload_init = apply_filters( 'rw_uploader_init', $plupload_init );
	        wp_localize_script( 'rw-uploader', 'rwUploaderInit', $plupload_init );
	    }
	}
	
	add_action( 'wp_ajax_photo_gallery_upload', "rw_ajax_photo_gallery_upload" );
	
	/**
	 * Ajax function to upload images.
	 *
	 * @since 1.0
	 */
	function rw_ajax_photo_gallery_upload()
	{
	
	    // check ajax noonce
	    $uploader_id = $_POST["imgid"];
	    check_ajax_referer( $uploader_id . 'gestplupload' );
	
	    // handle file upload
	    $file = $_FILES[$uploader_id . 'async-upload'];
	    $status = wp_handle_upload( $file, array( 'test_form' => true,
	                                            'action'      => 'photo_gallery_upload' ) );
	
	    $image_id = wp_insert_attachment(
	        array(
	             'guid'           => $status['url'],
	             'post_mime_type' => $status['type'],
	             'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file['name'] ) ),
	             'post_content'   => '',
	             'post_status'    => 'inherit'
	        ),
	        $status['file']
	    );
	
	    if ( $image_id )
	    {
	        wp_update_attachment_metadata( $image_id, wp_generate_attachment_metadata( $image_id, $status['file'] ) );
	
	        $gallery_thumbnail_size = apply_filters( 'rw_uploader_thumbnail_size', 'medium' );
	        $thumbnail = wp_get_attachment_image( $image_id, $gallery_thumbnail_size );
	        $src = wp_get_attachment_url( $image_id );
		
	        $response =
	            '<div class="rw-plupload-thumbnail">' .
	                '<input type="hidden" name="generated" id="generated" value="' . $image_id . '" />
					'. $thumbnail .'<a class="remove-gallery-image button" href="#">' . zl_option('lang_removeimage', __( 'Remove featured image', 'zatolab' )) . '</a></p></div>'
					;
	
	        echo $response;
			
	    } 
	
	    exit;
	}
	
	
	/* oooooooooooooooooooooooooooooooooooooooo
	AJAX DELETE POST
	ooooooooooooooooooooooooooooooooooooooooo*/
	add_action( 'wp_ajax_nopriv_my_delete_post', 'my_delete_post' );
	add_action( 'wp_ajax_my_delete_post', 'my_delete_post' );
	function my_delete_post(){
	
		$permission = check_ajax_referer( 'my_delete_post_nonce', 'nonce', false );
		if( $permission == false ) {
			echo 'error';
		}
		else {
			wp_delete_post( $_REQUEST['id'] );
			echo 'success';
		}
		die();
	}
	/* oooooooooooooooooooooooooooooooooooooooo
	AJAX POST SUBMISSION
	ooooooooooooooooooooooooooooooooooooooooo*/
	function apf_post_form($allowNotLoggedInuser='yes')
	{
			if($allowNotLoggedInuser == 'no' &&  !is_user_logged_in())
			{
				return;
			}
			?>
<div class="post frontsubmit">
	<section class="submit_post">
		<form id="apfform" action="" method="post" enctype="multipart/form-data">
			<div class="zl_whatsnew"><?php echo zl_option('lang_sharenew', __("Share what's new...", 'zatolab')) ?></div>
			<!-- oooooooooooooooooooooooooooooooooo
				POST FORM
				oooooooooooooooooooooooooooooooooooo-->
			<div class="zl_poster_outest">
				<div class="large-8 column noleftpad">
					<div class="zl_hidefirst">
						<label for="the_title">
						<input type="text" name="the_title" id="the_title" placeholder="<?php echo zl_option('lang_postitle', __('Post Title', 'zatolab')); ?>" autocomplete="off"/>
						</label>
						<label for="the_content">
						<?php 
							/*  <textarea class="zl_whatsnew" name="the_content" id="the_content"></textarea>  */
							// default settings
							$content = '';
							$settings = array(
							'wpautop' => true,
							'media_buttons' => true,
							'textarea_name' => 'the_content',
							'textarea_rows' => get_option('default_post_edit_rows', 10),
							'tabindex' => '',
							'editor_css' => '',
							'editor_class'  => 'frontend-article-editor',
							'teeny' => false, 
							'dfw' => true, 
							'tinymce' => array( 
							          'content_css' => get_template_directory_uri() . '/lib/css/editor-style.css'
							   ),
							'quicktags' => true,
							'drag_drop_upload' => true
							);
							wp_editor( $content, 'the_content', $settings );
							?>
						</label>
						<div class="clear"></div>
						<br class="zl_hidefirst"/>
						<!--  Close Button -->
						<a class="closebutton"><span class="dashicons dashicons-no"></span></a>
						<div class="clear"></div>
					</div>
					<!-- END HIDEFIRST -->
					<div class="clear"></div>
					<!-- oooooooooooooooooooooooooooooooooo
						POST FORMAT CHOICES
						oooooooooooooooooooooooooooooooooooo-->
					<div class="zl_post_format_opt">
						<ul>
							<li class="tooltip" title="Text">
								<label for="default">
								<input id="default" type="radio" name="postformatcheck" value="default" />
								<span class="dashicons dashicons-admin-post"></span>
								</label>
							</li>
							<li class="tooltip" title="Image">
								<label for="Image">
								<input id="Image" type="radio" name="postformatcheck" value="image" />
								<span class="dashicons dashicons-camera"></span>
								</label>
							</li>
							<li class="tooltip" title="Gallery">
								<label for="Gallery">
								<input id="Gallery" type="radio" name="postformatcheck" value="gallery" />
								<span class="dashicons dashicons-images-alt2"></span>
								</label>
							</li>
							<li class="tooltip" title="Status">
								<label for="Status">
								<input id="Status" type="radio" name="postformatcheck" value="status" />
								<span class="dashicons dashicons-format-status"></span>
								</label>
							</li>
							<li class="tooltip" title="Link">
								<label for="Link">
								<input id="Link" type="radio" name="postformatcheck" value="link" />
								<span class="dashicons dashicons-admin-links"></span>
								</label>
							</li>
							<li class="tooltip" title="Audio">
								<label for="Audio">
								<input id="Audio" type="radio" name="postformatcheck" value="audio" />
								<span class="dashicons dashicons-format-audio"></span>
								</label>
							</li>
							<li class="tooltip" title="Video">
								<label for="Video">
								<input id="Video" type="radio" name="postformatcheck" value="video" />
								<span class="dashicons dashicons-video-alt2"></span>
								</label>
							</li>
							<li class="tooltip" title="Quote">
								<label for="Quote">
								<input id="Quote" type="radio" name="postformatcheck" value="quote" />
								<span class="dashicons dashicons-format-quote"></span>
								</label>
							</li>
							<li class="tooltip" title="Aside">
								<label for="Aside">
								<input id="Aside" type="radio" name="postformatcheck" value="aside" />
								<span class="dashicons dashicons-format-aside"></span>
								</label>
							</li>
							<li class="tooltip" title="Chat">
								<label for="Chat">
								<input id="Chat" type="radio" name="postformatcheck" value="chat" />
								<span class="dashicons dashicons-format-chat"></span>
								</label>
							</li>
							<input type="hidden" name="the_format" value="" id="the_format"/>
						</ul>
					</div>
					<div class="clear"></div>
					<div class="zl_hidefirst">
						<div class="zl_default vp-pfui-elm-block" style="display: none;"></div>
						<!-- GALLERY --> 
						<div id="vp-pfui-format-gallery-preview" class="zl_gallery vp-pfui-elm-block vp-pfui-elm-block-image" style="display:none">
							<div class="vp-pfui-elm-container">
								<div class="vp-pfui-gallery-picker">
									<?php
										$images = '';
										echo '<div class="gallery clearfix">';
										echo '</div>';
										?>
									<input type="hidden" name="_format_gallery_images" id="_format_gallery_images"  value="" class="imagesclean"/>
									<div class="clear"></div>
									<p class="none"><a href="#" class="btn vp-pfui-gallery-button"><?php _e('Pick Images', 'vp-post-formats-ui'); ?></a></p>
								</div>
							</div>
							<div class="clear"></div>
							<br>
							<strong>
								<?php echo zl_option('lang_gallerytype', __('Gallery Type', 'zatolab')); ?>
							</strong>
							<input type="radio" name="_format_gallery_type" value="slide" id="slide">
							<label style="display: inline-block;" for="slide">
								<?php echo zl_option('lang_slide', __('Slide', 'zatolab')); ?>
							</label>
							<input type="radio" name="_format_gallery_type" value="grid" id="grid">
							<label style="display: inline-block;" for="grid">
								<?php echo zl_option('lang_photogrid', __('Photo Grid', 'zatolab')); ?>
							</label>
							<input type="radio" name="_format_gallery_type" value="justified" id="justified">
							<label style="display: inline-block;" for="justified">
								<?php echo zl_option('lang_justified', __('Justified Gallery', 'zatolab')); ?>
							</label>
							<input type="hidden"value="" id="the_galltype" name="the_galltype">
						</div>
						<div class="clear"></div>
						<!-- Image -->
						<div class="zl_image vp-pfui-elm-block" id="vp-pfui-format-image-fields" style="display: none;"></div>
						<!-- Status -->
						<div class="zl_status vp-pfui-elm-block" id="vp-pfui-format-status-fields" style="display: none;"></div>
						<!-- Link -->
						<div class="zl_link vp-pfui-elm-block" id="vp-pfui-format-link-fields" style="display: none;">
							<input placeholder="Link" type="text" name="_format_link_url" value="" id="_format_link_url" tabindex="1" />
						</div>
						<!-- AUDIO -->
						<div class="zl_audio vp-pfui-elm-block" id="vp-pfui-format-audio-fields" style="display: none;">
							<textarea name="_format_audio_embed" id="_format_audio_embed" placeholder="<?php _e('Audio URL (oEmbed) or Embed Code', 'zatolab'); ?>" tabindex="1"></textarea>
						</div>
						<!-- Video -->
						<div class="zl_video vp-pfui-elm-block" id="vp-pfui-format-video-fields" style="display: none;">
							<textarea name="_format_video_embed" id="_format_video_embed" placeholder="<?php _e('Video URL (oEmbed) or Embed Code', 'zatolab'); ?>" tabindex="1" ></textarea>
						</div>
						<!-- Quote -->
						<div class="zl_quote vp-pfui-elm-block" id="vp-pfui-format-quote-fields" style="display: none;">
							<div class="vp-pfui-elm-block">
								<input type="text" name="_format_quote_source_name" value="" id="_format_quote_source_name" tabindex="1" placeholder="Source Name"/>
							</div>
							<div class="vp-pfui-elm-block">
								<input type="text" name="_format_quote_source_url" value="" id="_format_quote_source_url" tabindex="1" placeholder="Source Link"/>
							</div>
						</div>
						<!-- Aside -->
						<div class="zl_aside vp-pfui-elm-block" id="vp-pfui-format-aside-fields" style="display: none;"></div>
						<!-- Chat -->
						<div class="zl_chat vp-pfui-elm-block" id="vp-pfui-format-chat-fields" style="display: none;"></div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="large-4 column zl_hidefirst">
					<!-- Choose CAtegory -->
					<h4><?php echo zl_option('lang_categories', __('Categories', 'zatolab')) ?></h4>
					<?php
						$categories = get_categories(array('hide_empty'=> 0));
						echo '<div class="the_cat">';
						foreach($categories as $category) 
						{ 
							echo "<input type='checkbox' name='apfcategorycheck' id='apfcategorycheck' value='$category->term_id' />";  
							echo $category->cat_name;
							echo '<br/>';
						}
						echo '</div>';
						?>
					<hr/>
					<h4><?php echo zl_option('lang_tags', __('Tags', 'zatolab')) ?></h4>
					<input type="text" name="the_tags" value="" id="the_tags"/>
					<h4><?php echo zl_option('lang_post_thumb', __('Featured Image', 'zatolab')) ?></h4>
					<?php 
						rw_upload_form( 'gallery', 'jobs_gallery_image' );
						?>
					<input type="hidden" name="the_post_thumbnail" id="the_post_thumbnail" value="" />
				</div>
			</div>
			<div class="clear"></div>
			<!-- oooooooooooooooooooooooooooooooooo
				Submit Button
				oooooooooooooooooooooooooooooooooooo-->
			<div class="submitarea zl_hidefirst">
				<!-- SUBMIT IT -->
				<a onclick="apfaddpost(the_title.value,the_content.value,the_tags.value,the_post_thumbnail.value,the_format.value,_format_gallery_images.value,the_galltype.value,_format_audio_embed.value,_format_link_url.value,_format_video_embed.value,_format_quote_source_name.value,_format_quote_source_url.value,apfcategorycheck);" class="btn submit" id="postsubmit"> <i class="entypo paper-plane"></i> <?php echo zl_option('lang_createpost', __('Create Post', 'zatolab')) ?></a>
				<a class="btn cancel" id="cancel"><i class="entypo cross"></i> <?php echo zl_option('lang_cancel',__('Discard','zatolab'));?></a>
				<div class="clear"></div>
				<div id="apf-response"></div>
			</div>
		</form>
	</section>
</div>
<?php
	}
	function apf_addpost()
	{
			$results = '';
			$user_ID = get_current_user_id();
			$title = $_POST['the_title'];
			$content =	$_POST['the_content'];
			$thumb = $_POST['the_post_thumbnail'];
			$theformat = $_POST['the_format'];
			$gallery = $_POST['_format_gallery_images'];
			$audio = $_POST['_format_audio_embed'];
			$link = $_POST['_format_link_url'];
			$quoteurl = $_POST['_format_quote_source_url'];
			$quotename = $_POST['_format_quote_source_name'];
			$video = $_POST['_format_video_embed'];
			if ( empty($_POST['apfcategory']) ) {
				$category = null;
			} else {
				$category = $_POST['apfcategory'];
			} 
			if ( empty($_POST['the_tags']) ) {
				$tags = null;
			} else {
				$tags = $_POST['the_tags'];
			} 
			
			if ( empty($_POST['the_galltype']) ) {
				$galltype = null;
			} else {
				$galltype = $_POST['the_galltype'];
			} 
			$post_id = wp_insert_post( 
							array(
								'post_title'		=> $title,
								'post_content'		=> $content,
								'post_status'		=> 'publish',
								'post_author'       => $user_ID
							) );
			set_post_format( $post_id , $theformat );
			if ($thumb) {
				set_post_thumbnail( $post_id, $thumb );
			} 
			if (!empty($category)) {
				wp_set_post_categories( $post_id, $category );
			}
			if (!empty($tags)) {
				wp_set_post_tags( $post_id, $tags, true );
			}
	
			if ('gallery' == $theformat) {
				add_post_meta( $post_id , '_format_gallery_images', $gallery );
				if(!empty($galltype)){
					add_post_meta( $post_id , '_format_gallery_type', $galltype );
				}
			} else if('audio' == $theformat){
				add_post_meta( $post_id , '_format_audio_embed', $audio );
			} else if('link' == $theformat){
				add_post_meta( $post_id , '_format_link_url', $link );
			} else if('quote' == $theformat){
				add_post_meta( $post_id , '_format_quote_source_url', $quoteurl );
				add_post_meta( $post_id , '_format_quote_source_name', $quotename );
			} else if('video' == $theformat){
				add_post_meta( $post_id , '_format_video_embed', $video );
			}
			
			
			if($post_id != 0  )
			{
				//$results = 'Success';
				$query = new WP_Query(
					array(
						'p' => $post_id
					));
				if($query->have_posts()) : 
				while($query->have_posts()) : $query->the_post(); 
					get_template_part( 'loop', get_post_format() );
				endwhile; endif; 
			}
			/*
			else
			{
				//$results = 'Fail';
			}
			*/
			
			
			// Return the String
			die($results);
	}
	// creating Ajax call for WordPress
	add_action( 'wp_ajax_nopriv_apf_addpost', 'apf_addpost' );
	add_action( 'wp_ajax_apf_addpost', 'apf_addpost' );
	
	
	?>