<?php
/**
 * Ecobox functions and definitions
 *
 * @package Ecobox
 */

/**
 * Set Proper Parent/Child theme paths for inclusion
*/
@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );


/*------------------------------------*\
	Includes
\*------------------------------------*/

//Multiple Sidebar
require_once(PARENT_DIR . '/inc/plugins/multiple_sidebars.php');

// Add the postmeta to Pages
include_once(PARENT_DIR . '/inc/meta-pages.php');

// Twitter
require_once(PARENT_DIR . '/inc/twitter-includes/twitter-feed-for-developers.php');

// Widgets
require_once PARENT_DIR . '/inc/widgets/social_links.php';
require_once PARENT_DIR . '/inc/widgets/posts_widget.php';
require_once PARENT_DIR . '/inc/widgets/flickr_widget.php';
require_once PARENT_DIR . '/inc/widgets/twitter_widget.php';

// Add the postmeta to Portfolio
include_once(PARENT_DIR . '/inc/theme-portfoliometa.php');

// WP-Less
require_once ( 'inc/plugins/wp-less-oncletom/bootstrap-for-theme.php' );
WPLessPlugin::getInstance()->dispatch();
define('WP_LESS_COMPILATION', 'deep');
define('WP_LESS_ALWAYS_RECOMPILE', false);

add_action('wp_head','redux_opt_inc');
function redux_opt_inc() {
	include('redux-opt.php');
}

/**
 * Add Redux Framework & extras
 */
require get_template_directory() . '/admin/admin-init.php';


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}


if ( ! function_exists( 'ecobox_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ecobox_setup() {

	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'ecobox', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1176, 516, true ); // Normal post thumbnails
	add_image_size('small', 272, 172, true); // Small Thumbnail
	add_image_size('related-img', 512, 240, true); // Small Thumbnail
	add_image_size('portfolio-n', 632, 632, true); // Portfolio Thumbnails (3, 4 cols layouts)
	add_image_size('portfolio-lg', 1022, 1022, true); // Portfolio Thumbnails (2 cols layout)
	add_image_size('portfolio-xlg', 1500, 1014, true); // Portfolio Thumbnails (2 cols layout)

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ecobox' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
}
endif; // ecobox_setup
add_action( 'after_setup_theme', 'ecobox_setup' );



/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ecobox_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'ecobox' ),
		'id'            => 'sidebar-1',
		'description'   => 'The Sidebar containing the main widget areas.',
		'before_widget' => '<aside id="%1$s" class="widget widget__sidebar %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shortcodes Sidebar', 'ecobox' ),
		'id'            => 'sidebar-2',
		'description'   => 'The Shortcodes Sidebar containing the navigation of shortcodes pages.',
		'before_widget' => '<aside id="%1$s" class="widget widget__sidebar %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'ecobox' ),
		'id'            => 'ecobox-footer-widget-1',
		'description'   => '1st Footer Widget Area',
		'before_widget' => '<aside id="%1$s" class="widget widget__footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'ecobox' ),
		'id'            => 'ecobox-footer-widget-2',
		'description'   => '2nd Footer Widget Area',
		'before_widget' => '<aside id="%1$s" class="widget widget__footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'ecobox' ),
		'id'            => 'ecobox-footer-widget-3',
		'description'   => '3rd Footer Widget Area',
		'before_widget' => '<aside id="%1$s" class="widget widget__footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 4', 'ecobox' ),
		'id'            => 'ecobox-footer-widget-4',
		'description'   => '4th Footer Widget Area',
		'before_widget' => '<aside id="%1$s" class="widget widget__footer %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'ecobox_widgets_init' );


/**
 * Enqueue scripts and styles.
 */

function ecobox_enqueue_style() {
	wp_enqueue_style( 'ecobox-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', false );

	require_once('redux-opt-less.php'); // needed here to get less variables
	wp_enqueue_style( 'test', get_template_directory_uri() . '/less/master.less', false ); 
	wp_enqueue_style( 'base', get_template_directory_uri() . '/css/base.css', false );
	wp_enqueue_style( 'magnific', get_template_directory_uri() . '/css/magnific-popup.css', false );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', false ); 
}

function ecobox_enqueue_script() {
	// Bootstrap
	wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.1', true);
	wp_enqueue_script('bootstrap');
	// hoverIntent
	wp_register_script('hoverintent', get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js', array('jquery'), '1.0', true);
	wp_enqueue_script('hoverintent');
	// hoverIntent
	wp_register_script('flexnav', get_template_directory_uri() . '/js/jquery.flexnav.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('flexnav');
	// Isotope
	wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), '1.5.26', true);
	wp_enqueue_script('isotope');

	wp_register_script('isotope_masonry', get_template_directory_uri() . '/js/jquery.isotope.sloppy-masonry.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('isotope_masonry');

	wp_register_script('imgsloaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('imgsloaded');
	// FitVideo
	wp_register_script('fitvideo', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.1', true);
	wp_enqueue_script('fitvideo');
	// Flickr
	wp_register_script('flickr', get_template_directory_uri() . '/js/jquery.flickrfeed.js', array('jquery'), '1.0', true);
	wp_enqueue_script('flickr');
	// OwlCarousel
	wp_register_script('owlcarousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '1.3.2', true);
	wp_enqueue_script('owlcarousel');
	// Magnific Popup
	wp_register_script('magnificpopup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), '0.9.9', true);
	wp_enqueue_script('magnificpopup');
	// Appear
	wp_register_script('appear', get_template_directory_uri() . '/js/jquery.appear.js', array('jquery'), '1.0', true);
	wp_enqueue_script('appear');
	// Custom
	wp_register_script('initjs', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true);
	wp_enqueue_script('initjs');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Conditional for Contact page
	if (is_page_template('template-contacts.php')) {
		// Google Map
		wp_register_script('gmap_api', '//maps.google.com/maps/api/js?sensor=true', array('jquery'), '1.0');
		wp_enqueue_script('gmap_api');
		wp_register_script('gmap', get_template_directory_uri() . '/js/jquery.ui.map.js', array('jquery'), '3.0');
		wp_enqueue_script('gmap');
	}
}

add_action( 'wp_enqueue_scripts', 'ecobox_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'ecobox_enqueue_script' );


// Change active menu class
add_filter('nav_menu_css_class' , 'ecobox_special_nav_class' , 10 , 2);
function ecobox_special_nav_class($classes, $item){
	if( in_array('current-menu-item', $classes) ){
		$classes[] = 'active';
	}
	return $classes;
}


/*-----------------------------------------------------------------------------------*/
/*  Breadcrumbs
/*-----------------------------------------------------------------------------------*/


function ecobox_breadcrumbs() {
	global $ecobox_data;

  /* === OPTIONS === */
  $text['home']     = __('Home', 'ecobox'); // text for the 'Home' link
  $text['category'] = __('Archive by Category "%s"', 'ecobox'); // text for a category page
  $text['search']   = __('Search Results for "%s" Query', 'ecobox'); // text for a search results page
  $text['tag']      = __('Posts Tagged "%s"', 'ecobox'); // text for a tag page
  $text['author']   = __('Articles Posted by %s', 'ecobox'); // text for an author page
  $text['404']      = __('Error 404', 'ecobox'); // text for the 404 page
  $blog_txt         = $ecobox_data['opt-blog-title'];
 

  $showCurrent = false; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $showOnHome  = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter   = ''; // delimiter between crumbs
  $before      = '<li class="current">'; // tag before the current crumb
  $after       = '</li>'; // tag after the current crumb
  /* === END OF OPTIONS === */

  global $post;
  $homeLink = home_url();
  $linkBefore = '<li typeof="v:Breadcrumb">';
  $linkAfter = '</li>';
  $linkAttr = ' rel="v:url" property="v:title"';
  $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

  if ( is_home() && !is_front_page()) {

    if ($showOnHome == 1) echo '<ul class="breadcrumb"><li><a href="' . $homeLink . '">' . $text['home'] . '</a></li></ul>';

  } elseif (is_home() || is_front_page()) {

    if ($showOnHome == 1) echo '<ul class="breadcrumb"><li><a href="' . $homeLink . '">' . $text['home'] . '</a></li></ul>';

  } else {

    echo '<ul class="breadcrumb">' . sprintf($link, $homeLink, $text['home']) . $delimiter;

    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) {
        $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
      }
      echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

    } elseif ( is_search() ) {
      echo $before . sprintf($text['search'], get_search_query()) . $after;

    } elseif ( is_day() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        // printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $delimiter);
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      $cats = get_category_parents($cat, TRUE, $delimiter);
      $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
      $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
      echo $cats;
      printf($link, get_permalink($parent), $parent->post_title);
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo $delimiter;
      }
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . sprintf($text['author'], $userdata->display_name) . $after;

    } elseif ( is_404() ) {
      echo $before . $text['404'] . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page', 'blitz') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</ul>';

  }
} // Breadcrumbs / End



/*-----------------------------------------------------------------------------------*/
/*  Pagination
/*-----------------------------------------------------------------------------------*/
if(!function_exists('ecobox_pagination')) {
	function ecobox_pagination($pages = '', $range = 2) { 
		$showitems = ($range * 2)+1; 

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
		}  

		if(1 != $pages) {
		echo "<ul class=\"pagination no-bottom-margin\">";
		// if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a class='first' href='".get_pagenum_link(1)."'>First</a></li>";
		if($paged > 1) echo "<li class='prev'><a href='".get_pagenum_link($paged - 1)."'><i class=\"fa fa-angle-left fa-lg\"></i></a></li>";

		for ($i=1; $i <= $pages; $i++) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){ echo ($paged == $i)? "<li class='active'><span class=\"current\">".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
			}
		}

		if ($paged < $pages) echo "<li class='next'><a href=\"".get_pagenum_link($paged + 1)."\"><i class=\"fa fa-angle-right fa-lg\"></i></a></li>"; 
		// if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a class='last' href='".get_pagenum_link($pages)."'>Last</a></li>";
		echo "</ul>\n";
		}
	}
}



/*-----------------------------------------------------------------------------------*/
/*  Twitter Date
/*-----------------------------------------------------------------------------------*/
if(!function_exists('ecobox_twitter_time')) {
	function ecobox_twitter_time($a) {
		//get current timestampt
		$b = strtotime("now"); 
		//get timestamp when tweet created
		$c = strtotime($a);
		//get difference
		$d = $b - $c;
		//calculate different time values
		$minute = 60;
		$hour   = $minute * 60;
		$day    = $hour * 24;
		$week   = $day * 7;
		  
		if(is_numeric($d) && $d > 0) {
			//if less then 3 seconds
			if($d < 3) return __('right now', 'ecobox');
			//if less then minute
			if($d < $minute) return floor($d) . __(' seconds ago', 'ecobox');
			//if less then 2 minutes
			if($d < $minute * 2) return __('about 1 minute ago', 'ecobox');
			//if less then hour
			if($d < $hour) return floor($d / $minute) . __(' minutes ago', 'ecobox');
			//if less then 2 hours
			if($d < $hour * 2) return __('about 1 hour ago', 'ecobox');
			//if less then day
			if($d < $day) return floor($d / $hour) . __(' hours ago', 'ecobox');
			//if more then day, but less then 2 days
			if($d > $day && $d < $day * 2) return __('yesterday', 'ecobox');
			//if less then year
			if($d < $day * 365) return floor($d / $day) . __(' days ago', 'ecobox');
			//else return more than a year
			return __('over a year ago', 'ecobox');
		}
	}
}



/*-----------------------------------------------------------------------------------*/
/*  Remove Empty Paragraphs
/*-----------------------------------------------------------------------------------*/
add_filter('the_content', 'ecobox_shortcode_empty_paragraph_fix');
function ecobox_shortcode_empty_paragraph_fix($content)
{   
  $array = array (
      '<p>[' => '[', 
      ']</p>' => ']', 
      ']<br />' => ']'
  );

  $content = strtr($content, $array);

return $content;
}



/*-----------------------------------------------------------------------------------*/
/*  Related Posts
/*-----------------------------------------------------------------------------------*/
if(!function_exists('ecobox_get_related_posts')) {
	function ecobox_get_related_posts($post_id) {
		$query = new WP_Query();

	  $args = '';

		$args = wp_parse_args($args, array(
			'showposts'           => 3,
			'post__not_in'        => array($post_id),
			'ignore_sticky_posts' => 0,
			'category__in'        => wp_get_post_categories($post_id)
		));
		
		$query = new WP_Query($args);
		return $query;
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Password protected post
/*-----------------------------------------------------------------------------------*/
if(!function_exists('ecobox_password_form')) {
	function ecobox_password_form() {
		global $post;
		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
		$output = '<form class="form-inline" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		<p>' . __( "To view this protected post, enter the password below:", "ecobox" ) . '</p>
		<div class="form-group"><label for="' . $label . '">' . __( "Password:", "ecobox" ) . ' </label> &nbsp; <input class="form-control" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /> &nbsp; </div><input type="submit" class="btn btn-primary" name="Submit" value="' . esc_attr__( "Submit", "ecobox" ) . '" />
		</form>
		';
		return $output;
	}
}
add_filter( 'the_password_form', 'ecobox_password_form' );

// Add the Password Form to the Excerpt (for password protected posts)
if(!function_exists('ecobox_excerpt_password_form')) {
	function ecobox_excerpt_password_form( $excerpt ) {
	  if ( post_password_required() )
	  	$excerpt = get_the_password_form();
	  return $excerpt;
	}
	add_filter( 'the_excerpt', 'ecobox_excerpt_password_form' );
}



/*-----------------------------------------------------------------------------------*/
/*  Custom Comments Callback
/*-----------------------------------------------------------------------------------*/
function ecobox_comments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
    
	if ( 'div' == $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-wrap">
	<?php endif; ?>
	<header class="media-heading">
		<div class="reply-btn pull-right">
		<?php comment_reply_link(array_merge( $args, array(
			'add_below'   => $add_below,
			'depth'       => $depth,
			'reply_text'  => '<i class="fa fa-reply"></i>',
			'max_depth'   => $args['max_depth']
			))) ?>
		</div>
		<div class="comment-author vcard">
			<figure class="avatar alignleft">
			<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, 86 ); ?>
			</figure>
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'ecobox') ?></em>
		<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
		printf( __('%1$s at %2$s', 'ecobox'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'ecobox'),'  ','' );
		?>
		</div>
	</header>

	<div class="media-body">
		<?php comment_text() ?>
	</div>
	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }


add_filter('comment_reply_link', 'ecobox_replace_reply_link_class');

function ecobox_replace_reply_link_class($class){
	$class = str_replace("class='comment-reply-link", "class='btn btn-default btn-xs", $class);
	return $class;
}




/*-----------------------------------------------------------------------------------*/
/*  Custom Post Types
/*-----------------------------------------------------------------------------------*/

// Portfolio
function ecobox_create_post_type_portfolio() {
	register_post_type( 'portfolio',
	array( 
	'label'             => __('Portfolio', 'ecobox'), 
	'singular_label'    => __('Porfolio Item', 'ecobox'),
	'_builtin'          => false,
	'public'            => true,
	'show_ui'           => true,
	'show_in_nav_menus' => true,
	'hierarchical'      => true,
	'capability_type'   => 'page',
	'menu_icon'         => 'dashicons-format-gallery',
	'rewrite'           => array(
		'slug'       => 'portfolio-view',
		'with_front' => FALSE,
	),
	'supports'          => array(
		'title',
		'editor',
		'thumbnail',
		'excerpt',
		'custom-fields',
		'comments')
		) 
	);

	register_taxonomy(
		'portfolio_category', 'portfolio', 
		array(
			'hierarchical'  => true, 
			'label'         => __('Porfolio Categories', 'ecobox'),
			'singular_name' => __('Category', 'ecobox'), 
			'rewrite'       => true, 
			'query_var'     => true
		)
	);
}
add_action('init', 'ecobox_create_post_type_portfolio'); // Add Portfolio Custom Post Type


// If no category selected, post in 'Uncategorized'
function ecobox_mfields_set_default_object_terms( $post_id, $post ) {
  if ( 'publish' === $post->post_status && $post->post_type === 'portfolio' ) {
    $defaults = array(
      'portfolio_category' => array( 'Uncategorized' )
    );
	  $taxonomies = get_object_taxonomies( $post->post_type );
	  foreach ( (array) $taxonomies as $taxonomy ) {
      $terms = wp_get_post_terms( $post_id, $taxonomy );
      if ( empty( $terms ) && array_key_exists( $taxonomy, $defaults ) ) {
        wp_set_object_terms( $post_id, $defaults[$taxonomy], $taxonomy );
      }
    }
  }
}
add_action( 'save_post', 'ecobox_mfields_set_default_object_terms', 100, 2 );



// Video Link Parser
if(!function_exists('ecobox_video_link_parser')) {
	function ecobox_video_link_parser( $link ) {
	  $parsed_url = parse_url( $link );

	  $host = $parsed_url['host'];

	  // check that the service exists, otherwise return false
	  if( strpos( $host, 'youtube.com' ) !== false
			&& strpos( $host, 'youtu.be' ) !== false
			&& strpos( $host, 'vimeo.com' ) !== false ) {
			return false;
	  }

	  // set $service
	  if( strpos( $host, 'youtube.com' ) !== false
	   || strpos( $host, 'youtu.be' ) !== false ) {
	  	$service = 'youtube';
	  }
	  if( strpos( $host, 'vimeo.com' ) !== false ) {
			// handle vimeo
			$service = 'vimeo';
	  }

	  // set $video_id
	  if( strpos( $host, 'youtube.com' ) !== false ) {
			// handle youtube regular url
			$vars = array();

			parse_str( $parsed_url['query'], $vars );

			$video_id = $vars['v'];
	  }
	  if( strpos( $host, 'youtu.be' ) !== false ) {
			// handle youtube shortened URL
			$video_id = $parsed_url['path'];
	  }
	  if( strpos( $host, 'vimeo.com' ) !== false ) {
			// handle vimeo
			$video_id = $parsed_url['path'];
	  }

	  return array(
			'service' => $service, // youtube or vimeo
			'id'      => $video_id // the id of the video
	  );
	}
}



/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// The excerpt based on words
if(!function_exists('ecobox_string_limit_words')) {
	function ecobox_string_limit_words($string, $word_limit) {
		$words = explode(' ', $string, ($word_limit + 1));
		if(count($words) > $word_limit)
		array_pop($words);
		return implode(' ', $words).'... ';
	}
}

// Images quality
add_filter( 'jpeg_quality', 'ecobox_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'ecobox_image_full_quality' );
function ecobox_image_full_quality( $quality ) {
	return 50; 
}


/*------------------------------------*\
    WPML compatibility
\*------------------------------------*/
function ecobox_wpml_translate_filter( $name, $value ) {
    return icl_translate( 'ecobox', 'ecobox_' . $name, $value );
}
//Check if WPML is activated
if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
    add_filter( 'ecobox_text_translate', 'ecobox_wpml_translate_filter', 10, 2 );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';