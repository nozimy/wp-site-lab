<?php 
/* Template name: Portfolio 2 Columns */
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
		

		<div class="zlisportfolio zl_loop">
			<div class="row">
				<div class="large-12  text-center">
					<header>
						<h1 class="entry-title text-center"><?php the_title();?></h1>
					</header>
					<div class="zlportdesc">
						<?php 
						$post = get_post($post->ID); 
						$content = apply_filters('the_content', $post->post_content); 
						echo $content;  
						?>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="row">
				<div class="large-12">
					<div id="zl_ajax_content">
						
					</div>
					<div class="clear"></div>
				</div>
			</div>
		
			<!-- oooooooooooooooooooooooooooooooooo
				Post Entries
			oooooooooooooooooooooooooooooooooooo-->
			<section id="zl_content_entries">
				<div class="row">
					<div id="source">
						<a href="#" class="current" data-filter="*">All</a>
						<?php 
							$taxonomies = array( 
							    'project_types'
							);

							$args = array(
							    'orderby'       => 'count', 
							    'order'         => 'DESC',
							    'hide_empty'    => true, 
							); 
							$terms = get_terms( $taxonomies, $args );
							/*
							echo "<pre>";
							print_r($terms);
							echo "</pre>";
							*/	
							foreach ($terms as $term) {
								echo '<a href="#" data-filter="'.$term->slug.'" class="tooltip" title="'.$term->count.'">'.$term->name.'</a>';
							}
						 ?>
					</div>
					<div class="row">
						<div class="portfolioContainer">
							<?php
								global $wp_query;
								$args = array(
									'post_type' => 'zl_portfolio',
									'post_status' => 'publish',
									'orderby' => 'DATE',
									'order' => 'DESC',
									'paged' => $pageds,
									'posts_per_page' => -1,
									'ignore_sticky_posts' => 1,
								  );
							   $porto = new WP_Query($args);
							?>
							<?php if($porto->have_posts()) : ?><?php while($porto->have_posts()) : 
							$porto->the_post(); 
								//Let's Generate the Thumbnail.
								$thumb = get_post_thumbnail_id();
								$img_url = wp_get_attachment_url( $thumb,'full' ); 
								$image = zl_theme_thumb($img_url, 500, 400, 'c', true);
								$terms = get_the_terms( get_the_ID(), 'project_types' ); 

							?>
								<!-- Portfolio Loop -->
								<div class="zl_porto_itemwrap large-6 column <?php foreach( $terms as $term ) { echo $term->slug.' '; } ?>">
									<div class="zl_porto_inner">
										<?php
											if ($image) {
												echo '<img src="' . $image . '" alt="'.get_the_title().'" />';
											} 
										?>
										<div class="zl_porto_thumb">
											<h2 class="entry-title portotitle"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="ajaxLink" data-id="<?php the_ID(); ?>"><?php the_title(); ?></a></h2>
											<p class="zl_porto_desc"><?php /*echo substr(get_the_excerpt(), 0,50).'...'*/ foreach( $terms as $term ) { echo $term->slug.' '; }  ?></p>
											<a href="<?php echo $img_url; ?>" class="portozoom" rel="portfolio"><span class="dashicons dashicons-external"></span></a>
											<a href="<?php the_permalink(); ?>" class="ajaxLink portolink" data-id="<?php the_ID(); ?>"><span class="dashicons dashicons-admin-links"></span></a>
										</div>
									</div>
								</div><!-- // .zl_porto_itemwrap large-4 Album Loop -->
							<?php endwhile; endif; ?>
							
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</section>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>

		<?php 
		if (function_exists('zl_pagination')){
			zl_pagination($pages = $porto->max_num_pages);
		} else {
			posts_nav_link();
		}
		 ?>

	<?php get_footer();?>