<?php
/**
 * @package Ecobox
 */
?>

<div class="article-wrapper">
	<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
		<?php if(has_post_thumbnail()) { ?>
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
			<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
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
			<div class="post-excerpt">
				<?php the_excerpt(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'ecobox' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .post-excerpt -->
			<footer class="post-footer">
				<?php if ( ! post_password_required() ) : ?>
				<a href="<?php the_permalink() ?>" class="link-bordered link-more"><?php _e('More', 'ecobox'); ?></a>
				<?php endif; ?>
				<span class="post-author"><?php _e('by', 'ecobox'); ?> <?php the_author();?></span>
			</footer><!-- .post-footer -->
		</div>
	</article><!-- #post-## -->
</div>