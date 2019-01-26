<?php
/**
 * Template Filters
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Extend the default WordPress body class
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 * @since 1.0
 */
function humble_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';
    if( ! get_theme_mod ('featured_carousel') == true ) :
		$classes[] = 'no-featured';
    endif;
	return $classes;
}

add_filter( 'body_class', 'humble_body_class' );

/**
 * Content Class Filter
 *
 * @since 1.0
 */
if ( ! function_exists( 'humble_content_class' ) ) :
    function humble_content_class() {
		$content_class = get_theme_mod ('humble_sidebar');
        if ( $content_class == 'r_sidebar' ) {
            $class = 'main-content pull-left';
        } elseif ( $content_class == 'l_sidebar' ) {
            $class = 'main-content pull-right';
        } elseif ( $content_class == 'no_sidebar' ) {
            $class = 'main-content fullwidth';
        } else {
            $class = 'main-content pull-left';
        }
	    return $class;
    }
endif;

/**
 * Sidebar Class Filter
 *
 * @since 1.0
 */
if ( ! function_exists( 'humble_sidebar_class' ) ) :
    function humble_sidebar_class() {
		$sidebar_class = get_theme_mod ('humble_sidebar');
        if ( $sidebar_class == 'r_sidebar' ) {
            $class = 'sidebar pull-right';
        } elseif ( $sidebar_class == 'l_sidebar' ) {
            $class = 'sidebar pull-left';
        } elseif ( $sidebar_class == 'no_sidebar' ) {
            $class = 'hidden';
        } else {
            $class = 'sidebar pull-right';
        }
        return $class;
    }
endif;


/**
 * Post Class Filter
 *
 * @since 1.0
 */
if ( ! function_exists( 'humble_post_class' ) ) :
    function humble_post_class() {
		$content_class = get_theme_mod ('standard');
        if ( $content_class == 'list' ) {
            $class = 'humble-listview';
        } else {
            $class = 'row';
        }
	    return $class;
    }
endif;
