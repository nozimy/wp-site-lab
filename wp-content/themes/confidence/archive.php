<?php
	/*
	Template name: Fullwidth Template
	*/

	 get_header(); 
	get_template_part('menu_section');

	?>
	

	<div class="subpage-head page-header has-margin-bottom">
		<div class="container">
				<h3><?php  esc_html_e('Archive','confidence');  ?></h3>
			<p class="lead"><?php ninetheme_confidence_breadcrubms(); ?></p>
		</div>
	</div>
	
	<div class="container has-margin-bottom blog-post-container">
		<div class="row">
			<div class="col-md-12-off has-margin-bottom-off">
			
			<?php if( ot_get_option( 'archivelayout' ) == 'right-sidebar') { ?>
			<div class="col-lg-9  col-md-9 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( 'archivelayout' ) == 'left-sidebar') { ?>
			<?php get_sidebar(); ?>
			<div class="col-lg-9  col-md-9 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( 'archivelayout' ) == 'full-width') { ?>
			<div class="col-xs-12 full-width-index v">
			<?php } ?>

			 
			 <?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post();
					get_template_part( 'post-format/content', get_post_format() );
				endwhile;

				the_posts_pagination( array(
					'prev_text'          => esc_html__( 'Previous page', 'confidence' ),
					'next_text'          => esc_html__( 'Next page', 'confidence' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'confidence' ) . ' </span>',
				) );
				else :
					get_template_part( 'content', 'none' );
				endif;
			?>
			 

			 
				

			</div><!-- #end sidebar+ content -->

			
			
				<?php if( ot_get_option( 'archivelayout' ) == 'right-sidebar') { ?>
					<?php get_sidebar(); ?>
				<?php } ?>
				
			</div>
		</div>
	</div>
	<?php get_footer(); ?>
