<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Ecobox
 */
?>

		</div>
	</main><!-- #content -->
	
	<!-- Footer
	================================================== -->
	<div class="footer-wrap">
		
		<!-- Footer -->
		<?php global $ecobox_data; ?>
		<?php if($ecobox_data['opt-footer-twitter'] == 1 || $ecobox_data['opt-footer-widgets'] == 1): ?>
		<footer class="footer" role="contentinfo">
			<div class="container">

				
				<?php if($ecobox_data['opt-footer-twitter'] == 1): ?>

					<?php // Twitter List 
					require_once ('inc/twitter-includes/twitter-feed-list.php' ); ?>

					<?php if($ecobox_data['opt-footer-twitter'] == 1 && $ecobox_data['opt-footer-widgets'] == 1): ?>
					<div class="hr hr__two-half">
						<div class="left-hr"></div>
						<div class="right-hr"></div>
					</div>
					<?php endif; ?>

				<?php endif; ?>
				

				<?php if($ecobox_data['opt-footer-widgets']): ?>
				<!-- Widgets -->
				<div class="footer-widgets">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-3">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('ecobox-footer-widget-1')): 
							endif;
							?>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('ecobox-footer-widget-2')): 
							endif;
							?>
						</div>
						<div class="clearfix visible-sm"></div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('ecobox-footer-widget-3')): 
							endif;
							?>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<?php
							if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('ecobox-footer-widget-4')): 
							endif;
							?>
						</div>
					</div>
				</div>
				<!-- Widgets / End-->
				<?php endif; ?>
			</div>
		</footer>
		<!-- Footer / End -->
		<?php endif; ?>
		
		<?php if($ecobox_data['opt-footer-copyright'] == 1): ?>
		<!-- Copyright -->
		<div class="copyright">
			<div class="container">
				<?php echo $ecobox_data['opt-footer-text']; ?>
			</div>
		</div>
		<!-- Copyright / End -->
		<?php endif; ?>
	</div>

	<?php
	if ( $ecobox_data['navbar_sticky'] == 1 ) :
		echo '<script>
		jQuery(function($){
			jQuery("#navbar").affix({
		    offset: {
		      top: 20
		    }
		  });
		});
	</script>';
	endif; ?>

	<?php // Tracking Code
	if($ecobox_data['tracking_code']) :
		echo $ecobox_data['tracking_code'];
	endif; ?>

<?php wp_footer(); ?> 
</body>
</html>