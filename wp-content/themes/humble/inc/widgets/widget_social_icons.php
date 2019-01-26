<?php
/**
 * Widget : Social Icons
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Core class used to implement a About Author widget.
 *
 * @see WP_Widget
 */
class Humble_Widget_Social_Icons extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'social-icons-widget', // Widget ID
			esc_html__( 'Humble: Social Icons', 'humble' ), // Widget Name.
			array(
				'classname'   => 'social-icons-widget', // Widget Class.
				'description' => esc_html__( 'A widget that displays social media icons.', 'humble' ), // Widget Description.
			)
		);
	}

	/**
	 * Outputs the content for the current About me widget instance.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Archives widget instance.
	 */
 	function widget( $args, $instance ) {
 		extract( $args );

 		/* Our variables from the widget settings. */
 		$title = apply_filters('widget_title', $instance['title'] );

 		/* Before widget */
 		echo $before_widget;

 		/* Display the widget title if one was input. */
 		if ( $title )
 			echo $before_title . $title . $after_title;

 		?>

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
				<?php if(get_theme_mod('social_bloglovin')) : ?><a href="<?php echo esc_url(get_theme_mod('social_bloglovin')); ?>" target="_blank"><i class="fa fa-heart"></i></a><?php endif; ?>
				<?php if(get_theme_mod('social_vk')) : ?><a href="<?php echo esc_url(get_theme_mod('social_vk')); ?>" target="_blank"><i class="fa fa-vk"></i></a><?php endif; ?>
				<?php if(get_theme_mod('social_etsy')) : ?><a href="<?php echo esc_url(get_theme_mod('social_etsy')); ?>" target="_blank"><i class="fa fa-etsy"></i></a><?php endif; ?>

 			</div>

 		<?php

 		/* After widget */
 		echo $after_widget;
 	}


	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options.
	 *
	 * @param array $old_instance The previous options.
	 *
	 * @return array
	 */

	 function update( $new_instance, $old_instance ) {
	    $instance = $old_instance;

	    /* Strip tags for title and name to remove HTML (important for text inputs). */
	    $instance['title'] = strip_tags( $new_instance['title'] );

	    return $instance;
	 }

	/**
	 * Outputs the settings form for the About me widget.
	 *
	 * @param array $instance Current settings.
	 */
	 function form( $instance ) {

 		/* Set up some default widget settings. */
 		$defaults = array( 'title' => 'Follow Me');
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

 		<p>
 			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_html_e('Title:', 'humble'); ?></label>
 			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
 		</p>
	<?php
	}
}

add_action( 'widgets_init',
	create_function( '', 'return register_widget( "Humble_Widget_Social_Icons" );' )
);

?>
