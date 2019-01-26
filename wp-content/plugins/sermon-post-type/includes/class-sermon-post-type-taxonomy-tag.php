<?php
/**
 * Sermon Post Type
 *
 * @package   Sermon_Post_Type
 * @author    Devin Price
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      http://wptheming.com/sermon-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 */

/**
 * Sermon tag taxonomy.
 *
 * @package Sermon_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Sermon_Post_Type_Taxonomy_Tag extends Gamajosermon_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'sermon_tag';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => __( 'Sermon Tags', 'sermon-post-type' ),
			'singular_name'              => __( 'Sermon Tag', 'sermon-post-type' ),
			'menu_name'                  => __( 'Sermon Tags', 'sermon-post-type' ),
			'edit_item'                  => __( 'Edit Sermon Tag', 'sermon-post-type' ),
			'update_item'                => __( 'Update Sermon Tag', 'sermon-post-type' ),
			'add_new_item'               => __( 'Add New Sermon Tag', 'sermon-post-type' ),
			'new_item_name'              => __( 'New Sermon Tag Name', 'sermon-post-type' ),
			'parent_item'                => __( 'Parent Sermon Tag', 'sermon-post-type' ),
			'parent_item_colon'          => __( 'Parent Sermon Tag:', 'sermon-post-type' ),
			'all_items'                  => __( 'All Sermon Tags', 'sermon-post-type' ),
			'search_items'               => __( 'Search Sermon Tags', 'sermon-post-type' ),
			'popular_items'              => __( 'Popular Sermon Tags', 'sermon-post-type' ),
			'separate_items_with_commas' => __( 'Separate Sermon tags with commas', 'sermon-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove Sermon tags', 'sermon-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used Sermon tags', 'sermon-post-type' ),
			'not_found'                  => __( 'No Sermon tags found.', 'sermon-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'sermon_tag' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		return apply_filters( 'sermonposttype_tag_args', $args );
	}
}