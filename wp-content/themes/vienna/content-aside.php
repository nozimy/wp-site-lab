
<article <?php post_class('post')?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	
	<div class="zl_loop">
		<div class="zl_post_detail">
			<div class="row">
				<!-- Detail -->
				<div class="large-12 column conentry">
					<div class="zl_post_icon">
						<div class="dashicons dashicons-format-aside"></div>
					</div>
			
					<?php the_content();?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div><div class="clear"></div>
	</div><!-- end .zl_loop -->
</article>
	