<?php 
/* Template name: Portfolio */
get_header();
global $post;


if ( get_query_var('paged') ) { 
	$pageds = get_query_var('paged'); 
} else if ( get_query_var('page') ) {
	$pageds = get_query_var('page'); 
} else {
	$pageds = 1; 
}
?>
		<!-- oooooooooooooooooooooooooooooooooo
			Profile
		oooooooooooooooooooooooooooooooooooo-->
		<div class="row">
			<div class="zl_profilebar singleprofbar">
				<!-- pagination -->
				<div class="small-6 column postnav">
					&nbsp;
				</div>
				
				<!-- Sorter -->
				<div class="small-6 column text-right sorter postnav">
					&nbsp;
				</div>
				<div class="clear"></div>
				<!-- oooooooooooooooooooooooooooooooooo
					Breadcrumbs
				oooooooooooooooooooooooooooooooooooo-->
				<div class="text-center">
					<?php zl_breadcrumbs();?>
				</div>
			</div>
		</div>
		<div class="clear albtop"></div>
		

		<div class="row">
			<div class="zlisportfolio zl_loop">
				<header class="pg_ttl_hdr">
					<h1 class="entry-title text-center"><?php the_title(); ?></h1>
				</header>
				<div class="clear"></div>
				<div class="zl_post_detail">
					<div id="zl_ajax_content">
						<?php get_template_part('inc/functions/portfoliodetail'); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>

	<?php get_footer();?>