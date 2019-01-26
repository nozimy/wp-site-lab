<?php
/**
 * Widget : About Author
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
class Humble_Widget_About_Author extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'about-widget', // Widget ID
			esc_html__( 'Humble: About Author', 'humble' ), // Widget Name.
			array(
				'classname'   => 'about-widget', // Widget Class.
				'description' => esc_html__( 'A widget that displays author information.', 'humble' ), // Widget Description.
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
 		$image = $instance['image'];
 		$author_name = $instance['author_name'];
 		$description = $instance['description'];
 		$author_link = $instance['author_link'];

 		/* Before widget */
 		echo $before_widget;

 		/* Display the widget title if one was input. */
 		if ( $title )
 			echo $before_title . $title . $after_title;

 		?>

 			<div class="about-widget">

 				<?php if($image) : ?>
 				<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_html($title); ?>" />
 				<?php endif; ?>

 				<?php if($author_name) : ?>
 				<h3><?php echo wp_kses_post($author_name); ?></h3>
 				<?php endif; ?>

 				<?php if($description) : ?>
 				<p><?php echo wp_kses_post($description); ?></p>
 				<?php endif; ?>

 				<?php if($author_link) : ?>
				<a href="<?php echo esc_url($author_link); ?>" title=""><?php esc_html_e('Read More','humble');?></a>
 				<?php endif; ?>

 			</div>

 		<?php

 		/* After widget (defined by themes). */
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
	    $instance['image'] = strip_tags( $new_instance['image'] );
	    $instance['author_name'] = $new_instance['author_name'];
	    $instance['description'] = $new_instance['description'];
	    $instance['author_link'] = strip_tags( $new_instance['author_link'] );

	    return $instance;
	 }

	/**
	 * Outputs the settings form for the About me widget.
	 *
	 * @param array $instance Current settings.
	 */
	 function form( $instance ) {

 		/* Set up some default widget settings. */
 		$defaults = array( 'title' => 'About Me', 'image' => '', 'author_name' => '', 'description' => '', 'author_link' => '');
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:','humble');?></label>
 			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e('Image URL:','humble');?></label>
 			<input id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" style="width:100%;" /><br />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'author_name' ); ?>"><?php esc_html_e('Author Name:','humble');?></label>
 			<input id="<?php echo $this->get_field_id( 'author_name' ); ?>" name="<?php echo $this->get_field_name( 'author_name' ); ?>" value="<?php echo $instance['author_name']; ?>" style="width:100%;" /><br />
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php esc_html_e('About me text:','humble');?></label>
 			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" style="width:95%;" rows="6"><?php echo $instance['description']; ?></textarea>
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'author_link' ); ?>"><?php esc_html_e('Author URL:','humble');?></label>
 			<input id="<?php echo $this->get_field_id( 'author_link' ); ?>" name="<?php echo $this->get_field_name( 'author_link' ); ?>" value="<?php echo $instance['author_link']; ?>" style="width:100%;" /><br />
 		</p>
	<?php
	}
}

add_action( 'widgets_init',
	create_function( '', 'return register_widget( "Humble_Widget_About_Author" );' )
);

?>
