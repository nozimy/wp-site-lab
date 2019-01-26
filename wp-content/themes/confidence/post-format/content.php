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
				<img src="<?php echo esc_url($image_src); ?>" alt="image-title">
			<?php  ?>
			</div>
		<?php endif; ?>
		
		<div class="content-container">
			<header class="entry-header">
				<div class="post-tittle">
					<div class="date-post">
						<h4> <a href="<?php echo get_permalink(); ?>"><?php echo date_i18n(the_time( 'j' ) ); ?></a></h4>
						<span> <a href="<?php echo get_permalink(); ?>"><?php echo date_i18n(the_time( 'F' ) ); ?></a></span>
					</div>					
					<?php if ( is_single() ) :?>			
					<?php the_title( '<a class="post-heading">', '</a>' ); ?>
					<?php else : ?>
					<?php the_title( sprintf( '<a  class="post-heading" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' );?>
					<?php endif;?>						
				</div>
			</header><!-- .entry-header -->
			
			<div class="post-meta-first">
				<span><i class="fa fa-calendar"></i> <a href="<?php echo get_permalink(); ?>"><?php the_time('F j, Y'); ?></a></span>
				<span><i class="fa fa-user"></i> <?php the_author(); ?></span>
				<span><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></span>
				<span><?php the_tags( '<i class="fa fa-tag"></i>' ,' , ',' '); ?></span>
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
	<?php
		// Author bio.
		if ( is_single()  ) :
			get_template_part( 'author-bio' );
		endif;
	?>