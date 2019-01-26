<article <?php post_class('post')?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<div class="zl_loop">
		<!-- Thumb -->
		<div class="mediaplayer">
			<?php 
				$video = get_post_meta($post->ID, '_format_video_embed', true);
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' ); 
				$image = zl_theme_thumb($img_url, 960, 600, 'c', false);
				$media = $video;
		        $type = wp_check_filetype($media);
				if ($img_url) {  
					if( strstr($type['type'], "video/") ){
	                    echo do_shortcode('[video src="'.$media.'" ] poster="'.$img_url.'" ');
	                } else { ?>
	                	<div class="videothumb">
							<a class="oembedtrigger">
								<img src="<?php echo $image; ?>" alt="<?php the_title(); ?>"/>
							</a>
							<a href="<?php echo $video;?>" class="letsembed"></a>
						</div>
	             	<?php } ?>
				<?php } else {
					if (strpos($video,'iframe') !== false) {
						echo $video;
					} else {
		                if( strstr($type['type'], "video/") ){
		                    echo do_shortcode('[video src="'.$media.'" ]');
		                } else{
		                	echo wp_oembed_get( $video );
		                }
					}
				}
			?>
		</div>
		<div class="clear"></div>
		<div class="zl_post_detail">
			
			<div class="row">
				<!-- Detail -->
				<div class="medium-9 column conentry">
					<div class="zl_post_icon">
						<div class="dashicons dashicons-format-video"></div>
					</div>
					<header>
						<h1 class="entry-title"><?php the_title();?></h1>
						<div class="zl_entry-meta">
							<!-- Date -->
							<span itemprop="author"><?php echo zl_option('lang_postauthor', __('Written by', 'zatolab'));?> <?php the_author_posts_link();?></span> <span class="show_on_grid"> 
							<?php echo zl_option('lang_in', __('In ','zatolab')); the_category(', ')?></span>
						</div>
						<hr/>
					</header>
					<?php the_content();?>
				</div>
				
				<!-- Meta -->
				<div class="medium-3 column entry-meta">
					<!-- DATE -->
					<div class="zl_the_date">
						<time pubdate itemprop="datePublished" class="entry-date updated" datetime="<?php echo get_the_date( 'c' );?>" >
							<span class="zl_post_date"><?php echo get_the_date( 'd' ); ?></span><br/>
							<?php echo get_the_date( 'M' ); ?> <br/>
							<?php echo get_the_date( 'Y' ); ?>
						</time>
					</div>
					<div class="clear"></div>
					<?php 
					/* Use this function for displaying post meta */
					if (function_exists('zl_article_extra')){
						zl_article_extra();
					}
					?>
				</div>
			</div>
			<div class="clear"></div>
		</div><div class="clear"></div>
	</div><!-- end .zl_loop -->
</article>