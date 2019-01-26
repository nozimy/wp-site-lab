<?php
/**
 * Prayers Post Type
 *
 * @package   Prayers_Post_Type
 * @author    Devin Price
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      http://wptheming.com/prayers-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 */

/**
 * Prayers category taxonomy.
 *
 * @package Prayers_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Prayers_Post_Type_Taxonomy_Category extends Gamajoprayers_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'prayers_category';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => __( 'Prayers Categories', 'prayers-post-type' ),
			'singular_name'              => __( 'Prayers Category', 'prayers-post-type' ),
			'menu_name'                  => __( 'Prayers Categories', 'prayers-post-type' ),
			'edit_item'                  => __( 'Edit Prayers Category', 'prayers-post-type' ),
			'update_item'                => __( 'Update Prayers Category', 'prayers-post-type' ),
			'add_new_item'               => __( 'Add New Prayers Category', 'prayers-post-type' ),
			'new_item_name'              => __( 'New Prayers Category Name', 'prayers-post-type' ),
			'parent_item'                => __( 'Parent Prayers Category', 'prayers-post-type' ),
			'parent_item_colon'          => __( 'Parent Prayers Category:', 'prayers-post-type' ),
			'all_items'                  => __( 'All Prayers Categories', 'prayers-post-type' ),
			'search_items'               => __( 'Search Prayers Categories', 'prayers-post-type' ),
			'popular_items'              => __( 'Popular Prayers Categories', 'prayers-post-type' ),
			'separate_items_with_commas' => __( 'Separate prayers categories with commas', 'prayers-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove prayers categories', 'prayers-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used prayers categories', 'prayers-post-type' ),
			'not_found'                  => __( 'No prayers categories found.', 'prayers-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'prayers_category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		return apply_filters( 'prayersposttype_category_args', $args );
	}
}