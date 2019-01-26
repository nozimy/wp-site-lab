<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Ecobox
 */

get_header(); ?>

<section id="primary" class="content-area">
	<main id="main" class="content" role="main">
		<section class="error-404 not-found">
			<div class="page-content">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<div class="error404-notice">
							<?php _e( 'Looks like something broke! The page you were looking for is not here.', 'ecobox' ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-xs"><?php _e( 'Go home', 'ecobox' ); ?></a>
						</div>
					</div>
				</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>