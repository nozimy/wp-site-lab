	<?php
	
	get_header(); 
	get_template_part('menu_section');

	?>
	
	<div class="subpage-head page-header has-margin-bottom">
		<div class="container">
			<h3><?php the_title(); ?></h3>
			<p class="lead"><?php esc_html_e( 'Posted on', 'confidence' ); ?> <?php the_time('F j, Y'); ?><?php esc_html_e( 'by', 'confidence' ); ?>   <?php the_author(); ?> -  <?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_causes_location', true )){ echo '<i class="fa fa-map-marker"></i> '.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_causes_location', true ).''; } ?></p>
			
		</div>
	</div>
	<div class="container has-margin-bottom-off">
		<div class="row">
			<div class="col-md-12-off has-margin-bottom-off">
			
			<?php if( ot_get_option( 'causessingle' ) == 'right-sidebar') { ?>
			<div class="col-lg-9 col-md-9 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( 'causessingle' ) == 'left-sidebar') { ?>
			<div id="widget-area" class="widget-area col-lg-3 col-md-3 col-sm-12">
			
				<?php if ( is_active_sidebar( 'single-causes-page-sidebar' ) ) { ?>
					<?php dynamic_sidebar( 'single-causes-page-sidebar' ); ?>
				<?php } ?>
			</div>
			
			<div class="col-lg-9 col-md-9 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( 'causessingle' ) == 'full-width') { ?>
			
			<div class="col-xs-12 full-width-index v">
		
			<?php } ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
				<div class="eventInner">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="eventImg-off has-margin-bottom-off">
						<?php 
						$att=get_post_thumbnail_id();
						$image_src = wp_get_attachment_image_src( $att, 'span5' );
						$image_src = $image_src[0]; ?> 
						<img src="<?php echo esc_url($image_src); ?>" alt="Exemple">
						<?php  ?>
					</div>
					<?php endif; ?>
				<?php get_template_part( 'includes/causes/donation-causes', 'index' ); ?>
					<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						esc_html__( 'Continue reading %s', 'confidence' ),
						the_title( '<span class="screen-reader-text">', '</span>', false )
					) );
					?>
				</div>

				<!-- I got these buttons from simplesharebuttons.com -->
				<div id="share-buttons">
					<a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
					<a href="http://twitter.com/share?url=<?php echo get_permalink(); ?>&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank"><i class="fa fa-twitter"></i></a>
					<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
					<a href="http://www.digg.com/submit?url=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-digg"></i></a>
					<a href="http://reddit.com/submit?url=<?php echo get_permalink(); ?>&title=Simple Share Buttons" target="_blank"><i class="fa fa-reddit"></i></a>
					<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
					<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="fa fa-pinterest"></i></a>
					<a href="http://www.stumbleupon.com/submit?url=<?php echo get_permalink(); ?>&title=Simple Share Buttons" target="_blank"><i class="fa fa-stumbleupon"></i></a>
					<a href="mailto:?Subject=Simple Share Buttons&Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo get_template_directory_uri(); ?>"><i class="fa fa-envelope-o"></i></a>
				</div>
			</article><!-- #article -->

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>
			<?php endwhile; // end of the loop. ?>
			</div><!-- #end sidebar+ content -->
						   
			<?php if( ot_get_option( 'causessingle' ) == 'right-sidebar') { ?>
				<div id="widget-area" class="widget-area col-lg-3 col-md-3 col-sm-12">
					
				<?php if ( is_active_sidebar( 'single-causes-page-sidebar' ) ) { ?>
					<?php dynamic_sidebar( 'single-causes-page-sidebar' ); ?>
				<?php } ?>
				</div>
			<?php } ?>
				
			</div>
		</div>
	</div>
	<div class="related-section">
		<div class="container related-container">
			<div id="" class="align-center uppercase heading-container">
				<h4 class="section-heading"><?php esc_html_e( 'RELATED CAUSES', 'confidence' ); ?></h4>
				<p class="section-slogan"><?php esc_html_e( 'Maybe we could help on a regular basis.', 'confidence' ); ?></p>
			</div>
			
			<div class="row feature-block">
				<?php
				$related = get_posts( array( 
				'category__in' => wp_get_post_categories($post->ID), 
				'numberposts' => 3,
				'post_type' => 'causes', 
				'post__not_in' => array($post->ID)
				) );
				if( $related ) foreach( $related as $post ) {
				setup_postdata($post); 
				
				$thumb = get_post_thumbnail_id();
				$class = 'img-responsive';
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 360, 300, true ); //resize & crop the image
				?>
				<div class="col-md-4 col-sm-6 has-margin-bottom" <?php post_class()?> id="post-<?php the_ID(); ?>">
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