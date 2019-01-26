	<?php
	
	get_header(); 
	get_template_part('menu_section');

	?>
	
	<div class="subpage-head page-header has-margin-bottom">
		<div class="container">
			<h3><?php printf( esc_html__( 'Search Results for: %s', 'confidence' ), get_search_query() ); ?></h3>
			<p class="lead"><?php ninetheme_confidence_breadcrubms(); ?></p>
			
		</div>
	</div>
	<div class="container has-margin-bottom">
		<div class="row">
			<div class="col-md-12-off has-margin-bottom-off">
			
			<?php if( ot_get_option( 'searchlayout' ) == 'right-sidebar') { ?>
			<div class="col-lg-9 col-md-9 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( 'searchlayout' ) == 'left-sidebar') { ?>
			<?php get_sidebar(); ?>
			<div class="col-lg-9 col-md-9 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( 'searchlayout' ) == 'full-width') { ?>
			<div class="col-xs-12 full-width-index v">
			<?php } ?>
				<?php if ( have_posts() ) : ?>

					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'search' );

					// End the loop.
					endwhile;

					// Previous/next page navigation.
					the_posts_pagination( array(
						
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'confidence' ) . ' </span>',
					) );

				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'content', 'none' );

				endif;
				?>	
				
				<?php wp_link_pages(); ?>
				</div><!-- #end sidebar+ content -->

			
			
				<?php if( ot_get_option( 'searchlayout' ) == 'right-sidebar') { ?>
					<?php get_sidebar(); ?>
				<?php } ?>
				
			</div>
		</div>
	</div>
	<?php get_footer(); ?>