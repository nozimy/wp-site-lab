<?php 

function zl_option( $name, $callback = null )
{
	$option = vp_option( "zl_option." . $name );
	if (empty($option)) {
		$option = $callback;
	} 
    return $option;
}

/**
 * Set up the content width value based on the theme's design.
 *
 * @see zatolab_content_width()
 *
 * @since Dichan 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

if ( ! function_exists( 'vienna_setup' ) ) :
/**
 * Vienna setup.
 *
 */
function vienna_setup() {

	/*
	 * Make Vienna available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Vienna, use a find and
	 * replace to change 'zatolab' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'zatolab', get_template_directory() . '/lang' );

	// This theme styles the visual editor to resemble the theme style.
	
	add_editor_style( get_template_directory_uri() . '/lib/css/editor-style.css' );


	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 672, 372, true );
	add_image_size( 'zatolab-full-width', 1038, 576, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'zatolab' ),
		//'secondary' => __( 'Secondary menu in left sidebar', 'zatolab' ),
	) );
	/*-----------------------------------------------------------------------------------*/
	// MENU
	/*-----------------------------------------------------------------------------------*/
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'zatolab' ),
	));	
	function zl_fallbackmenu(){ ?>
		<li><a href="#">Go to Adminpanel > Appearance > Menus to create your menu. WP 3.0++ is required</a></li>
	<?php }	

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'status', 'video', 'audio', 'quote', 'link', 'gallery', 'chat'
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // dichan_setup
add_action( 'after_setup_theme', 'vienna_setup' );

/**
 * Adjust content_width value for image attachment template.
 *
 * @since Dichan 1.0
 *
 * @return void
 */
function zatolab_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'zatolab_content_width' );


function zl_postMeta(){
	global $post;
	?>
	<div id="zl_post_id_meta-<?php the_ID();?>">
		<ul class="zl_post_id_meta">
			<li><span class="dashicons dashicons-portfolio"></span> 
			<?php 
			$category = get_the_category(); 
			//echo $category[0]->cat_name;
			?>
			<a href="<?php echo get_category_link( $category[0]->term_id );?>"><?php echo $category[0]->cat_name; ?></a>
			</li>
			<li><span class="dashicons dashicons-admin-comments"></span> <a href="<?php the_permalink(); ?>#zl_comments"><?php comments_number( '0', '1', '%' ); ?></a></li>
			<li><span class="dashicons dashicons-visibility"></span> <a href="<?php the_permalink();?>"><?php echo zl_getPostViews(get_the_ID()); ?></a></li>
			<?php 
				$likes = get_post_meta( get_the_ID(), "_post_like_count", true );
				if ($likes == 0) {
					$liked = '0';
				} else {
					$liked = $likes;
				}
			 ?>
			<li><span class="dashicons dashicons-heart"></span> <?php echo $liked ?></li>
		</ul>
	</div>
<?php }


/**
 * Query Vars
 *
 */
function add_query_vars_filter( $vars ){
  $vars[] = "sortby";
  $vars[] = "order";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function search_url_rewrite_rule() {
	if ( is_search() && !empty($_GET['s'])) {
		wp_redirect(home_url("/search/") . urlencode(get_query_var('s')));
		exit();
	}	
}
add_action('template_redirect', 'search_url_rewrite_rule');



function remove_shortcode_in_album($content) {
  if ( is_singular( 'zl_album' ) ) {
   		$content = strip_shortcodes( $content );
  }
  return $content;
}
add_filter('the_content', 'remove_shortcode_in_album');


function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}

add_filter('pre_get_posts','SearchFilter');


// add new field under gallery post format forms ui
add_action( 'vp_pfui_after_gallery_meta', 'mytheme_add_gallery_type_field' );
 
// handle the saving of our new field
add_action( 'admin_init', 'mytheme_admin_init' );
 
function mytheme_admin_init() {
	$post_formats = get_theme_support('post-formats');
	if (!empty($post_formats[0]) && is_array($post_formats[0])) {
		if (in_array('gallery', $post_formats[0])) {
			add_action('save_post', 'mytheme_format_gallery_save_post');
		}
	}
}
 
function mytheme_add_gallery_type_field() {
	global $post;
	$type = get_post_meta($post->ID, '_format_gallery_type', true);
	?>
	<div class="vp-pfui-elm-block">
		<label for="vp-pfui-format-gallery-type"><?php _e('Gallery Type', 'my-theme'); ?></label>
 
		<!-- Radio Button Sample -->
		<input type="radio" name="_format_gallery_type" value="slide" id="slide" <?php checked( $type, "slide" ); ?>><label style="display: inline-block;" for="slide">Slide</label>
		<input type="radio" name="_format_gallery_type" value="grid" id="grid" <?php checked( $type, "grid" ); ?>><label style="display: inline-block;" for="grid">Photo Grid</label>
		<input type="radio" name="_format_gallery_type" value="justified" id="justified" <?php checked( $type, "justified" ); ?>><label style="display: inline-block;" for="justified">Justified Gallery</label>
 
		<!-- Select Box Sample -->
 		<!-- <select name="_format_gallery_type" id="vp-pfui-format-gallery-type">
			<option value="option1" <?php selected( $type, "option1" ); ?>>Option 1</option>
			<option value="option2" <?php selected( $type, "option2" ); ?>>Option 2</option>
			<option value="option3" <?php selected( $type, "option3" ); ?>>Option 3</option>
		</select> -->
 
		<!-- Text Box Sample -->
		<!-- <input type="text" name="_format_gallery_type" value="<?php echo esc_attr(get_post_meta($post->ID, '_format_gallery_type', true)); ?>" id="vp-pfui-format-gallery-type" tabindex="1" /> -->
	</div>
	<?php
}
 
function mytheme_format_gallery_save_post($post_id) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (!defined('XMLRPC_REQUEST') && isset($_POST['_format_gallery_type'])) {
		update_post_meta($post_id, '_format_gallery_type', $_POST['_format_gallery_type']);
	}
}
// Extra
function zl_article_extra(){
	global $post;
 ?>

	<!-- category, link, comment -->
	<div id="zl_post_id_meta">
		<ul class="zl_post_id_meta">
			<li><span class="dashicons dashicons-portfolio"></span> 
				<?php 
					$category = get_the_category(); 
					//echo $category[0]->cat_name;
					?>
				<a href="<?php echo get_category_link( $category[0]->term_id );?>"><?php echo $category[0]->cat_name; ?></a>
			</li>
			<li><span class="dashicons dashicons-admin-comments"></span> <a href="<?php the_permalink(); ?>#zl_comments"><?php comments_number( '0', '1', '%' ); ?></a></li>
			<li><span class="dashicons dashicons-visibility"></span> <a href="<?php the_permalink();?>"><?php echo zl_getPostViews(get_the_ID()); ?></a></li>
			<li><?php echo getPostLikeLink( $post->ID );?></li>
		</ul>
	</div>
	<div class="clear"></div>
	<!-- oooooooooooooooooooooooooooooooooo
		Tags
		oooooooooooooooooooooooooooooooooooo-->
	<?php 
		echo "<div class='zl_posttags'>";
		the_tags('<span>' . zl_option('lang_tags', __('Tagged with: ', 'zatolab')) . '</span><div class="clear"></div>', ' ', '<br />');
		echo "</div>";
	 ?>
	 <div class="clear"></div>
	<!-- oooooooooooooooooooooooooooooooooo
		Share Button
		oooooooooooooooooooooooooooooooooooo-->
	<?php 
	if(vp_option('zl_option.show_share') == 1):
	 ?>
	<a class="zl_post_readmore is_single" id="zl_share_it"><span class="dashicons dashicons-share"></span> <?php echo zl_option('lang_share', __('Share', 'zatolab'));?></a>
	<ul id="share_button">
		<?php 
			$link =  get_permalink();
			$linkparse = urlencode($link);
			?>
		<?php 
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url( $thumb,'full' );  

		?>
		<ul class="sharelist">
			<li><a onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="sicon-facebook"></i> Facebook</a></li>

			<li><a onclick="window.open('https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php echo rawurlencode(get_the_title()); ?>&amp;url=<?php the_permalink();?>','Twitter','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php echo rawurlencode(get_the_title()); ?>&amp;url=<?php the_permalink();?>"><i class="sicon-twitter"></i> Twitter</a></li>

			<li><a onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','Google Plus','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="dashicons dashicons-googleplus"></i> Google+</a></li>
			<?php /*
			<li><a onclick="window.open('http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>','Reddit','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>"><i class="sicon-reddit"></i></a></li>

			<li><a onclick="window.open('http://digg.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>','Digg','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://digg.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>#sthash.P7yHgObG.dpuf"><i class="sicon-digg"></i></a></li>
			*/?>

			<li><a onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>&amp;summary=<?php echo rawurlencode(get_the_excerpt()); ?>&amp;source=<?php the_permalink(); ?>','LinkedIn','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>&amp;summary=<?php echo rawurlencode(get_the_excerpt()); ?>&amp;source=<?php get_permalink(); ?>"><i class="sicon-linkedin"></i> LinkedIn</a></li>

			<li><a onclick="window.open('https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $img_url; ?>&amp;description=<?php echo rawurlencode(get_the_excerpt()); ?>','Pinterest','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;"  href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $img_url; ?>&amp;description=<?php echo rawurlencode(get_the_excerpt()); ?>"><i class="sicon-pinterest"></i> Pinterest</a></li>

			<li><a onclick="window.open('http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>','Google Plus','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(get_the_title()); ?>"><i class="sicon-stumbleupon"></i> Stumbleupon</a></li>

			<li><a onclick="window.open('http://www.tumblr.com/share/link?url=<?php the_permalink(); ?>&amp;name=<?php echo rawurlencode(get_the_title()); ?>&amp;description=<?php echo rawurlencode(get_the_excerpt()); ?>','Google Plus','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.tumblr.com/share/link?url=<?php the_permalink(); ?>&amp;name=<?php echo rawurlencode(get_the_title()); ?>&amp;description=<?php echo rawurlencode(get_the_excerpt()); ?>"><i class="sicon-tumblr"></i> Tumblr</a></li>

			<li><a href="mailto:?subject=<?php echo rawurlencode('I want to share ' . get_the_title() . ' from '); ?><?php echo rawurlencode(get_bloginfo('name')); ?>&amp;amp;body=<?php echo rawurlencode('See more at '.get_permalink()); ?>"><i class="entypo mail"></i> Mail</a></li>
	</ul>
	<!-- end share button -->
	<div class="clear"></div><br>
	<?php endif; ?>
<?php } 

function content($limit) {
	$content = explode(' ', get_the_content(), $limit);
	if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
	} else {
		$content = implode(" ",$content);
	}	
	$content = preg_replace('/\[.+\]/','', $content);
	$content = apply_filters('the_content', $content); 
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}
