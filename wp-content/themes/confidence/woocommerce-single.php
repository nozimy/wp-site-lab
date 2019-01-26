	<?php
	
	get_header(); 
	get_template_part('menu_section');

	?>
	

	<div class="subpage-head page-header  has-margin-bottom">
		<div class="container">
		<div class="row">
			<div class="col-md-9">
				<h3><?php  the_title(); ?></h3>
				<p class="lead"><?php ninetheme_confidence_breadcrubms(); ?></p>
			</div>
			<div class="col-md-3 shopping-cart">
				<i class="fa fa-shopping-cart"></i>
				<span class="hidden-xs"><?php esc_html_e('Totals', 'confidence' ); ?></span> : <span class="theme">
				<?php echo WC()->cart->get_cart_subtotal();?>
				</span>
			</div>
		</div>
		</div>
	</div>
	
	<div class="container has-margin-bottom">
		<div class="row">
			<div class="col-md-12-off has-margin-bottom-off">
			
			<?php if( ot_get_option( 'woosingle' ) == 'right-sidebar') { ?>
			<div class="col-lg-9  col-md-9 col-sm-9 index float-right posts">
			<?php } elseif( ot_get_option( 'woosingle' ) == 'left-sidebar') { ?>
			
				<div id="widget-area" class="widget-area col-lg-3 col-md-3 col-sm-3 woo-sidebar">
					
					<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'shop-sidebar' ); ?>
					<?php } ?>

				</div>

			<div class="col-lg-9  col-md-9 col-sm-9 index float-left posts">
			<?php } elseif( ot_get_option( 'woosingle' ) == 'full-width') { ?>
			<div class="col-xs-12 full-width-index v">
			<?php } ?>

			
			<?php woocommerce_content(); ?>
			
			 </div><!-- #end sidebar+ content -->

			
			
				<?php if( ot_get_option( 'woosingle' ) == 'right-sidebar') { ?>
				<div id="widget-area" class="widget-area col-lg-3 col-md-3 col-sm-3 woo-sidebar">
					<?php if ( is_active_sidebar( 'shop-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'shop-sidebar' ); ?>
					<?php } ?>
				</div>
				<?php } ?>
				
			</div>
		</div>
	</div>
	<?php get_footer(); ?>