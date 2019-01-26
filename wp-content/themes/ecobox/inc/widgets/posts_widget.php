<?php
add_action('widgets_init', 'latest_load_widgets');

function latest_load_widgets()
{
  register_widget('Posts_Widget');
}

class Posts_Widget extends WP_Widget {
  
  function __construct() {
    $widget_ops = array(
      'classname' => 'latest-posts',
      'description' => __('The most recent posts on your site.', 'ecobox')
    );

    $control_ops = array('id_base' => 'latest-posts');

    parent::__construct('latest-posts', 'Ecobox - Latest Posts', $widget_ops, $control_ops);
  }
  
  function widget($args, $instance)
  {
    extract($args);
    $title = apply_filters('widget_title', $instance['title']);
    $postscount = $instance['postscount'];

    echo $before_widget;

    if($title) {
      echo $before_title.$title.$after_title;
    }
    ?>

    <ul class="widget-posts-list">
      <?php
      $pp = new WP_Query("orderby=date&posts_per_page=".$postscount); ?>
      <?php while ($pp->have_posts()) : $pp->the_post();
      $format = get_post_format();
      ?>
      <li>
        <?php if(has_post_thumbnail()) { ?>
        <!-- begin post image -->
        <figure class="thumb">
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('small', array('class' => 'alignnone')); ?></a>
        </figure>
        <!-- end post image -->
        <?php } else { ?>

        <figure class="thumb thumb__with-icon">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img class="alignnone" src="<?php echo get_template_directory_uri() ?>/images/empty.jpg" alt=""><i class="fa fa-file-image-o"></i></a>
        </figure>

        <?php } ?>
        <h5 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
        <span class="date"><?php the_time(get_option('date_format')); ?></span>
      </li>
      <?php endwhile; ?>
    </ul>
    
    <?php
    echo $after_widget;
  }
  
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;

    $instance['title'] = strip_tags($new_instance['title']);
    $instance['postscount'] = $new_instance['postscount'];
    
    return $instance;
  }

  function form($instance)
  {
    $defaults = array(
      'title' => 'Latest Posts',
      'postscount' => 3
    );
    $instance = wp_parse_args((array) $instance, $defaults); ?>
    
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php echo _e('Title:', 'emotion') ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
    </p>
    
    </p>
      <label for="<?php echo $this->get_field_id('postscount'); ?>"><?php echo _e('Number of posts:', 'emotion') ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('postscount'); ?>" name="<?php echo $this->get_field_name('postscount'); ?>" value="<?php echo $instance['postscount']; ?>" />
    </p>

  <?php
  }
}
?>