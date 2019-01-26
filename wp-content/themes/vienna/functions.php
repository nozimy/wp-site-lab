<?php


/**
 * Include Vafpress Framework
 */
require_once 'vafpress/bootstrap.php';

/**
 * Include Custom Data Sources
 */
require_once 'admin/data_sources.php';

/**
 * Load options, metaboxes
 */
// options
$tmpl_opt  = get_template_directory() . '/admin/option/option.php';
/**
 * Create instance of Options
 */
$theme_options = new VP_Option(array(
	'is_dev_mode'           => false,                                  // dev mode, default to false
	'option_key'            => 'zl_option',                           // options key in db, required
	'page_slug'             => 'zl_option',                           // options page slug, required
	'template'              => $tmpl_opt,                              // template file path or array, required
	'menu_page'             => 'themes.php',                           // parent menu slug or supply `array` (can contains 'icon_url' & 'position') for top level menu
	/*'menu_page'             => array('icon_url'=> 'http://facebook.com', 'position' => '59.54'),*/
	'use_auto_group_naming' => true,                                   // default to true
	'use_util_menu'         => true,                                   // default to true, shows utility menu
	'minimum_role'          => 'edit_theme_options',                   // default to 'edit_theme_options'
	'layout'                => 'fixed',                                // fluid or fixed, default to fixed
	'page_title'            => __( 'Theme Options', 'zatolab' ), // page title
	'menu_label'            => __( 'Theme Options', 'zatolab' ), // menu label
));

/**
 * Require core functions related to theme
 */
require_once 'inc/corefunctions.php';


/**
* Metabox
*/
$album  = get_template_directory() . '/admin/metabox/general.php';
$portfolio  = get_template_directory() . '/admin/metabox/portfolio.php';
$mb2 = new VP_Metabox($album);
$mb3 = new VP_Metabox($portfolio);
