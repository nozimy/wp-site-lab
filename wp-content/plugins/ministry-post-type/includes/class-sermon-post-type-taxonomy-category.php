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
class Ministry_Post_Type_Taxonomy_Category extends Gamajoministry_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'ministry_category';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => __( 'ministry Categories', 'ministry-post-type' ),
			'singular_name'              => __( 'ministry Category', 'ministry-post-type' ),
			'menu_name'                  => __( 'ministry Categories', 'ministry-post-type' ),
			'edit_item'                  => __( 'Edit ministry Category', 'ministry-post-type' ),
			'update_item'                => __( 'Update ministry Category', 'ministry-post-type' ),
			'add_new_item'               => __( 'Add New ministry Category', 'ministry-post-type' ),
			'new_item_name'              => __( 'New ministry Category Name', 'ministry-post-type' ),
			'parent_item'                => __( 'Parent ministry Category', 'ministry-post-type' ),
			'parent_item_colon'          => __( 'Parent ministry Category:', 'ministry-post-type' ),
			'all_items'                  => __( 'All ministry Categories', 'ministry-post-type' ),
			'search_items'               => __( 'Search ministry Categories', 'ministry-post-type' ),
			'popular_items'              => __( 'Popular ministry Categories', 'ministry-post-type' ),
			'separate_items_with_commas' => __( 'Separate ministry categories with commas', 'ministry-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove ministry categories', 'ministry-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used ministry categories', 'ministry-post-type' ),
			'not_found'                  => __( 'No ministry categories found.', 'ministry-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'ministry_category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		return apply_filters( 'ministryposttype_category_args', $args );
	}
}