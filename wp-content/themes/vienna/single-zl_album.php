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

$prev = get_adjacent_post(false, '', true);
$next = get_adjacent_post(false, '', false);
if (!empty($prev)) {
	$prevID = $prev->ID;
}
if (!empty($next)) {
	$newerID = $next->ID;
}
?>
<div class="zl_close_lightbox dashicons dashicons-no-alt"></div>
		<!-- oooooooooooooooooooooooooooooooooo
			Profile
		oooooooooooooooooooooooooooooooooooo-->
		<div class="row">
			<div class="zl_profilebar singleprofbar">
				<!-- pagination -->
				<div class="small-6 column postnav">
					<?php 
						if($prev) {
							$url = get_permalink($prev->ID); 
							echo '<a href="' . $url . '" class="tooltip" title="'.get_the_title($prev->ID).'" id="zl_older_post"><span class="dashicons dashicons-arrow-left"></span> '.zl_option('lang_prev_alb', __('Older Album','zatolab')).'</a>';
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
							echo '<a href="' . $url . '" class="tooltip" title="'.get_the_title($next->ID).'" id="zl_newer_alb">'.zl_option('lang_next_alb', __('Newer Album','zatolab')).' <span class="dashicons dashicons-arrow-right"></span></a>';
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
		<div class="clear albtop"></div>
		
		

		<div class="zlisportfolio zl_loop">
			<div class="row">
				<div class="large-12  text-center">
					<?php while (have_posts()) : the_post(); ?>
					<h1 class="entry-title"><?php the_title();?></h1>
					<p class="albumdate"><?php echo zl_option('lang_uploaded', __('Uploaded on ', 'zatolab')); ?> <?php the_date(); ?></p>
					<br>
					<?php endwhile; ?>
				</div>
			</div>
			<div class="clear"></div>
		


			<!-- oooooooooooooooooooooooooooooooooo
				Post Entries
			oooooooooooooooooooooooooooooooooooo-->
			<section id="zl_content_entries">
				<div class="row text-center sglalbm">
						<?php 
							global $post;
							while (have_posts()) : the_post(); 
							the_content(); 
								$albumlayout = vp_metabox('zl_album.albumtype');
								$attachment_ids = array();
								$pattern = get_shortcode_regex();
								$ids = array();

								if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) ) {   
									//finds the     "gallery" shortcode and puts the image ids in an associative array at $matches[3]
									$count=count($matches[3]);      //in case there is more than one gallery in the post.
									for ($i = 0; $i < $count; $i++){
									    $atts = shortcode_parse_atts( $matches[3][$i] );
									    if ( isset( $atts['ids'] ) ){
									    	$attachment_ids = explode( ',', $atts['ids'] );
									    	$ids = array_merge($ids, $attachment_ids);
									    }
									}
								}

								$photos = $ids;
								/*
								echo '<pre>';
								print_r($photos);
								echo '</pre>';
								*/
							?>
						<div class="clear"></div><br>
						<?php 
						if( 'justified' == $albumlayout ){
						 ?>

							<div class="swipeboxEx">
								<?php 
									foreach($photos as $photo) {
										$attimgurl   = wp_get_attachment_url($photo,'full');
										$imgsrc   = zl_theme_thumb($attimgurl, null, 150, 'c', true);
										//Output
										?>
										<a href="<?php echo get_attachment_link($photo); ?>" class="zl_zoom">
											<img src="<?php echo $imgsrc; ?>" alt="<?php echo get_the_title($photo); ?>" />
										</a>
								<?php }
								 ?>
							</div>

						<?php } else if ( 'square4col' == $albumlayout ) { ?>

							<div class="row albcols">
							<?php
								foreach($photos as $photo) {
								$attimgurl   = wp_get_attachment_url($photo,'full');
								$imgsrc   = zl_theme_thumb($attimgurl, 300, 300, 'c', true);
							 ?>
								<div class="albumsquare">
									<div class="zl_fourcolphoto">
										<img src="<?php echo $imgsrc; ?>" alt="<?php echo get_the_title($photo); ?>" />
										<div class="zl_alb_overlay">
											<div class="zl_alb_zoom">
												<a href="<?php echo get_attachment_link($photo); ?>" class="zl_zoom">
													<span class="dashicons dashicons-external"></span>
												</a>
											</div>
											<div class="zl_alb_likebox">
												<?php echo getPostLikeLink( $photo );?>
												<span class="dashicons dashicons-admin-comments"></span> 
												<?php echo get_comments_number( $photo ); ?>
											</div>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							<?php } ?>
							</div>

						<?php } else { ?>
							<div class="swipeboxEx">
								<?php 
									foreach($photos as $photo) {
										$attimgurl   = wp_get_attachment_url($photo,'full');
										$imgsrc   = zl_theme_thumb($attimgurl, null, 150, 'c', true);
										//Output
										?>
										<a href="<?php echo get_attachment_link($photo); ?>" class="zl_zoom">
											<img src="<?php echo $imgsrc; ?>" alt="<?php echo get_the_title($photo); ?>" />
										</a>
								<?php }
								 ?>
							</div>
						<?php }  ?>
						<?php endwhile; ?>
				</div>
			</section>
		</div>
		<!-- oooooooooooooooooooooooooooooooooooo
		Comments Section
		oooooooooooooooooooooooooooooooooooo -->
		<div class="clear"></div>
		<section id="zl_comments">
			<div class="row">
				<?php 
					if ( comments_open() ) {
						//get_template_part('inc/parts/comments');
						comments_template();
					}
				?>
			</div>
		</section>
		
	<?php get_footer();?>