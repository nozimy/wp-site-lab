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
 * Register post types and taxonomies.
 *
 * @package Portfolio_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Ministry_Post_Type_Registrations {

	public $post_type;

	public $taxonomies;

	public function init() {
		// Add the portfolio post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 */
	public function register() {
		global $ministry_post_type_post_type, $ministry_post_type_taxonomy_category, $ministry_post_type_taxonomy_tag;

		$ministry_post_type_post_type = new ministry_post_type_post_type;
		$ministry_post_type_post_type->register();
		$this->post_type = $ministry_post_type_post_type->get_post_type();

		$ministry_post_type_taxonomy_category = new ministry_post_type_taxonomy_category;
		$ministry_post_type_taxonomy_category->register();
		$this->taxonomies[] = $ministry_post_type_taxonomy_category->get_taxonomy();
		register_taxonomy_for_object_type(
			$ministry_post_type_taxonomy_category->get_taxonomy(),
			$ministry_post_type_post_type->get_post_type()
		);

		$ministry_post_type_taxonomy_tag = new ministry_post_type_taxonomy_tag;
		$ministry_post_type_taxonomy_tag->register();
		$this->taxonomies[] = $ministry_post_type_taxonomy_tag->get_taxonomy();
		register_taxonomy_for_object_type(
			$ministry_post_type_taxonomy_tag->get_taxonomy(),
			$ministry_post_type_post_type->get_post_type()
		);
	}

	/**
	 * Unregister post type and taxonomies registrations.
	 */
	public function unregister() {
		global $ministry_post_type_post_type, $ministry_post_type_taxonomy_category, $ministry_post_type_taxonomy_tag;
		$ministry_post_type_post_type->unregister();
		$this->post_type = null;

		$ministry_post_type_taxonomy_category->unregister();
		unset( $this->taxonomies[ $ministry_post_type_taxonomy_category->get_taxonomy() ] );

		$ministry_post_type_taxonomy_tag->unregister();
		unset( $this->taxonomies[ $ministry_post_type_taxonomy_tag->get_taxonomy() ] );
	}
}
