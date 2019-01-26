<?php get_header();
/*  
	Get Previous and Next Post URL
*/
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
							echo '<a href="' . $url . '" class="tooltip" title="'.get_the_title($prev->ID).'" id="zl_older_post"><span class="dashicons dashicons-arrow-left"></span> '.zl_option('lang_prev_post', __('Older Post','zatolab')).'</a>';
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
							echo '<a href="' . $url . '" class="tooltip" title="'.get_the_title($next->ID).'" id="zl_newer_post">'.zl_option('lang_next_post', __('Newer Post','zatolab')).' <span class="dashicons dashicons-arrow-right"></span></a>';
						}
					?>
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

		
		
		<!-- oooooooooooooooooooooooooooooooooo
			Post Entries
		oooooooooooooooooooooooooooooooooooo-->
		<section id="zl_content_entries">
			<div id="container" class="default switchable-view">
				<div class="row">
					<?php 
						while (have_posts()) : the_post(); 
						get_template_part( 'content', get_post_format() );
						zl_setPostViews(get_the_ID()); 
						endwhile; 
					 ?>		
				</div>
			</div>
		</section>
		<div class="clear"></div>
		<section id="zl_related">
			<?php get_template_part('inc/parts/relatedposts');?>
		</section>
		<div class="clear"></div>
		<?php get_template_part('inc/parts/authorbio');?>
		<!-- oooooooooooooooooooooooooooooooooooo
		Comments Section
		oooooooooooooooooooooooooooooooooooo -->
		<div class="clear"></div>
		<section id="zl_comments">
			<div class="row">
				<?php 
					if ( comments_open() || get_comments_number() ) {
						//get_template_part('inc/parts/comments');
						comments_template();
					}
				?>
			</div>
		</section>
		<div class="clear"></div>
		
		
	<?php get_footer();?>