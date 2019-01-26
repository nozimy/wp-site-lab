<?php
/**
 * The Template for displaying all single posts.
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

?>

<div id="primary" class="row <?php echo $blog_sidebar; ?>">
	<main id="main" class="content" role="main">
		<div class="inner">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php 
				// ecobox_post_nav();
			?>
			
			<?php wp_reset_query(); ?>
			<?php
				comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- .inner -->
	</main><!-- #main -->

	<div class="spacer hidden-md hidden-lg"></div>

	<?php if($ecobox_data['opt-blog-sidebar'] != '3'): ?>
	<?php get_sidebar(); ?>
	<?php endif; ?>
	
</div><!-- #primary -->
<?php get_footer(); ?>