<?php 
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb,'full' ); 
$image = zl_theme_thumb($img_url, 960, null, 'c', true);
$quotebg ='';
$addiotionalClass = '';
if($image){
	$quotebg = 'style="background:url('.$image.'); background-size:100% auto;"';
	$addiotionalClass= 'quotebg';
}
$source_url = get_post_meta($post->ID, '_format_quote_source_url', true);
$sourcename = get_post_meta($post->ID, '_format_quote_source_name', true);
if (!empty($source_url)) {
	$source_url_before = '<a href="'.$source_url.'">';
	$source_url_after = '</a>';
}  else {
	$source_url_before = '';
	$source_url_after = '';
}
?>
	
<article <?php post_class('post')?>  itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<div class="zl_loop <?php echo $addiotionalClass; ?>">
		<div class="zl_post_detail" <?php echo $quotebg; ?> >
			<div class="row">
				<!-- Detail -->
				<div class="large-12 column conentrystatus">
					<div class="zl_post_icon">
						<div class="dashicons dashicons-format-quote"></div>
					</div>
					<header>
						<blockquote>
							<?php the_content();?>
							<span class="quotesoure">- <?php 
								echo $source_url_before;
								echo $sourcename; 
								echo $source_url_after; ?> -
							</span>
						</blockquote>
					</header>
				</div>
			</div>
			<div class="clear"></div>
		</div><div class="clear"></div>
	</div> 

</article>
	<!-- end .zl_loop -->
