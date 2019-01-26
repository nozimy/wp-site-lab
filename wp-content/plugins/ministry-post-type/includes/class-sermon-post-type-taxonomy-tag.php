<?php
/**
 * ministry Post Type
 *
 * @package   Ministry_Post_Type
 * @author    Devin Price
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      http://wptheming.com/ministry-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 */

/**
 * ministry tag taxonomy.
 *
 * @package Ministry_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Ministry_Post_Type_Taxonomy_Tag extends Gamajoministry_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'ministry_tag';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => __( 'ministry Tags', 'ministry-post-type' ),
			'singular_name'              => __( 'ministry Tag', 'ministry-post-type' ),
			'menu_name'                  => __( 'ministry Tags', 'ministry-post-type' ),
			'edit_item'                  => __( 'Edit ministry Tag', 'ministry-post-type' ),
			'update_item'                => __( 'Update ministry Tag', 'ministry-post-type' ),
			'add_new_item'               => __( 'Add New ministry Tag', 'ministry-post-type' ),
			'new_item_name'              => __( 'New ministry Tag Name', 'ministry-post-type' ),
			'parent_item'                => __( 'Parent ministry Tag', 'ministry-post-type' ),
			'parent_item_colon'          => __( 'Parent ministry Tag:', 'ministry-post-type' ),
			'all_items'                  => __( 'All ministry Tags', 'ministry-post-type' ),
			'search_items'               => __( 'Search ministry Tags', 'ministry-post-type' ),
			'popular_items'              => __( 'Popular ministry Tags', 'ministry-post-type' ),
			'separate_items_with_commas' => __( 'Separate ministry tags with commas', 'ministry-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove ministry tags', 'ministry-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used ministry tags', 'ministry-post-type' ),
			'not_found'                  => __( 'No ministry tags found.', 'ministry-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => false,
			'rewrite'           => array( 'slug' => 'ministry_tag' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		return apply_filters( 'ministryposttype_tag_args', $args );
	}
}