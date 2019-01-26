<?php get_header();
global $post;
global $wp;
global $loopview;
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

$current_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

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
$lang_cat = zl_option('lang_postauthor', __('Written by','zatolab'));
?>
		<!-- oooooooooooooooooooooooooooooooooo
			Profile
		oooooooooooooooooooooooooooooooooooo-->
		<div class="row">
			<div class="zl_profilebar singleprofbar">
				<!-- pagination -->
				<div class="small-6 column postnav">
					<form action="" method="get" class="sorterform">
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
						if($sortby){
							if ('DESC' == $order) { ?>
								 <a href="<?php echo $current_url; ?>&order=ASC" class="browse_order"><span class="dashicons dashicons-arrow-down-alt"></span></a>
							<?php } elseif ('ASC' == $order) { ?>
								<a href="<?php echo $current_url; ?>&order=DESC" class="browse_order"><span class="dashicons dashicons-arrow-up-alt"></span></a>
							<?php 
							}
						}
						?>
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
			</div><div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="clear albtop"></div>
		<div class="row text-center">
			<h1 class='zl_arcTitle'> <?php echo $lang_cat; ?> <span><?php echo get_the_author_meta('display_name'); ?></span></h1>
		</div>

		<!-- oooooooooooooooooooooooooooooooooo
			Post Entries
		oooooooooooooooooooooooooooooooooooo-->
		<section id="zl_content_entries">
			<div class="row">
				<div id="container" class="switchable-view <?php echo $containerclass; ?>" data-view="<?php echo $containerclass; ?>">

					<?php 

						if ($sortby or $sortby) { ?>
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
					<?php }  else { ?>
						<?php while (have_posts()) : the_post(); ?>
						<?php get_template_part( 'loop', get_post_format() ); ?>
						<?php endwhile; ?>
					<?php } ?>
					
				</div>
			</div>
		</section>
		
		
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