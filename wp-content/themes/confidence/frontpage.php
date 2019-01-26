	<?php
	/*
	Template Name: Frontpage
	*/
	get_header();

	get_template_part('menu_section');	?>
		

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>	

	<?php get_footer(); ?>