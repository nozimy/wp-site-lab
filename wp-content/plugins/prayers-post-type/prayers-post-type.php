<?php
/**
 * Prayers Post Type
 *
 * @package   Prayers_Post_Type
 * @author    Devin Price
 * @license   GPL-2.0+
 * @link      http://wptheming.com/prayers-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 *
 * @wordpress-plugin
 * Plugin Name: Prayers Post Type
 * Plugin URI:  http://wptheming.com/prayers-post-type/
 * Description: Enables a prayers post type and taxonomies.
 * Version:     0.9.1
 * Author:      Devin Price
 * Author URI:  http://www.wptheming.com/
 * Text Domain: prayersposttype
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/class-prayers-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/interface-gamajo-prayers-registerable.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-prayers-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-prayers-taxonomy.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-prayers-post-type-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-prayers-post-type-taxonomy-category.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-prayers-post-type-taxonomy-tag.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-prayers-post-type-registrations.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$prayers_post_type_registrations = new Prayers_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$prayers_post_type = new Prayers_Post_Type( $prayers_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $prayers_post_type, 'activate' ) );

// Initialise registrations for post-activation requests.
$prayers_post_type_registrations->init();

add_action( 'init', 'prayers_post_type_init', 100 );
/**
 * Adds styling to the dashboard for the post type and adds prayers posts
 * to the "At a Glance" metabox.
 *
 * Adds custom taxonomy body classes to prayers posts on the front end.
 *
 * @since 0.8.3
 */
function prayers_post_type_init() {
	if ( is_admin() ) {
		global $prayers_post_type_admin, $prayers_post_type_registrations;
		// Loads for users viewing the WordPress dashboard
		if ( ! class_exists( 'Gamajoprayersprayers_Dashboard_Glancer' ) ) {
			require plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-prayers-dashboard-glancer.php';  // WP 3.8
		}
		require plugin_dir_path( __FILE__ ) . 'includes/class-prayers-post-type-admin.php';
		$prayers_post_type_admin = new Prayers_Post_Type_Admin( $prayers_post_type_registrations );
		$prayers_post_type_admin->init();
	} else {
		// Loads for users viewing the front end
		if ( apply_filters( 'prayersposttype_add_taxonomy_terms_classes', true ) ) {
			if ( ! class_exists( 'Gamajoprayers_Single_Entry_Term_Body_Classes' ) ) {
				require plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-prayers-single-entry-term-body-classes.php';
			}
			$prayers_post_type_body_classes = new Gamajoprayers_Single_Entry_Term_Body_Classes;
			$prayers_post_type_body_classes->init( 'prayers' );
		}
	}
}
