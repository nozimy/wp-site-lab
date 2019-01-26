<?php
add_action('widgets_init', 'social_links_load_widgets');

function social_links_load_widgets()
{
	register_widget('Social_Links_Widget');
}

class Social_Links_Widget extends WP_Widget {
	
	function __construct() {
		$widget_ops = array(
			'classname' => 'social_links',
			'description' => __('Widget displays your social links.', 'ecobox')
		);

		$control_ops = array('id_base' => 'social_links-widget');

		parent::__construct('social_links-widget', 'Ecobox - Social Networks', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}
		?>
		<ul class="social-list social-list__footer list-unstyled">
			<?php if($instance['facebook_link']): ?>
			<li>
				<a href="<?php echo $instance['facebook_link']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
			</li>
			<?php endif; ?>

			<?php if($instance['twitter_link']): ?>
			<li>
				<a href="<?php echo $instance['twitter_link']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
			</li>
			<?php endif; ?>

			<?php if($instance['linkedin_link']): ?>
			<li>
				<a href="<?php echo $instance['linkedin_link']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
			</li>
			<?php endif; ?>
			
			<?php if($instance['google_link']): ?>
			<li>
				<a href="<?php echo $instance['google_link']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</li>
			<?php endif; ?>

			<?php if($instance['pinterest_link']): ?>
			<li>
				<a href="<?php echo $instance['pinterest_link']; ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
			</li>
			<?php endif; ?>

			<?php if($instance['youtube_link']): ?>
			<li>
				<a href="<?php echo $instance['youtube_link']; ?>" target="_blank"><i class="fa fa-youtube"></i></a>
			</li>
			<?php endif; ?>

			<?php if($instance['instagram_link']): ?>
			<li>
				<a href="<?php echo $instance['instagram_link']; ?>" target="_blank"><i class="fa fa-instagram"></i></i></a>
			</li>
			<?php endif; ?>

			<?php if($instance['flickr_link']): ?>
			<li>
				<a href="<?php echo $instance['flickr_link']; ?>" target="_blank"><i class="fa fa-flickr"></i></a>
			</li>
			<?php endif; ?>

			<?php if($instance['xing_link']): ?>
			<li>
				<a href="<?php echo $instance['xing_link']; ?>" target="_blank"><i class="fa fa-xing"></i></a>
			</li>
			<?php endif; ?>
			
			<?php if($instance['rss_link']): ?>
			<li>
				<a href="<?php echo $instance['rss_link']; ?>" target="_blank"><i class="fa fa-rss"></i></i></a>
			</li>
			<?php endif; ?>
			
		</ul>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['facebook_link'] = $new_instance['facebook_link'];
		$instance['twitter_link'] = $new_instance['twitter_link'];
		$instance['linkedin_link'] = $new_instance['linkedin_link'];
		$instance['google_link'] = $new_instance['google_link'];
		$instance['pinterest_link'] = $new_instance['pinterest_link'];
		$instance['youtube_link'] = $new_instance['youtube_link'];
		$instance['instagram_link'] = $new_instance['instagram_link'];
		$instance['flickr_link'] = $new_instance['flickr_link'];
		$instance['xing_link'] = $new_instance['xing_link'];
		$instance['rss_link'] = $new_instance['rss_link'];

		return $instance;
	}

	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array( 
			'title' => 'Social',
			'facebook_link' => '#',
			'twitter_link' => '#',
			'linkedin_link' => '#',
			'google_link' => '#',
			'pinterest_link' => '#',
			'youtube_link' => '#',
			'instagram_link' => '',
			'flickr_link' => '',
			'xing_link' => '',
			'rss_link' => ''
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo _e('Title:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php echo _e('Facebook Link:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" value="<?php echo $instance['facebook_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter_link'); ?>"><?php echo _e('Twitter Link:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" value="<?php echo $instance['twitter_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('linkedin_link'); ?>"><?php echo _e('Linkedin Link:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin_link'); ?>" name="<?php echo $this->get_field_name('linkedin_link'); ?>" value="<?php echo $instance['linkedin_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('google_link'); ?>"><?php echo _e('Google+ Link:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('google_link'); ?>" name="<?php echo $this->get_field_name('google_link'); ?>" value="<?php echo $instance['google_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('pinterest_link'); ?>"><?php echo _e('Pinterest Link:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('pinterest_link'); ?>" name="<?php echo $this->get_field_name('pinterest_link'); ?>" value="<?php echo $instance['pinterest_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('youtube_link'); ?>"><?php echo _e('YouTube Channel:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('youtube_link'); ?>" name="<?php echo $this->get_field_name('youtube_link'); ?>" value="<?php echo $instance['youtube_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('instagram_link'); ?>"><?php echo _e('Instagram Link:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('instagram_link'); ?>" name="<?php echo $this->get_field_name('instagram_link'); ?>" value="<?php echo $instance['instagram_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('flickr_link'); ?>"><?php echo _e('Flickr Link:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr_link'); ?>" name="<?php echo $this->get_field_name('flickr_link'); ?>" value="<?php echo $instance['flickr_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('xing_link'); ?>"><?php echo _e('Xing Link:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('xing_link'); ?>" name="<?php echo $this->get_field_name('xing_link'); ?>" value="<?php echo $instance['xing_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('rss_link'); ?>"><?php echo _e('RSS Link:', 'ecobox') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('rss_link'); ?>" name="<?php echo $this->get_field_name('rss_link'); ?>" value="<?php echo $instance['rss_link']; ?>" />
		</p>
	<?php
	}
}
?>