<!-- oooooooooooooooooooooooooooooooooo
	SLIDER CAROUSEL
oooooooooooooooooooooooooooooooooooo-->
<!-- Slider -->
<div class="featuredarticle">
	<div class="row">
		<div id="featuredarticles" class="owl-carousel owl-theme">
			<?php 
				$cats = zl_option('slider_cats','');
				$orderby = zl_option('orderby','');
				if ($cats) {
					$cats = implode(',', $cats);
				} 
				$slides = new WP_Query(
					array(
						'orderby' => $orderby,
						'order' => 'DESC',
						'post_type' => 'post',
						'posts_per_page' => zl_option('slider_fetch','3'),
						'meta_key' => 'wpb_post_views_count',
						'cat' => $cats
					)
				); 
			?>
				
			<?php if($slides->have_posts()) : ?><?php while($slides->have_posts()) : $slides->the_post(); 
			//Thumb Generate
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); 
			if ( wp_is_mobile() ) {
				$image = zl_theme_thumb($img_url, 370, 200, 'c', true);
			} else {
				$image = zl_theme_thumb($img_url, 370, 200, 'c', true);
			}
			$spec_cond = zl_postformat(); 
			?>
			<div class="item large-12 columns">
				<div class="zl_carou_thumb">
					<?php if ($image) { ?>
						<a href="<?php the_permalink();?>" rel="bookmark" title="<?php echo __('Permanent Link to', 'envalabs');?> <?php the_title_attribute(); ?>">
							<img itemprop="image" class="entry-thumb" src="<?php echo $image; ?>" alt="<?php the_title();?>" title="<?php the_title();?>"/>
						</a>
					<?php } else { ?>
						<a href="<?php the_permalink();?>" rel="bookmark" title="<?php echo __('Permanent Link to', 'envalabs');?> <?php the_title_attribute(); ?>">
							<img src="http://placehold.it/370x200"/>
						</a>
					<?php } ?>
					<span class="zl_carou_icon">
						<?php echo $spec_cond['icon']; ?>
					</span>
				</div>
				<div class="zl_thecaption">
					<h3 itemprop="name" class="entry-title">
						<a itemprop="url" href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title();?>">
							<?php the_title();?>
						</a>
					</h3>
					<time pubdate itemprop="datePublished" class="entry-date updated" datetime="<?php echo get_the_date( 'c' );?>" ><?php echo get_the_date( 'M d, Y' ); ?></time>
					<div class="clear"></div>
				</div>
			</div>
			<?php endwhile; endif; wp_reset_query();?>
		</div>
	</div>
</div>
		
		