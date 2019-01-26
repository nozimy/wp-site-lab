<?php 

/* Template name: Browse */


get_header();
global $post;


if ( get_query_var("sortby")) {
	$sortby = get_query_var("sortby");
} else {
	$sortby='';
}

if (get_query_var("order")) {
	$order = get_query_var("order");
} else {
	$order = 'DESC';
}
//echo $_GET["sortby"];
if ( get_query_var('paged') ) { 
	$pageds = get_query_var('paged'); 
} else if ( get_query_var('page') ) {
	$pageds = get_query_var('page'); 
} else {
	$pageds = 1; 
}
global $loopview;
if(!empty($_COOKIE['loopview'])){
	if ($_COOKIE['loopview'] == "default") {
		$containerclass = 'default';
	} else {
		$containerclass = 'zl_grid two';
	} 
} else {
	$containerclass = 'zl_grid two';
}

if ($containerclass == 'zl_grid two') {
	$currentGrid = 'currents';
	$currentDef = '';
} else {
	$currentGrid = '';
	$currentDef = 'currents';
}
						
?>
		<!-- oooooooooooooooooooooooooooooooooo
			Profile
		oooooooooooooooooooooooooooooooooooo-->
		<div class="row">
			<div class="zl_profilebar singleprofbar">
				<!-- pagination -->
				<div class="small-6 column postnav">
					<form action="http://user-pc/arfa/browse/" method="get" class="sorterform">
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
						<?php 
						/*
						if ('DESC' == $order) { ?>
							 <a href="<?php echo get_permalink( $post->ID ); ?>/?sortby=<?php echo get_query_var("sortby");?>&order=ASC" class="browse_order"><span class="dashicons dashicons-arrow-down-alt"></span></a>
						<?php } elseif('ASC' == $order) { ?>
							<a href="<?php echo get_permalink( $post->ID ); ?>/?sortby=<?php echo get_query_var("sortby");?>&order=DESC" class="browse_order"><span class="dashicons dashicons-arrow-up-alt"></span></a>
						<?php } */ ?>
						
					</form>
				</div>
				
				<!-- Sorter -->
				<div class="small-6 column text-right sorter postnav">
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
			</div>
		</div>
		
		
		<!-- oooooooooooooooooooooooooooooooooo
			Post Entries
		oooooooooooooooooooooooooooooooooooo-->
		<section id="zl_content_entries">
			<div class="row">
				<div id="container" class="switchable-view <?php echo $containerclass; ?>" data-view="<?php echo $containerclass; ?>">
					<?php
						if ('views' == get_query_var("sortby")){
							$args = array(
								'post_type' => 'post',
								'post_status' => 'publish',
								'meta_key' => 'wpb_post_views_count',
								'orderby' => 'meta_value_num',
								'order' => $order,
								'paged' => $pageds,
								'ignore_sticky_posts' => 1,
							);
						} else {
							$args = array(
								'post_type' => 'post',
								'post_status' => 'publish',
								'orderby' => $sortby,
								'order' => $order,
								'paged' => $pageds,
								'ignore_sticky_posts' => 1,
							);
						}
					   $browse = new WP_Query($args);
					?>
					<?php if($browse->have_posts()) : ?><?php while($browse->have_posts()) : $browse->the_post(); ?>
						<?php get_template_part( 'loop', get_post_format() ); ?>
					<?php endwhile; endif; ?>
					
					<?php /*while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'loop', get_post_format() ); ?>
					<?php endwhile;*/ ?>		
				</div>
			</div>
		</section>
		
		
		<!-- oooooooooooooooooooooooooooooooooo
			Pagination
		oooooooooooooooooooooooooooooooooooo-->
		<?php 
		if (function_exists('zl_pagination')){
			zl_pagination($pages = $browse->max_num_pages);
		} else {
			posts_nav_link();
		}
		 ?>
		
	<?php get_footer();?>