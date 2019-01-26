<?php 

$customfont = zl_option('usecustomfont');
/*--------------------------------------
//add the font
--------------------------------------*/
$body_font_face   = zl_option('body_font_face');
$body_font_weight = zl_option('body_font_weight');
$body_font_style  = zl_option('body_font_style');

$h1_font_face   = zl_option('h1_font_face');
$h1_font_weight = zl_option('h1_font_weight');
$h1_font_style  = zl_option('h1_font_style');

VP_Site_GoogleWebFont::instance()->add($body_font_face, $body_font_weight, $body_font_style);
VP_Site_GoogleWebFont::instance()->add($h1_font_face, $h1_font_weight, $h1_font_style);
function zl_embed_fonts()
{
	VP_Site_GoogleWebFont::instance()->register_and_enqueue();
}


if ($customfont == "1") {
add_action('wp_enqueue_scripts', 'zl_embed_fonts'); //Enqueue when use custom font is enabled
}  



/**
 * Register Open Sans Google font for Vienna.
 *
 * @since Vienna 1.0
 *
 * @return string
 */
function zatolab_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Vienna, translate this to 'off'. Do not translate into your own language.
	 */
	$font_url = add_query_arg( 'family',  'Open+Sans:400italic,600italic,700italic,800italic,400,600,700,800', "//fonts.googleapis.com/css" );
	return $font_url;
}

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Vienn 1.0
 *
 * @return void
 */
function zatolab_admin_fonts() {
	wp_enqueue_style( 'zatolab-opensans', zatolab_font_url(), array(), null );
	wp_register_style( 'zatolab-opensans' );
}
if ( 0 == $customfont ) {
	add_action( 'admin_print_scripts-appearance_page_custom-header', 'zatolab_admin_fonts' );
}  

?>