<?php
/**
 * Widget : Popular Posts
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
class Humble_Widget_Popular_Posts extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'popular-posts-widget', // Widget ID
			esc_html__( 'Humble: Popular Posts', 'humble' ), // Widget Name.
			array(
				'classname'   => 'popular-posts-widget', // Widget Class.
				'description' => esc_html__( 'A widget that displays popular posts.', 'humble' ), // Widget Description.
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
 		$categories = $instance['categories'];
 		$number = $instance['number'];

 		$query = array(
			'showposts'   => $number,
			'nopaging'    => 0,
			'orderby'     => 'meta_value_num',
			'meta_key'    => 'post_views_count',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'cat' => $categories
		);
 		$loop = new WP_Query($query);
 		if ($loop->have_posts()) :

 		/* Before widget */
 		echo $before_widget;

 		/* Display the widget title if one was input. */
 		if ( $title )
 			echo $before_title . $title . $after_title;

 		?>

			<ul class="posts-widget">
			<?php  while ($loop->have_posts()) : $loop->the_post(); ?>
				<li>
					<div class="post-image">
						<a href="<?php echo esc_url(get_the_permalink()); ?>" rel="bookmark">
						<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
							<?php the_post_thumbnail('humble_small_thumb'); ?>
						<?php else: ?>
							<img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/no-thumb.png" alt="">
						<?php endif; ?>
						</a>
					</div>
					<div class="post-text">
						<?php the_title( sprintf( '<h4><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
						<span class="post-date"><?php the_time( get_option('date_format') ); ?></span>
					</div>
				</li>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</ul>

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
	    $instance['categories'] = $new_instance['categories'];
	    $instance['number'] = strip_tags( $new_instance['number'] );

	    return $instance;
	 }

	/**
	 * Outputs the settings form for the About me widget.
	 *
	 * @param array $instance Current settings.
	 */
	 function form( $instance ) {

 		/* Set up some default widget settings. */
 		$defaults = array( 'title' => 'Popular Posts', 'number' => 5, 'categories' => '');
 		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:','humble');?></label>
 			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
 		</p>
 		<p>
 		<label for="<?php echo $this->get_field_id('categories'); ?>"><?php esc_html_e('Filter by Category:','humble');?></label>
 		<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
 			<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php esc_html_e('All categories:','humble');?></option>
 			<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
 			<?php foreach($categories as $category) { ?>
 			<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
 			<?php } ?>
 		</select>
 		</p>
 		<p>
 			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e('Number of posts to show:', 'humble'); ?></label>
 			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
 		</p>
	<?php
	}
}

add_action( 'widgets_init',
	create_function( '', 'return register_widget( "Humble_Widget_Popular_Posts" );' )
);

?>
