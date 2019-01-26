<?php
/**
 * Humble Featured Post meta boxes
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

/**
 * Registering meta boxes
 *
 */

add_filter( 'rwmb_meta_boxes', 'Humble_Post_Meta_Box' );

/** Register meta boxes **/
function Humble_Post_Meta_Box( $meta_boxes )
{

	// Better has an underscore as last sign
	$prefix = 'humble__';

	// Gallery Format Metabox
	$meta_boxes[] = array(
		'id'         => 'Humble_Post_Metas',
		'title'      => esc_html__( 'Post Setting', 'humble' ),
		'post_types' => array( 'post' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,
		'fields'     => array(
			// FEATURED CHECKBOX
			array(
				'name' => esc_html__( 'Checkbox', 'humble' ),
				'id'   => "{$prefix}featured",
				'desc' => esc_html__( 'Mark this post as a featured to show on featured posts slider.', 'humble' ),
				'type' => 'checkbox',
				'std'  => 0,
			),
		)
	);

	return $meta_boxes;
}
