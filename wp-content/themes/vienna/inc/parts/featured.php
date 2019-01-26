<?php 
$featured_cats = zl_option('featured_cats','');
if ($featured_cats) {
	$featured_cats = implode(',', $featured_cats);
} 
 ?>

<div class="row">
	<div class="large-12 column nogap">
		<?php 
		/*echo '<pre>';
		print_r($featured_cats);
		echo '</pre>';*/
		//echo array($featured_cats);
		 ?>
		<?php 
		/*$args = array(
				'post_type' => 'post',
				'cat' => $featured_cats,
				'posts_per_page' => 5,
				'orderby' => 'DATE',
			);
		$featured = new WP_Query($args);
		if ($featured->have_posts()):
		while ($featured->have_posts()):
			$featured->the_post();
			the_title(); echo '<br>';
		endwhile;
		endif;
		wp_reset_query();wp_reset_postdata();*/
		 ?>
		<?php 
			if(is_home() && !is_singular()){
		?>
		<div class="zl_gallery">
			<!-- COL 1 -->
			<div class="zl_gal_col1">
				<?php 
				$args = array(
						'post_type' => 'post',
						'cat' => $featured_cats,
						'posts_per_page' => 2,
						'orderby' => 'DATE',
						'ignore_sticky_posts ' => 1,
						'offset' => 1,
					);
				$featured = new WP_Query($args);
				if ($featured->have_posts()):
				while ($featured->have_posts()):
					$featured->the_post();

					/* Featured Image */
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full' ); 
					$image = zl_theme_thumb($img_url, 250, 250, 'c', true);
				?>
				<!-- Featured Post -->
				<div class="zl_gal_inner">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="zl_featlink">&nbsp;</a>
					<?php if($image){ ?>
						<img src="<?php echo $image?>" alt="<?php the_title(); ?>" width="240" height="240"/>
					<?php } else { ?>
						<img src="http://placehold.it/250x250" alt="<?php the_title(); ?>"  width="240" height="240"/>
					<?php }  ?>
					<div class="zl_gal_detail">
						<div class="zl_gal_detail_table">
							<div class="zl_gal_detail_table_inner">
								<h3><?php the_title(); ?></h3>
								<p><?php the_time("jS M, Y"); ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile; endif; wp_reset_query();wp_reset_postdata();  ?>
			</div>
			


			<!-- COL 2 -->
			<div class="zl_gal_col2">
				<?php 
				$args = array(
						'post_type' => 'post',
						'cat' => $featured_cats,
						'posts_per_page' => 1,
						'orderby' => 'DATE',
						'ignore_sticky_posts ' => 1,
					);
				$featured2 = new WP_Query($args);
				if ($featured2->have_posts()):
				while ($featured2->have_posts()):
					$featured2->the_post();

					/* Featured Image */
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full' ); 
					$image = zl_theme_thumb($img_url, 480, 480, 'c', true);
				?>
				<div class="zl_gal_inner">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="zl_featlink">&nbsp;</a>
					<?php if($image){ ?>
						<img src="<?php echo $image?>" alt="<?php the_title(); ?>" width="480" height="480"/>
					<?php } else { ?>
						<img src="http://placehold.it/250x250" alt="<?php the_title(); ?>"  width="480" height="480"/>
					<?php }  ?>
					<div class="zl_gal_detail">
						<div class="zl_gal_detail_table">
							<div class="zl_gal_detail_table_inner">
								<h3><?php the_title(); ?></h3>
								<p><?php the_time("jS M, Y"); ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile; endif; wp_reset_query();wp_reset_postdata();  ?>
			</div>

			<!-- COL 3 -->
			<div class="zl_gal_col3">
				<?php 
				$args = array(
						'post_type' => 'post',
						'cat' => $featured_cats,
						'posts_per_page' => 2,
						'orderby' => 'DATE',
						'ignore_sticky_posts ' => 1,
						'offset' => 3,
					);
				$featured = new WP_Query($args);
				if ($featured->have_posts()):
				while ($featured->have_posts()):
					$featured->the_post();

					/* Featured Image */
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full' ); 
					$image = zl_theme_thumb($img_url, 250, 250, 'c', true);
				?>
				<!-- Featured Post -->
				<div class="zl_gal_inner">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="zl_featlink">&nbsp;</a>
					<?php if($image){ ?>
						<img src="<?php echo $image?>" alt="<?php the_title(); ?>" width="240" height="240"/>
					<?php } else { ?>
						<img src="http://placehold.it/250x250" alt="<?php the_title(); ?>"  width="240" height="240"/>
					<?php }  ?>
					<div class="zl_gal_detail">
						<div class="zl_gal_detail_table">
							<div class="zl_gal_detail_table_inner">
								<h3><?php the_title(); ?></h3>
								<p><?php the_time("jS M, Y"); ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile; endif; wp_reset_query();wp_reset_postdata();  ?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>