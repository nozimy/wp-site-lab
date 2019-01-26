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
 * Prayers post type.
 *
 * @package Prayers_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Prayers_Post_Type_Post_Type extends Gamajoprayers_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'prayers';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'               => __( 'Prayers', 'prayers-post-type' ),
			'singular_name'      => __( 'Prayers Item', 'prayers-post-type' ),
			'menu_name'          => _x( 'Prayers', 'admin menu', 'prayers-post-type' ),
			'name_admin_bar'     => _x( 'Prayers Item', 'add new on admin bar', 'prayers-post-type' ),
			'add_new'            => __( 'Add New Item', 'prayers-post-type' ),
			'add_new_item'       => __( 'Add New Prayers Item', 'prayers-post-type' ),
			'new_item'           => __( 'Add New Prayers Item', 'prayers-post-type' ),
			'edit_item'          => __( 'Edit Prayers Item', 'prayers-post-type' ),
			'view_item'          => __( 'View Item', 'prayers-post-type' ),
			'all_items'          => __( 'All Prayers Items', 'prayers-post-type' ),
			'search_items'       => __( 'Search Prayers', 'prayers-post-type' ),
			'parent_item_colon'  => __( 'Parent Prayers Item:', 'prayers-post-type' ),
			'not_found'          => __( 'No prayers items found', 'prayers-post-type' ),
			'not_found_in_trash' => __( 'No prayers items found in trash', 'prayers-post-type' ),
		);

		$supports = array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'comments',
			'author',
			'custom-fields',
			'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'prayers', ), // Permalinks format
			'menu_position'   => 5,
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-format-gallery' : false ,
			'has_archive'     => true,
		);

		return apply_filters( 'prayersposttype_args', $args );
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
			1  => __( 'Prayers item updated.', 'prayers-post-type' ),
			2  => __( 'Custom field updated.', 'prayers-post-type' ),
			3  => __( 'Custom field deleted.', 'prayers-post-type' ),
			4  => __( 'Prayers item updated.', 'prayers-post-type' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Prayers item restored to revision from %s', 'prayers-post-type' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Prayers item published.', 'prayers-post-type' ),
			7  => __( 'Prayers item saved.', 'prayers-post-type' ),
			8  => __( 'Prayers item submitted.', 'prayers-post-type' ),
			9  => sprintf(
				__( 'Prayers item scheduled for: <strong>%1$s</strong>.', 'prayers-post-type' ),
				/* translators: Publish box date format, see http://php.net/date */
				date_i18n( __( 'M j, Y @ G:i', 'prayers-post-type' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Prayers item draft updated.', 'prayers-post-type' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View prayers item', 'prayers-post-type' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview prayers item', 'prayers-post-type' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}
