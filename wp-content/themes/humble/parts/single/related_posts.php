<?php
/**
 * The template part to show related posts.
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
$orig_post = $post;

global $post;

$categories = get_the_category($post->ID);

if ($categories) {

	$category_ids = array();

	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

	$args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => 3,
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand'
	);

	$hb_query = new wp_query( $args );

	if( $hb_query->have_posts() ) { ?>

		<div class="related-posts">

			<h5 class="short-title"><?php echo esc_html_e('You May Also Like', 'humble'); ?></h5>

			<div class="row">

			<?php while( $hb_query->have_posts() ) { $hb_query->the_post();?>

				<div class="col-md-4">

					<div class="related">

						<?php the_post_thumbnail('humble_base_thumb'); ?>

						<?php the_title( sprintf( '<h5 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>

						<?php if(!get_theme_mod('post_date')) : ?>

							<span class="post-date"><?php the_time( get_option('date_format') ); ?></span>

						<?php endif; ?>

					</div>

				</div>

			<?php } ?>

			</div>

		</div>

    <?php
	}
}
$post = $orig_post;
wp_reset_postdata();
?>
