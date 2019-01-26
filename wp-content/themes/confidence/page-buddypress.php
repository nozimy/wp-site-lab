<?php
	/*
	Template name: Buddypress
	*/

	 get_header(); 
	get_template_part('menu_section');

	$headerbgcolor = 					rwmb_meta('ninetheme_confidence_m_b_headerbgcolor', 			'type=color'); 
	$headertextcolor = 					rwmb_meta('ninetheme_confidence_m_b_pagetextcolor', 			'type=color');
	$headerpaddingtop = 				rwmb_meta('ninetheme_confidence_m_b_headerptop', 				'type=number'); 
	$headerpaddingbottom = 				rwmb_meta('ninetheme_confidence_m_b_headerpbottom', 			'type=number'); 
	$pagelayout = 				rwmb_meta('ninetheme_confidence_m_b_pagelayout', 						'type=select'); 

	$att=get_post_thumbnail_id();
	$image_src = wp_get_attachment_image_src( $att, 'span5' );
	$image_src = $image_src[0]; 
	?>
	
	<style>
		<?php if ($headertextcolor): ?>
			.breadcrumbs a,
			.subpage-head.page-header , 
			.subpage-head.page-header h3 { color :<?php echo esc_attr( $headertextcolor ); ?> ; }
		<?php endif; ?>
		
		<?php if ($headerbgcolor): ?>
			.subpage-head { background-color :<?php echo esc_attr( $headerbgcolor ); ?>; }
		<?php endif; ?>
		
		
		
		<?php if ($image_src): ?>
			.subpage-head.page-header  {
			  background: url(<?php echo $image_src; ?>) no-repeat center center fixed !important;
			  background-size: cover !important;
			  height: auto !important;
			}
		<?php endif; ?>
		
		<?php if ($headerpaddingtop || $headerpaddingbottom ): ?>
			.subpage-head.page-header  {
				padding-top :<?php echo esc_attr( $headerpaddingtop ); ?>px ;
				padding-bottom :<?php echo esc_attr( $headerpaddingbottom ); ?>px ;
			}
		<?php endif; ?>
	</style>
	
	<div class="subpage-head page-header  has-margin-bottom">
		<div class="container">
			<h3><?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_alt_title', true )){ echo get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_alt_title', true ); } else { the_title(); } ?></h3>
			<p class="lead"><?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_subtitle', true )){ echo ''.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_subtitle', true ).''; } ?>
			<?php ninetheme_confidence_breadcrubms(); ?></p>
		</div>
	</div>
	<div class="container has-margin-bottom">
		<div class="row">
			<div class="col-md-12-off  has-margin-bottom-off">
			
			<?php if( ot_get_option( 'forumlayout' ) == 'right-sidebar') { ?>
			<div class="col-lg-8  col-md-8 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( 'forumlayout' ) == 'left-sidebar') { ?>
			<div id="widget-area" class="widget-area col-lg-4 col-md-4 col-sm-4">
			
				<?php if ( is_active_sidebar( 'buddy-page-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'buddy-page-sidebar' ); ?>
				<?php } ?>
			</div>
			<div class="col-lg-8  col-md-8 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( 'forumlayout' ) == 'full-width') { ?>
			<div class="col-xs-12 full-width-index v">
			<?php } ?>
		

				<?php    
					if (have_posts()) : 
						while (have_posts()) : 
							the_post();
							the_content(); 
						endwhile; 
					endif; 
				?>
			</div>
			
			
				<?php if( ot_get_option( 'forumlayout' ) == 'right-sidebar') { ?>
					<div id="widget-area" class="widget-area col-lg-4 col-md-4 col-sm-4">
					<?php if ( is_active_sidebar( 'buddy-page-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'buddy-page-sidebar' ); ?>
					<?php } ?>
					</div>
				<?php } ?>
				
			</div>
		</div>
	</div>
	<?php get_footer(); ?>