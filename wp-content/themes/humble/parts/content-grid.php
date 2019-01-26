<?php
/**
 * The template part for displaying grid post content
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
 
 $sidebar_class = get_theme_mod ('humble_sidebar');
 if ( $sidebar_class == 'no_sidebar' ) {
	 $grid_post_class = 'col-md-4 grid-post';
 } else {
     $grid_post_class = 'col-md-6 grid-post';
 }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $grid_post_class ); ?>>

	<div class="humble-post s2">

		<?php if(has_post_thumbnail()) : ?>

			<div class="post-media">

				<a href="<?php echo esc_url(get_the_permalink()); ?>">

					<?php the_post_thumbnail('humble_full_thumb'); ?>

				</a>

			</div>

		<?php endif; ?>

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

		<p><?php echo humble_string_limit_words(get_the_excerpt(), 30); ?>&hellip;</p>

	</div><!-- Humble Post -->

</article>
