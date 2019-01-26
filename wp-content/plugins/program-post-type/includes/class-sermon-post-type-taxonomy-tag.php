<?php
/**
 * program Post Type
 *
 * @package   program_post_type
 * @author    Devin Price
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      http://wptheming.com/program-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 */

/**
 * program tag taxonomy.
 *
 * @package program_post_type
 * @author  Devin Price
 * @author  Gary Jones
 */
class program_Post_Type_Taxonomy_Tag extends Gamajoprogram_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'program_tag';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => __( 'program Tags', 'program-post-type' ),
			'singular_name'              => __( 'program Tag', 'program-post-type' ),
			'menu_name'                  => __( 'program Tags', 'program-post-type' ),
			'edit_item'                  => __( 'Edit program Tag', 'program-post-type' ),
			'update_item'                => __( 'Update program Tag', 'program-post-type' ),
			'add_new_item'               => __( 'Add New program Tag', 'program-post-type' ),
			'new_item_name'              => __( 'New program Tag Name', 'program-post-type' ),
			'parent_item'                => __( 'Parent program Tag', 'program-post-type' ),
			'parent_item_colon'          => __( 'Parent program Tag:', 'program-post-type' ),
			'all_items'                  => __( 'All program Tags', 'program-post-type' ),
			'search_items'               => __( 'Search program Tags', 'program-post-type' ),
			'popular_items'              => __( 'Popular program Tags', 'program-post-type' ),
			'separate_items_with_commas' => __( 'Separate program tags with commas', 'program-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove program tags', 'program-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used program tags', 'program-post-type' ),
			'not_found'                  => __( 'No program tags found.', 'program-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'program_tag' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		return apply_filters( 'programposttype_tag_args', $args );
	}
}