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
	$containerclass = 'zl_grid two';
}

if ($containerclass == 'zl_grid two') {
	$currentGrid = 'currents';
	$currentDef = '';
} else {
	$currentGrid = '';
	$currentDef = 'currents';
}

/* Translatable Strings */
$lang_cat = zl_option('lang_cat', __('Category:','zatolab'));
?>
		<!-- oooooooooooooooooooooooooooooooooo
			Profile
		oooooooooooooooooooooooooooooooooooo-->
		<div class="row">
			<div class="zl_profilebar singleprofbar">
				<br><br><br>
				<!-- oooooooooooooooooooooooooooooooooo
					Breadcrumbs
				oooooooooooooooooooooooooooooooooooo-->
				<div class="text-center">
					<?php zl_breadcrumbs();?>
				</div>
			</div><div class="clear"></div>
		</div>
		<div class="clear"></div>
		<!-- oooooooooooooooooooooooooooooooooo
			Post Entries
		oooooooooooooooooooooooooooooooooooo-->
		<section id="zl_content_entries">
			<div class="row">
				<div id="container" class="switchable-view <?php echo $containerclass; ?>" data-view="<?php echo $containerclass; ?>">
					<?php 
						get_template_part('content', 'notfound');
					?>
				</div>
			</div>
		</section>
		
		
		<!-- oooooooooooooooooooooooooooooooooo
			Pagination
		oooooooooooooooooooooooooooooooooooo-->
		
		<?php zl_pagination();?>
		
	<?php get_footer();?>