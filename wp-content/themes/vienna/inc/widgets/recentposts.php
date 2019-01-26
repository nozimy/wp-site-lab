<?php
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class zl_recent_post_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function zl_recent_post_Widget() {
        $widget_ops = array( 'classname' => 'zl_recent_post_Widget', 'description' => 'Display Most Recent Posts' );
        $this->WP_Widget( 'zl_recent_post_Widget', '&raquo; zl Recent Posts', $widget_ops );
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
   
	<?php 
        global $post;
         /**
         * The WordPress Query class.
         * @link http://codex.wordpress.org/Function_Reference/WP_Query
         *
         */
        $args = array(
            'posts_per_page' => $fetch,          
            'ignore_sticky_posts' => 1,          
        );
    $recentposts = new WP_Query( $args );
    if($recentposts->have_posts()):
        echo '<ul class="row zl_recentpost_widget">';
        while($recentposts->have_posts()):
        $recentposts->the_post(); 
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url( $thumb,'full' ); 
        $image = zl_theme_thumb($img_url, 50, 50, 'c', true);
    ?>
        <li>
            <div class="row">
                    <?php 
                    if($image){
                        echo '<div class="small-3 columns">';
                        echo '<img src="'.$image.'" alt="'.get_the_title().'"/>';
                        echo '</div>';

                        echo '<div class="small-9 column">';
                        echo '<div class="posttimestamp">';
                        echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago';
                        echo '</div>';
                         echo '<div class="clear"></div>';
                        echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
                        echo '<div class="clear"></div>';
                        echo '</div>';

                    } else {
                        echo '<div class="small-12 column">';
                        echo '<div class="posttimestamp">';
                        echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago';
                        echo '</div>';
                         echo '<div class="clear"></div>';
                        echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
                        echo '<div class="clear"></div>';
                        echo '</div>';
                    }
                    ?>
                    <div class="clear"></div>
            </div>
        </li>
    <?php 
        endwhile;
        echo '</ul>';
    endif; wp_reset_query();
    ?>

<?php    
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/
/* </END of: Here We Go, BUild the Gate to prevent headache to find out which the Output*>
/*oooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo*/


    echo $after_widget;
    }
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
        		'fetch' => null
        	));
        $title = $instance['title'];
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
			<label for="<?php echo $this->get_field_id('fetch'); ?>">
			Fetch count
			<input type="fetch" class="widefat" id="<?php echo $this->get_field_id('fetch'); ?>" name="<?php echo $this->get_field_name('fetch'); ?>" value="<?php echo esc_attr($fetch); ?>" />
			</label>
		</p>
        <?php
    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'zl_recent_post_Widget' );" ) );