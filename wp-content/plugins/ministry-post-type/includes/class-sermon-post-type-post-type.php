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
class Ministry_Post_Type_Post_Type extends Gamajoministry_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'ministry';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'               => __( 'Ministry', 'ministry-post-type' ),
			'singular_name'      => __( 'Ministry Item', 'ministry-post-type' ),
			'menu_name'          => _x( 'Ministry', 'admin menu', 'ministry-post-type' ),
			'name_admin_bar'     => _x( 'Ministry Item', 'add new on admin bar', 'ministry-post-type' ),
			'add_new'            => __( 'Add New Item', 'ministry-post-type' ),
			'add_new_item'       => __( 'Add New ministry Item', 'ministry-post-type' ),
			'new_item'           => __( 'Add New ministry Item', 'ministry-post-type' ),
			'edit_item'          => __( 'Edit ministry Item', 'ministry-post-type' ),
			'view_item'          => __( 'View Item', 'ministry-post-type' ),
			'all_items'          => __( 'All ministry Items', 'ministry-post-type' ),
			'search_items'       => __( 'Search ministry', 'ministry-post-type' ),
			'parent_item_colon'  => __( 'Parent ministry Item:', 'ministry-post-type' ),
			'not_found'          => __( 'No ministry items found', 'ministry-post-type' ),
			'not_found_in_trash' => __( 'No ministry items found in trash', 'ministry-post-type' ),
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
			'rewrite'         => array( 'slug' => 'ministry', ), // Permalinks format
			'menu_position'   => 5,
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-admin-media' : false ,
			'has_archive'     => true,
		);

		return apply_filters( 'ministryposttype_args', $args );
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
			1  => __( 'ministry item updated.', 'ministry-post-type' ),
			2  => __( 'Custom field updated.', 'ministry-post-type' ),
			3  => __( 'Custom field deleted.', 'ministry-post-type' ),
			4  => __( 'ministry item updated.', 'ministry-post-type' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'ministry item restored to revision from %s', 'ministry-post-type' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'ministry item published.', 'ministry-post-type' ),
			7  => __( 'ministry item saved.', 'ministry-post-type' ),
			8  => __( 'ministry item submitted.', 'ministry-post-type' ),
			9  => sprintf(
				__( 'ministry item scheduled for: <strong>%1$s</strong>.', 'ministry-post-type' ),
				/* translators: Publish box date format, see http://php.net/date */
				date_i18n( __( 'M j, Y @ G:i', 'ministry-post-type' ), strtotime( $post->post_date ) )
			),
			10 => __( 'ministry item draft updated.', 'ministry-post-type' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View ministry item', 'ministry-post-type' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview ministry item', 'ministry-post-type' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}
