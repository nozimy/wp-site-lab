<?php 
	/* Template name: Archive */
	get_header();
	
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
				/*if($prev) {
					$url = get_permalink($prev->ID); 
					echo '<a href="' . $url . '" class="tooltip" title="'.get_the_title($prev->ID).'" id="zl_older_post"><span class="dashicons dashicons-arrow-left"></span> '.zl_option('lang_older_page', __('Older Page','zatolab')).'</a>';
				}*/
				?>
			&nbsp;
		</div>
		<!-- Next Post -->
		<div class="small-6 column text-right postnav">
			&nbsp;
			<?php /*
				if($next){
					$url = get_permalink($next->ID);            
					echo '<a href="' . $url . '" class="tooltip" title="'.get_the_title($next->ID).'" id="zl_newer_post">'.zl_option('lang_newer_page', __('Newer Page','zatolab')).' <span class="dashicons dashicons-arrow-right"></span></a>';
				} */
				?>
		</div>
		<div class="clear"></div>
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
				<div class="post">
					<div class="zl_loop">
						<header class="pg_ttl_hdr">
							<h1 class="entry-title text-center"><?php the_title(); ?></h1>
						</header>
						<div class="zl_post_detail row">
							<?php while (have_posts()) : the_post(); ?>
							<div class="large-12 column">
								<?php the_content(); ?>
							</div>
							<div class="clear"></div>
							<br><br>
							<?php endwhile; ?>
							
							<div class="clear"></div>
							<div class="zl_archives">
								<?php /*
								<div class="medium-4 column">
									<h4>Archives by Year</h4>
									<ul>
										<?php wp_get_archives('type=yearly'); ?>
									</ul>
								</div>
								<div class="medium-4 column">
									<h4>Archives by Month</h4>
									<ul>
										<?php wp_get_archives('type=monthly'); ?>
									</ul>
								</div>
								<div class="medium-4 column">
									<h4>Archives by Categories</h4>
									<ul>
										<?php wp_list_categories('title_li=0'); ?>
									</ul>
								</div>
								<div class="clear"></div><br>
								<div class="medium-4 column">
									<h4>Archives by Tags</h4>
									<?php 
										$terms = get_terms( 'post_tag' );
										echo '<ul>';
										foreach ( $terms as $term ) {
										    // The $term is an object, so we don't need to specify the $taxonomy.
										    $term_link = get_term_link( $term );
										    // If there was an error, continue to the next term.
										    if ( is_wp_error( $term_link ) ) {
										        continue;
										    }
										    // We successfully got a link. Print it out.
										    echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';
										}
										echo '</ul>';
									 ?>
								</div>
								<div class="medium-4 column">
									<h4>Portfolio Archives</h4>
									<ul>
										<?php
											global $wp_query;
											$args = array(
												'post_type' => 'zl_portfolio',
												'post_status' => 'publish',
												'orderby' => 'DATE',
												'order' => 'DESC',
												'posts_per_page' => -1,
												'ignore_sticky_posts' => 1,
											  );
										   $porto = new WP_Query($args);
										?>
										<?php if($porto->have_posts()) : ?><?php while($porto->have_posts()) : 
										$porto->the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
										<?php endwhile; endif; wp_reset_postdata(); ?>
									 </ul>
								</div>
								<div class="medium-4 column">
									<h4>Album Archives</h4>
									<ul>
										<?php
											global $wp_query;
											$args = array(
												'post_type' => 'zl_album',
												'post_status' => 'publish',
												'orderby' => 'DATE',
												'order' => 'DESC',
												'posts_per_page' => -1,
												'ignore_sticky_posts' => 1,
											  );
										   $porto = new WP_Query($args);
										?>
										<?php if($porto->have_posts()) : ?><?php while($porto->have_posts()) : 
										$porto->the_post(); ?>
										<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
										<?php endwhile; endif; wp_reset_postdata(); ?>
									 </ul>
								</div>
								*/?>
							</div>
							<div class="clear"></div>
							<div class="large-12 column">
								<hr>
							</div>
							<div class="monthlygroup">
								<?php
									// set up our archive arguments
									$archive_args = array(
									  'post_type' => 'post',    // get only posts
									  'posts_per_page'=> -1   // this will display all posts on one page
									);
									// new instance of WP_Quert
									$archive_query = new WP_Query( $archive_args );
								?>
								<?php $date_old = "";  ?>
								<?php 
								$i=1;
								while ( $archive_query->have_posts() ) : $archive_query->the_post(); ?>
								<?php $date_new = get_the_time("F Y");  ?>
								<?php if ( $date_old != $date_new ) { ?>
								<div class="hoho">
									<div class="monthead large-12 column">
										<h2><?php echo $date_new; ?></h2>
									</div>
									<div class="clear"></div>
								<?php } ?>
								<article <?php post_class('medium-6 column left');  ?>>
									<div class="zl_archive_post">
										<h4><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<span><?php the_time("jS M, Y"); ?></span>
									</div>
								</article>
								<?php if ( $date_old != $date_new ) { ?>
								</div>
								<?php } ?>
								<?php $date_old = $date_new; // update $date_old ?>
								
								<?php 
								$i++;
								endwhile; // end the custom loop ?>
								<?php wp_reset_postdata();  ?>
							</div>
							<div class="clear"></div>
							


						</div>
					</div> <!-- .zl_loop -->
				</div>
		</div> <!-- .row -->
	</div> <!-- #container -->
</section> <!-- zl_content_entries -->
<div class="clear"></div>

<?php get_footer();?>