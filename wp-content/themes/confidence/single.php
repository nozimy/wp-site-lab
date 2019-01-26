	<?php

	get_header();
	get_template_part('menu_section');

	$headerbgcolor = 					rwmb_meta('ninetheme_confidence_m_b_headerbgcolor', 			'type=color');
	$headertextcolor = 					rwmb_meta('ninetheme_confidence_m_b_pagetextcolor', 			'type=color');
	$headerpaddingtop = 				rwmb_meta('ninetheme_confidence_m_b_headerptop', 				'type=number');
	$headerpaddingbottom = 				rwmb_meta('ninetheme_confidence_m_b_headerpbottom', 			'type=number');
	$header_bg_single = 				rwmb_meta('ninetheme_confidence_m_b_header_bg_single', 			'type=select');
	$header_bg_single_image = 			rwmb_meta('ninetheme_confidence_m_b_header_bg_single_image', 	'type=image');

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


		<?php if(( $header_bg_single ) == 'featured') { ?>
			<?php if ($image_src): ?>
				.subpage-head.page-header  {
				  background: url(<?php echo $image_src; ?>) no-repeat center center fixed !important;
				  background-size: cover !important;
				  height: auto !important;
				}
			<?php endif; ?>
		<?php } ?>

      <?php if(( $header_bg_single ) == 'default' || ( $header_bg_single ) == '') { ?>
         <?php if ($image_src): ?>
            .subpage-head.page-header  {
              background: url(<?php echo $header_bg_single_image; ?>) no-repeat center center fixed !important;
              background-size: cover !important;
              height: auto !important;
            }
         <?php endif; ?>
      <?php } ?>

		<?php if ($headerpaddingtop || $headerpaddingbottom ): ?>
			.subpage-head.page-header  {
				padding-top :<?php echo esc_attr( $headerpaddingtop ); ?>px ;
				padding-bottom :<?php echo esc_attr( $headerpaddingbottom ); ?>px ;
			}
		<?php endif; ?>

	</style>

	<div class="subpage-head page-header has-margin-bottom">
		<div class="container">
			<h3><?php  the_title();  ?></h3>
			<p class="lead"><?php ninetheme_confidence_breadcrubms(); ?></p>

		</div>
	</div>
	<div class="container has-margin-bottom blog-post-container">
		<div class="row">
			<div class="col-md-12-off has-margin-bottom-off">

			<?php if( ot_get_option( 'postlayout' ) == 'right-sidebar') { ?>
			<div class="col-lg-9 col-md-9 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( 'postlayout' ) == 'left-sidebar') { ?>
			<?php get_sidebar(); ?>
			<div class="col-lg-9 col-md-9 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( 'postlayout' ) == 'full-width') { ?>
			<div class="col-xs-12 full-width-index v">
			<?php } ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'post-format/content', get_post_format() ); ?>
					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					?>
				<?php endwhile; // end of the loop. ?>
				<?php ninetheme_confidence_post_nav(); ?>

				</div><!-- #end sidebar+ content -->

				<?php if( ot_get_option( 'postlayout' ) == 'right-sidebar') { ?>
					<?php get_sidebar(); ?>
				<?php } ?>

			</div>
		</div>
	</div>
	<?php get_footer(); ?>
