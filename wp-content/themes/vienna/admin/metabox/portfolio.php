<?php

return array(
	'id'          => 'portfolio',
	'types'       => array('zl_portfolio'),
	'title'       => __('Portfolio Settings', 'zatolab'),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type' => 'radiobutton',
			'name' => 'layoutype',
			'label' => __('Layout Type', 'vp_textdomain'),
			'description' => __('The portfolio layout that will affect to <strong>media</strong> size. ', 'vp_textdomain'),
			'items' => array(
				array(
					'value' => 'full',
					'label' => __('Full Width Media', 'vp_textdomain'),
				),
				array(
					'value' => 'normal',
					'label' => __('Side by side with description', 'vp_textdomain'),
				),
			),
		),

		array(
			'type' => 'textarea',
			'name' => 'shortdesc',
			'label' => __('Short Description', 'zatolab'),
			'description' => __('Write short description about this project', 'zatolab'),
			'default' => '',
		),
		array(
			'type' => 'textbox',
			'name' => 'clientname',
			'label' => __('Client Name', 'zatolab'),
			'description' => __('Keyword to filter.', 'zatolab'),
			'default' => '',
		),
		array(
			'type' => 'date',
			'name' => 'projectdate',
			'label' => __('Completion Date', 'zatolab'),
			'description' => __('When you finished the project?', 'zatolab'),
			'format' => 'yy-mm-dd',
			'default' => '',
		),
		array(
			'type' => 'textbox',
			'name' => 'skills',
			'label' => __('Skill Used', 'zatolab'),
			'description' => __('Write the skills used in this project', 'zatolab'),
			'default' => '',
		),
		array(
			'type' => 'textbox',
			'name' => 'url',
			'label' => __('URL', 'zatolab'),
			'description' => __('Put the Live URL of the work, if any.', 'zatolab'),
			'default' => '',
		),
		array(
			'type' => 'toggle',
			'name' => 'additional',
			'label' => __('Add Media(s)', 'vp_textdomain'),
		),
		array(
			'type'      => 'group',
			'repeating' => true,
			'sortable' => true,
			'name'      => 'portfoliogallery',
			'title'     => __('Media/Image', 'zatolab'),
			'default'   => null,
			'fields'    => array(
				array(
					'type' => 'upload',
					'name' => 'media_file',
					'label' => __('Media File', 'zatolab'),
					'description' => __('Image', 'zatolab'),
				),
			),
			'dependency' => array(
				'field'    => 'additional',
				'function' => 'vp_dep_boolean',
			),
		),
	),
);

/**
 * EOF
 */