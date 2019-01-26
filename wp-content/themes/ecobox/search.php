<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Ecobox
 */

get_header(); ?>

<?php global $ecobox_data;

	$blog_sidebar = $ecobox_data['opt-blog-sidebar']; 
	switch ($blog_sidebar) {
		case '1':
			$blog_sidebar = 'blog-standard';
			break;
		case '2':
			$blog_sidebar = 'blog-standard blog-standard__left';
			break;
		case '3':
			$blog_sidebar = 'blog-fullwidth';
			break;
	}

	$blog_layout = $ecobox_data['opt-blog-layout']; 
	switch($blog_layout) {
		case '1':
			$blog_layout = '';
			break;
		case '2':
			$blog_layout = 'blog-columns blog-columns__two';
			break;
		case '3':
			$blog_layout = 'blog-columns blog-columns__three';
			break;
	};

?>

	<section id="primary" class="row <?php echo $blog_sidebar; ?> <?php echo $blog_layout; ?>">
		<main id="main" class="content" role="main">
			<div class="inner">
				<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'content', 'search' );
					?>

				<?php endwhile; ?>

				<?php ecobox_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>
			</div>
		</main><!-- #main -->

		<div class="spacer hidden-md hidden-lg"></div>

		<?php if($ecobox_data['opt-blog-sidebar'] != '3'): ?>
		<?php get_sidebar(); ?>
		<?php endif; ?>

	</section><!-- #primary -->

<?php get_footer(); ?>