<?php 
/* // Create post object
if (isset($_POST['submitted'])){
//echo "treasure will be set if the form has been submitted (to TRUE, I believe)";
$title = $_POST['the_title'];
$content = $_POST['the_content'];
$cat = $_POST['cat'];
$my_post = array(
	'ID' => '',
	'post_title'    => $title,
	'post_content'  => $content,
	'post_status'   => 'publish',
	'post_author'   => 1,
	'post_category' => array($cat),
);

// Insert the post into the database
wp_insert_post( $my_post ); 
}
 */
?>
			<div class="post frontsubmit">
				<section class="submit_post">
					<form action="" method="post" enctype="multipart/form-data">
					<div class="zl_whatsnew"><?php echo zl_option('lang_sharewhatsnew', __('Share what\'s new...', 'zatolab')) ?></div>
					<!-- oooooooooooooooooooooooooooooooooo
						POST FORM
					oooooooooooooooooooooooooooooooooooo-->
						<div class="zl_hidefirst">
							<label for="the_title">
								<?php echo zl_option('lang_title', __('Title:', 'zatolab')) ?>
								<input type="text" name="the_title" id="the_title"/>
							</label>
							<label for="the_content">
								<?php echo zl_option('lang_content', __('Content:', 'zatolab')) ?>
								<textarea class="zl_whatsnew" name="the_content" id="the_content"></textarea>
							</label>
							<label for="the_content">
								<?php wp_dropdown_categories('orderby=name&hide_empty=0&exclude=1&hierarchical=1'); ?>
							</label>
						</div>
					<div class="clear"></div>
					<!-- oooooooooooooooooooooooooooooooooo
						POST FORMAT CHOOSE
					oooooooooooooooooooooooooooooooooooo-->
					<div class="zl_post_format_opt">
						<ul>
							<li class="tooltip" title="Text">
								<label for="post-format-default">
									<input id="post-format-default" type="radio" name="post-format" value="default" />
									<span class="dashicons dashicons-admin-post"></span>
								</label>
							</li>
							<li class="tooltip" title="Image">
								<label for="Image">
									<input id="Image" type="radio" name="post-format" value="image" />
									<span class="dashicons dashicons-format-image"></span>
								</label>
							</li>
							<li class="tooltip" title="Status">
								<label for="Status">
									<input id="Status" type="radio" name="post-format" value="status" />
									<span class="dashicons dashicons-format-status"></span>
								</label>
							</li>
							<li class="tooltip" title="Link">
								<label for="Link">
									<input id="Link" type="radio" name="post-format" value="link" />
									<span class="dashicons dashicons-admin-links"></span>
								</label>
							</li>
							<li class="tooltip" title="Audio">
								<label for="Audio">
									<input id="Audio" type="radio" name="post-format" value="audio" />
									<span class="dashicons dashicons-format-audio"></span>
								</label>
							</li>
							<li class="tooltip" title="Video">
								<label for="Video">
									<input id="Video" type="radio" name="post-format" value="video" />
									<span class="dashicons dashicons-video-alt2"></span>
								</label>
							</li>
							<li class="tooltip" title="Quote">
								<label for="Quote">
									<input id="Quote" type="radio" name="post-format" value="quote" />
									<span class="dashicons dashicons-format-quote"></span>
								</label>
							</li>
							<li class="tooltip" title="Gallery">
								<label for="Gallery">
									<input id="Gallery" type="radio" name="post-format" value="gallery" />
									<span class="dashicons dashicons-images-alt2"></span>
								</label>
							</li>
							<li class="tooltip" title="Aside">
								<label for="Aside">
									<input id="Aside" type="radio" name="post-format" value="aside" />
									<span class="dashicons dashicons-format-aside"></span>
								</label>
							</li>
							<li class="tooltip" title="Chat">
								<label for="Chat">
									<input id="Chat" type="radio" name="post-format" value="chat" />
									<span class="dashicons dashicons-format-chat"></span>
								</label>
							</li>
						</ul>
					</div>
					<div class="clear"></div>
					<!-- oooooooooooooooooooooooooooooooooo
						Submit Button
					oooooooooooooooooooooooooooooooooooo-->
					<div class="submitarea zl_hidefirst">
						<input type="submit" value="Share" class="btn submit" name="submitted"/>
						<a class="btn cancel" id="cancel"><?php echo zl_option('lang_cancel', __('Cancel:', 'zatolab')) ?></a>
					</div>
					</form>
				</section>
			</div>
				
		