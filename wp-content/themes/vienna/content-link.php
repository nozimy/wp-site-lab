<?php 
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb,'full' ); 
$image = zl_theme_thumb($img_url, 960, 600, 'c', true);
?>


<article <?php post_class()?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	
	<div class="zl_loop">
		<div class="zl_post_detail">
			
			<div class="row">
				<!-- Detail -->
				<div class="large-12 column">
					<div class="zl_post_icon">
						<div class="dashicons dashicons-admin-links"></div>
					</div>
					<header>
						<p class="zl_the_link">
							<a itemprop="url" href="<?php echo get_post_meta($post->ID, '_format_link_url', true); ?>" rel="bookmark" title="<?php the_title();?>">
								<?php echo get_post_meta($post->ID, '_format_link_url', true); ?>
							</a>
						</p>
						<p>
							<?php the_excerpt();?>
						</p>
					</header>
				</div>
			</div>
			<div class="clear"></div>
		</div><div class="clear"></div>
	</div> <!-- end .zl_loop -->
	
</article>
	