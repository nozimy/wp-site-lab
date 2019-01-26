<?php
/**
 * Portfolio Post Type
 *
 * @package   Portfolio_Post_Type
 * @author    Devin Price
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      http://wptheming.com/portfolio-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 */

/**
 * Portfolio category taxonomy.
 *
 * @package Portfolio_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Sermon_Post_Type_Taxonomy_Category extends Gamajosermon_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'sermon_category';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => __( 'Sermon Categories', 'sermon-post-type' ),
			'singular_name'              => __( 'Sermon Category', 'sermon-post-type' ),
			'menu_name'                  => __( 'Sermon Categories', 'sermon-post-type' ),
			'edit_item'                  => __( 'Edit Sermon Category', 'sermon-post-type' ),
			'update_item'                => __( 'Update Sermon Category', 'sermon-post-type' ),
			'add_new_item'               => __( 'Add New Sermon Category', 'sermon-post-type' ),
			'new_item_name'              => __( 'New Sermon Category Name', 'sermon-post-type' ),
			'parent_item'                => __( 'Parent Sermon Category', 'sermon-post-type' ),
			'parent_item_colon'          => __( 'Parent Sermon Category:', 'sermon-post-type' ),
			'all_items'                  => __( 'All Sermon Categories', 'sermon-post-type' ),
			'search_items'               => __( 'Search Sermon Categories', 'sermon-post-type' ),
			'popular_items'              => __( 'Popular Sermon Categories', 'sermon-post-type' ),
			'separate_items_with_commas' => __( 'Separate Sermon categories with commas', 'sermon-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove Sermon categories', 'sermon-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used Sermon categories', 'sermon-post-type' ),
			'not_found'                  => __( 'No Sermon categories found.', 'sermon-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'sermon_category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		return apply_filters( 'sermonposttype_category_args', $args );
	}
}