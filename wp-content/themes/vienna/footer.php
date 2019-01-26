		<?php 
		$footercols = zl_option('footercol', '3')  
		 ?>
		<!-- oooooooooooooooooooooooooooooooooo
			Footer
		oooooooooooooooooooooooooooooooooooo-->
		<footer id="zl_footer">
			<div class="zl_footer" data-col="<?php echo $footercols; ?>">
				<div class="footerwidgets">
					<div class="owl-carousel footerslide">
						<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer-widget') ) : else : ?><?php endif; ?>					
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="zl_copyright">
				<div class="row">
					<div class="large-6 ">
						<?php echo zl_option('footer_copyright'); ?>
					</div>
					<div class="large-6  text-right">
						<?php 
							$logo = zl_option('logo_footer');
							$logo = mr_image_resize($logo, 100, null, false, 'c', false);
							if ($logo) { ?>
							 <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zl_logo" src="<?php echo $logo; ?>" alt="<?php bloginfo('title');?>"/></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</footer>
		<div class="clear"></div>
	</div> <!-- END class="mp-pusher" id="mp-pusher" -->
	<div class="clear"></div>
	<div class="zl_backtotop" style="display: block;">
		<span class="dashicons dashicons-arrow-up-alt2"></span>
	</div>
	<div class="clear"></div>
	<div class="mobileonly">
		<?php get_template_part('inc/parts/msidebar'); ?>
	</div>
	<?php 
	echo zl_option('tracker');
	wp_footer();?>
	</body>
</html>