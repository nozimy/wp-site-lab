<?php
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class zl_flickr_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function zl_flickr_Widget() {
        $widget_ops = array( 'classname' => 'zl_flickr_Widget', 'description' => 'Display Flickr Widget by ID. You can manage how much the item that\'ll be displayed' );
        $this->WP_Widget( 'zl_flickr_Widget', '&raquo; zl Flickr', $widget_ops );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $userid = empty($instance['userid']) ? ' ' : apply_filters('widget_title', $instance['userid']);
    	$fetch = empty($instance['fetch']) ? ' ' : apply_filters('widget_title', $instance['fetch']);


        echo $before_widget;
        echo $before_title;
        echo $title; // Can set this with a widget option, or omit altogether
        echo $after_title;

    //
    // Widget display logic goes here
    //
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
/* Here We Go, BUild the Gate to prevent headache to find out which the Output*/
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
?>
	<div class="flickr">
        <div class="flickrdom" data-id="<?php echo $userid; ?>" data-itemfetch="<?php echo $fetch; ?>"></div>     
    </div>


<?php

echo $after_widget;
}
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
/* </END of: Here We Go, BUild the Gate to prevent headache to find out which the Output*>
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        // update logic goes here
        $updated_instance = $new_instance;

        $instance['title'] = $new_instance['title'];
        $instance['userid'] = $new_instance['userid'];
    	$instance['fetch'] = $new_instance['fetch'];

        return $updated_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, 
        	array( 
        		'title' => null,
                'userid' => null,
        		'fetch' => null
        	));
        $title = $instance['title'];
        $userid = $instance['userid'];
    	$fetch = $instance['fetch'];
        // display field names here using:
        // $this->get_field_id( 'option_name' ) - the CSS ID
        // $this->get_field_name( 'option_name' ) - the HTML name
        // $instance['option_name'] - the option value
        ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
			Title
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		<p>
            <label for="<?php echo $this->get_field_id('userid'); ?>">
            User ID
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('userid'); ?>" name="<?php echo $this->get_field_name('userid'); ?>" value="<?php echo esc_attr($userid); ?>" />
            </label>
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('fetch'); ?>">
			Items to Fetch
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('fetch'); ?>" name="<?php echo $this->get_field_name('fetch'); ?>" value="<?php echo esc_attr($fetch); ?>" />
			</label>
		</p>
        

        <?php
    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'zl_flickr_Widget' );" ) );