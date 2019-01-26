<?php

add_filter( 'rwmb_meta_boxes', 'ninetheme_confidence_register_page_meta_boxes' );
function ninetheme_confidence_register_page_meta_boxes( $meta_boxes ) {

$prefix = 'ninetheme_confidence_m_b_';
$meta_boxes = array();

	// page settings
$meta_boxes[] = array(
	'id' => 'portfoliosettings',
	'title' => 'Page Settings',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(



		array(
			'name' => 'Disable Page Title',
			'id'   => $prefix . "disable_title",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),

		array(
			'name'		=> 'Alternate Page Title',
			'id'		=> $prefix . "alt_title",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Page Subtitle',
			'id'		=> $prefix . "subtitle",
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
		// COLOR
		array(
			'name' => esc_html__( 'Page breadcrumb background color', 'confidence' ),
			'id'   => $prefix . "pagebgcolor",
			'type' => 'color',
		),
		array(
			'name' => esc_html__( 'Page breadcrumb text color', 'confidence' ),
			'id'   => $prefix . "pagetextcolor",
			'type' => 'color',
		),

		array(
			'name' => __( 'Page header padding top', 'confidence' ),
			'id'   => $prefix . "headerptop",
			'type' => 'number',
			'min'  => 0,
			'step' => 1,
		),

		array(
			'name' => __( 'Page header padding bottom', 'confidence' ),
			'id'   => $prefix . "headerpbottom",
			'type' => 'number',
			'min'  => 0,
			'step' => 1,
		),

		// SELECT BOX
		array(
			'name'     => esc_html__( 'Page sidebar', 'confidence' ),
			'id'       => $prefix . "pagelayout",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'left-sidebar' => esc_html__( 'left', 'confidence' ),
				'right-sidebar' => esc_html__( 'right', 'confidence' ),
				'full' => esc_html__( 'full', 'confidence' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'right-sidebar',
			'placeholder' => esc_html__( 'Select an Item', 'confidence' ),
		),
	)
);

// page settings
$meta_boxes[] = array(
	'id' => 'post-header-settings',
	'title' => 'Post Header Design Settings',
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		// COLOR
		array(
			'name' => esc_html__( 'Page breadcrumb background color', 'confidence' ),
			'id'   => $prefix . "pagebgcolor",
			'type' => 'color',
		),
		array(
			'name' => esc_html__( 'Page breadcrumb text color', 'confidence' ),
			'id'   => $prefix . "pagetextcolor",
			'type' => 'color',
		),

		array(
			'name' => __( 'Page header padding top', 'confidence' ),
			'id'   => $prefix . "headerptop",
			'type' => 'number',
			'min'  => 0,
			'step' => 1,
		),

		array(
			'name' => __( 'Page header padding bottom', 'confidence' ),
			'id'   => $prefix . "headerpbottom",
			'type' => 'number',
			'min'  => 0,
			'step' => 1,
		),


		array(
			'name' => __( 'Page header background image, add image full url', 'confidence' ),
			'id'   => $prefix . "header_bg_single_image",
			'type' => 'text',


		),


		// SELECT BOX
		array(
			'name'     => esc_html__( 'Post header breadcrumb background type', 'confidence' ),
			'id'       => $prefix . "header_bg_single",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'default' => esc_html__( 'default', 'confidence' ),
				'featured' => esc_html__( 'featured image', 'confidence' ),
			),
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => 'default',
			'placeholder' => esc_html__( 'Select an Item', 'confidence' ),
		),
	)
);

$meta_boxes[] = array(
	'id' => 'eventssettings',
	'title' => 'Events Settings',
	'pages' => array( 'sermon' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(


		array(
			'name' => 'Sermon Date',
			'id'   => $prefix . "sermon_date",
			'type' => 'date',
			// Value can be 0 or 1
			'std'  => 0,
		),

		array(
			'name'		=> 'Sermon manager',
			'id'		=> $prefix . "sermon_manager",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Sermon Location',
			'id'		=> $prefix . "sermon_location",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
	)
);



$meta_boxes[] = array(
	'id' => 'eventssettings',
	'title' => 'Events Settings',
	'pages' => array( 'program' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(


		array(
			'name' => 'Program Date',
			'id'   => $prefix . "program_date",
			'type' => 'date',
			// Value can be 0 or 1
			'std'  => 0,
		),

		array(
			'name'		=> 'Program manager',
			'id'		=> $prefix . "program_manager",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Program Location',
			'id'		=> $prefix . "program_location",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
	)
);


$meta_boxes[] = array(
	'id' => 'eventssettings',
	'title' => 'Events Settings',
	'pages' => array( 'ministry' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(


		array(
			'name' => 'ministry Date',
			'id'   => $prefix . "ministry_date",
			'type' => 'date',
			// Value can be 0 or 1
			'std'  => 0,
		),

		array(
			'name'		=> 'ministry manager',
			'id'		=> $prefix . "ministry_manager",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'ministry Location',
			'id'		=> $prefix . "ministry_location",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
	)
);

$meta_boxes[] = array(
	'id' => 'peoplessettings',
	'title' => 'Events Settings',
	'pages' => array( 'peoples' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(



		array(
			'name' => 'Show People Details',
			'id'   => $prefix . "disable_peoples",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),


		array(
			'name'		=> 'Position',
			'id'		=> $prefix . "stories_Position",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Telephone',
			'id'		=> $prefix . "stories_Telephone",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Fax',
			'id'		=> $prefix . "stories_Fax",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'E-mail',
			'id'		=> $prefix . "stories_mail",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),


	)
);

$meta_boxes[] = array(
	'id' => 'causessettings',
	'title' => 'Causes Settings',
	'pages' => array( 'causes' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name' => 'Show Causes Features',
			'id'   => $prefix . "disable_causes",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),

		array(
			'name' => 'Causes Time End',
			'id'   => $prefix . "causes_time_end",
			'type' => 'date',
			// Value can be 0 or 1
			'std'  => 0,
		),

		array(
			'name'		=> 'Collected',
			'id'		=> $prefix . "causes_collacted",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Goal',
			'id'		=> $prefix . "causes_goal",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Backer Total',
			'id'		=> $prefix . "causes_backer",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Location',
			'id'		=> $prefix . "causes_location",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name' => 'Slider',
			'desc'  => 'Donate Percentage',
			'id'    => $prefix.'causes_slider',
			'type'  => 'slider',
			'min'   => '0',
			'max'   => '100',
			'step'  => '5'
		),
		// POST
		array(
			'name'    => esc_html__( 'Select page for donate', 'confidence' ),
			'id'      => $prefix.'causes_button',
			'type'    => 'post',

			// Post type
			'post_type' => 'page',
			// Field type, either 'select' or 'select_advanced' (default)
			'field_type' => 'select_advanced',
			// Query arguments (optional). No settings means get all published posts
			'query_args' => array(
				'post_status' => 'publish',
				'posts_per_page' => '-1',
			)
		),
		array(
			'name' => 'Icon',
			'id' => $prefix . 'icon',
			'type' => 'select',
			'options' => array(
								'Select icon' => 'none',
								'fa-adjust' => 'adjust',
								'fa-adn' => 'adn',
								'fa-align-center' => 'align-center',
								'fa-align-justify' => 'align-justify',
								'fa-align-left' => 'align-left',
								'fa-align-right' => 'align-right',
								'fa-ambulance' => 'ambulance',
								'fa-anchor' => 'anchor',
								'fa-android' => 'android',
								'fa-angle-double-down' => 'angle-double-down',
								'fa-angle-double-left' => 'angle-double-left',
								'fa-angle-double-right' => 'angle-double-right',
								'fa-angle-double-up' => 'angle-double-up',
								'fa-angle-down' => 'angle-down',
								'fa-angle-left' => 'angle-left',
								'fa-angle-right' => 'angle-right',
								'fa-angle-up' => 'angle-up',
								'fa-apple' => 'apple',
								'fa-archive' => 'archive',
								'fa-arrow-circle-down' => 'arrow-circle-down',
								'fa-arrow-circle-left' => 'arrow-circle-left',
								'fa-arrow-circle-o-down' => 'arrow-circle-o-down',
								'fa-arrow-circle-o-left' => 'arrow-circle-o-left',
								'fa-arrow-circle-o-right' => 'arrow-circle-o-right',
								'fa-arrow-circle-o-up' => 'arrow-circle-o-up',
								'fa-arrow-circle-right' => 'arrow-circle-right',
								'fa-arrow-circle-up' => 'arrow-circle-up',
								'fa-arrow-down' => 'arrow-down',
								'fa-arrow-left' => 'arrow-left',
								'fa-arrow-right' => 'arrow-right',
								'fa-arrow-up' => 'arrow-up',
								'fa-arrows' => 'arrows',
								'fa-arrows-alt' => 'arrows-alt',
								'fa-arrows-h' => 'arrows-h',
								'fa-arrows-v' => 'arrows-v',
								'fa-asterisk' => 'asterisk',
								'fa-automobile' => 'automobile',
								'fa-backward' => 'backward',
								'fa-ban' => 'ban',
								'fa-bank' => 'bank',
								'fa-bar-chart-o' => 'bar-chart-o',
								'fa-barcode' => 'barcode',
								'fa-bars' => 'bars',
								'fa-beer' => 'beer',
								'fa-behance' => 'behance',
								'fa-behance-square' => 'behance-square',
								'fa-bell' => 'bell',
								'fa-bell-o' => 'bell-o',
								'fa-bitbucket' => 'bitbucket',
								'fa-bitbucket-square' => 'bitbucket-square',
								'fa-bitcoin' => 'bitcoin',
								'fa-bold' => 'bold',
								'fa-bolt' => 'bolt',
								'fa-bomb' => 'bomb',
								'fa-book' => 'book',
								'fa-bookmark' => 'bookmark',
								'fa-bookmark-o' => 'bookmark-o',
								'fa-briefcase' => 'briefcase',
								'fa-btc' => 'btc',
								'fa-bug' => 'bug',
								'fa-building' => 'building',
								'fa-building-o' => 'building-o',
								'fa-bullhorn' => 'bullhorn',
								'fa-bullseye' => 'bullseye',
								'fa-cab' => 'cab',
								'fa-calendar' => 'calendar',
								'fa-calendar-o' => 'calendar-o',
								'fa-camera' => 'camera',
								'fa-camera-retro' => 'camera-retro',
								'fa-car' => 'car',
								'fa-caret-down' => 'caret-down',
								'fa-caret-left' => 'caret-left',
								'fa-caret-right' => 'caret-right',
								'fa-caret-square-o-down' => 'caret-square-o-down',
								'fa-caret-square-o-left' => 'caret-square-o-left',
								'fa-caret-square-o-right' => 'caret-square-o-right',
								'fa-caret-square-o-up' => 'caret-square-o-up',
								'fa-caret-up' => 'caret-up',
								'fa-certificate' => 'certificate',
								'fa-chain' => 'chain',
								'fa-chain-broken' => 'chain-broken',
								'fa-check' => 'check',
								'fa-check-circle' => 'check-circle',
								'fa-check-circle-o' => 'check-circle-o',
								'fa-check-square' => 'check-square',
								'fa-check-square-o' => 'check-square-o',
								'fa-chevron-circle-down' => 'chevron-circle-down',
								'fa-chevron-circle-left' => 'chevron-circle-left',
								'fa-chevron-circle-right' => 'chevron-circle-right',
								'fa-chevron-circle-up' => 'chevron-circle-up',
								'fa-chevron-down' => 'chevron-down',
								'fa-chevron-left' => 'chevron-left',
								'fa-chevron-right' => 'chevron-right',
								'fa-chevron-up' => 'chevron-up',
								'fa-child' => 'child',
								'fa-circle' => 'circle',
								'fa-circle-o' => 'circle-o',
								'fa-circle-o-notch' => 'circle-o-notch',
								'fa-circle-thin' => 'circle-thin',
								'fa-clipboard' => 'clipboard',
								'fa-clock-o' => 'clock-o',
								'fa-cloud' => 'cloud',
								'fa-cloud-download' => 'cloud-download',
								'fa-cloud-upload' => 'cloud-upload',
								'fa-cny' => 'cny',
								'fa-code' => 'code',
								'fa-code-fork' => 'code-fork',
								'fa-codepen' => 'codepen',
								'fa-coffee' => 'coffee',
								'fa-cog' => 'cog',
								'fa-cogs' => 'cogs',
								'fa-columns' => 'columns',
								'fa-comment' => 'comment',
								'fa-comment-o' => 'comment-o',
								'fa-comments' => 'comments',
								'fa-comments-o' => 'comments-o',
								'fa-compass' => 'compass',
								'fa-compress' => 'compress',
								'fa-copy' => 'copy',
								'fa-credit-card' => 'credit-card',
								'fa-crop' => 'crop',
								'fa-crosshairs' => 'crosshairs',
								'fa-css3' => 'css3',
								'fa-cube' => 'cube',
								'fa-cubes' => 'cubes',
								'fa-cut' => 'cut',
								'fa-cutlery' => 'cutlery',
								'fa-dashboard' => 'dashboard',
								'fa-database' => 'database',
								'fa-dedent' => 'dedent',
								'fa-delicious' => 'delicious',
								'fa-desktop' => 'desktop',
								'fa-deviantart' => 'deviantart',
								'fa-digg' => 'digg',
								'fa-dollar' => 'dollar',
								'fa-dot-circle-o' => 'dot-circle-o',
								'fa-download' => 'download',
								'fa-dribbble' => 'dribbble',
								'fa-dropbox' => 'dropbox',
								'fa-drupal' => 'drupal',
								'fa-edit' => 'edit',
								'fa-eject' => 'eject',
								'fa-ellipsis-h' => 'ellipsis-h',
								'fa-ellipsis-v' => 'ellipsis-v',
								'fa-empire' => 'empire',
								'fa-envelope' => 'envelope',
								'fa-envelope-o' => 'envelope-o',
								'fa-envelope-square' => 'envelope-square',
								'fa-eraser' => 'eraser',
								'fa-eur' => 'eur',
								'fa-euro' => 'euro',
								'fa-exchange' => 'exchange',
								'fa-exclamation' => 'exclamation',
								'fa-exclamation-circle' => 'exclamation-circle',
								'fa-exclamation-triangle' => 'exclamation-triangle',
								'fa-expand' => 'expand',
								'fa-external-link' => 'external-link',
								'fa-external-link-square' => 'external-link-square',
								'fa-eye' => 'eye',
								'fa-eye-slash' => 'eye-slash',
								'fa-facebook' => 'facebook',
								'fa-facebook-square' => 'facebook-square',
								'fa-fast-backward' => 'fast-backward',
								'fa-fast-forward' => 'fast-forward',
								'fa-fax' => 'fax',
								'fa-female' => 'female',
								'fa-fighter-jet' => 'fighter-jet',
								'fa-file' => 'file',
								'fa-file-archive-o' => 'file-archive-o',
								'fa-file-audio-o' => 'file-audio-o',
								'fa-file-code-o' => 'file-code-o',
								'fa-file-excel-o' => 'file-excel-o',
								'fa-file-image-o' => 'file-image-o',
								'fa-file-movie-o' => 'file-movie-o',
								'fa-file-o' => 'file-o',
								'fa-file-pdf-o' => 'file-pdf-o',
								'fa-file-photo-o' => 'file-photo-o',
								'fa-file-picture-o' => 'file-picture-o',
								'fa-file-powerpoint-o' => 'file-powerpoint-o',
								'fa-file-sound-o' => 'file-sound-o',
								'fa-file-text' => 'file-text',
								'fa-file-text-o' => 'file-text-o',
								'fa-file-video-o' => 'file-video-o',
								'fa-file-word-o' => 'file-word-o',
								'fa-file-zip-o' => 'file-zip-o',
								'fa-files-o' => 'files-o',
								'fa-film' => 'film',
								'fa-filter' => 'filter',
								'fa-fire' => 'fire',
								'fa-fire-extinguisher' => 'fire-extinguisher',
								'fa-flag' => 'flag',
								'fa-flag-checkered' => 'flag-checkered',
								'fa-flag-o' => 'flag-o',
								'fa-flash' => 'flash',
								'fa-flask' => 'flask',
								'fa-flickr' => 'flickr',
								'fa-floppy-o' => 'floppy-o',
								'fa-folder' => 'folder',
								'fa-folder-o' => 'folder-o',
								'fa-folder-open' => 'folder-open',
								'fa-folder-open-o' => 'folder-open-o',
								'fa-font' => 'font',
								'fa-forward' => 'forward',
								'fa-foursquare' => 'foursquare',
								'fa-frown-o' => 'frown-o',
								'fa-gamepad' => 'gamepad',
								'fa-gavel' => 'gavel',
								'fa-gbp' => 'gbp',
								'fa-ge' => 'ge',
								'fa-gear' => 'gear',
								'fa-gears' => 'gears',
								'fa-gift' => 'gift',
								'fa-git' => 'git',
								'fa-git-square' => 'git-square',
								'fa-github' => 'github',
								'fa-github-alt' => 'github-alt',
								'fa-github-square' => 'github-square',
								'fa-gittip' => 'gittip',
								'fa-glass' => 'glass',
								'fa-globe' => 'globe',
								'fa-google' => 'google',
								'fa-google-plus' => 'google-plus',
								'fa-google-plus-square' => 'google-plus-square',
								'fa-graduation-cap' => 'graduation-cap',
								'fa-group' => 'group',
								'fa-h-square' => 'h-square',
								'fa-hacker-news' => 'hacker-news',
								'fa-hand-o-down' => 'hand-o-down',
								'fa-hand-o-left' => 'hand-o-left',
								'fa-hand-o-right' => 'hand-o-right',
								'fa-hand-o-up' => 'hand-o-up',
								'fa-hdd-o' => 'hdd-o',
								'fa-header' => 'header',
								'fa-headphones' => 'headphones',
								'fa-heart' => 'heart',
								'fa-heart-o' => 'heart-o',
								'fa-history' => 'history',
								'fa-home' => 'home',
								'fa-hospital-o' => 'hospital-o',
								'fa-html5' => 'html5',
								'fa-image' => 'image',
								'fa-inbox' => 'inbox',
								'fa-indent' => 'indent',
								'fa-info' => 'info',
								'fa-info-circle' => 'info-circle',
								'fa-inr' => 'inr',
								'fa-instagram' => 'instagram',
								'fa-institution' => 'institution',
								'fa-italic' => 'italic',
								'fa-joomla' => 'joomla',
								'fa-jpy' => 'jpy',
								'fa-jsfiddle' => 'jsfiddle',
								'fa-key' => 'key',
								'fa-keyboard-o' => 'keyboard-o',
								'fa-krw' => 'krw',
								'fa-language' => 'language',
								'fa-laptop' => 'laptop',
								'fa-leaf' => 'leaf',
								'fa-legal' => 'legal',
								'fa-lemon-o' => 'lemon-o',
								'fa-level-down' => 'level-down',
								'fa-level-up' => 'level-up',
								'fa-life-bouy' => 'life-bouy',
								'fa-life-ring' => 'life-ring',
								'fa-life-saver' => 'life-saver',
								'fa-lightbulb-o' => 'lightbulb-o',
								'fa-link' => 'link',
								'fa-linkedin' => 'linkedin',
								'fa-linkedin-square' => 'linkedin-square',
								'fa-linux' => 'linux',
								'fa-list' => 'list',
								'fa-list-alt' => 'list-alt',
								'fa-list-ol' => 'list-ol',
								'fa-list-ul' => 'list-ul',
								'fa-location-arrow' => 'location-arrow',
								'fa-lock' => 'lock',
								'fa-long-arrow-down' => 'long-arrow-down',
								'fa-long-arrow-left' => 'long-arrow-left',
								'fa-long-arrow-right' => 'long-arrow-right',
								'fa-long-arrow-up' => 'long-arrow-up',
								'fa-magic' => 'magic',
								'fa-magnet' => 'magnet',
								'fa-mail-forward' => 'mail-forward',
								'fa-mail-reply' => 'mail-reply',
								'fa-mail-reply-all' => 'mail-reply-all',
								'fa-male' => 'male',
								'fa-map-marker' => 'map-marker',
								'fa-maxcdn' => 'maxcdn',
								'fa-medkit' => 'medkit',
								'fa-meh-o' => 'meh-o',
								'fa-microphone' => 'microphone',
								'fa-microphone-slash' => 'microphone-slash',
								'fa-minus' => 'minus',
								'fa-minus-circle' => 'minus-circle',
								'fa-minus-square' => 'minus-square',
								'fa-minus-square-o' => 'minus-square-o',
								'fa-mobile' => 'mobile',
								'fa-mobile-phone' => 'mobile-phone',
								'fa-money' => 'money',
								'fa-moon-o' => 'moon-o',
								'fa-mortar-board' => 'mortar-board',
								'fa-music' => 'music',
								'fa-navicon' => 'navicon',
								'fa-openid' => 'openid',
								'fa-outdent' => 'outdent',
								'fa-pagelines' => 'pagelines',
								'fa-paper-plane' => 'paper-plane',
								'fa-paper-plane-o' => 'paper-plane-o',
								'fa-paperclip' => 'paperclip',
								'fa-paragraph' => 'paragraph',
								'fa-paste' => 'paste',
								'fa-pause' => 'pause',
								'fa-paw' => 'paw',
								'fa-pencil' => 'pencil',
								'fa-pencil-square' => 'pencil-square',
								'fa-pencil-square-o' => 'pencil-square-o',
								'fa-phone' => 'phone',
								'fa-phone-square' => 'phone-square',
								'fa-photo' => 'photo',
								'fa-picture-o' => 'picture-o',
								'fa-pied-piper' => 'pied-piper',
								'fa-pied-piper-alt' => 'pied-piper-alt',
								'fa-pied-piper-square' => 'pied-piper-square',
								'fa-pinterest' => 'pinterest',
								'fa-pinterest-square' => 'pinterest-square',
								'fa-plane' => 'plane',
								'fa-play' => 'play',
								'fa-play-circle' => 'play-circle',
								'fa-play-circle-o' => 'play-circle-o',
								'fa-plus' => 'plus',
								'fa-plus-circle' => 'plus-circle',
								'fa-plus-square' => 'plus-square',
								'fa-plus-square-o' => 'plus-square-o',
								'fa-power-off' => 'power-off',
								'fa-print' => 'print',
								'fa-puzzle-piece' => 'puzzle-piece',
								'fa-qq' => 'qq',
								'fa-qrcode' => 'qrcode',
								'fa-question' => 'question',
								'fa-question-circle' => 'question-circle',
								'fa-quote-left' => 'quote-left',
								'fa-quote-right' => 'quote-right',
								'fa-ra' => 'ra',
								'fa-random' => 'random',
								'fa-rebel' => 'rebel',
								'fa-recycle' => 'recycle',
								'fa-reddit' => 'reddit',
								'fa-reddit-square' => 'reddit-square',
								'fa-refresh' => 'refresh',
								'fa-renren' => 'renren',
								'fa-reorder' => 'reorder',
								'fa-repeat' => 'repeat',
								'fa-reply' => 'reply',
								'fa-reply-all' => 'reply-all',
								'fa-retweet' => 'retweet',
								'fa-rmb' => 'rmb',
								'fa-road' => 'road',
								'fa-rocket' => 'rocket',
								'fa-rotate-left' => 'rotate-left',
								'fa-rotate-right' => 'rotate-right',
								'fa-rouble' => 'rouble',
								'fa-rss' => 'rss',
								'fa-rss-square' => 'rss-square',
								'fa-rub' => 'rub',
								'fa-ruble' => 'ruble',
								'fa-rupee' => 'rupee',
								'fa-save' => 'save',
								'fa-scissors' => 'scissors',
								'fa-search' => 'search',
								'fa-search-minus' => 'search-minus',
								'fa-search-plus' => 'search-plus',
								'fa-send' => 'send',
								'fa-send-o' => 'send-o',
								'fa-share' => 'share',
								'fa-share-alt' => 'share-alt',
								'fa-share-alt-square' => 'share-alt-square',
								'fa-share-square' => 'share-square',
								'fa-share-square-o' => 'share-square-o',
								'fa-shield' => 'shield',
								'fa-shopping-cart' => 'shopping-cart',
								'fa-sign-in' => 'sign-in',
								'fa-sign-out' => 'sign-out',
								'fa-signal' => 'signal',
								'fa-sitemap' => 'sitemap',
								'fa-skype' => 'skype',
								'fa-slack' => 'slack',
								'fa-sliders' => 'sliders',
								'fa-smile-o' => 'smile-o',
								'fa-sort' => 'sort',
								'fa-sort-alpha-asc' => 'sort-alpha-asc',
								'fa-sort-alpha-desc' => 'sort-alpha-desc',
								'fa-sort-amount-asc' => 'sort-amount-asc',
								'fa-sort-amount-desc' => 'sort-amount-desc',
								'fa-sort-asc' => 'sort-asc',
								'fa-sort-desc' => 'sort-desc',
								'fa-sort-down' => 'sort-down',
								'fa-sort-numeric-asc' => 'sort-numeric-asc',
								'fa-sort-numeric-desc' => 'sort-numeric-desc',
								'fa-sort-up' => 'sort-up',
								'fa-soundcloud' => 'soundcloud',
								'fa-space-shuttle' => 'space-shuttle',
								'fa-spinner' => 'spinner',
								'fa-spoon' => 'spoon',
								'fa-spotify' => 'spotify',
								'fa-square' => 'square',
								'fa-square-o' => 'square-o',
								'fa-stack-exchange' => 'stack-exchange',
								'fa-stack-overflow' => 'stack-overflow',
								'fa-star' => 'star',
								'fa-star-half' => 'star-half',
								'fa-star-half-empty' => 'star-half-empty',
								'fa-star-half-full' => 'star-half-full',
								'fa-star-half-o' => 'star-half-o',
								'fa-star-o' => 'star-o',
								'fa-steam' => 'steam',
								'fa-steam-square' => 'steam-square',
								'fa-step-backward' => 'step-backward',
								'fa-step-forward' => 'step-forward',
								'fa-stethoscope' => 'stethoscope',
								'fa-stop' => 'stop',
								'fa-strikethrough' => 'strikethrough',
								'fa-stumbleupon' => 'stumbleupon',
								'fa-stumbleupon-circle' => 'stumbleupon-circle',
								'fa-subscript' => 'subscript',
								'fa-suitcase' => 'suitcase',
								'fa-sun-o' => 'sun-o',
								'fa-superscript' => 'superscript',
								'fa-support' => 'support',
								'fa-table' => 'table',
								'fa-tablet' => 'tablet',
								'fa-tachometer' => 'tachometer',
								'fa-tag' => 'tag',
								'fa-tags' => 'tags',
								'fa-tasks' => 'tasks',
								'fa-taxi' => 'taxi',
								'fa-tencent-weibo' => 'tencent-weibo',
								'fa-terminal' => 'terminal',
								'fa-text-height' => 'text-height',
								'fa-text-width' => 'text-width',
								'fa-th' => 'th',
								'fa-th-large' => 'th-large',
								'fa-th-list' => 'th-list',
								'fa-thumb-tack' => 'thumb-tack',
								'fa-thumbs-down' => 'thumbs-down',
								'fa-thumbs-o-down' => 'thumbs-o-down',
								'fa-thumbs-o-up' => 'thumbs-o-up',
								'fa-thumbs-up' => 'thumbs-up',
								'fa-ticket' => 'ticket',
								'fa-times' => 'times',
								'fa-times-circle' => 'times-circle',
								'fa-times-circle-o' => 'times-circle-o',
								'fa-tint' => 'tint',
								'fa-toggle-down' => 'toggle-down',
								'fa-toggle-left' => 'toggle-left',
								'fa-toggle-right' => 'toggle-right',
								'fa-toggle-up' => 'toggle-up',
								'fa-trash-o' => 'trash-o',
								'fa-tree' => 'tree',
								'fa-trello' => 'trello',
								'fa-trophy' => 'trophy',
								'fa-truck' => 'truck',
								'fa-try' => 'try',
								'fa-tumblr' => 'tumblr',
								'fa-tumblr-square' => 'tumblr-square',
								'fa-turkish-lira' => 'turkish-lira',
								'fa-twitter' => 'twitter',
								'fa-twitter-square' => 'twitter-square',
								'fa-umbrella' => 'umbrella',
								'fa-underline' => 'underline',
								'fa-undo' => 'undo',
								'fa-university' => 'university',
								'fa-unlink' => 'unlink',
								'fa-unlock' => 'unlock',
								'fa-unlock-alt' => 'unlock-alt',
								'fa-unsorted' => 'unsorted',
								'fa-upload' => 'upload',
								'fa-usd' => 'usd',
								'fa-user' => 'user',
								'fa-user-md' => 'user-md',
								'fa-users' => 'users',
								'fa-video-camera' => 'video-camera',
								'fa-vimeo-square' => 'vimeo-square',
								'fa-vine' => 'vine',
								'fa-vk' => 'vk',
								'fa-volume-down' => 'volume-down',
								'fa-volume-off' => 'volume-off',
								'fa-volume-up' => 'volume-up',
								'fa-warning' => 'warning',
								'fa-wechat' => 'wechat',
								'fa-weibo' => 'weibo',
								'fa-weixin' => 'weixin',
								'fa-wheelchair' => 'wheelchair',
								'fa-windows' => 'windows',
								'fa-won' => 'won',
								'fa-wordpress' => 'wordpress',
								'fa-wrench' => 'wrench',
								'fa-xing' => 'xing',
								'fa-xing-square' => 'xing-square',
								'fa-yahoo' => 'yahoo',
								'fa-yen' => 'yen',
								'fa-youtube' => 'youtube',
								'fa-youtube-play' => 'youtube-play',
								'fa-youtube-square' => 'youtube-square',

 ),
 ),

	)
);


 /* ----------------------------------------------------- */
// Team Settings
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'teamsettings',
	'title' => 'Team Settings',
	'pages' => array( 'team' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(


		array(
			'name'		=> 'E-mail',
			'id'		=> $prefix . "mail",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Phone Number',
			'id'		=> $prefix . "team_phone",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Location',
			'id'		=> $prefix . "team_location",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Adress',
			'id'		=> $prefix . "team_adress",
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
		array(
			'name'		=> 'About team member',
			'id'		=> $prefix . "team_about",
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),

		// HEADING
		array(
			'type' => 'heading',
			'name' => esc_html__( 'Team member social options', 'confidence' ),
			'id'   => 'fake_id', // Not used but needed for plugin
		),
		array(
			'name'		=> 'Team facebook url',
			'id'		=> $prefix . "team_facebook",
			'clone'		=> false,
			'type'		=> 'url',
			'std'		=> 'https://www.facebook.com/'
		),
		array(
			'name'		=> 'Team twitter url',
			'id'		=> $prefix . "team_twitter",
			'clone'		=> false,
			'type'		=> 'url',
			'std'		=> 'https://www.twitter.com/'
		),
		array(
			'name'		=> 'Team google url',
			'id'		=> $prefix . "team_google",
			'clone'		=> false,
			'type'		=> 'url',
			'std'		=> 'https://plus.google.com/'
		),
		array(
			'name'		=> 'Team linkedin url',
			'id'		=> $prefix . "team_linkedin",
			'clone'		=> false,
			'type'		=> 'url',
			'std'		=> 'https://www.linkedin.com/'
		),
		array(
			'name'		=> 'profession',
			'id'		=> $prefix . "team_profession",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),


	)
); //end team


/*-----------------------------------------------------------------------------------*/
/*  Metaboxes for blog posts
/*-----------------------------------------------------------------------------------*/

    /* Gallery Post Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Gallery Settings', 'confidence'),
        'pages'    => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__('Gallery Style', 'confidence'),
                'desc' => esc_html__('Select the gallery style.', 'confidence'),
                'id'   => $prefix . 'gallery_style',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Slider', 'confidence' ),
                    'value2' => esc_html__( 'Grid', 'confidence' ),
                ),
                'std'         => 'Slider'
            ),
            array(
                'name' => esc_html__('Select Images', 'confidence'),
                'desc' => esc_html__('Select the images from the media library or upload your new ones.', 'confidence'),
                'id'   => $prefix . 'gallery_image',
                'type' => 'image_advanced',
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_gallery_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show__gallery_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );

    /* Quote Post Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Quote Settings', 'confidence'),
        'pages'    => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__('The Quote', 'confidence'),
                'desc' => esc_html__('Write your quote in this field.', 'confidence'),
                'id'   => $prefix . 'quote_text',
                'type' => 'textarea',
                'rows' => 5
            ),
            array(
                'name' => esc_html__('The Author', 'confidence'),
                'desc' => esc_html__('Enter the name of the author of this quote.', 'confidence'),
                'id'   => $prefix . 'quote_author',
                'type' => 'text'
            ),
            array(
                'name' => esc_html__('Background Color', 'confidence'),
                'desc' => esc_html__('Choose the background color for this quote.', 'confidence'),
                'id'   => $prefix . 'quote_bg',
                'type' => 'color'
            ),
            array(
                'name' => esc_html__('Background Opacity', 'confidence'),
                'desc' => esc_html__('Choose the opacity of the background color.', 'confidence'),
                'id'   => $prefix . 'quote_bg_opacity',
                'type' => 'text',
                'std' => 80
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('Divider.', 'confidence'),
                'id'   => $prefix . 'quote_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_quote_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show_quote_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );

    /* Link Post Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Link Settings', 'confidence'),
        'pages'    => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__('The URL', 'confidence'),
                'desc' => esc_html__('Insert the URL you wish to link to.', 'confidence'),
                'id'   => $prefix . 'the_link',
                'type' => 'textarea',
            ),
            array(
                'name' => esc_html__('Background Color', 'confidence'),
                'desc' => esc_html__('Choose the background color for this link.', 'confidence'),
                'id'   => $prefix . 'link_bg',
                'type' => 'color',
                'std'  => '#d5d85f'
            ),
            array(
                'name' => esc_html__('Background Opacity', 'confidence'),
                'desc' => esc_html__('Choose the opacity of the background color.', 'confidence'),
                'id'   => $prefix . 'link_bg_opacity',
                'type' => 'text',
                'std' => 80
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('Divider.', 'confidence'),
                'id'   => $prefix . 'link_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_link_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show_link_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );

    /* Image Post Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Image Settings', 'confidence'),
        'pages'    => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__('Enable Lightbox', 'confidence'),
                'desc' => esc_html__('Check this to enable the lightbox.', 'confidence'),
                'id'   => $prefix . 'enable_lightbox',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
            array(
                'name' => esc_html__('Enter URL', 'confidence'),
                'desc' => esc_html__('Insert the url for the image.', 'confidence'),
                'id'   => $prefix . 'the_image_url',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_image_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show_image_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );

    /* Audio Post Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Audio Settings', 'confidence'),
        'pages'    => array('post'),
        'fields' => array(
            array(
            'type' => 'heading',
            'name' => esc_html__( 'These settings enable you to embed audio in your posts. Note that for audio, you must supply both MP3 and OGG files to satisfy all browsers. For poster you can select a featured image.', 'confidence' ),
            'id'   => 'audio_head'
            ),
            array(
                'name' => esc_html__('MP3 File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .mp3 audio file.', 'confidence'),
                'id'   => $prefix . 'audio_mp3',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('OGA File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .oga, .ogg audio file.', 'confidence'),
                'id'   => $prefix . 'audio_ogg',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'audio_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('SoundCloud', 'confidence'),
                'desc' => esc_html__('Enter the url of the soundcloud audio.', 'confidence'),
                'id'   => $prefix . 'audio_sc',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Color', 'confidence'),
                'desc' => esc_html__('Choose the color.', 'confidence'),
                'id'   => $prefix . 'audio_sc_color',
                'type' => 'color',
                'std'  => '#ff7700'
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'audio_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_audio_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show_audio_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );

    /* Status Post Format */

    $meta_boxes[] = array(
        'title'    => esc_html__('Status Settings', 'confidence'),
        'pages'    => array('post'),
        'fields' => array(
            array(
                'name' => esc_html__('Style', 'confidence'),
                'desc' => esc_html__('Select status style.', 'confidence'),
                'id'   => $prefix . 'status_style',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Normal', 'confidence' ),
                    'value2' => esc_html__( 'Background', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Static'
            ),
            array(
                'name' => esc_html__('Background Color', 'confidence'),
                'desc' => esc_html__('Choose the background color for this status.', 'confidence'),
                'id'   => $prefix . 'status_bg',
                'type' => 'color',
                'std'  => '#d5d85f'
            ),
            array(
                'name' => esc_html__('Background Opacity', 'confidence'),
                'desc' => esc_html__('Choose the opacity of the background color.', 'confidence'),
                'id'   => $prefix . 'status_bg_opacity',
                'type' => 'text',
                'std' => 80
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show_status_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );

    /* Video Post Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Video Settings', 'confidence'),
        'pages'    => array('post'),
        'fields' => array(
            array(
            'type' => 'heading',
            'name' => esc_html__( 'These settings enable you to embed videos into your posts. Note that for video, you must supply an M4V file to satisfy both HTML5 and Flash solutions. The optional OGV format is used to increase x-browser support for HTML5 browsers such as Firefox and Opera. For the poster, you can select a featured image.', 'confidence' ),
            'id'   => 'video_head'
            ),
            array(
                'name' => esc_html__('M4V File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .m4v video file.', 'confidence'),
                'id'   => $prefix . 'video_m4v',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('OGV File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .ogv video file.', 'confidence'),
                'id'   => $prefix . 'video_ogv',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('WEBM File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .webm video file.', 'confidence'),
                'id'   => $prefix . 'video_webm',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Embeded Code', 'confidence'),
                'desc' => esc_html__('Select the preview image for this video.', 'confidence'),
                'id'   => $prefix . 'video_embed',
                'type' => 'textarea',
                'rows' => 8
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'video_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_video_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show_video_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );

	/*-----------------------------------------------------------------------------------*/
	/*  Metaboxes for sermon posts
	/*-----------------------------------------------------------------------------------*/

    /* Gallery Post Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Gallery Settings', 'confidence'),
        'pages'    => array('sermon'),
        'fields' => array(
            array(
                'name' => esc_html__('Gallery Style', 'confidence'),
                'desc' => esc_html__('Select the gallery style.', 'confidence'),
                'id'   => $prefix . 'gallery_style',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Slider', 'confidence' ),
                    'value2' => esc_html__( 'Grid', 'confidence' ),
                ),
                'std'         => 'Slider'
            ),
            array(
                'name' => esc_html__('Select Images', 'confidence'),
                'desc' => esc_html__('Select the images from the media library or upload your new ones.', 'confidence'),
                'id'   => $prefix . 'gallery_image',
                'type' => 'image_advanced',
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_gallery_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );



    /* Audio sermon Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Audio Settings', 'confidence'),
        'pages'    => array('ministry'),
        'fields' => array(
            array(
            'type' => 'heading',
            'name' => esc_html__( 'These settings enable you to embed audio in your sermons. Note that for audio, you must supply both MP3 and OGG files to satisfy all browsers. For sermoner you can select a featured image.', 'confidence' ),
            'id'   => 'audio_head'
            ),
            array(
                'name' => esc_html__('MP3 File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .mp3 audio file.', 'confidence'),
                'id'   => $prefix . 'audio_mp3',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('OGA File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .oga, .ogg audio file.', 'confidence'),
                'id'   => $prefix . 'audio_ogg',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'audio_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('SoundCloud', 'confidence'),
                'desc' => esc_html__('Enter the url of the soundcloud audio.', 'confidence'),
                'id'   => $prefix . 'audio_sc',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Color', 'confidence'),
                'desc' => esc_html__('Choose the color.', 'confidence'),
                'id'   => $prefix . 'audio_sc_color',
                'type' => 'color',
                'std'  => '#ff7700'
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'audio_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_audio_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );



    /* Video ministry Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Video Settings', 'confidence'),
        'pages'    => array('ministry'),
        'fields' => array(
            array(
            'type' => 'heading',
            'name' => esc_html__( 'These settings enable you to embed videos into your sermons. Note that for video, you must supply an M4V file to satisfy both HTML5 and Flash solutions. The optional OGV format is used to increase x-browser support for HTML5 browsers such as Firefox and Opera. For the sermoner, you can select a featured image.', 'confidence' ),
            'id'   => 'video_head'
            ),
            array(
                'name' => esc_html__('M4V File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .m4v video file.', 'confidence'),
                'id'   => $prefix . 'video_m4v',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('OGV File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .ogv video file.', 'confidence'),
                'id'   => $prefix . 'video_ogv',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('WEBM File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .webm video file.', 'confidence'),
                'id'   => $prefix . 'video_webm',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Embeded Code', 'confidence'),
                'desc' => esc_html__('Select the preview image for this video.', 'confidence'),
                'id'   => $prefix . 'video_embed',
                'type' => 'textarea',
                'rows' => 8
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'video_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_video_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );



	/*-----------------------------------------------------------------------------------*/
	/*  Metaboxes for ministry posts
	/*-----------------------------------------------------------------------------------*/

    /* Gallery Post Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Gallery Settings', 'confidence'),
        'pages'    => array('ministry'),
        'fields' => array(
            array(
                'name' => esc_html__('Gallery Style', 'confidence'),
                'desc' => esc_html__('Select the gallery style.', 'confidence'),
                'id'   => $prefix . 'gallery_style',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Slider', 'confidence' ),
                    'value2' => esc_html__( 'Grid', 'confidence' ),
                ),
                'std'         => 'Slider'
            ),
            array(
                'name' => esc_html__('Select Images', 'confidence'),
                'desc' => esc_html__('Select the images from the media library or upload your new ones.', 'confidence'),
                'id'   => $prefix . 'gallery_image',
                'type' => 'image_advanced',
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_gallery_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );



    /* Audio sermon Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Audio Settings', 'confidence'),
        'pages'    => array('sermon'),
        'fields' => array(
            array(
            'type' => 'heading',
            'name' => esc_html__( 'These settings enable you to embed audio in your sermons. Note that for audio, you must supply both MP3 and OGG files to satisfy all browsers. For sermoner you can select a featured image.', 'confidence' ),
            'id'   => 'audio_head'
            ),
            array(
                'name' => esc_html__('MP3 File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .mp3 audio file.', 'confidence'),
                'id'   => $prefix . 'audio_mp3',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('OGA File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .oga, .ogg audio file.', 'confidence'),
                'id'   => $prefix . 'audio_ogg',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'audio_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('SoundCloud', 'confidence'),
                'desc' => esc_html__('Enter the url of the soundcloud audio.', 'confidence'),
                'id'   => $prefix . 'audio_sc',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Color', 'confidence'),
                'desc' => esc_html__('Choose the color.', 'confidence'),
                'id'   => $prefix . 'audio_sc_color',
                'type' => 'color',
                'std'  => '#ff7700'
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'audio_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_audio_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );



    /* Video sermon Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Video Settings', 'confidence'),
        'pages'    => array('sermon'),
        'fields' => array(
            array(
            'type' => 'heading',
            'name' => esc_html__( 'These settings enable you to embed videos into your sermons. Note that for video, you must supply an M4V file to satisfy both HTML5 and Flash solutions. The optional OGV format is used to increase x-browser support for HTML5 browsers such as Firefox and Opera. For the sermoner, you can select a featured image.', 'confidence' ),
            'id'   => 'video_head'
            ),
            array(
                'name' => esc_html__('M4V File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .m4v video file.', 'confidence'),
                'id'   => $prefix . 'video_m4v',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('OGV File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .ogv video file.', 'confidence'),
                'id'   => $prefix . 'video_ogv',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('WEBM File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .webm video file.', 'confidence'),
                'id'   => $prefix . 'video_webm',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Embeded Code', 'confidence'),
                'desc' => esc_html__('Select the preview image for this video.', 'confidence'),
                'id'   => $prefix . 'video_embed',
                'type' => 'textarea',
                'rows' => 8
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'video_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_video_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );

	  /* Audio program Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Audio Settings', 'confidence'),
        'pages'    => array('program'),
        'fields' => array(
            array(
            'type' => 'heading',
            'name' => esc_html__( 'These settings enable you to embed audio in your sermons. Note that for audio, you must supply both MP3 and OGG files to satisfy all browsers. For sermoner you can select a featured image.', 'confidence' ),
            'id'   => 'audio_head'
            ),
            array(
                'name' => esc_html__('MP3 File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .mp3 audio file.', 'confidence'),
                'id'   => $prefix . 'audio_mp3',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('OGA File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .oga, .ogg audio file.', 'confidence'),
                'id'   => $prefix . 'audio_ogg',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'audio_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('SoundCloud', 'confidence'),
                'desc' => esc_html__('Enter the url of the soundcloud audio.', 'confidence'),
                'id'   => $prefix . 'audio_sc',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Color', 'confidence'),
                'desc' => esc_html__('Choose the color.', 'confidence'),
                'id'   => $prefix . 'audio_sc_color',
                'type' => 'color',
                'std'  => '#ff7700'
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'audio_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_audio_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );



    /* Video program Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Video Settings', 'confidence'),
        'pages'    => array('program'),
        'fields' => array(
            array(
            'type' => 'heading',
            'name' => esc_html__( 'These settings enable you to embed videos into your sermons. Note that for video, you must supply an M4V file to satisfy both HTML5 and Flash solutions. The optional OGV format is used to increase x-browser support for HTML5 browsers such as Firefox and Opera. For the sermoner, you can select a featured image.', 'confidence' ),
            'id'   => 'video_head'
            ),
            array(
                'name' => esc_html__('M4V File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .m4v video file.', 'confidence'),
                'id'   => $prefix . 'video_m4v',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('OGV File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .ogv video file.', 'confidence'),
                'id'   => $prefix . 'video_ogv',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('WEBM File URL', 'confidence'),
                'desc' => esc_html__('The URL to the .webm video file.', 'confidence'),
                'id'   => $prefix . 'video_webm',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__('Embeded Code', 'confidence'),
                'desc' => esc_html__('Select the preview image for this video.', 'confidence'),
                'id'   => $prefix . 'video_embed',
                'type' => 'textarea',
                'rows' => 8
            ),
            array(
                'name' => esc_html__('Divider', 'confidence'),
                'desc' => esc_html__('divider.', 'confidence'),
                'id'   => $prefix . 'video_divider',
                'type' => 'divider'
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_video_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );



	/*-----------------------------------------------------------------------------------*/
	/*  Metaboxes for program posts
	/*-----------------------------------------------------------------------------------*/

    /* Gallery Post Format ------------*/

    $meta_boxes[] = array(
        'title'    => esc_html__('Gallery Settings', 'confidence'),
        'pages'    => array('program'),
        'fields' => array(
            array(
                'name' => esc_html__('Gallery Style', 'confidence'),
                'desc' => esc_html__('Select the gallery style.', 'confidence'),
                'id'   => $prefix . 'gallery_style',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Slider', 'confidence' ),
                    'value2' => esc_html__( 'Grid', 'confidence' ),
                ),
                'std'         => 'Slider'
            ),
            array(
                'name' => esc_html__('Select Images', 'confidence'),
                'desc' => esc_html__('Select the images from the media library or upload your new ones.', 'confidence'),
                'id'   => $prefix . 'gallery_image',
                'type' => 'image_advanced',
            ),
            array(
                'name' => esc_html__('Show Meta Information', 'confidence'),
                'desc' => esc_html__('Check this to show metadata.', 'confidence'),
                'id'   => $prefix . 'show_gallery_meta',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            ),
			array(
                'name' => esc_html__('Show Social Icons', 'confidence'),
                'desc' => esc_html__('Check this to show Social Icons.', 'confidence'),
                'id'   => $prefix . 'show_social_icons',
                'type' => 'select',
                'options'  => array(
                    'value1' => esc_html__( 'Yes', 'confidence' ),
                    'value2' => esc_html__( 'No', 'confidence' ),
                ),
                'multiple'    => false,
                'std'         => 'Yes'
            )
        )
    );

  return $meta_boxes;
}

function ninetheme_confidence_m_b_admin_scripts() {
    wp_register_script('ninetheme_confidence_m_b_custom_admin', get_template_directory_uri() . '/js/jquery.custom.admin.js');
    wp_enqueue_script('ninetheme_confidence_m_b_custom_admin');
}

function ninetheme_confidence_m_b_admin_styles() {
    wp_register_style('ninetheme_confidence_m_b_options_css', get_template_directory_uri() . '/admin/admin-style.css');
    wp_register_style('ninetheme_confidence_m_b_options_grey_css', get_template_directory_uri() . '/admin/admin-style-grey.css');
    wp_enqueue_style('ninetheme_confidence_m_b_options_css');
    wp_enqueue_style('ninetheme_confidence_m_b_options_grey_css');
}

add_action('admin_print_scripts', 'ninetheme_confidence_m_b_admin_scripts');
add_action('admin_print_styles', 'ninetheme_confidence_m_b_admin_styles');
