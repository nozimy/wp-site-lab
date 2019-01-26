<?php get_header();

if(!empty($_COOKIE['loopview'])){
	if ($_COOKIE['loopview'] == "default") {
		$containerclass = 'default';
	} else {
		$containerclass = 'zl_grid two';
	} 
} else {
	$containerclass = 'default';
}

if ($containerclass == 'zl_grid two') {
	$currentGrid = 'currents';
	$currentDef = '';
} else {
	$currentGrid = '';
	$currentDef = 'currents';
}
$browseaction = get_option('page_for_posts', '1');
$browsepage = zl_option('browsepage', '1');


?>
		<!-- oooooooooooooooooooooooooooooooooo
			Profile
		oooooooooooooooooooooooooooooooooooo-->
		<div class="row">
			<div class="zl_profilebar">
				<!-- pagination -->
				<div class="medium-6 column">
					
					<form action="<?php echo get_permalink($browsepage); ?>" method="get" class="sorterform">
						<?php echo zl_option('lang_shortby', __('Sort by:', 'zatolab')) ?>
						<select name="sortby">
							<?php 
							$by_date = zl_option('by_date', '1');
							$by_comments = zl_option('by_comments', '1');
							$by_views = zl_option('by_views', '1');
							$by_title = zl_option('by_title', '1');
							 ?>
							<?php if($by_date == 1){ ?>
							<option value="date"><?php echo zl_option('lang_date', __('Date', 'zatolab')) ?></option> <?php } ?>
							
							<?php if($by_comments == 1){ ?>
							<option value="comment_count"><?php echo zl_option('lang_comments', __('Comments', 'zatolab')) ?></option> <?php } ?>
							
							<?php if($by_views == 1){ ?>
							<option value="views"><?php echo zl_option('lang_views', __('Views', 'zatolab')) ?></option> <?php } ?>
							
							<?php if($by_title == 1){ ?>
							<option value="title"><?php echo zl_option('lang_title', __('Title', 'zatolab')) ?></option> <?php } ?>
						</select>
						<button type="submit"><?php echo zl_option('lang_go', __('Go', 'zatolab')) ?></button>
						
					</form>
				</div>
				
				<!-- Sorter -->
				<div class="medium-6 column text-right sorter">
					<?php echo zl_option('lang_view', __('View: ','zatolab'));?>
					<a class="zl_grid_add <?php echo $currentGrid; ?>" data-type="zl_grid two"><span class="dashicons dashicons-screenoptions"></span></a>
					<a class="zl_default_add <?php echo $currentDef; ?>" data-type="default"><span class="dashicons dashicons-editor-justify"></span></a>
				</div>
				<div class="clear"></div>
				<!-- oooooooooooooooooooooooooooooooooo
					Breadcrumbs
				oooooooooooooooooooooooooooooooooooo-->
				<div class="text-center">
					<?php zl_breadcrumbs();?>
				</div>
			</div><div class="clear"></div>
		</div>
		
		<!-- oooooooooooooooooooooooooooooooooo
			Post Entries
		oooooooooooooooooooooooooooooooooooo-->
		<div id="zl_content_entries">
			<div class="row">
				<div id="container" class="switchable-view <?php echo $containerclass; ?>" data-view="<?php echo $containerclass; ?>">
					<?php 
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						if(1 == $paged) {
							$show_frontendpost = zl_option('show_frontendpost');
							if( 1 == $show_frontendpost){
								echo apf_post_form($allowNotLoggedInuser='no');
							}
						}
						/*echo apf_post_form($allowNotLoggedInuser='no');*/
					?>
					<?php while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'loop', get_post_format() ); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		
		<!-- oooooooooooooooooooooooooooooooooo
			Pagination
		oooooooooooooooooooooooooooooooooooo-->
		<?php 
		if (function_exists('zl_pagination')){
			zl_pagination();
		} else {
			posts_nav_link();
		}
		?>
		
	<?php get_footer();?>