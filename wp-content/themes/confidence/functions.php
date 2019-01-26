<?php
/**
 *
 * @package WordPress
 * @subpackage confidence
 * @since confidence 1.0
 *
*/

define( 'CONFIDENCE_THEME_VERSION', wp_get_theme()->Version );


/*************************************************
## Google Font
*************************************************/

function ninetheme_confidence_fonts_url() {
    $ninetheme_confidence_font_url = '';

    if ( 'off' !== _x( 'on', 'Google font: on or off', 'confidence' ) ) {
        $ninetheme_confidence_font_url = add_query_arg( 'family', urlencode( 'Montserrat|Droid+Serif:400,700' ), "//fonts.googleapis.com/css" );
    }
    return $ninetheme_confidence_font_url;
}

/*************************************************
## Styles and Scripts
*************************************************/


function ninetheme_confidence_scripts() {

	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

	wp_enqueue_style(  'bootstrap', 						get_template_directory_uri() . '/css/bootstrap.min.css', false, '1.0');
	wp_enqueue_style(  'ninetheme-confidence-main-style', 	get_template_directory_uri() . '/css/style.css', false, '1.0');
	wp_enqueue_style(  'helper-css', 						get_template_directory_uri() . '/css/helper.css', false, '1.0');
	wp_register_style( 'prettyPhoto', 						get_template_directory_uri() . '/css/prettyPhoto.css', false, '1.0');
	wp_enqueue_style(  'flexslider', 						get_template_directory_uri() . '/css/flexslider.css', false, '1.0');
	wp_enqueue_style(  'font-awesome', 						get_template_directory_uri() . '/css/font-awesome.css', false, '1.0');
	wp_enqueue_style(  'ninetheme-confidence-eventstyle', 	get_template_directory_uri() . '/css/eventstyle.css', false, '1.0');
	wp_enqueue_style(  'ninetheme-confidence-defaultstyle', get_template_directory_uri() . '/css/wordpress.css', false, '1.0');
	wp_enqueue_style(  'ninetheme-confidence-update', 		get_template_directory_uri() . '/css/update.css', false, '1.0');
	wp_enqueue_style(  'ninetheme-confidence-fonts', 		ninetheme_confidence_fonts_url(), array(), '1.0.0' );

	wp_enqueue_style( 'style', get_stylesheet_uri() );


	wp_enqueue_script( 'fitvids', 	 					get_template_directory_uri() .  '/js/jquery.fitvids.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'flexslider', 					get_template_directory_uri() .  '/js/jquery.flexslider.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'bootstrap', 					get_template_directory_uri() .  '/js/bootstrap.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'owl-carousel', 	 				get_template_directory_uri() .  '/js/owl.carousel.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'countTo', 	 					get_template_directory_uri() .  '/js/jquery.countTo.js', array('jquery'), '1.0', true);
	wp_enqueue_script( 'imagesloaded-pkgd', 			get_template_directory_uri() .  '/js/imagesloaded.pkgd.js', array('jquery'), '3.1.8', true);
	wp_enqueue_script( 'ninetheme-confidence-main', 	get_template_directory_uri() .  '/js/main.js', array('jquery'), '1.0', true);

	global $is_IE;
	if ( $is_IE ) {
	 wp_enqueue_script( 'respond', get_template_directory_uri()  .  '/js/respond.min.js', array('jquery'), '1.0.0', true );
	 wp_enqueue_script( 'html5shiv', get_template_directory_uri()  .  '/js/html5shiv.js', array('jquery'), '3.7.0', true );
    }

}

add_action( 'wp_enqueue_scripts', 'ninetheme_confidence_scripts' );

/*************************************************
## Admin style and scripts
*************************************************/

function ninetheme_confidence_admin_styles() {

	// Update CSS within in Admin
	wp_enqueue_style('ninetheme_confidence_custom_admin', get_template_directory_uri().'/admin/admin.css');

}
add_action('admin_enqueue_scripts', 'ninetheme_confidence_admin_styles');


/*************************************************
## Theme option & Metaboxes & shortcodes
*************************************************/

	if(function_exists('vc_set_as_theme')) {
		require_once get_template_directory() . '/includes/visualcomposer/ninetheme_shortcodes.php';
		vc_is_updater_disabled();
	}

	if ( ! function_exists( 'rwmb_meta' ) ) {
	  function rwmb_meta( $key, $args = '', $post_id = null ) {
	   return false;
	  }
	}

	// theme special files - metaboxes - settings - tags
	require_once get_template_directory() . '/includes/woocommerce/woocommerce.php';
	require_once get_template_directory() . '/includes/custom-metaboxes/page-metaboxes.php';
	require_once get_template_directory() . '/includes/breadcrumb.php';
	require_once get_template_directory() . '/includes/extras.php';
	require_once get_template_directory() . '/includes/aq_resizer.php';
	require_once get_template_directory() . '/includes/template-tags.php';


	// support shortcodes default text widget
	add_filter('widget_text', 'do_shortcode');

   // Option tree controllers
   if ( ! class_exists( 'OT_Loader' )){

      function ot_get_option() {
         return false;
      }

   }

   // add filter for  options panel loader
   add_filter( 'ot_show_pages', 		'__return_false' );
   add_filter( 'ot_show_new_layout', 	'__return_false' );

   // Theme options admin panel setings file
   include_once get_template_directory() . '/includes/theme-options.php';



/*************************************************
## Theme image size support
*************************************************/

	add_image_size( 'ninetheme_confidence_mini', 80, 80 );
	add_image_size( 'ninetheme_confidence_midi', 150, 150 , true );
	add_image_size( 'ninetheme_confidence_causes_medium', 360, 300);
	add_image_size( 'ninetheme_confidence_causes', 596, 281, true  );
	add_image_size( 'ninetheme_confidence_half', 600, 600 );
	add_image_size( 'ninetheme_confidence_grid', 800, 800 , true);
	add_image_size( 'ninetheme_confidence_event', 280, 280, true);


/*************************************************
## Theme Setup
*************************************************/


add_action( 'after_setup_theme', 'ninetheme_confidence_theme_setup' );

function ninetheme_confidence_theme_setup() {

	if ( ! isset( $content_width ) ) $content_width = 960;

	// Confidence theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style('custom-editor-style.css');

	// Confidence theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array('gallery','video', 'audio', 'quote', 'status', 'project'));

	add_post_type_support( 'portfolio', 'post-formats' );
	add_post_type_support( 'sermon', 	'post-formats' );
	add_post_type_support( 'causes', 	'post-formats' );
	add_post_type_support( 'program', 	'post-formats' );
	add_post_type_support( 'ministry', 	'post-formats' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'confidence', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	//   This theme uses wp_nav_menu() in one location
	register_nav_menus( array(
		'primary' => esc_html__ ('Primary Menu', 'confidence' ),
	) );
}


/*************************************************
## Register Menu
*************************************************/

class Ninetheme_Confidence_Navwalker extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu\">\n";
	}
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		/**
		 * Dividers, Headers or Disabled
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider item-has-children">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider item-has-children">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header item-has-children') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header item-has-children">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			if ( $args->has_children )
				$class_names .= 'sub item-has-children';
			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';
			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= '#';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			$item_output = $args->before;
			/*
			 * Glyphicons
			 **/
			if ( ! empty( $item->attr_title ) )
				$item_output .= '<a'. $attributes .'><span class=" ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
			else
				$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
	/**
	 * Traverse elements to create list from elements.
	 **/
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;
        $id_field = $this->db_fields['id'];
        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
	/**
	 * Menu Fallback
	 **/
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {
			extract( $args );
			$fb_output = null;
			if ( $container ) {
				$fb_output = '<' . $container;
				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';
				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';
				$fb_output .= '>';
			}
			$fb_output .= '<ul';
			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';
			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';
			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';
			if ( $container )
				$fb_output .= '</' . $container . '>';
			echo ($fb_output);
		}
	}
}

/*************************************************
## Widget areas
*************************************************/

function ninetheme_confidence_widgets_init() {
	register_sidebar( array(
	  'name' => esc_html__('Blog Sidebar', 'confidence' ),
	  'id' => 'sidebar-1',
	  'description'   => esc_html__('These are widgets for the Blog page.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('Newsletter', 'confidence' ),
	  'id' => 'newsletter',
	  'description'   => esc_html__('These are widgets for the footer newsletter.','confidence' )
	) );
	register_sidebar( array(
	  'name' => esc_html__('Widgetize footer', 'confidence' ),
		'id' => 'footer',
	  'description'   => esc_html__('These are widgets for the Shop single Sidebar.','confidence' ),
	  'before_widget' => '<div class="col-sm-3"><div class="widget  %2$s">',
	  'after_widget'  => '</div></div>',
	  'before_title'  => '<h5 class="uppercase">',
	  'after_title'   => '</h5>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('Shop single Sidebar', 'confidence' ),
	 'id' => 'shop-sidebar',
	  'description'   => esc_html__('These are widgets for the Shop single Sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('Woo  shop page Sidebar', 'confidence' ),
	 'id' => 'shop-page-sidebar',
	  'description'   => esc_html__('These are widgets for the shop page Sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('Causes Pages Sidebar', 'confidence' ),
	 'id' => 'causes-page-sidebar',
	  'description'   => esc_html__('These are widgets for the causes page sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('Single Causes Pages Sidebar', 'confidence' ),
	 'id' => 'single-causes-page-sidebar',
	  'description'   => esc_html__('These are widgets for the causes page sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('Buddypress Pages Sidebar', 'confidence' ),
	 'id' => 'buddy-page-sidebar',
	  'description'   => esc_html__('These are widgets for the buddypress page sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('Sermon Pages Sidebar', 'confidence' ),
	 'id' => 'sermon-page-sidebar',
	  'description'   => esc_html__('These are widgets for the sermon page sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('Team Pages Sidebar', 'confidence' ),
	 'id' => 'team-page-sidebar',
	  'description'   => esc_html__('These are widgets for the team page sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('Prayer Pages Sidebar', 'confidence' ),
	 'id' => 'prayer-page-sidebar',
	  'description'   => esc_html__('These are widgets for the prayer page sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('program Pages Sidebar', 'confidence' ),
	 'id' => 'program-page-sidebar',
	  'description'   => esc_html__('These are widgets for the program page sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
	register_sidebar( array(
	  'name' => esc_html__('ministry Pages Sidebar', 'confidence' ),
	 'id' => 'ministry-page-sidebar',
	  'description'   => esc_html__('These are widgets for the ministry page sidebar.','confidence' ),
	  'before_widget' => '<div class="widget  %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
}
add_action( 'widgets_init', 'ninetheme_confidence_widgets_init' );

/*************************************************
## Include the TGM_Plugin_Activation class.
*************************************************/

require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'ninetheme_confidence_register_required_plugins' );

function ninetheme_confidence_register_required_plugins() {

    $plugins = array(

      array(
         'name'		   	=> esc_html__('Envato Auto Update Theme', "confidence"),
         'slug'		   	=> 'envato-market-update-theme',
         'source'       	=> get_template_directory() . '/plugins/envato-market-update-theme.zip',
         'required'	   	=> false,
      ),
      array(
         'name'         	=> esc_html__('Visual Composer', "confidence"),
         'slug'         	=> 'visual_composer',
         'source'        => get_template_directory() . '/plugins/visual_composer.zip',
         'required'     	=> true,
      ),
      array(
         'name'         	=> esc_html__('Revolution Slider', "confidence"),
         'slug'         	=> 'revolution_slider',
         'source'        => get_template_directory() . '/plugins/revolution_slider.zip',
         'required'     	=> false,
      ),
      array(
            'name'         => esc_html__('OneClick Demodata Installer', "confidence"),
            'slug'         => 'easy_installer',
            'source'       => get_template_directory() . '/plugins/easy_installer.zip',
            'required'     => false,
       ),
		array(
            'name'                  => esc_html__('Causes post type', "confidence"),
            'slug'                  => 'causes-post-type',
            'source'        => get_template_directory() . '/plugins/causes-post-type.zip',
            'required'              => false,
        ),
		array(
            'name'                  => esc_html__('Prayers post type', "confidence"),
            'slug'                  => 'prayers-post-type',
            'source'        => get_template_directory() . '/plugins/prayers-post-type.zip',
            'required'              => false,
        ),
		array(
            'name'                  => esc_html__('Sermon post type', "confidence"),
            'slug'                  => 'sermon-post-type',
            'source'        => get_template_directory() . '/plugins/sermon-post-type.zip',
            'required'              => false,
        ),
		array(
            'name'                  => esc_html__('Team post type', "confidence"),
            'slug'                  => 'team-post-type',
            'source'        => get_template_directory() . '/plugins/team-post-type.zip',
            'required'              => false,
        ),
		array(
            'name'                  => esc_html__('Program Manager', "confidence"),
            'slug'                  => 'program-post-type',
            'source'        => get_template_directory() . '/plugins/program-post-type.zip',
            'required'              => false,
        ),
		array(
            'name'                  => esc_html__('Ministry Manager', "confidence"),
            'slug'                  => 'ministry-post-type',
            'source'        => get_template_directory() . '/plugins/ministry-post-type.zip',
            'required'              => false,
        ),
		array(
            'name'                  => esc_html__('Theme shortcodes', "confidence"),
            'slug'                  => 'ninetheme-shortcodes',
            'source'                => get_template_directory() . '/plugins/ninetheme-shortcodes.zip',
            'required'              => true,
            'version'               => '1.1',
        ),
		array(
            'name'                  => esc_html__('Woocommerce', "confidence"),
            'slug'                  => 'woocommerce',
            'required'              => false,
        ),
		array(
            'name'                  => esc_html__('Contact Form 7', "confidence"),
            'slug'                  => 'contact-form-7',
        ),
        array(
            'name'                  => esc_html__('Meta Box', "confidence"),
            'slug'                  => 'meta-box',
			'required'              => true,
        ),
		array(
            'name'                  => esc_html__('Events calendar', "confidence"),
            'slug'                  => 'the-events-calendar',
        ),
		array(
            'name'                  => esc_html__('Seamless donations', "confidence"),
            'slug'                  => 'seamless-donations',
        ),
		array(
            'name'         			=> esc_html__('Custom Post Type Permalinks', 'confidence'),
            'slug'         			=> 'custom-post-type-permalinks',
        ),
      array(
                'name'         	=> esc_html__('Option Tree', "confidence"),
                'slug'         	=> 'option-tree',
           'required'     	=> true,
      ),
    );

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}

/*************************************************
## confidence Comment
*************************************************/

if ( ! function_exists( 'ninetheme_confidence_comment' ) ) :
 function ninetheme_confidence_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
   case 'pingback' :
   case 'trackback' :
  ?>
   <div class="container">
   <div class="comments">
   <article class="post pingback">
   <p><?php esc_html_e ('Pingback:', 'confidence' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__ ('(Edit)', 'confidence' ), ' ' ); ?></p>
	  <?php
		break;
	   default :
	  ?>
        <div class="comments">
            <ul>
				<li class="comment">
					<span class="who">
						<?php echo get_avatar( $comment, 80 ); ?>
					</span>
					<div class="who-comment">
					<p class="name"><?php comment_author(); ?></p>
					<?php comment_text(); ?>
                    <?php edit_comment_link( esc_html__('Edit', 'confidence' ), ' ' ); ?>
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    <span class="meta-data"><time class="comment-date" pubdate datetime="<?php comment_time( 'c' ); ?>"><?php comment_date(); ?> <?php esc_html_e ('at', 'confidence' ); ?> <?php comment_time(); ?></time></span>
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php esc_html_e ('Your comment is awaiting moderation.', 'confidence' ); ?></em>
					<?php endif; ?>
					</div>
				</li>
            </ul>
		</div>
	  <?php
		break;
	  endswitch;
	 }
	endif;
