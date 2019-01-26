<?php
/**
 * @package Ecobox
 */
?>

<?php global $ecobox_data; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(has_post_thumbnail() && $ecobox_data['opt-post-image'] == 1) { ?>
	<figure class="thumb">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
	</figure>
	<?php } ?>
	<div class="post-body clearfix">
		<div class="post-date">
			<div class="post-date-inner">
				<?php the_time('M j'); ?>
				<span class="post-date-year"><?php the_time('Y'); ?></span>
			</div>
		</div><!-- .post-date -->
		<?php if($ecobox_data['opt-post-title'] == 1): ?>
		<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
		<?php endif; ?>
		<?php
			/* translators: used between list items, there is a space between items */
			$categories_list = get_the_category_list( __( ' ', 'ecobox' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ' ', 'ecobox' ) );

			if ( ! ecobox_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'ecobox' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'ecobox' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'ecobox' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'ecobox' );
				}

			} // end check for categories on this blog
		?>
		<?php if ( $categories_list && ecobox_categorized_blog() ) : ?>
		<span class="cat-links">
			<?php printf( __( '%1$s', 'ecobox' ), $categories_list ); ?>
		</span>
		<?php endif; // End if categories ?>

		<?php if ( $tag_list ) : ?>
		<span class="cat-links">
			<?php printf( __( '%1$s', 'ecobox' ), $tag_list ); ?>
		</span>
		<?php endif; // End if tags ?>

		<footer class="post-footer">
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="post-comments"><?php comments_popup_link( __( 'Leave a comment', 'ecobox' ), __( '1 Comment', 'ecobox' ), __( '% Comments', 'ecobox' ) ); ?></span>
			<?php endif; ?>
			<span class="post-author"><?php _e('by', 'ecobox'); ?> <?php the_author();?></span>
		</footer><!-- .post-footer -->
	</div>
	<div class="post-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ecobox' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .post-content -->
	<?php if($ecobox_data['opt-social-box'] == 1): ?>
	<div class="share-box">
		<span class="share-box-title"><?php _e('Share:', 'ecobox'); ?></span>
		<ul class="social-list social-list__footer list-unstyled">
			<li>
				<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>"><i class="fa fa-facebook"></i></a>
			</li>
			<li>
				<a href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
			</li>
			<li>
				<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"><i class="fa fa-linkedin"></i></a>
			</li>
			<li>
				<a href="http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"><i class="fa fa-reddit"></i></a>
			</li>
			<li>
				<a href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>"><i class="fa fa-tumblr"></i></a>
			</li>
			<li>
				<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a>
			</li>
			<li>
				<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;description=<?php echo urlencode($post->post_title); ?>&amp;media=<?php echo urlencode($full_image[0]); ?>"><i class="fa fa-pinterest"></i></a>
			</li>
			<li>
				<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><i class="fa fa-envelope"></i></a>
			</li>
		</ul>
	</div><!-- .share-box -->
	<?php endif; ?>
	<?php if($ecobox_data['opt-info-box']): ?>
	<div class="about-author">
		<div class="about-author-title">
			<h3><?php echo __('About the Author:', 'ecobox'); ?> <?php the_author_posts_link(); ?></h3>
		</div>
		<div class="about-author-body clearfix">
			<div class="avatar alignleft">
				<?php echo get_avatar(get_the_author_meta('email'), '72'); ?>
			</div>
			<div class="description">
				<?php the_author_meta("description"); ?>
			</div>
		</div>
	</div><!-- .about-author -->
	<?php endif; ?>
	<?php if($ecobox_data['opt-related-posts']): ?>
	<?php $related = ecobox_get_related_posts($post->ID); ?>
	<?php if($related->have_posts()): ?>
	<div class="related-posts">
		<h3 class="alt-title text-center"><?php echo __('Related Posts', 'ecobox'); ?></h3>
		<div class="img-box">
			<div class="img-box-inner">
				<ul class="img-list">

					<?php while($related->have_posts()): $related->the_post(); ?>
					<?php if(has_post_thumbnail()) { ?>
					<li>
						<a href="<?php the_permalink(); ?>" class="img-item" title="<?php the_title(); ?>">
							<figure class="img-holder">
								<?php the_post_thumbnail('related-img'); ?>
							</figure>
							<div class="img-title-wrap">
								<h4 class="img-title"><?php the_title(); ?></h4>
							</div>
						</a>
					</li>
					<?php } else { ?>
					<li>
						<a href="<?php the_permalink(); ?>" class="img-item" title="<?php the_title(); ?>">
							<figure class="img-holder">
								<img src="<?php echo get_template_directory_uri() ?>/images/empty.jpg" alt="">
								<i class="fa fa-file-image-o"></i>
							</figure>
							<div class="img-title-wrap">
								<h4 class="img-title"><?php the_title(); ?></h4>
							</div>
						</a>
					</li>
					<?php } ?>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
	</div><!-- .related-posts -->
	<?php endif; ?>
	<?php endif; ?>
</article><!-- #post-## -->