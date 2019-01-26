<?php /* Template Name: Blog Two Columns */ ?>
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

<section id="primary" class="row <?php echo $blog_sidebar; ?> blog-columns blog-columns__two">
	<main id="main" class="content" role="main">
		<div class="inner">

			<?php // Loop
			$temp = $wp_query;
			$wp_query= null;
			$wp_query = new WP_Query();
			$wp_query->query("post_type=post&paged=".$paged); ?>

			<?php if ( have_posts() ) : ?>

				<div class="posts-wrapper">

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						get_template_part( 'content' );
					?>

				<?php endwhile; ?>
				
				</div>

				<?php ecobox_pagination(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			<?php $wp_query = null; $wp_query = $temp;?>

		</div><!-- .inner -->
	</main><!-- #main -->

	<div class="spacer hidden-md hidden-lg"></div>

	<?php if($ecobox_data['opt-blog-sidebar'] != '3'): ?>
	<?php get_sidebar(); ?>
	<?php endif; ?>
	
</section><!-- #primary -->
<?php get_footer(); ?>