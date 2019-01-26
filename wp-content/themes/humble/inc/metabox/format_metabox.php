<?php
/**
 * Humble Post Format meta boxes
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Register and load admin javascript
 */
function humble_admin_js($hook) {
	if ($hook == 'post.php' || $hook == 'post-new.php') {
		wp_register_script('humble-metabox', get_template_directory_uri() . '/inc/metabox/js/metabox.js');
		wp_enqueue_script('humble-metabox');

	}
}
add_action('admin_enqueue_scripts','humble_admin_js',10,1);

/**
 * Registering meta boxes
 *
 */

add_filter( 'rwmb_meta_boxes', 'Humble_Format_Metabox' );

/** Register meta boxes **/
function Humble_Format_Metabox( $meta_boxes )
{

	// Better has an underscore as last sign
	$prefix = 'humble_';

	// Gallery Format Metabox
	$meta_boxes[] = array(
		'id'         => 'humble_gallery_format_metabox',
		'title'      => esc_html__( 'Gallery Format Options', 'humble' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => esc_html__( 'Upload Gallery Images', 'humble' ),
				'id'               => "{$prefix}gallery_format",
				'type'             => 'image_advanced',
				'max_file_uploads' => 10,
			),
		)
	);

	// Video Format Metabox
	$meta_boxes[] = array(
		'id'         => 'humble_video_format_metabox',
		'title'      => esc_html__( 'Video Format Options', 'humble' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			// TEXTAREA
			array(
				'name' => esc_html__( 'Video Embed Code', 'humble' ),
				'id'   => "{$prefix}video_format",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 4,
			),
		)
	);

	// Audio Format Metabox
	$meta_boxes[] = array(
		'id'         => 'humble_audio_format_metabox',
		'title'      => esc_html__( 'Audio Format Options', 'humble' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			// TEXTAREA
			array(
				'name' => esc_html__( 'Audio Embed Code', 'humble' ),
				'id'   => "{$prefix}audio_format",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 4,
			),
		)
	);

	// Link Format Metabox
	$meta_boxes[] = array(
		'id'         => 'humble_link_format_metabox',
		'title'      => esc_html__( 'Link Format Options', 'humble' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			// TEXTAREA
			array(
				'name' => esc_html__( 'Site URL', 'humble' ),
				'id'   => "{$prefix}link_format",
				'type' => 'text',
			),
		)
	);

	return $meta_boxes;
}
