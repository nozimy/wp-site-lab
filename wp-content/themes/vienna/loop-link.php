<?php 
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb,'full' ); 
$image = zl_theme_thumb($img_url, 960, null, 'c', false);
?>
<article <?php post_class('post')?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<div class="zl_loop">
		<div class="zl_post_detail">
			
			<div class="row">
				<!-- Detail -->
				<div class="medium-12 column conentrystatus">
					<div class="zl_post_icon">
						<div class="dashicons dashicons-admin-links"></div>
					</div>
					<header>
						<h3 class="entry-title">
							<a class="anchor" itemprop="url" href="<?php echo get_post_meta($post->ID, '_format_link_url', true); ?>" rel="bookmark" title="<?php the_title();?>" target="_blank">
								<?php the_title();?>
							</a>
						</h3>
					</header>
					<p class="zl_linksource">
						<?php 
							$url = get_post_meta($post->ID, '_format_link_url', true);
							$url = parse_url($url, PHP_URL_HOST);
						?>
						<a href="<?php echo get_post_meta($post->ID, '_format_link_url', true); ?>">
							<?php echo $url; ?>
						</a>
					</p>
					<?php 
						if(is_singular() || is_page()){
							the_excerpt();
						} else {
							the_content( '', '' );
						}
					 ?>
					
				</div>
			</div>
			<div class="clear"></div>
		</div><div class="clear"></div>
		
	</div> <!-- end .zl_loop -->
	
</article>
	