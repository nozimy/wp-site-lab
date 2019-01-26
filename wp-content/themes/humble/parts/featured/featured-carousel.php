<?php
/**
 * The template part to show featured carousel.
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>
<div class="featured section">

	<div class="block no-padding">

		<div class="humble-slider style2">

			<?php

			$slider_qty = get_theme_mod( 'featured_qty' );

			$args = array(

				'post_type'      => 'post',
				'posts_per_page' => $slider_qty,
				'ignore_sticky_posts' => '1',
			    'meta_query' => array(
				    array(
					    'key'       => 'humble__featured',
						'value'     => '1',
						'compare'   => '=',
					),
				),
			);

			?>
			<?php $query = new WP_Query( $args ); ?>

			<?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>

			<div class="humble-slide">

				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>

                <?php $featured_image =  aq_resize($image[0],634,455,true,true,true); ?>

				<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php the_title(); ?>"/>

				<div class="slide-title">

					<?php if(!get_theme_mod('post_cat')) : ?>

						<span class="cat"><?php the_category(' '); ?></span>

					<?php endif; ?>

					<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				</div>

			</div>

			<?php endwhile; wp_reset_postdata(); ?>

			<?php endif; ?>

		</div>

	</div>

</div>
