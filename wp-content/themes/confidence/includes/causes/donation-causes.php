	
	<?php
	$goal = rwmb_meta('ninetheme_confidence_m_b_causes_goal', 'type=text');
	$collacted = rwmb_meta('ninetheme_confidence_m_b_causes_collacted', 'type=text');
	$slider = rwmb_meta('ninetheme_confidence_m_b_causes_slider', 'type=text');
	$backer = rwmb_meta('ninetheme_confidence_m_b_causes_backer', 'type=text');
	$time_end = rwmb_meta('ninetheme_confidence_m_b_causes_time_end', 'type=text');
	$button = rwmb_meta('ninetheme_confidence_m_b_causes_button', 'type=post');
	?>
	
	<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_disable_causes', true )){ ?>	
		<div class="col-sm-12 nopadding m_bottom_30">
			<div class="charity-box has-margin-xs-bottom">
				<div class="charity-desc">
				
				<div class="col-sm-3">
					<?php if($collacted!='') : ?>
						<h4 class="pledged-amount has-no-margin"><?php echo esc_html($collacted); ?></h4>
					<?php endif; ?>
					<?php if($goal!='') : ?>
						<p class="goal"><?php echo esc_html($goal); ?></p>
					<?php endif; ?>
				</div>
				<div class="col-sm-3">
				
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo esc_attr($slider); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo esc_attr($slider); ?>%">
						<span class="sr-only"><?php echo esc_html($slider); ?>% <?php esc_html_e( 'Complete', 'confidence' ); ?></span><?php echo esc_html($slider); ?>%</div>
					</div>
					<div class="pull-left-off">
						<p><?php esc_html_e( 'Collected', 'confidence' ); ?></p>
					</div>
					
				</div>	
				<div class="col-sm-3">
					<div class="clearfix">
						<div class="pull-left has-margin-xs-right">
							<h4 class="pledged-amount"><?php echo esc_html($backer); ?></h4>
							<p><?php esc_html_e( 'Backer', 'confidence' ); ?></p>
						</div>
						
					</div>
				</div>
				<div class="col-sm-3">	
					<div class=" <?php if( ot_get_option( 'causessingle' ) != 'full-width') { ?>text-center  <?php } ?>">
						<a href="<?php echo esc_url( get_permalink($button)); ?>" class="btn btn-lg btn-primary button-causes"><?php esc_html_e( 'Donate Now', 'confidence' ); ?></a> 
					</div>
				</div>
					
				</div>
			</div>
		</div>
	<?php } ?> 