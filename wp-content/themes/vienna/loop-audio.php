<?php 
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb,'full' ); 
$image = zl_theme_thumb($img_url, 960, null, 'c', true);
?>
<article <?php post_class('post')?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<div class="zl_loop">
		<!-- Thumb -->
		<div class="mediaplayer">
			<!-- Thumb -->
			<?php if ($image) {?>
			<div class="zl_post_thumb entry-thumb">
				<img src="<?php echo $image; ?>" alt="<?php echo $image; ?>"/>
				<a href="<?php echo $img_url; ?>" class="thumb_button_zoom"><i class="entypo search"></i></a>
			</div>
			<div class="clear"></div>
			<?php } ?>
			<?php 
				$audio = get_post_meta($post->ID, '_format_audio_embed', true);
				if (strpos($audio,'iframe') !== false) {
					echo $audio;
				} else {
					$media = $audio;
	                $type = wp_check_filetype($media);
	                if( strstr($type['type'], "audio/") ){
	                    echo do_shortcode('[audio src="'.$media.'" ]');
	                } else{
	                	echo wp_oembed_get( $audio, array('width'=>960) ); 
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
						<div class="dashicons dashicons-format-audio"></div>
					</div>
					<header>
						<!-- Title -->
						<h3 class="entry-title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h3>

						<div class="zl_entry-meta">
							<!-- Date -->
							<span itemprop="author"><?php echo zl_option('lang_postauthor', __('Written by', 'zatolab'));?> <?php the_author_posts_link();?></span> <span class="show_on_grid"> 
							<?php echo zl_option('lang_in', __('In ','zatolab')); the_category(', ')?></span>
						</div>
						<hr/>
					</header>
					<?php 
						if(is_singular() || is_page()){
							the_excerpt();
						} else {
							the_content( '', '' );
						}
					 ?>
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
					<!-- category, link, comment -->
					<?php zl_postMeta(); ?>
					<!-- Read More -->
					<a href="<?php the_permalink();?>" class="zl_post_readmore">
						<?php echo zl_option('lang_more', __('Continue Reading', 'zatolab'));?>
					</a>
				</div>
			</div>
			<div class="clear"></div>
		</div><div class="clear"></div>
	</div><!-- end .zl_loop -->
</article>