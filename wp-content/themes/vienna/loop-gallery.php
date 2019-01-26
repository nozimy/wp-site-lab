<article <?php post_class('post')?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
	<div class="zl_loop">
		<!-- Thumb -->
		<div class="mediaplayer">
			<?php 
			$type = get_post_meta($post->ID, '_format_gallery_type', true);
			$galls = get_post_meta($post->ID, '_format_gallery_images', true);
			//echo implode(',', $galls);
			/* oooooooooooooooooooooooooooooooooooooooooooooooooooooo
			JUSTIFIED GALLERY
			oooooooooooooooooooooooooooooooooooooooooooooooooooooo */
			if( 'slide' == $type){
				if ($galls) {
				echo '<div class="owl-carousel postgallery">';
				foreach ($galls as $gall) { 
				$thumbnail = wp_get_attachment_image_src($gall, 'full');
				$thumb = zl_theme_thumb($thumbnail[0], 960, 600, 'c', false);
				?>
				<div>
					<a href="<?php echo $thumbnail[0]; ?>" class="thumb_button_zoom" rel="prettyPhoto[pp_gal_<?php echo get_the_id();?>]"><i class="entypo search"></i></a>
					<img src="<?php echo $thumb;?>" alt="<?php echo $thumb;?>"/>
				</div>
			<?php } //ENd FOREACH
				echo '</div>';
			}

			/* oooooooooooooooooooooooooooooooooooooooooooooooooooooo
			JUSTIFIED GALLERY
			oooooooooooooooooooooooooooooooooooooooooooooooooooooo */
			} else if( 'justified' == $type ){ ?>
				<div class="swipeboxEx postgaljust">
					<?php 
						$i=0;
						foreach ($galls as $gall) { 
							$thumbnail = wp_get_attachment_image_src($gall, 'full');
							$small = zl_theme_thumb($thumbnail[0], null, 300, 'c', false);
							//Output
							?>
							<a href="<?php echo $thumbnail[0]; ?>" rel="prettyPhoto[pp_gal_'.get_the_id().']">
								<img src="<?php echo $small; ?>" alt="<?php echo get_the_title($gall); ?>" />
							</a>
					<?php $i++; }  ?>
				</div>
			<?php
			/* oooooooooooooooooooooooooooooooooooooooooooooooooooooo
			PLAIN SQUARE (DEFAULT)
			oooooooooooooooooooooooooooooooooooooooooooooooooooooo */
			} else {
				$items = count($galls);
				$layout = '';
				$height = '240';
				if( 2 == $items ){
					$layout = ' two-box';
					$height = '476';
				} else if( 4 == $items or 8 == $items or 12 == $items or 16 == $items or 20 == $items ){
					$layout = ' four-box'; 
				 	$height = '316';
				} else if( 3 == $items or 5 == $items or 6 == $items or 9 == $items){
				 	$layout = ' three-box'; 
				 	$height = '320';
				} else if( 10 == $items or 15 == $items){
					$layout = ' five-box'; 
				 	$height = '316';
				} else {
					$layout = ' four-box';
					$height = '240';
				}
			?>
			<div class="zl_square-grid<?php echo $layout; ?>">
				<?php 
				
				if ($galls) {
					$i=0;
					foreach ($galls as $gall) { 
					$thumbnail = wp_get_attachment_image_src($gall, 'full');
					$small = zl_theme_thumb($thumbnail[0], $height, $height, 'c');
						echo '<a href="'.$thumbnail[0].'" class="plainzoom" rel="prettyPhoto[pp_gal_'.get_the_id().']">'."\n";
						echo '<img src="'.$small.'" alt="'.get_the_title().'gall-'.$i.'"/>'."\n";
						echo '</a>'."\n";
					$i++;} //End foreach;
				} //endif $galls;
				?>
			</div>
			<?php } // END if( 'grid' == $type) ?>
		</div>
		<div class="clear"></div>

		<!-- POST CONTENT -->
		<div class="zl_post_detail">
			
			<div class="row">
				<!-- Detail -->
				<div class="medium-9 column conentry">
					<div class="zl_post_icon">
						<div class="dashicons dashicons-format-gallery"></div>
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