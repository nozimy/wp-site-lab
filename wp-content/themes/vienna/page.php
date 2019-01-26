<?php get_header();

$prev = get_adjacent_post(false, '', true);
$next = get_adjacent_post(false, '', false);
if (!empty($prev)) {
	$prevID = $prev->ID;
}
if (!empty($next)) {
	$newerID = $next->ID;
}
?>
		<!-- oooooooooooooooooooooooooooooooooo
			Profile
		oooooooooooooooooooooooooooooooooooo-->
		<div class="row">
			<div class="zl_profilebar singleprofbar">
				
				<div class="small-6 column postnav">
					<?php 
						
						if($prev) {
							$url = get_permalink($prev->ID); 
							echo '<a href="' . $url . '" class="tooltip" title="'.get_the_title($prev->ID).'" id="zl_older_post"><span class="dashicons dashicons-arrow-left"></span> '.zl_option('lang_older_page', __('Older Page','zatolab')).'</a>';
						}
					?>
					&nbsp;
				</div>
				
				<!-- Next Post -->
				<div class="small-6 column text-right postnav">
					&nbsp;
					<?php 
						if($next){
							$url = get_permalink($next->ID);            
							echo '<a href="' . $url . '" class="tooltip" title="'.get_the_title($next->ID).'" id="zl_newer_post">'.zl_option('lang_newer_page', __('Newer Page','zatolab')).' <span class="dashicons dashicons-arrow-right"></span></a>';
						}
					?>
				</div>
				<div class="clear"></div>
				<div class="text-center">
					<?php zl_breadcrumbs();?>
				</div>
			</div>
		</div>
	
		
		<!-- oooooooooooooooooooooooooooooooooo
			Post Entries
		oooooooooooooooooooooooooooooooooooo-->
		<section id="zl_content_entries">
			<div id="container" class="default switchable-view">
				<div class="row">
					<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', 'page' ); ?>
					<?php endwhile; ?>		
				</div>
			</div>
		</section>
		<div class="clear"></div>
		<section id="zl_related">
			<?php get_template_part('inc/parts/relatedposts');?>
		</section>
		<div class="clear"></div>
		
	<?php get_footer();?>