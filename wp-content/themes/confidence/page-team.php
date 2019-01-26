	<?php
	/*
	Template name: Team
	*/

	get_header(); 
	get_template_part('menu_section');

	$headerbgcolor 			= 	rwmb_meta('ninetheme_confidence_m_b_headerbgcolor'); 
	$headertextcolor 		= 	rwmb_meta('ninetheme_confidence_m_b_pagetextcolor');
	$headerpaddingtop 		= 	rwmb_meta('ninetheme_confidence_m_b_headerptop'); 
	$headerpaddingbottom 	= 	rwmb_meta('ninetheme_confidence_m_b_headerpbottom'); 
	$pagelayout 			= 	rwmb_meta('ninetheme_confidence_m_b_pagelayout'); 
	$att					=	get_post_thumbnail_id();
	$image_src 				= 	wp_get_attachment_image_src( $att, 'span5' );
	$image_src 				= 	$image_src[0];
	$columns 				= 	ot_get_option('teamcolumn');
	$column 				= 	($columns != '') ? ''. esc_attr($columns) . '' : '3';
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

	<div class="subpage-head page-header has-margin-bottom">
		<div class="container">
			<h3><?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_alt_title', true )){ echo get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_alt_title', true ); } else { the_title(); } ?></h3>
			<p class="lead-off"><?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_subtitle', true )){ echo ''.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_subtitle', true ).''; } ?><?php ninetheme_confidence_breadcrubms(); ?></p>
		</div>
	</div>
	<?php 
		if ( have_posts() ) :  
		while ( have_posts() ) : 
		the_post(); 
		the_content(); 
		endwhile;  
		endif; 
	?>
	<div class="container has-margin-bottom-off team-container">
		<div class="row">
			<div class="col-md-12-off  has-margin-bottom-off">
			
			<?php if( ot_get_option( 'teamlayout' ) == 'right-sidebar') { ?>
			<div class="col-lg-8  col-md-8 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( 'teamlayout' ) == 'left-sidebar') { ?>
			<div id="widget-area" class="widget-area col-lg-4 col-md-4 col-sm-4">
				<?php if ( is_active_sidebar( 'team-page-sidebar' ) ) { ?>
					<?php dynamic_sidebar( 'team-page-sidebar' ); ?>
				<?php } ?>
			</div>
			<div class="col-lg-8  col-md-8 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( 'teamlayout' ) == 'full-width') { ?>
			<div class="col-xs-12-off full-width-index v">
			<?php } ?>

				<?php 
					$loop = new WP_Query(array( 'post_type' => 'team', 'posts_per_page' => -1 ));
					if ( $loop ) : 
					while ( $loop->have_posts() ) : 
					$loop->the_post();
					
				?>
				
				<div class="eventsItem col-lg-<?php echo esc_attr( $column ); ?> col-md-<?php echo esc_attr( $column ); ?> col-sm-6 col-xs-12 team">
					<div class="eventInner">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="eventImg">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>
						<div class="team-detail">
						<div class="detail-social">
						<ul class="social-icon nav-default inline clearfix">
							<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_facebook', true )) : ?>
								<li><a href="<?php echo ''.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_facebook', true ).'';  ?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
							<?php endif; ?>
							<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_twitter', true )) : ?>
								<li><a href="<?php echo ''.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_twitter', true ).'';  ?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
							<?php endif; ?>
							
							<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_google', true )) : ?>
								<li><a href="<?php echo ''.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_google', true ).'';  ?>" class="google"><i class="fa fa-google-plus"></i></a></li>
							<?php endif; ?>
							
							<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_linkedin', true )) : ?>
								<li><a href="<?php echo ''.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_linkedin', true ).'';  ?>" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
							<?php endif; ?>
							
						</ul>
					</div>
					</div>
						<div class="description">
							<h4 class="eventTitle"><?php the_title(); ?>
								<span class="detail-title">
									<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_profession', true )){ 
									echo ''.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_profession', true ).''; 
									} ?>
								</span>
							</h4>
						</div>
					</div>
					
					<div class="event-container">
						<div class="inner">
							<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_about', true )){ 
							echo '<p class="lead-off uppercase-off">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_about', true ).'</p> '; 						
							} ?>
							<div class="inner items">
								<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_mail', true )){ 
								echo '<p class="lead-off-off uppercase strong">' . esc_html__('E-mail', 'confidence') . '</p> '; 
								echo '<p class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_mail', true ).'</p> '; 
								} ?>
							</div>
							<div class="inner items">
								<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_phone', true )){ 
								echo '<p class="lead-off uppercase strong">' . esc_html__('Phone', 'confidence') . '</p> '; 
								echo '<p class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_phone', true ).'</p> '; 
								} ?>
							</div>
							<div class="inner items">
								<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_location', true )){ 
								echo '<p class="lead-off uppercase strong">' . esc_html__('Location', 'confidence') . '</p> '; 
								echo '<p class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_location', true ).'</p> '; 
								} ?>
							</div>
							<div class="inner items">
							<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_adress', true )){ 
								echo '<p class="lead-off uppercase strong">' . esc_html__('Address', 'confidence') . '</p> '; 
								echo '<p class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_team_adress', true ).'</p> '; 
								} ?>
							</div> 
						</div> 
					</div> 
				</div>
			<?php 
				endwhile; 
				endif; 
			?>
			</div><!-- #end sidebar+ content -->
 
			<?php if( ot_get_option( 'teamlayout' ) == 'right-sidebar') { ?>
				<div id="widget-area" class="widget-area col-lg-4 col-md-4 col-sm-4">
					<?php if ( is_active_sidebar( 'team-page-sidebar' ) ) { ?>
						<?php dynamic_sidebar( 'team-page-sidebar' ); ?>
					<?php } ?>
				</div>
			<?php } ?>
				
			</div>
		</div>
	</div>
	<?php get_footer(); ?>