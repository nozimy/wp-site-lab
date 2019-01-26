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
class Sermon_Post_Type_Post_Type extends Gamajosermon_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'sermon';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'               => __( 'Sermon', 'sermon-post-type' ),
			'singular_name'      => __( 'Sermon Item', 'sermon-post-type' ),
			'menu_name'          => _x( 'Sermon', 'admin menu', 'sermon-post-type' ),
			'name_admin_bar'     => _x( 'Sermon Item', 'add new on admin bar', 'sermon-post-type' ),
			'add_new'            => __( 'Add New Item', 'sermon-post-type' ),
			'add_new_item'       => __( 'Add New Sermon Item', 'sermon-post-type' ),
			'new_item'           => __( 'Add New Sermon Item', 'sermon-post-type' ),
			'edit_item'          => __( 'Edit Sermon Item', 'sermon-post-type' ),
			'view_item'          => __( 'View Item', 'sermon-post-type' ),
			'all_items'          => __( 'All Sermon Items', 'sermon-post-type' ),
			'search_items'       => __( 'Search Sermon', 'sermon-post-type' ),
			'parent_item_colon'  => __( 'Parent Sermon Item:', 'sermon-post-type' ),
			'not_found'          => __( 'No Sermon items found', 'sermon-post-type' ),
			'not_found_in_trash' => __( 'No Sermon items found in trash', 'sermon-post-type' ),
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
			'rewrite'         => array( 'slug' => 'sermon', ), // Permalinks format
			'menu_position'   => 5,
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-portfolio' : false ,
			'has_archive'     => true,
		);

		return apply_filters( 'sermonposttype_args', $args );
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
			1  => __( 'Sermon item updated.', 'sermon-post-type' ),
			2  => __( 'Custom field updated.', 'sermon-post-type' ),
			3  => __( 'Custom field deleted.', 'sermon-post-type' ),
			4  => __( 'Sermon item updated.', 'sermon-post-type' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Sermon item restored to revision from %s', 'sermon-post-type' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Sermon item published.', 'sermon-post-type' ),
			7  => __( 'Sermon item saved.', 'sermon-post-type' ),
			8  => __( 'Sermon item submitted.', 'sermon-post-type' ),
			9  => sprintf(
				__( 'Sermon item scheduled for: <strong>%1$s</strong>.', 'sermon-post-type' ),
				/* translators: Publish box date format, see http://php.net/date */
				date_i18n( __( 'M j, Y @ G:i', 'sermon-post-type' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Sermon item draft updated.', 'sermon-post-type' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View Sermon item', 'sermon-post-type' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview Sermon item', 'sermon-post-type' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}
