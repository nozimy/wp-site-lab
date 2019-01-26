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
 * Register post types and taxonomies.
 *
 * @package Prayers_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Prayers_Post_Type_Registrations {

	public $post_type;

	public $taxonomies;

	public function init() {
		// Add the prayers post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 */
	public function register() {
		global $prayers_post_type_post_type, $prayers_post_type_taxonomy_category, $prayers_post_type_taxonomy_tag;

		$prayers_post_type_post_type = new Prayers_Post_Type_Post_Type;
		$prayers_post_type_post_type->register();
		$this->post_type = $prayers_post_type_post_type->get_post_type();

		$prayers_post_type_taxonomy_category = new Prayers_Post_Type_Taxonomy_Category;
		$prayers_post_type_taxonomy_category->register();
		$this->taxonomies[] = $prayers_post_type_taxonomy_category->get_taxonomy();
		register_taxonomy_for_object_type(
			$prayers_post_type_taxonomy_category->get_taxonomy(),
			$prayers_post_type_post_type->get_post_type()
		);

		$prayers_post_type_taxonomy_tag = new Prayers_Post_Type_Taxonomy_Tag;
		$prayers_post_type_taxonomy_tag->register();
		$this->taxonomies[] = $prayers_post_type_taxonomy_tag->get_taxonomy();
		register_taxonomy_for_object_type(
			$prayers_post_type_taxonomy_tag->get_taxonomy(),
			$prayers_post_type_post_type->get_post_type()
		);
	}

	/**
	 * Unregister post type and taxonomies registrations.
	 */
	public function unregister() {
		global $prayers_post_type_post_type, $prayers_post_type_taxonomy_category, $prayers_post_type_taxonomy_tag;
		$prayers_post_type_post_type->unregister();
		$this->post_type = null;

		$prayers_post_type_taxonomy_category->unregister();
		unset( $this->taxonomies[ $prayers_post_type_taxonomy_category->get_taxonomy() ] );

		$prayers_post_type_taxonomy_tag->unregister();
		unset( $this->taxonomies[ $prayers_post_type_taxonomy_tag->get_taxonomy() ] );
	}
}
