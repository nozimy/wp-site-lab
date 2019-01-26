<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage ninetheme_confidence
 * @since ninetheme_confidence 1.0
 */
?>


<div class="author-info clearfix m_top_50 white">
	<div class="col-sm-2 avatar-container">
	<div class="author-avatar">
		<?php
		$author_bio_avatar_size = apply_filters( 'ninetheme_confidence_author_bio_avatar_size', 80 );
		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->
	</div><!-- .author-avatar -->
<div class="col-sm-10">
	<div class="author-description">
		<h6 class="author-title uppercase strong white"><?php echo get_the_author(); ?></h6>
<p class="white"><?php the_author_meta( 'description' ); ?></p>
<p class="white"><?php the_author(); ?> <?php esc_html_e( 'has blogged ', 'confidence' ); ?><?php echo number_format_i18n( the_author_posts() ); ?> <?php esc_html_e( 'posts ', 'confidence' ); ?></p>
	</div><!-- .author-description -->
	</div><!-- .author-description -->
</div><!-- .author-info -->


