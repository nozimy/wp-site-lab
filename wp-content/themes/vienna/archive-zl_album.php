<?php 
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
					Wow, such album
				</div>
				
				<!-- Sorter -->
				<div class="small-6 column text-right sorter postnav">
					Wow
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
			<div class="large-12  text-center">
				<h1><?php echo zl_option('lang_albums', __('Albums','zatolab'));?></h1>
				<br>
			</div>
		</div>
		<div class="clear"></div>
		


		<!-- oooooooooooooooooooooooooooooooooo
			Post Entries
		oooooooooooooooooooooooooooooooooooo-->
		<section id="zl_content_entries">
			<div class="row" id="container">
				<div class="row" id="zl_albums">

					<?php
						$args = array(
							'post_type' => 'zl_album',
							'post_status' => 'publish',
							'orderby' => 'DATE',
							'order' => 'DESC',
							'paged' => $pageds,
							'ignore_sticky_posts' => 1,
						  );
					   $browse = new WP_Query($args);
					?>
					<?php if($browse->have_posts()) : ?><?php while($browse->have_posts()) : 
					$browse->the_post(); 
						//Let's Generate the Thumbnail.
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full' ); 
						$image = zl_theme_thumb($img_url, 225, 225, 'c', true);

						//Define Gallery Images
						$gallery = get_post_gallery_images();
						//Count Items
						$items = count($gallery);
						//Get First Item if featured image isn't set.
						$firstimg = reset($gallery);
						//Crop the first image.
						$firstimg = zl_theme_thumb($firstimg, 225, 225, 'c', true);
					?>
						<!-- Album Loop -->
						<div class="zl_album_parent large-3 column">
							<div class="zl_album" data-albumlink='<?php the_permalink(); ?>' data-albumid="<?php the_ID();?>">
								<div class="zl_albumthumb">
									<?php
										if ($image) {
											echo '<img src="' . $image . '" alt="'.get_the_title().'" />';
										} else {
											echo '<img src="' . $firstimg . '" alt="'.get_the_title().'" />';
										}
									?>

									<a href="<?php the_permalink();?>" class="zl_alb_title"><span><span><?php the_title();?></span></span></a>	
									<span class="zl_album_photos_num">
										<span>
											<span>
												<?php echo $items . zl_option('lang_photos', __(' Photos','zatolab')) ;?>
											</span>
										</span>
									</span>
									<div class="zl_alborder"></div>
								</div>
							</div>
						</div><!-- // .zl_album_parent large-3 Album Loop -->
					<?php endwhile; endif; ?>
					
					
					
				</div>
			</div>
		</section>
		
	<?php get_footer();?>