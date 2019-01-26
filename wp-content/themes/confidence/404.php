<?php
	/*
	404 page
	*/

	get_header(); 
	get_template_part('menu_section');
	
	?>

	<div class="subpage-head page-header has-margin-bottom">
		<div class="container">
			<h3><?php esc_html_e( '404', 'confidence' ); ?></h3>
			<p class="lead-off"><?php esc_html_e( 'Oops!', 'confidence' ); ?></p>
		</div>
	</div>
		<div class="container has-margin-bottom">
		<div class="row">
			
			<?php if( ot_get_option( '404layout' ) == 'right-sidebar') { ?>
			<div class="col-lg-9  col-md-9 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( '404layout' ) == 'left-sidebar') { ?>
			<?php get_sidebar(); ?>
			<div class="col-lg-9  col-md-9 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( '404layout' ) == 'full-width') { ?>
			<div class="col-xs-12 full-width-index v">
			<?php } ?>
					
				<h3><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'confidence' ); ?></h3>

				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'confidence' ); ?></p>

				<?php get_search_form(); ?>

			</div>
			
			

			
			
				<?php if( ot_get_option( '404layout' ) == 'right-sidebar') { ?>
					<?php get_sidebar(); ?>
				<?php } ?>
				

		</div>
	</div>
	<?php get_footer(); ?>