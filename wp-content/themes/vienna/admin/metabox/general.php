<?php

return array(
	'id'          => 'zl_album',
	'types'       => array('zl_album'),
	'title'       => __('Album Settings', 'zatolab'),
	'priority'    => 'high',
	'context'     => 'side',
	'template'    => array(

		
		array(
			'type' => 'select',
			'name' => 'albumtype',
			'label' => __('Album Type', 'zatolab'),
			'items' => array(
				array(
					'value' => 'justified',
					'label' => 'Justified',
				),
				array(
					'value' => 'square4col',
					'label' => 'Square Columns',
				),
			),
		),
		
	),
);

/**
 * EOF
 */