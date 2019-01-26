<?php
	/*
	Template name: Causes
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
			<p class="lead"><?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_subtitle', true )){ echo ''.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_subtitle', true ).''; } ?><?php ninetheme_confidence_breadcrubms(); ?></p>
		</div>
	</div>
	<div class="container causes-container has-margin-bottom">
		<div class="row">
			<div class="col-md-12-off has-margin-bottom-off">
			
			<?php if( ot_get_option( 'causessingle' ) == 'right-sidebar') { ?>
			<div class="col-lg-9 col-md-9 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( 'causessingle' ) == 'left-sidebar') { ?>
			
			<div id="widget-area" class="widget-area col-lg-3 col-md-3 col-sm-3">
				<?php if ( is_active_sidebar( 'causes-page-sidebar' ) ) { ?>
					<?php dynamic_sidebar( 'causes-page-sidebar' ); ?>
				<?php } ?>
			</div>
			
			<div class="col-lg-9 col-md-9 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( 'causessingle' ) == 'full-width') { ?>
			<div class="col-xs-12 full-width-index v">
			
			<?php } ?>
			  <div id="eventContainer">

				<?php  $loop = new WP_Query(array('post_type' => 'causes', 'posts_per_page' => -1)); $count =0; ?>
				
				<?php if ( $loop ) : 
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="causes-container">
							<div class="causes-container-inner">
							<div class="row-off">
								
								<?php if ( has_post_thumbnail() ) : ?>
									<?php $disable = rwmb_meta('ninetheme_confidence_m_b_disable_causes', 'type=checkbox'); ?>
									<div class="col-sm-12 nopadding">
										<div class="<?php if ( $disable =='') : ?> m-b-30 <?php else : ?>eventsItem  has-margin-bottom <?php endif; ?>">
											<?php 
												$att=get_post_thumbnail_id();
												$image_src = wp_get_attachment_image_src( $att, 'ninetheme_confidence_causes' );
												$image_src = $image_src[0]; ?> 
												<img src="<?php echo esc_url($image_src); ?>" class="img-responsive" alt="<?php the_title(); ?>">
											<?php  ?>
										</div>
									</div>

								
								<?php endif; ?>
								<?php get_template_part( 'includes/causes/donation-causes-page', 'index' ); ?>
								</div>
								<!--Donate Box-->
								<div class="row">
								  <div class="col-sm-12">
										<div class="description">
											<h4 class="CausesTitle uppercase"><a class="noteasing image-modal" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
											<div class="post-meta-first">
												<span class="details"><i class="fa  fa-user"></i> <?php the_author(); ?></span>
												<span class="details"><i class="fa  fa-clock-o"></i> <?php the_time('F j, Y'); ?></span>
												<span class="details"><i class="fa fa-map-marker"></i> <?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_causes_location', true )){ echo ''.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_causes_location', true ).''; } ?></span>
											</div>
										</div>
										<p><?php echo substr(get_the_excerpt(), 0,630); ?></p> 
								   </div>
								</div>
							</div>
						</div>
						<?php endwhile; ?>	
					<?php endif; ?>
				</div>
			</div><!-- #end sidebar+ content -->

			<?php if( ot_get_option( 'causessingle' ) == 'right-sidebar') { ?>
			<div id="widget-area" class="widget-area col-lg-3 col-md-3 col-sm-3"> 
				<?php if ( is_active_sidebar( 'causes-page-sidebar' ) ) { ?>
					<?php dynamic_sidebar( 'causes-page-sidebar' ); ?>
			<?php } ?>
			</div>
			<?php } ?>
				
			</div>
		</div>
	</div>
	<?php get_footer(); ?>