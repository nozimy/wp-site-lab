<?php
/**
 * The template part for displaying single post content
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post-page'); ?>>

	<div class="humble-post">

		<?php if(!get_theme_mod('post_cat')) : ?>

			<span class="cat"><?php the_category(' '); ?></span>

		<?php endif; ?>

		<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>

		<ul class="meta">

			<?php if(!get_theme_mod('post_author')) : ?>

				<li><?php esc_html_e( 'By', 'humble' ); ?> <?php the_author_posts_link(); ?></li>

			<?php endif; ?>

			<?php if(!get_theme_mod('post_date')) : ?>

            	<li><?php the_time( get_option('date_format') ); ?></li>

            <?php endif; ?>

			<?php if (is_sticky()) : ?>

			    <li>
			        <?php $sticky_text = get_theme_mod('sticky_text'); ?>

			        <?php if($sticky_text) : ?>

			            <?php echo esc_html( $sticky_text );  ?>

			        <?php else: ?>

			            <?php echo esc_html_e('Sticky','humble'); ?>

			        <?php endif; ?>

			    </li>

			<?php endif; ?>

		</ul>

		<?php if(has_post_format('gallery')) : ?>

			<?php $images = rwmb_meta( 'humble_gallery_format', 'type=image&size=humble_base_thumb' ); ?>

			<div class="post-media">

				<div class="single-post-slider">

					<?php foreach ( $images as $image ) {

						echo "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";

					} ?>

				</div>

			</div>

		<?php elseif(has_post_format('audio')) : ?>

			<?php $humble_audio = get_post_meta( $post->ID, 'humble_audio_format', true ); ?>

			<div class="post-media audio">

				<?php if(wp_oembed_get( $humble_audio )) : ?>

					<?php echo wp_oembed_get($humble_audio); ?>

				<?php else : ?>

					<?php echo $humble_audio; ?>

				<?php endif; ?>

			</div>

		<?php elseif(has_post_format('video')) : ?>

			<?php $humble_video = get_post_meta( $post->ID, 'humble_video_format', true ); ?>

			<div class="post-media video">

				<?php if(wp_oembed_get( $humble_video )) : ?>

					<?php echo wp_oembed_get($humble_video); ?>

				<?php else : ?>

					<?php echo $humble_video; ?>

				<?php endif; ?>

			</div>

		<?php elseif(has_post_format('link')) : ?>

			<?php $humble_link = get_post_meta( $post->ID, 'humble_link_format', true ); ?>

	        <div class="post-media">

			<?php if(has_post_thumbnail()) : ?>

				<?php the_post_thumbnail('humble_base_thumb'); ?>

			<?php else : ?>

				<img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/no-image.png" alt="">

			<?php endif; ?>

				<div class="link-post">

					<a href="<?php echo esc_url($humble_link); ?>" title="">

						<?php echo esc_url($humble_link); ?>

					</a>

				</div>

			</div>

		<?php else : ?>

			<?php if(has_post_thumbnail()) : ?>

	        <div class="post-media">

				<?php the_post_thumbnail('humble_base_thumb'); ?>

			</div>

	        <?php endif; ?>

		<?php endif; ?>

		<div class="post-content">

            <?php the_content();?>

    		<?php
              wp_link_pages( array(
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'humble' ),
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
              ) );
            ?>

		</div>

		<div class="post-bottom">

            <?php if(!get_theme_mod('post_tags')) : ?>

	            <?php if(has_tag()) : ?>

	                <div class="post-tags">

	                    <?php the_tags("",""); ?>

	                </div>

	            <?php endif; ?>

            <?php endif; ?>

			<div class="socials">

				<?php if(!get_theme_mod('post_share')) : ?>

					<a href="http://twitter.com/home?status=<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i></a>

					<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-facebook"></i></a>

					<?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>

					<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_the_permalink()); ?>&media=<?php echo $pin_image; ?>" data-pin-do="none" target="_blank"><i class="fa fa-pinterest"></i></a>

				<?php endif; ?>

			</div>

		</div><!-- Post Bottom -->

	</div><!-- Humble Post -->

    <?php if(!get_theme_mod('author_box')) : ?>

        <?php get_template_part('parts/single/author_box'); ?>

    <?php endif; ?>

    <?php if(!get_theme_mod('related_posts')) : ?>

        <?php get_template_part('parts/single/related_posts'); ?>

    <?php endif; ?>

    <?php comments_template( '', true );  ?>

</article>
