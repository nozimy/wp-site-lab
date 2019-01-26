<?php 
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb,'full' ); 
$image = zl_theme_thumb($img_url, 960, 600, 'c', true);
?>

<!-- loop Item -->
<article <?php post_class('post')?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<div class="zl_loop">
		<div class="zl_post_detail">
			<div class="row">
				<!-- Detail -->
				<div class="medium-9 column conentry">
					<div class="zl_post_icon">
						<div class="dashicons dashicons-format-status"></div>
					</div>
					
					<?php 
						if(is_singular() || is_page()){
							the_content( '', '' );
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
	