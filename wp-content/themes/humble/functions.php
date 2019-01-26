<?php
/**
 * Humble functions and definitions
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

define( 'HUMBLE_VERSION', '1.5' );

if ( ! isset( $content_width ) ) {
	$content_width = 1080;
}

if ( ! function_exists( 'humble_setup' ) ) :
	/**
	 * Humble setup
	 */
	function humble_setup() {

		load_theme_textdomain( 'humble', get_template_directory() . '/languages' );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Register Menus
		 */
		 register_nav_menus( array(
			 'main-menu' => esc_html__( 'Main Menu', 'humble' ),
			 'side-menu' => esc_html__( 'Side Menu', 'humble' )
		 ) );

		/**
		 * Add post type
		 */
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link' ) );

		/**
		 * Add post thumbnail support
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add image size
		 */
		add_image_size( 'humble_full_thumb', 750, 9999 );  // Slider post format.
		add_image_size( 'humble_base_thumb', 1080, 720, true );  // Slider post format.
		add_image_size( 'humble_medium_thumb', 855, 720, true );  // Standard Post
		add_image_size( 'humble_related_thumb', 285, 240, true ); // Grid post featured.
		add_image_size( 'humble_small_thumb', 80, 65, true );   // Widget post format.

		/**
		 * Add feed links
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add title tag
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Add Editor Style
		 */
		add_editor_style( array( 'css/editor-style.css', humble_fonts_url() ) );

	}
endif;
add_action( 'after_setup_theme', 'humble_setup' );


/**
 * Register Google Fonts
 *
 * @since 1.0.5
 */
if ( ! function_exists( 'humble_fonts_url' ) ) :
	function humble_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Lato font: on or off', 'humble' ) ) {
			$fonts[] = 'Lato:400,100,100italic,300italic,300,400italic,700,700italic,900italic,900';
		}

		/* translators: If there are characters in your language that are not supported by Lora, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Lora font: on or off', 'humble' ) ) {
			$fonts[] = 'Lora:400,400i,700,700i';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;

/**
 * Register Sidebars
 *
 * @since 1.0
 */
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => esc_html__( 'Sidebar', 'humble' ),
		'id' => 'main_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	));
	register_sidebar(array(
		'name' => esc_html__( 'Instagram Footer', 'humble' ),
		'id' => 'instagram_widget',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
		'description' => esc_html__( 'Use the "Instagram" widget here. IMPORTANT: For best result set number of photos to 6.', 'humble' ),
	));
}


if ( ! function_exists( 'humble_load_scripts' ) ) :
	/**
	 * Register and enqueue styles/scripts
	 */
	function humble_load_scripts() {

		/**
		 * Load Fonts
		 */
		 wp_enqueue_style( 'humble-fonts', humble_fonts_url(), array(), null );

		/**
		 * Load styles
		 */
		 wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), HUMBLE_VERSION );
		 wp_enqueue_style( 'icons', get_template_directory_uri() . '/css/icons.css', array(), HUMBLE_VERSION );
		 wp_enqueue_style( 'humble-style', get_template_directory_uri() . '/style.css', array(), HUMBLE_VERSION );
		 wp_enqueue_style( 'humble-responsive', get_template_directory_uri() . '/css/responsive.css', array(), HUMBLE_VERSION );

		/**
		 * Load scripts
		 */
		 wp_enqueue_script( 'enscroll-script', get_template_directory_uri() . '/js/enscroll-0.5.2.min.js', array(), HUMBLE_VERSION, true );
		 wp_enqueue_script( 'owl-carousel-script', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), HUMBLE_VERSION, true );
		 wp_enqueue_script( 'sticky-kit-script', get_template_directory_uri() . '/js/jquery.sticky-kit.js', array(), HUMBLE_VERSION, true );
		 wp_enqueue_script( 'fitvids-script', get_template_directory_uri() . '/js/jquery.fitvids.js', array(), HUMBLE_VERSION, true );
		 wp_enqueue_script( 'masonry-script', get_template_directory_uri() . '/js/masonry.pkgd.min.js', array(), HUMBLE_VERSION, true );
		 wp_enqueue_script( 'humble-script', get_template_directory_uri() . '/js/humble.js', array('jquery'), HUMBLE_VERSION, true );

		 if ( is_singular() && get_option( 'thread_comments' ) ) {
			 wp_enqueue_script( 'comment-reply' );
		 }
	 }
endif;
add_action( 'wp_enqueue_scripts', 'humble_load_scripts' );
/**
 * TGM
 */
include get_template_directory() . '/inc/tgm/tgm-plugin-registration.php';

/**
 * Customizer
 */
include get_template_directory() . '/inc/customizer/humble_options.php';

/**
 * Metaboxes
 */
include get_template_directory() . '/inc/metabox/post_metabox.php';
include get_template_directory() . '/inc/metabox/format_metabox.php';

/**
 * Helpers
 */
include get_template_directory() . '/inc/humble-filters.php';
include get_template_directory() . '/inc/jetpack.php';
include get_template_directory() . '/inc/aq_resizer.php';

/**
 * Widgets
 */
include get_template_directory() . '/inc/widgets/widget_about_author.php';
include get_template_directory() . '/inc/widgets/widget_banner_ads.php';
include get_template_directory() . '/inc/widgets/widget_social_icons.php';
include get_template_directory() . '/inc/widgets/widget_popular_posts.php';

/**
 * Display Menu
 * @link https://codex.wordpress.org/Navigation_Menus
 * @since 1.0
 *
 */
if( !function_exists('humble_menu')) {
   function humble_menu($class = '') {
	   if ( function_exists('wp_nav_menu') && has_nav_menu( 'main-menu' ) ) {
		   wp_nav_menu(array(
			 'container'      => false,
			 'menu_class'     => $class,
			 'menu_id'        => '',
			 'theme_location' => 'main-menu',
		   ));
	   } else {
		   echo '<ul><li><a target="_blank" href="'. admin_url('nav-menus.php') .'" class="no-menu">'. __( 'Add Menu', 'humble' ) .'</a></li></ul>';
	}
  }
}

/**
 * The Excerpt
 *
 * @since 1.0
 */
function humble_custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'humble_custom_excerpt_length', 999 );

function humble_string_limit_words($string, $word_limit) {

	$words = explode(' ', $string, ($word_limit + 1));

	if(count($words) > $word_limit) {
		array_pop($words);
	}

	return implode(' ', $words);
}

/**
 * Restyle Categories Widget
 *
 * @since 1.0
 */
function humble_cat_count_inline($links) {

	$links = str_replace('</a> (', '</a><span>', $links);

	$links = str_replace(')', '</span>', $links);

	return $links;
}
add_filter('wp_list_categories', 'humble_cat_count_inline');

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function humble_custom_tag_cloud_widget($args) {
	$args['largest'] = 10; //largest tag
	$args['smallest'] = 10; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'humble_custom_tag_cloud_widget' );


/**
 * Pagination
 *
 * @since 1.0
 */
function humble_pagination() { ?>
	<div class="post-pagination col-md-12">
		<div class="paginate pull-right"><?php next_posts_link(__( 'Older Posts <i class="fa fa-angle-double-right"></i>', 'humble')); ?></div>
		<div class="paginate pull-left"><?php previous_posts_link(__( '<i class="fa fa-angle-double-left"></i> Newer Posts', 'humble')); ?></div>
	</div>
	<?php
}

/**
 * Get Post Views
 *
 * @since 1.3
 */

if(!function_exists('humble_getPostViews')) {
	function humble_getPostViews($postID){
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
			return wp_kses_post('0 View', 'humble');
	    }
		return $count.' '.esc_html__('Views', 'humble');
	}
}

/**
 * Set Post Views
 *
 * @since 1.3
 */
if(!function_exists('humble_setPostViews')) {
	function humble_setPostViews($postID) {
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }else{
	        $count++;
	        update_post_meta($postID, $count_key, $count);
	    }
	}
}

/**
 * Move Comment Textarea to bottom
 *
 * @since 1.0
 */
function humble_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
	}
add_filter( 'comment_form_fields', 'humble_move_comment_field_to_bottom' );


/**
 * Comments Layout
 *
 * @since 1.0
 */
 if ( ! function_exists( 'humble_comments' ) ) :
   /**
	* The function returns the html form comments.
	*
	* @param array  $comment comments array.
	* @param array  $args comments option.
	* @param number $depth comment depth.
	*/
	function humble_comments($comment, $args, $depth) { $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		   <div class="comment-list-item">
			   <div class="avatar">
				   <?php echo get_avatar($comment,$args['avatar_size']); ?>
			   </div>
			   <div class="comment-content">
				   <h6 class="comment-author"><?php echo get_comment_author_link(); ?></h6>
				   <?php if ($comment->comment_approved == '0') : ?>
					   <em class="wa"><?php esc_html_e('Comment awaiting approval', 'humble'); ?></em>
					   <br />
				   <?php endif; ?>
				   <div class="comment-text">
					   <p class="comment-text-content"><?php echo wp_kses_post( apply_filters( 'comment_text', get_comment_text() ) ) ?></p>
				   </div>
				   <span class="reply">
					   <?php comment_reply_link(array_merge( $args, array('reply_text' => esc_html__('Reply', 'humble'), 'depth' => $depth, 'max_depth' => $args['max_depth'])), $comment->comment_ID); ?>
					   <?php edit_comment_link(esc_html__('Edit', 'humble')); ?>
				   </span>
			   </div>
		   </div>
	   </li>
	   <?php
   }
 endif;
/**
 * Custom Styles
 *
 * @since 1.0
 */
function humble_custom_styles() {
    wp_enqueue_style( 'humble-custom-style', get_template_directory_uri() . '/css/custom_style.css' );
    $accent_color = get_theme_mod( 'color_accent' );
	$footer_bg_color = get_theme_mod( 'color_footer_bg' );
	$header_padding_top = get_theme_mod('header_padding_top');
	$header_padding_bottom = get_theme_mod('header_padding_bottom');
    $custom_css = "a:hover,.post-content p a, a:focus, dt a, dd a, th a, .cat, .about-widget > a, .post-tags a, .comment-reply a, .coloured-title, .logged-in-as a.log-out, blockquote.style2:before, blockquote.style2 span, .scroll-up a:hover, .scroll-up a:active {color: {$accent_color}}.cat:before, .cat:after, .btn, .widget_mc4wp_form_widget form input[type=submit]:hover, .page-title:before, .backtohome:hover, .wpcf7 .wpcf7-submit:hover,.comment-form button:hover {background-color: {$accent_color}}.post-content blockquote p, .scroll-up a:hover, .scroll-up a:active {border-color:{$accent_color}}.humble-footer {background-color:{$footer_bg_color}}header .logo{padding-top:{$header_padding_top}px;padding-bottom:{$header_padding_bottom}px}";
    wp_add_inline_style( 'humble-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'humble_custom_styles' );
