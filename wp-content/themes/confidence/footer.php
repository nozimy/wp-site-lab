	<?php
	/**
	* The template for displaying the footer
	*
	*
	* @package WordPress
	* @subpackage confidence
	* @since confidence 1.0
	*/
	?>
	
	<?php if ( ot_get_option('footernewsletter') != 'off') : ?>
	<div class="site-footer-container">
	<div class="highlight-bg social-top footer-top first">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 social-heading"><h5 class="uppercase"><?php esc_html_e('Our social accounts', 'confidence') ?></h5></div>
				<div class="col-sm-3 social-container">
				<?php $slide = ot_get_option( 'social' );
					if ($slide) {
							echo '<ul class="nomargin">';
						foreach($slide as $key => $value) {
						
							echo '<li>';
								echo '<a title="'.$value['social_text'].'" target="_blank" href="'.$value['social_link'].'">';
								echo '<span class="icon-circle large"><i class="fa fa-'.$value['social_text'].'"></i></span>';
								echo '</a>';
							echo '</li>';
							
						}
						echo '</ul>';
						} else { ?> 
				<?php } ?>
				</div>
				<div class="form-group col-md-6 newsletter-container">
					<?php if ( is_active_sidebar( 'newsletter' ) ) { ?>
							<?php dynamic_sidebar( 'newsletter' ); ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if ( ot_get_option('footerwd') != 'off') : ?>
	<footer class="footer-top">
		<div class="container">
			<div class="row">
				<?php if ( is_active_sidebar( 'footer' ) ) { ?>
						<?php dynamic_sidebar( 'footer' ); ?>
				<?php } ?>
			</div>
		</div>
	</footer>
	<?php endif; ?>
	
	<?php if ( ot_get_option('footerpowereds') != 'off') : ?>
	<div class="copyright">
		<div class="container">
			<div class="row">
				  <div class="col-sm-6 pull-left">
					<?php if ( ot_get_option('footerpowered') != '') : ?>
						<p class="text-center-off"><?php echo esc_html(ot_get_option('footerpowered') ); ?></p>
					<?php endif; ?>
				  </div>
				  
				  <div class="col-sm-6">
					<ul class="nomargin nopadding info list">
						<?php if ( ot_get_option('footerphone') != '') : ?>
							<li><span class="fa fa-phone"></span><?php echo esc_html(ot_get_option('footerphone') ); ?></li>
						<?php endif; ?>
						<?php if ( ot_get_option('footerfax') != '') : ?>
							<li><span class="fa fa-fax"></span><?php echo esc_html(ot_get_option('footerfax') ); ?></li>
						<?php endif; ?>
						<?php if ( ot_get_option('footermail') != '') : ?>
							<li><span class="fa fa-envelope-o"></span><?php echo esc_html(ot_get_option('footermail') ); ?></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	</div>
	</div>
	<?php wp_footer(); ?>
	</body>
	</html>
