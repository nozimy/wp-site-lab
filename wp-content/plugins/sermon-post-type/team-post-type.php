<?php
/**
 * Team Post Type
 *
 * @package   Portfolio_Post_Type
 * @author    Devin Price
 * @license   GPL-2.0+
 * @link      http://wptheming.com/portfolio-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 *
 * @wordpress-plugin
 * Plugin Name: Sermon manager
 * Plugin URI:  http://wptheming.com/portfolio-post-type/
 * Description: Enables a portfolio post type and taxonomies.
 * Version:     0.9.1
 * Author:      Devin Price
 * Author URI:  http://www.wptheming.com/
 * Text Domain: portfolioposttype
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/interface-sermon-gamajo-registerable.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-gamajo-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-gamajo-taxonomy.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-post-type-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-post-type-taxonomy-category.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-post-type-taxonomy-tag.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-post-type-registrations.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$sermon_post_type_registrations = new Sermon_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$sermon_post_type = new Sermon_Post_Type( $sermon_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $sermon_post_type, 'activate' ) );

// Initialise registrations for post-activation requests.
$sermon_post_type_registrations->init();

add_action( 'init', 'sermon_post_type_init', 100 );
/**
 * Adds styling to the dashboard for the post type and adds portfolio posts
 * to the "At a Glance" metabox.
 *
 * Adds custom taxonomy body classes to portfolio posts on the front end.
 *
 * @since 0.8.3
 */
function sermon_post_type_init() {
	if ( is_admin() ) {
		global $sermon_post_type_admin, $sermon_post_type_registrations;
		// Loads for users viewing the WordPress dashboard
		if ( ! class_exists( 'Gamajosermon_Dashboard_Glancer' ) ) {
			require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-gamajo-dashboard-glancer.php';  // WP 3.8
		}
		require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-post-type-admin.php';
		$sermon_post_type_admin = new Sermon_Post_Type_Admin( $sermon_post_type_registrations );
		$sermon_post_type_admin->init();
	} else {
		// Loads for users viewing the front end
		if ( apply_filters( 'sermonposttype_add_taxonomy_terms_classes', true ) ) {
			if ( ! class_exists( 'Gamajosermon_Single_Entry_Term_Body_Classes' ) ) {
				require plugin_dir_path( __FILE__ ) . 'includes/class-sermon-gamajo-single-entry-term-body-classes.php';
			}
			$sermon_post_type_body_classes = new Gamajosermon_Single_Entry_Term_Body_Classes;
			$sermon_post_type_body_classes->init( 'sermon' );
		}
	}
}
