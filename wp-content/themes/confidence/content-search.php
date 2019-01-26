<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage confidence
 * @since confidence 1.0
 */
?>


<!-- ARTICLE -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="content-container">
		<header class="entry-header">
			<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
			?>
		</header><!-- .entry-header -->

	</div><!-- .entry-footer -->
	
	<p class="date"><?php the_time('F j, Y'); ?></p>
	<div class="entry-meta">
			<span class="comments-link"><?php comments_popup_link( esc_html__( 'Leave a comment', 'confidence' ), esc_html__( '1 Comment', 'confidence' ), esc_html__( '% Comments', 'confidence' ) ); ?></span>
	</div><!-- .entry-meta -->
	<div class="excerpt-container" style="margin-bottom:30px;"><?php the_excerpt(); ?></div>
	<!-- Date -->
	
	
	<!-- Read me BTN -->
	
</article><!-- #post-## -->
