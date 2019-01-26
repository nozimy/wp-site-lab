<?php get_header(); ?>

<?php global $ecobox_data;

$portfolio_content  = 'col-md-8';
$portfolio_info     = 'col-md-4';

if($ecobox_data['opt-portfolio-layout'] == 2) {
	$portfolio_content  = 'col-md-8 col-md-push-4';
	$portfolio_info     = 'col-md-4 col-md-pull-8';
} elseif ($ecobox_data['opt-portfolio-layout'] == 3) {
	$portfolio_content  = 'col-md-12';
	$portfolio_info     = 'col-md-12';
} elseif ($ecobox_data['opt-portfolio-layout'] == 4) {
	$portfolio_content  = 'col-md-4 gallery-figure__floated';
	$portfolio_info     = 'gallery-description__floated';
}

// Grab Gallery IDs
$gallery_ids        = get_post_meta(get_the_ID(), 'ecobox_format_gallery_id', true);
$gallery_ids_array  = array_map( 'trim', explode( ',', $gallery_ids ) );?>

<!-- Loop -->
<?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="row">
	
	<div class="<?php echo $portfolio_content; ?>">

		<?php if($ecobox_data['opt-portfolio-nav'] == 1) : ?>
		<nav class="project-nav clearfix">
			
			<?php if( get_previous_post() ) : ?>
			<span class="prev pull-left"><?php previous_post_link('&larr; %link') ?></span>
			<?php endif; ?>
			
			<?php if( get_next_post() ) : ?>
			<span class="next pull-right"><?php next_post_link('%link &rarr;') ?></span>
			<?php endif; ?>

		</nav>
		<?php endif; ?>

		<?php if ( $gallery_ids !="" ) { ?>

			<!-- Gallery -->
			<!-- <div class="prev-next-holder pull-right hidden-xs">
				<a class="prev-btn" id="portfolio-carousel-prev"></a>
				<a class="next-btn" id="portfolio-carousel-next"></a>
			</div> -->
			<div class="owl-carousel owl-theme" id="portfolio-carousel">
				<?php 
				$args = array(
					'post_type'      => 'attachment',
			    'post_mime_type' => 'image',
			    'post_status'    => 'inherit',
			    'posts_per_page' => -1,
					'post__in'       => $gallery_ids_array
				);
				$attachments = get_posts($args); ?>

				<?php if ($attachments) : ?>

				<?php foreach ($attachments as $attachment) : ?>

				<?php $attachment_image = wp_get_attachment_image_src($attachment->ID, 'thumbnail-lg'); ?>
				<?php $full_image = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
				<?php $attachment_data = wp_get_attachment_metadata($attachment->ID); ?>
				
				<div class="item thumbnail">
					<img src="<?php echo $attachment_image[0]; ?>" alt="<?php echo $attachment->post_title; ?>" />
				</div>

				<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<!-- /Gallery -->

			<script>
				jQuery(document).ready(function() {
					jQuery("#portfolio-carousel").owlCarousel({
						navigation : false,
			      slideSpeed : 300,
			      paginationSpeed : 400,
			      singleItem:true
					});

					// jQuery("#portfolio-carousel-next").click(function(){
					// 	jQuery("#portfolio-carousel").trigger("owl.next");
					// });
					// jQuery("#portfolio-carousel-prev").click(function(){
					// 	jQuery("#portfolio-carousel").trigger("owl.prev");
					// });
				});
			</script>

		<?php } else {

			if( has_post_thumbnail() ) {
				$thumb    = get_post_thumbnail_id();
				$img_url  = wp_get_attachment_url( $thumb,'full'); //get img URL
				$image    = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portfolio-xlg');

				echo '<figure class="thumbnail">';
					echo '<img src="'. $image[0] .'" alt="'. get_the_title() .'" />';
				echo '</figure>';
			}

		} ?>
	</div>
	
	<!-- Project Description -->
	<div class="gallery-description <?php echo $portfolio_info; ?>">
		<?php the_content(); ?>
	</div>
</div>
<?php endwhile; endif; ?>
<!-- Loop / End -->


<?php if($ecobox_data['opt-portfolio-related'] == 1) : ?>
<div class="hr hr__two-half">
	<div class="left-hr"></div>
	<div class="right-hr"></div>
</div>

<!-- Related Projects -->
<h3 class="bold"><?php echo $ecobox_data['opt-portfolio-related-title']; ?></h3>

<!-- Gallery -->
<ul class="gallery-list gallery-list__4cols">
	<?php
	//Get array of terms
	$terms = get_the_terms( $post->ID , 'portfolio_category');
	//Pluck out the IDs to get an array of IDS
	$term_ids = array_values(wp_list_pluck($terms,'term_id'));

	//Query posts with tax_query. Choose in 'IN' if want to query posts with any of the terms
	//Chose 'AND' if you want to query for posts with all terms
	$second_query = new WP_Query( array(
		'post_type'           => 'portfolio',
		'tax_query'           => array(
			array(
				'taxonomy'  => 'portfolio_category',
				'field'     => 'id',
				'terms'     => $term_ids,
				'operator'  => 'IN' //Or 'AND' or 'NOT IN'
			)),
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => 1,
		'orderby'             => 'rand',
		'post__not_in'        => array($post->ID),
	));

	//Loop through posts and display...
	if($second_query->have_posts()) {
	while ($second_query->have_posts() ) : $second_query->the_post();

	$thumb   = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
	$image   = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portfolio-n'); ?>

	<li class="gallery-item">
		<?php if(has_post_thumbnail()): ?>
		<figure class="gallery-thumb">
			<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0] ?>" alt="" /></a>
		</figure>
		<?php endif; ?>
		<div class="gallery-caption">
			<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<span class="date">
				<?php the_time(get_option('date_format')); ?>
			</span>
		</div>
	</li>
	<?php endwhile; wp_reset_query(); } ?>
</ul>
<!-- Related Projects / End -->
<?php endif; ?>

<?php get_footer(); ?>