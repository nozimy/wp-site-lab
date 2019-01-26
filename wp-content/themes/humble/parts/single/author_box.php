<?php
/**
 * The template part to show author box.
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>
<div class="post-author">

	<?php echo get_avatar( get_the_author_meta('email'), '95' ); ?>

	<div class="author-detail">

		<strong><?php the_author_posts_link(); ?></strong>

		<p><?php echo get_the_author_meta('description'); ?></p>

		<div class="socials">

			<?php if(get_theme_mod('social_facebook')) : ?><a href="<?php echo esc_url(get_theme_mod('social_facebook')); ?>" target="_blank"><i class="fa fa-facebook"></i></a><?php endif; ?>
			<?php if(get_theme_mod('social_twitter')) : ?><a href="<?php echo esc_url(get_theme_mod('social_twitter')); ?>" target="_blank"><i class="fa fa-twitter"></i></a><?php endif; ?>
			<?php if(get_theme_mod('social_instagram')) : ?><a href="<?php echo esc_url(get_theme_mod('social_instagram')); ?>" target="_blank"><i class="fa fa-instagram"></i></a><?php endif; ?>
			<?php if(get_theme_mod('social_pinterest')) : ?><a href="<?php echo esc_url(get_theme_mod('social_pinterest')); ?>" target="_blank"><i class="fa fa-pinterest"></i></a><?php endif; ?>
			<?php if(get_theme_mod('social_google')) : ?><a href="<?php echo esc_url(get_theme_mod('social_google')); ?>" target="_blank"><i class="fa fa-google-plus"></i></a><?php endif; ?>
			<?php if(get_theme_mod('social_tumblr')) : ?><a href="<?php echo esc_url(get_theme_mod('social_tumblr')); ?>" target="_blank"><i class="fa fa-tumblr"></i></a><?php endif; ?>
			<?php if(get_theme_mod('social_youtube')) : ?><a href="<?php echo esc_url(get_theme_mod('social_youtube')); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a><?php endif; ?>
			<?php if(get_theme_mod('social_vimeo')) : ?><a href="<?php echo esc_url(get_theme_mod('social_vimeo')); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a><?php endif; ?>
			<?php if(get_theme_mod('social_dribbble')) : ?><a href="<?php echo esc_url(get_theme_mod('social_dribbble')); ?>" target="_blank"><i class="fa fa-dribbble"></i></a><?php endif; ?>
			<?php if(get_theme_mod('social_linkedin')) : ?><a href="<?php echo esc_url(get_theme_mod('social_linkedin')); ?>" target="_blank"><i class="fa fa-linkedin"></i></a><?php endif; ?>

		</div>

	</div>

</div><!-- Post Author -->
