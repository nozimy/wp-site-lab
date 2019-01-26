	<?php
	/**
	 * The default template for displaying content
	 *
	 * Used for both single and index/archive/search.
	 *
	 * @package WordPress
	 * @subpackage confidence
	 * @since confidence 1.0
	 */
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<!-- Article Image -->
			<div class="article-img-off">
			<?php 
				$att=get_post_thumbnail_id();
				$image_src = wp_get_attachment_image_src( $att, 'span5' );
				$image_src = $image_src[0]; ?> 
				<img src="<?php echo esc_url($image_src); ?>" alt="Exemple">
			<?php  ?>
			</div>
		<?php endif; ?>
		<div class="event-container">
			<div class="inner">
			
				<div class="inner items col-sm-3">
					<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_date', true )){ 
					echo '<span class="lead-off-off uppercase strong">' . esc_html__('ministry date', 'confidence') . '</span> '; 
					echo '<span class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_date', true ).'</span> '; 
					} ?>
				</div>
				<div class="inner items col-sm-4">
					<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_manager', true )){ 
					echo '<span class="lead-off uppercase strong">' . esc_html__('ministry manager', 'confidence') . '</span> '; 
					echo '<span class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_manager', true ).'</span> '; 
					} ?>
				</div>
				<div class="inner items col-sm-4">
					<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_location', true )){ 
					echo '<span class="lead-off uppercase strong">' . esc_html__('ministry Location', 'confidence') . '</span> '; 
					echo '<span class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_location', true ).'</span> '; 
					} ?>
				</div>

			</div>
		</div>

		<div class="content-container">
			<header class="entry-header">
				<?php
					if ( is_single() ) :
						the_title( '<h2 class="entry-title">', '</h2>' );
					else :
						the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
					endif;
				?>
			</header><!-- .entry-header -->
			
			<div class="post-meta-first">
				<span><i class="fa fa-calendar"></i> <?php the_time('F j, Y'); ?></span>
				<span><i class="fa fa-user"></i> <?php the_author(); ?></span>
				<span><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></span>
			</div>
			<div class="post-meta-second"></div>
		</div>
		

		<div class="entry-content">
				<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					esc_html__( 'Continue reading %s', 'confidence' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

				
			?>
		</div><!-- .entry-content -->
		<?php if ( ! is_single() ) : ?>
		<a href="<?php echo get_permalink(); ?>" role="button" class="btn more"><?php esc_html_e( 'Read More', 'confidence' ); ?><i class="fa fa-long-arrow-right "></i></a>
		<?php endif; // is_single() ?>
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
		
	</article><!-- #post-## -->
