<?php
/* Template Name: Left Sidebar */

/**
 * The template for displaying page with left sidebar.
 *
 * @package Ecobox
 */

get_header(); ?>

<?php
// Checking for WooCommerce. If true, load WooCommerce custom layout
if (class_exists('woocommerce') && ((is_woocommerce() == "true") || (is_checkout() == "true") || (is_cart() == "true") || (is_account_page() == "true") )){ ?>


<div class="row">
	<!-- Content -->
	<div id="content" class="col-md-9 col-md-push-3">
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
			<div id="page-content">
			  	<?php get_template_part( 'content', 'page' ); ?>						
			</div>
		</div>
	  	<?php endwhile; ?>

	</div>
	<!-- /Content -->

	<!-- Sidebar -->
	<div id="sidebar" class="col-md-3 col-md-pull-9">
		<?php 
		if ( (is_cart() == "true") || (is_checkout() == "true") ) {
			dynamic_sidebar("woocommerce-cart-sidebar");
		} else {
			dynamic_sidebar("woocommerce-sidebar");
		}
		?>
	</div>
	<!-- /Sidebar -->
</div>


<?php // ELSE load default layout
	} else { ?>

<div class="row">
	<!-- Content -->
	<div id="content" class="col-md-9 col-md-push-3">
		
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
			<div id="page-content">
			  	<?php get_template_part( 'content', 'page' ); ?>					
			</div>
		</div>
	  	<?php endwhile; ?>

	</div>
	<!-- /Content -->

	<!-- Sidebar -->
	<div id="sidebar" class="col-md-3 col-md-pull-9">
		<?php if(function_exists('generated_dynamic_sidebar')) { 
			generated_dynamic_sidebar();
		} else {
			get_sidebar();
		}?>
	</div>
	<!-- /Sidebar -->
</div>

<?php // END Default layout
	} ?>

<?php get_footer(); ?>