<?php

get_header();
get_template_part('menu_section');

$headerbgcolor = 					rwmb_meta('ninetheme_confidence_m_b_headerbgcolor');
$headertextcolor = 					rwmb_meta('ninetheme_confidence_m_b_pagetextcolor');
$headerpaddingtop = 				rwmb_meta('ninetheme_confidence_m_b_headerptop');
$headerpaddingbottom = 				rwmb_meta('ninetheme_confidence_m_b_headerpbottom');
$header_bg_single = 				rwmb_meta('ninetheme_confidence_m_b_header_bg_single');
$header_bg_single_image = 			rwmb_meta('ninetheme_confidence_m_b_header_bg_single_image');

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
			<?php    $current_blog_page_id = get_option('page_for_posts');  if((get_post_meta( $current_blog_page_id, 'ninetheme_confidence_m_b_disable_title', true )!= true) ){ ?>
			<h3><?php if(get_post_meta( $current_blog_page_id, 'ninetheme_confidence_m_b_alt_title', true )){ echo get_post_meta( $current_blog_page_id, 'ninetheme_confidence_m_b_alt_title', true ); } else { echo ('Our Blog'); } ?></h3>
			<p class="lead"><?php if(get_post_meta( $current_blog_page_id, 'ninetheme_confidence_m_b_subtitle', true )){ echo get_post_meta( $current_blog_page_id, 'ninetheme_confidence_m_b_subtitle', true ); }  ?></p>
			<p class="lead"><?php ninetheme_confidence_breadcrubms(); ?></p>
			<?php } ?>
		</div>
	</div>

	<div class="container has-margin-bottom blog-post-container">
		<div class="row">
			<?php if( ot_get_option( 'bloglayout' ) == 'right-sidebar') { ?>
			<div class="col-lg-9  col-md-9 col-sm-12 index float-right posts">
			<?php } elseif( ot_get_option( 'bloglayout' ) == 'left-sidebar') { ?>
			<?php get_sidebar(); ?>
			<div class="col-lg-9  col-md-9 col-sm-12 index float-left posts">
			<?php } elseif( ot_get_option( 'bloglayout' ) == 'full-width') { ?>
			<div class="col-xs-12 full-width-index v">
			<?php } elseif( ot_get_option( 'bloglayout' ) == '') { ?>
			<?php get_sidebar(); ?>
			<div class="col-lg-9  col-md-9 col-sm-12 index float-left posts">
			<?php } ?>

			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'post-format/content', get_post_format() ); ?>

			<?php endwhile; ?>
			<?php
			// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => esc_html__( 'Previous page', 'confidence' ),
					'next_text'          => esc_html__( 'Next page', 'confidence' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text"></span>',
				) );
			?>
			<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

			</div>

			<?php if( ot_get_option( 'bloglayout' ) == 'right-sidebar') { ?>
				<?php get_sidebar(); ?>
			<?php } ?>
		</div>
	</div>
	<?php get_footer(); ?>
