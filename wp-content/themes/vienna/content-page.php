<?php 
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb,'full' ); 
$image = zl_theme_thumb($img_url, 960, null, 'c', true);
?>


<article <?php post_class('post')?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	
	<div class="zl_loop">
		<header class="pg_ttl_hdr">
			<h1 class="entry-title text-center"><?php the_title();?></h1>
		</header>
		<div class="zl_post_detail">
			<div class="row">
				<!-- Detail -->
				<div class="large-12 column conentry">
					
					<?php the_content();?>
				</div><div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div><div class="clear"></div>
	</div><!-- end .zl_loop -->
</article>
