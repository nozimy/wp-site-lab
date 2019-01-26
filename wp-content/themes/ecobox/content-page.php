<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Ecobox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>

	<?php the_content(); ?>
	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'ecobox' ),
			'after'  => '</div>',
		) );
	?>
</article><!-- #post-## -->