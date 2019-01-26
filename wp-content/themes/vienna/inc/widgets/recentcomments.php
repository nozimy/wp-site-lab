<?php
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class zl_recentcomment_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function zl_recentcomment_Widget() {
        $widget_ops = array( 'classname' => 'zl_recentcomment_Widget', 'description' => 'Display most recent comments' );
        $this->WP_Widget( 'zl_recentcomment_Widget', '&raquo; zl Recent Comments', $widget_ops );
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
    $args = array(
        'order'     => 'DESC',
        'status'     => 'approve',
        'post_type'    => 'post',
    );

    // The Query
    $comments_query = new WP_Comment_Query;
    $comments = $comments_query->query( $args );

    // Comment Loop
    if ( $comments ) {
        echo '<ul class="zl_recentcomments">';
        $i = 1;
        foreach ( $comments as $comment ) {?>
            <li class="row">
                <div class="row">
                    <div class="small-3 column">
                        <?php 
                            $authormail = $comment->comment_author_email ; 
                            echo get_avatar( $authormail, 48 );
                         ?>
                    </div>
                    <div class="small-9 column">
                        <div class="posttimestamp">
                        <?php 
                        $d = "U";
                        $comment_date = get_comment_date( $d, $comment->comment_ID );
                        //echo $comment_date;
                        echo human_time_diff( $comment_date, current_time('timestamp') ) . ' ago'. zl_option('lang_on', __('on', 'zatolab'));
                         ?>
                        </div>
                        <a href="<?php echo get_comment_link($comment->comment_ID ); ?>">
                            <?php echo $comment->comment_author.': '; ?><br>
                            <?php echo get_the_title($comment->comment_post_ID); ?>
                        </a>
                    </div>
                </div>
                <div class="clear"></div>
            </li> <div class="clear"></div>
     <?php 
       
        if ($i++ == $fetch) break;
        }
        echo "</ul>";
    } else {
        echo 'No comments found.';
    }
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

add_action( 'widgets_init', create_function( '', "register_widget( 'zl_recentcomment_Widget' );" ) );