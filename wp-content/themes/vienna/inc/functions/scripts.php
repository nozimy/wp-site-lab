<?php 

/**
 * Check custom css directory
 */
function pre_check_custom_css_writable() {
	// custom css directory
	$the_dir = get_template_directory() . "/lib/css";

	if(!get_filesystem_method(array(), $the_dir ) == "direct")
	add_action("admin_notices", "pre_notice_custom_css_permission");
}
add_action( "admin_init", "pre_check_custom_css_writable" );

/**
 * Display notice if user need to set permission for directory
 */
function pre_notice_custom_css_permission(){
	echo '<div class="error">';
	echo "
	<p>This theme needs permission to write custom styles in css file. Please change directory permission at ( [theme_directory]/lib/css) to 644 or higher. If the css file still doesn't works (can't generate value by theme options to css file), make sure that <code>url_allow_fopen</code> enabled. If you didn't know what is that means, please contact your hosting provider to enable that. </p>";
	echo '</div>';
}

/**
 * Write CSS value from php to css file
 */
function zl_generate_options_css( $option ) {
	$cssdata = $option;
	$css_dir = get_template_directory() . '/lib/css/'; 
	if(is_multisite()) {
		$aq_uploads_dir = trailingslashit($uploads['basedir']);
	} else {
		$aq_uploads_dir = $css_dir;
	}
	ob_start();
	require( $css_dir . 'custom.php' ); //CSS php to get theme options for dynamic css
	$css = ob_get_clean();
	global $wp_filesystem;
	WP_Filesystem();
	if ( ! $wp_filesystem->put_contents( $css_dir . 'custom.css', $css, 0644 ) ) { //the writable css file
		return true;
	} 
}

/**
 * Hook the zl_generate_options_css() function to vp_option everytime save, restore, import and db init pressed
 * add_action('vp_option_after_ajax_save-zl_option', 'zl_generate_options_css', 10, 1);
 * add_action('vp_option_after_ajax_restore-zl_option', 'zl_generate_options_css', 10, 1);
 * add_action('vp_option_after_ajax_import-zl_option', 'zl_generate_options_css', 10, 1);
 * add_action('vp_option_after_db_init-zl_option', 'zl_generate_options_css', 10, 1);
 */
add_action('vp_option_after_ajax_save-zl_option', 'zl_generate_options_css', 10, 1);
add_action('vp_option_after_ajax_restore-zl_option', 'zl_generate_options_css', 10, 1);
add_action('vp_option_after_ajax_import-zl_option', 'zl_generate_options_css', 10, 1);
add_action('vp_option_after_db_init-zl_option', 'zl_generate_options_css', 10, 1);

/**
 * Check if first time visitor
 */
function is_first_time() {
    if (isset($_COOKIE['_wp_first_time']) || is_user_logged_in()) {
        return false;
    } else {
        // expires in 30 days.
        setcookie('_wp_first_time', 1, time() + (WEEK_IN_SECONDS * 4), COOKIEPATH, COOKIE_DOMAIN, false);

        return true;
    }
}
add_action( 'init', 'is_first_time');

function zl_script() {
	/* ========================================= 
	CSS STYLES
	========================================= */
	$the_dir = get_template_directory() . "/lib/css";
		
	/*Foundation*/
	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/lib/css/foundation.css', array(), '1.0.0' );

	/*Dashicons*/
	wp_enqueue_style( 'dashicons-custom', get_template_directory_uri() . '/lib/css/dashicons.css', array(), '1.0.0' );

	/*Plugins, all in one*/
	wp_enqueue_style( 'plugins', get_template_directory_uri() . '/lib/css/plugins.css', array(), '1.0.0' );

	/*Theme's style.css*/
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	/* Responsive */
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/lib/css/responsive.css', array(), '1.0.0' );

	/* Check If multisite directory to store custom. */
	if(is_multisite()) {
		$uploads = wp_upload_dir();
		wp_register_style('customstyle', $uploads['baseurl'] . '/custom.css', 'style');
	} else {
		wp_enqueue_style( 'customstyle', get_template_directory_uri() . '/lib/css/custom.css', array(), '1.0.0' );
	} //endif is_multisite

	
	/* ========================================= 
	JavaScript
	========================================= */

	/* Comment Reply, used in article page only */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	/* Include jQuery from WordPress core */ 
	wp_enqueue_script( 'jquery' );

	/* Modernizr */
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/lib/js/vendor/modernizr.js', array( 'jquery' ), '20140304', false );

	/* jQuery Plugins that required for this theme, put it into one file to reduce http requests */
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/lib/js/plugins.js', array( 'jquery' ), '20140304', true );

	/* jQuery Pace, if first visit load the script, if not then throws the script away */


	if (is_first_time() && vp_option('zl_option.use_preload') == 1 ) {
	    wp_enqueue_script( 'pace', get_template_directory_uri() . '/lib/js/pace.min.js', array( 'jquery' ), '20140304', false );
	}

	/* ========================================= 
	Front end Posting Scripts
	========================================= */
	if( 1 == zl_option('show_frontendpost') ){
		if(! is_singular() or is_page_template( 'template-browse.php' ) or is_home() ){
			if(is_user_logged_in() && ! is_singular()){

				wp_enqueue_script('apf', get_template_directory_uri() . '/lib/js/apf.js', array('jquery'), true);
				wp_localize_script( 'apf', 'apfajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
				/* Ajax Gallery Upload */
				wp_enqueue_media();
				wp_enqueue_script('degalleria', get_template_directory_uri() . '/lib/js/ajax-upload_pattern.js', array('jquery'), true);

				wp_localize_script(
					'degalleria',
					'vp_pfui_post_format',
					array(
						'loading'      => zl_option('lang_loading', __('Loading...', 'zatolab')),
						'wpspin_light' => admin_url('images/wpspin_light.gif'),
						'media_title'  => zl_option('lang_pickimage', __('Pick Gallery Images', 'zatolab')),
						'media_button' => zl_option('lang_addimage', __('Add Image(s)', 'zatolab'))
					)
				);
			}
		}
	}

	/* ========================================= 
	Portfolio Page
	========================================= */
	if( is_page_template('template-portfolio.php') or is_page_template('template-portfolio-4-columns.php') or is_page_template('template-portfolio-2-columns.php') ){
		wp_enqueue_script('isotope', get_template_directory_uri() . '/lib/js/isotope.pkgd.min.js', array('jquery'), true);
		wp_enqueue_script('portfolio', get_template_directory_uri() . '/lib/js/portfolio.js', array('jquery'), true);
	} // End Portfolio page
	
	if(is_singular( 'zl_portfolio' )){
		wp_enqueue_script('single_portfolio', get_template_directory_uri() . '/lib/js/singleportfolio.js', array('jquery'), true);
	}

	/* ========================================= 
	Autcomplete
	========================================= */
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_enqueue_style( 'jquery-ui-styles', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );

	// Vienna 
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/lib/js/custom.js', array( 'jquery' ), '20140304', true );

	// Need to load for Homepage and archive roll only.
	if(! is_singular() or is_page_template( 'template-browse.php' ) or is_home() or is_archive() ){
		wp_enqueue_script('home', get_template_directory_uri() . '/lib/js/home.js', array('jquery'), true);
	}

	// Front end poster form
	if(is_user_logged_in() && !is_singular() && 1 == zl_option('show_frontendpost')){
		wp_enqueue_script('poster', get_template_directory_uri() . '/lib/js/poster.js', array('jquery'), true);
	}
	//
	wp_localize_script( 'custom', 'ZlGallery', array( 'zlajaxgallery' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script( 'custom', 'AjaxPortfolio', array( 'portoajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script( 'custom', 'MyAutocomplete', array( 'autocomleteurl' => admin_url( 'admin-ajax.php' ) ) );
	
	//Localize Ajax Like Button 
	wp_localize_script( 'custom', 'ajax_var', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' )
		)
	);
}
add_action( 'wp_enqueue_scripts', 'zl_script' );

function zl_customscript(){ ?>
	<script>
		<?php echo zl_option('customscript'); ?>
	</script>
	<?php 
	$stickymenu = zl_option('stickymenu');
	if( $stickymenu == 1 ){
	?>
	<script>
		jQuery(document).ready(function(){
		    jQuery("#sticker").sticky({topSpacing:0});
		});
	</script>
<?php 
	}
}
add_action('wp_footer', 'zl_customscript', 100);

// Extreme Compress
/*remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);*/

?>