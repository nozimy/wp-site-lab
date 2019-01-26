<?php
/**
 * new WordPress Widget format
 * Wordpress 2.8 and above
 * @see http://codex.wordpress.org/Widgets_API#Developing_Widgets
 */
class zl_recentalbum_Widget extends WP_Widget {

    /**
     * Constructor
     *
     * @return void
     **/
    function zl_recentalbum_Widget() {
        $widget_ops = array( 'classname' => 'zl_recentalbum_Widget', 'description' => 'Display Most Recent Albums' );
        $this->WP_Widget( 'zl_recentalbum_Widget', '&raquo; zl Recent Album', $widget_ops );
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
    <div class="row albwidget">
    <?php
        global $wp_query;
        $args = array(
            'post_type' => 'zl_album',
            'post_status' => 'publish',
            'orderby' => 'DATE',
            'order' => 'DESC',
            'posts_per_page' => $fetch,
            'ignore_sticky_posts' => 1,
          );
       $album = new WP_Query($args);
    ?>
    <?php if($album->have_posts()) : ?><?php while($album->have_posts()) : 
    $album->the_post(); 
        //Let's Generate the Thumbnail.
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url( $thumb,'full' ); 
        $image = zl_theme_thumb($img_url, 100, 100, 'c', true);

        //Get Gallery Images
        $gallery = get_post_gallery_images();

        //Count Images
        $items = count($gallery);

        //Get the First Item if featured image isn't set.
        $firstimg = reset($gallery);
        $firstimg = str_replace('-150x150', '', $firstimg);

        //Crop the first image.
        $firstimg = zl_theme_thumb($firstimg, 100, 100, 'c', true);
        
    ?>
        <!-- Album Loop -->
        <div class="small-4 column tooltip" title="<?php the_title();?> | <?php echo $items . zl_option('lang_photos', __(' Photos','zatolab')) ;?>">
            <div class="zl_alb_wid" title="<?php the_title();?> | <?php echo $items . zl_option('lang_photos', __(' Photos','zatolab')) ;?>">
                <div data-albumlink='<?php the_permalink(); ?>' data-albumid="album-<?php the_ID();?>">
                    <a href="<?php the_permalink();?>" class="abs">&nbsp;</a>
                    <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                    <?php
                        if ($image) {
                            echo '<img src="' . $image . '" alt="'.get_the_title().'" />';
                        } else {
                            echo '<img src="' . $firstimg . '" alt="'.get_the_title().'" />';
                        }
                    ?>
                    </a>
                </div>
            </div>
        </div><!-- // .zl_album_parent large-3 Album Loop -->
    <?php endwhile; endif; ?>
    </div>
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

add_action( 'widgets_init', create_function( '', "register_widget( 'zl_recentalbum_Widget' );" ) );