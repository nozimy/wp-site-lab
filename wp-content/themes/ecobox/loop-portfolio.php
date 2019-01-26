<?php
//Theme Options vars
global $ecobox_data;
$filter   = $ecobox_data['opt-portfolio-filter'];
$count    = $ecobox_data['opt-portfolio-num'];
$title    = $ecobox_data['opt-portfolio-meta'];
$lightbox = $ecobox_data['opt-portfolio-lightbox'];
?>

<?php if($filter == 1) { ?> 
<!-- Gallery Filter -->
<ul class="gallery-filter">
	<li><a href="#" class="current" data-filter="*"><?php _e( 'All', 'ecobox' ); ?></a></li>
	<?php 
	$portfolio_categories = get_categories(array('taxonomy'=>'portfolio_category'));
	foreach($portfolio_categories as $portfolio_category)
		echo '<li><a href="#" data-filter=".'.$portfolio_category->slug.'">' . $portfolio_category->name . '</a></li>';
	?>
</ul>
<!-- Gallery Filter / End -->
<?php } ?>

<?php global $more;	$more = 0;

$grid    = "";
$imgsize = "";
if ( is_page_template('template-portfolio-2cols.php') ) {
	$grid    = "gallery-list__2cols";
	$imgsize = "portfolio-lg";
} elseif (is_page_template('template-portfolio-4cols.php') ) {
	$grid    = "gallery-list__4cols";
	$imgsize = "portfolio-n";
} else {
	$grid    = "gallery-list__3cols";
	$imgsize = "portfolio-n";
}
?>

<?php
// Category 
$values = get_post_custom_values("category"); $cat=$values[0];
$catinclude = 'portfolio_category='. $cat; ?>

<?php 
// Loop
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query(); ?>
<?php $wp_query->query("post_type=portfolio&".$catinclude."&paged=".$paged.'&showposts='.$count); ?>
<?php if ( ! have_posts() ) : ?>
<div class="error404 not-found">
	<h2><?php _e( 'Not Found', 'ecobox' ); ?></h2>
	<div>
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'ecobox' ); ?></p>
		<div class="row">
			<div class="col-md-4"><?php get_search_form(); ?></div>
		</div>
	</div><!-- .entry-content -->
</div><!-- #post-0 -->
<?php endif; ?>


<!-- Gallery -->
<ul class="gallery-list <?php echo $grid; ?>">
	<?php while ( have_posts() ) : the_post(); 

	$portfolio_terms = wp_get_object_terms($post->ID, 'portfolio_category');
	$portfolio_class = "folioItem " . $portfolio_terms[0]->slug;
	$portfolio_sort  = $portfolio_terms[0]->slug . '[1][0]';
	$portfolio_type  = $portfolio_terms[0]->slug;
	
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $imgsize);
	?>
   <li class="gallery-item <?php foreach( $portfolio_terms as $portfolio_class ) { echo $portfolio_class->slug.' ';} ?>">
			
		<?php if($lightbox == 0) { //Disabled lightbox ?>

			<?php if(has_post_thumbnail()): ?>
			<figure class="gallery-thumb">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<img src="<?php echo $image[0] ?>" alt="" />
				</a>
			</figure>
			<?php endif; ?>
			
		<?php } else { //Enabled lightbox ?>
			
			<?php if(has_post_thumbnail()): ?>
			<figure class="gallery-thumb">
				<a href="<?php echo $img_url; ?>" title="<?php the_title_attribute(); ?>" class="magnific-img">
					<img src="<?php echo $image[0] ?>" alt="" />
					<span class="thumbnail-caption-inner">
						<span class="line line__left"></span>
						<i class="fa fa-search fa-2x"></i>
						<span class="line line__right"></span>
					</span>
				</a>
			</figure>
			<?php endif; ?>
			
		<?php } ?>
		
		
		<div class="gallery-caption">
			<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>

			<?php if($title == "1") { ?>
			<span class="date">
				<?php the_time(get_option('date_format')); ?>
			</span>
			<?php } ?>
			
		</div>
   </li>
 <?php endwhile; ?>
</ul>
<!-- Gallery / End -->

<!-- Pagination -->
<?php ecobox_pagination(); ?>
<!-- /Pagination -->

<?php $wp_query = null; $wp_query = $temp;?>