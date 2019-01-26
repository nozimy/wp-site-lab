	<?php
	
	get_header(); 
	get_template_part('menu_section');

	?>
	
	
	
	<div class="subpage-head page-header has-margin-bottom">
		<div class="container">
			<h3><?php the_title(); ?></h3>
			<p class="lead"><?php esc_html_e( 'Posted on', 'confidence' ); ?> <?php the_time('F j, Y'); ?></p>
			<p class="lead"><?php ninetheme_confidence_breadcrubms(); ?></p>
			
		</div>
	</div>
	<div class="container has-margin-bottom">
		<div class="row">
			<div class="col-md-12-off  has-margin-bottom-off">
			
			<?php if( ot_get_option( 'sermonlayout' ) == 'right-sidebar') { ?>
			<div class="col-lg-9 col-md-9 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( 'sermonlayout' ) == 'left-sidebar') { ?>
			<div id="widget-area" class="widget-area col-lg-4 col-md-4 col-sm-4">
				<?php if ( is_active_sidebar( 'sermon-page-sidebar' ) ) { ?>
					<?php dynamic_sidebar( 'sermon-page-sidebar' ); ?>
				<?php } ?>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( 'sermonlayout' ) == 'full-width') { ?>
			<div class="col-xs-12 full-width-index v">
			<?php } ?>
				

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'post-format/sermon/content', get_post_format() ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					?>

				<?php endwhile; // end of the loop. ?>
				
				<?php ninetheme_confidence_post_nav(); ?>
					
				</div><!-- #end sidebar+ content -->

			
			
				<?php if( ot_get_option( 'sermonlayout' ) == 'right-sidebar') { ?>
					<div id="widget-area" class="widget-area col-lg-3 col-md-3 col-sm-3">
						<?php if ( is_active_sidebar( 'sermon-page-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'sermon-page-sidebar' ); ?>
						<?php } ?>
					</div>
				<?php } ?>
				
			</div>
		</div>
	</div>

	
	<div class="related-section">
		<div class="container related-container">
			<div id="" class="align-center uppercase heading-container">
				<h4 class="section-heading"><?php esc_html_e( 'RELATED SERMONS', 'confidence' ); ?></h4>
				<p class="section-slogan"><?php esc_html_e( 'Maybe we could help on a regular basis.', 'confidence' ); ?></p>
			</div>
			
			<div class="row feature-block">
				<?php
				$related = get_posts( array( 
				'category__in' => wp_get_post_categories($post->ID), 
				'numberposts' => 3,
				'post_type' => 'sermon', 
				'post__not_in' => array($post->ID)
				) );
				if( $related ) foreach( $related as $post ) {
				setup_postdata($post); ?>
				
				<?php
				$thumb = get_post_thumbnail_id();
				$class = 'img-responsive';
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 360, 220, true ); //resize & crop the image
				?>
			
				<div class="col-md-4 col-sm-6 has-margin-bottom">
					 <img class="<?php echo esc_attr($class) ?>" src="<?php echo esc_url($image) ?>"/>
					<h5 class="related-heading"><a href="<?php the_permalink() ?>" role="button" class=""><?php the_title(); ?></a></h5>
					<p><?php echo substr(get_the_excerpt(), 0,130); ?>...</p> 
					<p><a href="<?php the_permalink() ?>" role="button" class="btn more related-causes-more"><?php esc_html_e( 'Read more', 'confidence' ); ?> &#8594;</a></p>
				</div>
				<?php } wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
	
	<?php get_footer(); ?>