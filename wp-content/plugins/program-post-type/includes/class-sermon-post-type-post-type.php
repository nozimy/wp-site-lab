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
 * Portfolio post type.
 *
 * @package Portfolio_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class program_Post_Type_Post_Type extends Gamajoprogram_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'program';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'               => __( 'Program', 'program-post-type' ),
			'singular_name'      => __( 'Program Item', 'program-post-type' ),
			'menu_name'          => _x( 'Program', 'admin menu', 'program-post-type' ),
			'name_admin_bar'     => _x( 'Program Item', 'add new on admin bar', 'program-post-type' ),
			'add_new'            => __( 'Add New Item', 'program-post-type' ),
			'add_new_item'       => __( 'Add New program Item', 'program-post-type' ),
			'new_item'           => __( 'Add New program Item', 'program-post-type' ),
			'edit_item'          => __( 'Edit program Item', 'program-post-type' ),
			'view_item'          => __( 'View Item', 'program-post-type' ),
			'all_items'          => __( 'All program Items', 'program-post-type' ),
			'search_items'       => __( 'Search program', 'program-post-type' ),
			'parent_item_colon'  => __( 'Parent program Item:', 'program-post-type' ),
			'not_found'          => __( 'No program items found', 'program-post-type' ),
			'not_found_in_trash' => __( 'No program items found in trash', 'program-post-type' ),
		);

		$supports = array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'author',
			'post-formats',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'program', ), // Permalinks format
			'menu_position'   => 5,
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-admin-media' : false ,
			'has_archive'     => true,
		);

		return apply_filters( 'programposttype_args', $args );
	}

	/**
	 * Return post type updated messages.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type updated messages.
	 */
	public function messages() {
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'program item updated.', 'program-post-type' ),
			2  => __( 'Custom field updated.', 'program-post-type' ),
			3  => __( 'Custom field deleted.', 'program-post-type' ),
			4  => __( 'program item updated.', 'program-post-type' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'program item restored to revision from %s', 'program-post-type' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'program item published.', 'program-post-type' ),
			7  => __( 'program item saved.', 'program-post-type' ),
			8  => __( 'program item submitted.', 'program-post-type' ),
			9  => sprintf(
				__( 'program item scheduled for: <strong>%1$s</strong>.', 'program-post-type' ),
				/* translators: Publish box date format, see http://php.net/date */
				date_i18n( __( 'M j, Y @ G:i', 'program-post-type' ), strtotime( $post->post_date ) )
			),
			10 => __( 'program item draft updated.', 'program-post-type' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View program item', 'program-post-type' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview program item', 'program-post-type' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}
