<?php
/**
 * The template part for displaying standard post content
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12'); ?>>

	<div class="humble-post">

		<?php if(!get_theme_mod('post_cat')) : ?>

			<span class="cat"><?php the_category(' '); ?></span>

		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

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

		<?php if(has_post_thumbnail()) : ?>

			<div class="post-media"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_post_thumbnail('humble_base_thumb'); ?></a></div>

		<?php endif; ?>

		<div class="post-content">

			<?php if( get_theme_mod ('post_excerpt') == true ) : ?>

				<p><?php echo humble_string_limit_words(get_the_excerpt(), 70); ?>&hellip;</p>

			<?php else : ?>

				<?php the_content( '', TRUE ); ?>

			<?php endif; ?>

			<div class="read-more">

				<a class="btn" href="<?php echo esc_url(get_the_permalink()); ?>" title=""><?php echo _e('Continue Reading','humble'); ?></a>

			</div>

		</div>

		<div class="post-bottom">

			<?php if(!get_theme_mod('post_comments')) : ?>

			<span class="comment-count">

				<?php comments_number(esc_html__('No Comments','humble'), esc_html__('1 Comment','humble'), '% ' . esc_html__('Comments','humble') ); ?>

			</span>

			<?php endif; ?>

			<div class="socials">

				<?php if(!get_theme_mod('post_share')) : ?>

					<a href="http://twitter.com/home?status=<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i></a>

					<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-facebook"></i></a>

					<?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>

					<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_the_permalink()); ?>&media=<?php echo $pin_image; ?>" data-pin-do="none" target="_blank"><i class="fa fa-pinterest"></i></a>

				<?php endif; ?>

			</div>

		</div>

	</div><!-- Humble Post -->

</article>
