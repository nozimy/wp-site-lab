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
 * Prayers tag taxonomy.
 *
 * @package Prayers_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Prayers_Post_Type_Taxonomy_Tag extends Gamajoprayers_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'prayers_tag';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => __( 'Prayers Tags', 'prayers-post-type' ),
			'singular_name'              => __( 'Prayers Tag', 'prayers-post-type' ),
			'menu_name'                  => __( 'Prayers Tags', 'prayers-post-type' ),
			'edit_item'                  => __( 'Edit Prayers Tag', 'prayers-post-type' ),
			'update_item'                => __( 'Update Prayers Tag', 'prayers-post-type' ),
			'add_new_item'               => __( 'Add New Prayers Tag', 'prayers-post-type' ),
			'new_item_name'              => __( 'New Prayers Tag Name', 'prayers-post-type' ),
			'parent_item'                => __( 'Parent Prayers Tag', 'prayers-post-type' ),
			'parent_item_colon'          => __( 'Parent Prayers Tag:', 'prayers-post-type' ),
			'all_items'                  => __( 'All Prayers Tags', 'prayers-post-type' ),
			'search_items'               => __( 'Search Prayers Tags', 'prayers-post-type' ),
			'popular_items'              => __( 'Popular Prayers Tags', 'prayers-post-type' ),
			'separate_items_with_commas' => __( 'Separate prayers tags with commas', 'prayers-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove prayers tags', 'prayers-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used prayers tags', 'prayers-post-type' ),
			'not_found'                  => __( 'No prayers tags found.', 'prayers-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'prayers_tag' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		return apply_filters( 'prayersposttype_tag_args', $args );
	}
}