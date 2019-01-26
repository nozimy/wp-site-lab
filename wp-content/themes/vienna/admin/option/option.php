<?php
$imgdir = get_template_directory_uri() . '/lib/img/';
$thelogo = $imgdir.'tologo.png'; //Change here
return array(
	'title' => __('Theme Options', 'zatolab'),
	'logo' => $thelogo,
	'menus' => array(
		array(
			'title' => __('General Settings', 'zatolab'),
			'name' => 'pagelayouts',
			'icon' => 'font-awesome:fa-gear',
			'menus' => array(
				array(
					'title' => __('Branding', 'zatolab'),
					'name' => 'basic',
					'icon' => 'font-awesome:fa-wrench',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Branding', 'zatolab'),
							'name' => 'Branding',
							'fields' => array(
								array(
									'type' => 'upload',
									'name' => 'logo',
									'label' => __('Logo on Header', 'zatolab'),
									'description' => __('Upload your logo here.', 'zatolab'),
									'default' => '',
								),
								array(
									'type' => 'upload',
									'name' => 'logo_footer',
									'label' => __('Logo on Footer', 'zatolab'),
									'description' => __('Upload your logo here.', 'zatolab'),
									'default' => '',
								),
							),
						),
						array(
							'type' => 'section',
							'title' => __('Profil Photo', 'zatolab'),
							'name' => 'Profile Photo',
							'description' => __('', 'zatolab'),
							'fields' => array(
								array(
									'type' => 'upload',
									'name' => 'profilephoto',
									'label' => __('Profile Photo/Avatar Image', 'zatolab'),
									'description' => __('Upload your Photo here. Please use SQUARE size', 'zatolab'),
									'default' => '',
								),
							),
						),

						array(
							'type' => 'section',
							'title' => __('Favicon', 'zatolab'),
							'name' => 'favicon',
							'icon' => 'font-awesome:fa-gear',
							'fields' => array(
								//Favicon 144
								array(
									'type' => 'upload',
									'name' => 'favicon_144',
									'label' => __('144px Favicon', 'zatolab'),
									'description' => __('Upload your favicon for third-generation iPad with high-resolution Retina display (144x144 px)', 'zatolab'),
									'default' => '',
								),
								//Favicon 114
								array(
									'type' => 'upload',
									'name' => 'favicon_114',
									'label' => __('114px Favicon', 'zatolab'),
									'description' => __('Upload your favicon for iPhone with high-resolution Retina display (114x114 px)', 'zatolab'),
									'default' => '',
								),
								//Favicon 72
								array(
									'type' => 'upload',
									'name' => 'favicon_72',
									'label' => __('72px Favicon', 'zatolab'),
									'description' => __('Upload your favicon For first- and second-generation iPad (72x72 px)', 'zatolab'),
									'default' => '',
								),
								//Favicon 57
								array(
									'type' => 'upload',
									'name' => 'favicon_57',
									'label' => __('57px Favicon', 'zatolab'),
									'description' => __('Upload your favicon For non-Retina iPhone, iPod Touch, and Android 2.1+ devices (57x57 px)', 'zatolab'),
									'default' => '',
								),
								array(
									'type' => 'upload',
									'name' => 'favicon',
									'label' => __('Default Favicon', 'zatolab'),
									'description' => __('Upload your favicon For Default Browser', 'zatolab'),
									'default' => '',
								),		
							),
						),
					),
				),
				array(
					'title' => __('Additional Features', 'zatolab'),
					'icon' => 'font-awesome:fa-wrench',
					'controls' => array(
						/*  Show or not  */
						array(
							'type' => 'toggle',
							'name' => 'show_frontendpost',
							'label' => __('Frontend Posting ', 'zatolab'),
							'description' => __('Enable Frontend Posting', 'zatolab'),
							'default' => '0',
						),
						array(
							'type' => 'toggle',
							'name' => 'use_preload',
							'label' => __('Use Preload Effect ', 'zatolab'),
							'description' => __('This will displayed only at the first time visitor\'s visit', 'zatolab'),
							'default' => '1',
						),
						array(
							'type' => 'section',
							'title' => __('Post Sorter', 'zatolab'),
							'name' => 'sorter',
							'description' => __('The Post Sorter in archive, index, tag, category, and author page', 'zatolab'),
							'fields' => array(
								array(
									'type' => 'select',
									'name' => 'browsepage',
									'label' => __('Browse Page', 'zatolab'),
									'description' => __('Choose the browse page template that you\'ve created. ', 'zatolab'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_get_pages',
											),
										),
									),
								),
								array(
									'type' => 'toggle',
									'name' => 'by_date',
									'label' => __('Date', 'zatolab'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'by_comments',
									'label' => __('Comments', 'zatolab'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'by_views',
									'label' => __('Views', 'zatolab'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'by_title',
									'label' => __('Title', 'zatolab'),
									'default' => '1',
								),
							),
						),
					),
				),
			),
		),
		
		/* oooooooooooooooooooooooooooooooooooooooo
		index carousel
		ooooooooooooooooooooooooooooooooooooooooo*/
		array(
			'title' => __('Pages Settings', 'zatolab'),
			'name' => 'pagelayouts',
			'icon' => 'font-awesome:fa-columns',
			'menus' => array(
				array(
					'title' => __('Home (index)', 'zatolab'),
					'name' => 'indexphp',
					//'icon' => 'font-awesome:fa-th-large',
					'controls' => array(
						
						array(
							'type' => 'toggle',
							'name' => 'show_featured',
							'label' => __('Show Featured Content', 'zatolab'),
							'default' => '1',
						),
						array(
							'type' => 'radioimage',
							'name' => 'featuredmodel',
							'label' => __('Featured Content Mode', 'zatolab'),
							'items' => array(
								array(
									'value' => 'featuredpost',
									'label' => __('Featured Post', 'zatolab'),
									'img' => $imgdir.'featuredpost.jpg',
								),
								array(
									'value' => 'welcomessage',
									'label' => __('Welcome Message', 'zatolab'),
									'img' => $imgdir.'welcome.png',
								),
							),
							'item_max_width' => '418',
						),
						
						array(
							'type' => 'section',
							'title' => __('Welcome Message', 'zatolab'),
							'name' => 'welcome',
							'description' => __('Settings for Default Homepage (index.php)', 'zatolab'),
							'fields' => array(
								array(
									'type' => 'textbox',
									'name' => 'welcome_headline',
									'label' => __('Welcome Headline/Title', 'zatolab'),
									'description' => __('Write your welcome headline here, example: Welcome to my blog', 'zatolab'),
									'default' => 'Welcome to My Blog',
								),
								array(
									'type' => 'textarea',
									'name' => 'welcome_msg',
									'label' => __('Textarea', 'zatolab'),
									'description' => __('Your Blog Description', 'zatolab'),
									'default' => 'The blog that talking everything about advanture',
								),
							),
							'dependency' => array(
								'field'    => 'featuredmodel',
								'function' => 'featmod_welcome',
							),
						),
						array(
							'type' => 'section',
							'title' => __('Featured Posts', 'zatolab'),
							'name' => 'featuredpostts',
							'description' => __('This section will appear if you choose to enable "Featured Post" in Featured Content Model option', 'zatolab'),
							'fields' => array(
								array(
									'type' => 'multiselect',
									'name' => 'featured_cats',
									'label' => __('Featured Posts', 'zatolab'),
									'description' => __('Choose the category(ies) to Show the post. Leave blank to show the posts by all categories', 'zatolab'),
									'items' => array(
										'data' => array(
											array(
												'source' => 'function',
												'value' => 'vp_get_categories',
											),
										),
									),
								),
							),
							'dependency' => array(
								'field'    => 'featuredmodel',
								'function' => 'featmod_post',
							),
						),
					),
						
					//index.php SECTION:Sidebar Position
					array(
						'type' => 'section',
						'title' => __('Widget Option', 'zatolab'),
						'name' => 'sidebar_index',
						'description' => __('Sidebar position settings', 'zatolab'),
						'fields' => array(
							array(
								'type' => 'toggle',
								'name' => 'show_widget',
								'label' => __('Display Widget ', 'zatolab'),
								'description' => __('Show Widget', 'zatolab'),
								'default' => '1',
							),
						),
					),
				), // ENd index submenu
				array(
					'title' => __('Single', 'zatolab'),
					'name' => 'singlephp',
					//'icon' => 'font-awesome:fa-th-large',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Article Features', 'zatolab'),
							'name' => 'single_elements',
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'show_share',
									'label' => __('Share Buttons', 'zatolab'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'show_authorinfo',
									'label' => __('Author Info', 'zatolab'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'show_related',
									'label' => __('Related Articles Box', 'zatolab'),
									'default' => '1',
								),
								/*
								array(
									'type' => 'toggle',
									'name' => 'show_singledate',
									'label' => __('Show Date', 'zatolab'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'show_singlemeta',
									'label' => __('Show Meta', 'zatolab'),
									'default' => '1',
								),
								array(
									'type' => 'toggle',
									'name' => 'show_singlebreadcrumb',
									'label' => __('Show Breadcrumb', 'zatolab'),
									'default' => '1',
								),*/
							),
						),
					),
				), // END single
				
				/*array(
					'title' => __('Page', 'zatolab'),
					'name' => 'pagephp',
					//'icon' => 'font-awesome:fa-th-large',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Page Option', 'zatolab'),
							'name' => 'page_section',
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'show_pagebreadcrumb',
									'label' => __('Show Breadcrumb', 'zatolab'),
									'default' => '1',
								),
							),
						),
					),
				), // END Page
				
				array(
					'title' => __('Category', 'zatolab'),
					'name' => 'categoryphp',
					//'icon' => 'font-awesome:fa-th-large',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Archive Breadcrumb', 'zatolab'),
							'name' => 'categoryphp_section',
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'show_archivebreadcrumb',
									'label' => __('Show Breadcrumb', 'zatolab'),
									'default' => '1',
								),
							),
						),
					),
				), // END Cat
				
				array(
					'title' => __('Tag', 'zatolab'),
					'name' => 'tagphp',
					//'icon' => 'font-awesome:fa-th-large',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Tags Breadcrumb', 'zatolab'),
							'name' => 'taglayout',
							'fields' => array(
								array(
									'type' => 'toggle',
									'name' => 'show_tagbreadcrumb',
									'label' => __('Show Breadcrumb', 'zatolab'),
									'default' => '1',
								),
							),
						),
					),
				), // END Cat
				*/
				array(
					'title' => __('404', 'zatolab'),
					'name' => '404settings',
					//'icon' => 'font-awesome:fa-th-large',
					'controls' => array(
						array(
							'type' => 'textbox',
							'name' => 'notfoundtitle',
							'label' => __('Not Found Title', 'zatolab'),
							'description' => __('Not Found Title, leave blank to use default text', 'zatolab'),
						),
						array(
							'type' => 'section',
							'title' => __('Message 404', 'zatolab'),
							'name' => 'layout404',
							'fields' => array(
								array(
									'type' => 'wpeditor',
									'name' => 'message404',
									'label' => __('WP TinyMCE Editor', 'zatolab'),
									'description' => __('Custom Not Found message when your visitors are in this page. Leave blank to use default message.', 'zatolab'),
									'use_external_plugins'       => 1,
									'disabled_externals_plugins' => 'vp_sc_button, sgtroces2',
									'disabled_internals_plugins' => '',
								),
							),
						),
					),
				), // END Cat
				
				
			),
		),
		/* oooooooooooooooooooooooooooooooooooooooo
		STYLING
		ooooooooooooooooooooooooooooooooooooooooo*/
		array(
			'title' => __('Design & Styling', 'zatolab'),
			'name' => 'styling',
			'icon' => $imgdir.'paint41.png',
			'menus' => array(
				array(
					'title' => __('Header Styling', 'zatolab'),
					'name' => 'headersets',
					'controls' => array(
						array(
							'type' => 'section',
							'title' => __('Header Layout', 'zatolab'),
							'name' => 'Header_Settings',
							'description' => __('Header Style Options', 'zatolab'),
							'fields' => array(
								array(
									'type' => 'radioimage',
									'name' => 'header',
									'label' => __('Header Layout', 'zatolab'),
									'description' => __('Choose header design that fit to your needs', 'zatolab'),
									'items' => array(
										array(
											'value' => 'header1',
											'label' => __('Default', 'zatolab'),
											'img' => $imgdir.'header_icon1.png',
										),
										array(
											'value' => 'header2',
											'label' => __('Header 2', 'zatolab'),
											'img' => $imgdir.'header_icon2.png',
										),
										array(
											'value' => 'header3',
											'label' => __('Header 3', 'zatolab'),
											'img' => $imgdir.'header_icon3.png',
										),
										array(
											'value' => 'header4',
											'label' => __('Header 4', 'zatolab'),
											'img' => $imgdir.'header_icon4.png',
										),
									),
								),
								array(
									'type' => 'toggle',
									'name' => 'stickymenu',
									'label' => __('Sticky Top Navigation', 'zatolab'),
									'default' => '0',
								),

								/*array(
									'type' => 'select',
									'name' => 'header',
									'label' => __('Header Layout', 'zatolab'),
									'default' => 'masonry',
									'items' => array(
										array(
											'value' => 'header1',
											'label' => __('Default', 'zatolab'),
										),
										array(
											'value' => 'header2',
											'label' => __('Header 2', 'zatolab'),
										),
										array(
											'value' => 'header3',
											'label' => __('Header 3', 'zatolab'),
										),
										array(
											'value' => 'header4',
											'label' => __('Header 4', 'zatolab'),
										),
									),
								), */
							), 
						), 
						
						/*Header 1 Options*/
						array(
							'type' => 'section',
							'title' => __('Navigation Bar', 'zatolab'),
							'description' => __('Only works for default header layout', 'zatolab'),
							'name' => 'navigationbar',
							'fields' => array(
								array(
									'type' => 'color',
									'name' => 'navbar_color',
									'label' => __('Navigation Bar Background Color', 'zatolab'),
									'description' => __('You can set the background of navigation bar independently and seperated from colorscheme', 'zatolab'),
									'format' => 'hex',
								),
								array(
									'type' => 'color',
									'name' => 'navbar_text_color',
									'label' => __('Text Color', 'zatolab'),
									'description' => __('The text color in navigation bar', 'zatolab'),
									'format' => 'hex',
								),
							),
						),

						array(
							'type' => 'section',
							'title' => __('Main Header Background', 'zatolab'),
							'name' => 'subheaderbackground',
							'description' => __('', 'zatolab'),
							'fields' => array(
								array(
									'type' => 'color',
									'name' => 'bg_header',
									'label' => __('Background Header Color', 'zatolab'),
									'default' => '',
									'format' => 'hex',
								),
								array(
									'type' => 'upload',
									'name' => 'bg_headerimg',
									'label' => __('Header Image Background', 'zatolab'),
									'description' => __('Upload your image here. ', 'zatolab'),
									'default' => '',
								),
								array(
									'type'    => 'slider',
									'name'    => 'bg_imageopacity',
									'label'   => __('Header Image Background Opacity', 'zatolab'),
									'min'     => '0',
									'max'     => '1',
									'default' => '.5',
									'step' 	  => '0.01',
								),
								array(
									'type' => 'select',
									'name' => 'subhead_bg_rpt',
									'label' => __('Background Repeat', 'zatolab'),
									'items' => array(
										array(
											'value' => 'repeat-x',
											'label' => __('Repeat Horizontal', 'zatolab'),
										),
										array(
											'value' => 'repeat-y',
											'label' => __('Repeat Vertical', 'zatolab'),
										),
										array(
											'value' => 'repeat',
											'label' => __('Repeat Horizontal and Vertical', 'zatolab'),
										),
										array(
											'value' => 'no-repeat',
											'label' => __('No Repeat', 'zatolab'),
										),
										
									),
								),
								array(
									'type' => 'select',
									'name' => 'subhead_bg_pos',
									'label' => __('Background Position', 'zatolab'),
									'items' => array(
										array(
											'value' => 'top left',
											'label' => __('top left', 'zatolab'),
										),
										array(
											'value' => 'top center',
											'label' => __('top center', 'zatolab'),
										),
										array(
											'value' => 'top right',
											'label' => __('top right', 'zatolab'),
										),
										array(
											'value' => 'center left',
											'label' => __('center left', 'zatolab'),
										),
										array(
											'value' => 'center center',
											'label' => __('center center', 'zatolab'),
										),
										array(
											'value' => 'center right',
											'label' => __('center right', 'zatolab'),
										),
										array(
											'value' => 'bottom left',
											'label' => __('bottom left', 'zatolab'),
										),
										array(
											'value' => 'bottom center',
											'label' => __('bottom center', 'zatolab'),
										),
										array(
											'value' => 'bottom right',
											'label' => __('bottom right', 'zatolab'),
										),
										
									),
									
								),
								array(
									'type' => 'select',
									'name' => 'subhead_bg_att',
									'label' => __('Background Attachment', 'zatolab'),
									'items' => array(
										array(
											'value' => 'fixed',
											'label' => __('Fixed', 'zatolab'),
										),
										array(
											'value' => 'scroll',
											'label' => __('Scroll', 'zatolab'),
										),
									),
								),
							),
						),
					),
				),
				/* Footer Styling */

				array(
					'title' => __('Footer Styling', 'zatolab'),
					'name' => 'footerstyle',
					'controls' => array(
						array(
							'title' => __('Main Footer', 'zatolab'),
							'name' => 'mainfooterstyle',
							'type' => 'section',
							'fields' => array(
								array(
									'type' => 'textbox',
									'name' => 'footercol',
									'label' => __('Footer Columns', 'zatolab'),
									'description' => __('Columns number in footer, default is 3', 'zatolab'),
									'default' => __('3', 'zatolab'),
									'validation' => 'numeric',
								),
								array(
									'type' => 'color',
									'name' => 'footer_bg',
									'label' => __('Footer Background Color', 'zatolab'),
									'default' => '#353c3e',
									'format' => 'hex',
								),
								array(
									'type' => 'color',
									'name' => 'footer_txtclr',
									'label' => __('Footer Text Color', 'zatolab'),
									'default' => '#bbbbbb',
									'format' => 'hex',
								),
								array(
									'type' => 'color',
									'name' => 'footer_linkclr',
									'label' => __('Footer Link Color', 'zatolab'),
									'default' => '#fff',
									'format' => 'hex',
								),
							),
						),
						
						array(
							'title' => __('Copyright Footer', 'zatolab'),
							'name' => 'mainfooterstyle',
							'type' => 'section',
							'fields' => array(
								array(
									'type' => 'color',
									'name' => 'copyright_bg',
									'label' => __('Copyright Background Color', 'zatolab'),
									'default' => '#2D3335',
									'format' => 'hex',
								),
								array(
									'type' => 'color',
									'name' => 'copyright_txtclr',
									'label' => __('Copyright Text Color', 'zatolab'),
									'default' => '#777',
									'format' => 'hex',
								),
								array(
									'type' => 'color',
									'name' => 'copyright_linkclr',
									'label' => __('Copyright Link Color', 'zatolab'),
									'default' => '#fff',
									'format' => 'hex',
								),
							),
						),
					),
				),
				array(
					'title' => __('Misc', 'zatolab'),
					'name' => 'otherstyling',
					'controls' => array(
						array(
							'type' => 'color',
							'name' => 'colorscheme',
							'label' => __('Color Scheme', 'zatolab'),
							'default' => '',
							'format' => 'hex',
						),

						
						array(
							'type' => 'section',
							'title' => __('Main Body Styling', 'zatolab'),
							'name' => 'body',
							'fields' => array(
								array(
									'type' => 'color',
									'name' => 'bg_clr',
									'label' => __('Background Color', 'zatolab'),
									'description' => __('Color Picker, you can set the default color.', 'zatolab'),
									'format' => 'hex',
								),
								
								array(
									'type' => 'upload',
									'name' => 'bg_img',
									'label' => __('Background Image', 'zatolab'),
									'description' => __('Upload your image for body background', 'zatolab'),
								),
								array(
									'type' => 'select',
									'name' => 'bg_rpt',
									'label' => __('Background Repeat', 'zatolab'),
									'items' => array(
										array(
											'value' => 'repeat-x',
											'label' => __('Repeat Horizontal', 'zatolab'),
										),
										array(
											'value' => 'repeat-y',
											'label' => __('Repeat Vertical', 'zatolab'),
										),
										array(
											'value' => 'repeat',
											'label' => __('Repeat Horizontal and Vertical', 'zatolab'),
										),
										array(
											'value' => 'no-repeat',
											'label' => __('No Repeat', 'zatolab'),
										),
										
									),
								),
								array(
									'type' => 'select',
									'name' => 'bg_pos',
									'label' => __('Background Position', 'zatolab'),
									'items' => array(
										array(
											'value' => 'top left',
											'label' => __('top left', 'zatolab'),
										),
										array(
											'value' => 'top center',
											'label' => __('top center', 'zatolab'),
										),
										array(
											'value' => 'top right',
											'label' => __('top right', 'zatolab'),
										),
										array(
											'value' => 'center left',
											'label' => __('center left', 'zatolab'),
										),
										array(
											'value' => 'center center',
											'label' => __('center center', 'zatolab'),
										),
										array(
											'value' => 'center right',
											'label' => __('center right', 'zatolab'),
										),
										array(
											'value' => 'bottom left',
											'label' => __('bottom left', 'zatolab'),
										),
										array(
											'value' => 'bottom center',
											'label' => __('bottom center', 'zatolab'),
										),
										array(
											'value' => 'bottom right',
											'label' => __('bottom right', 'zatolab'),
										),
										
									),
									
								),
								array(
									'type' => 'select',
									'name' => 'bg_att',
									'label' => __('Background Attachment', 'zatolab'),
									'items' => array(
										array(
											'value' => 'fixed',
											'label' => __('Fixed', 'zatolab'),
										),
										array(
											'value' => 'scroll',
											'label' => __('Scroll', 'zatolab'),
										),
									),
									
								),
							),
						),
					),
				),
			),
		),
		
		
		
		/* oooooooooooooooooooooooooooooooooooooooo
		SOCIAL ICON
		ooooooooooooooooooooooooooooooooooooooooo*/
		array(
			'title' => __('Social Media', 'zatolab'),
			'name' => 'social',
			'icon' => 'font-awesome:fa-facebook',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Social Icon Radial Angle', 'zatolab'),
					'fields' => array(
						array(
							'type' => 'notebox',
							'name' => 'nb_1',
							'description' => '<img src="'.$imgdir.'/anglecircle.jpg"/>',
							'status' => 'normal',
						),
						array(
							'type' => 'slider',
							'name' => 'circle_angle',
							'label' => __('CIRCLE ANGLE', 'zatolab'),
							'description' => __('0-360', 'zatolab'),
							'max' => '360',
						),
					),
				),
				array(
					'type' => 'section',
					'title' => __('Social Media Links', 'zatolab'),
					'name' => 'social',
					'description' => __('Social Media Links That will appear in top right of the container', 'zatolab'),
					'fields' => array(
						
						array(
							'type' => 'textbox',
							'name' => 'facebook_link',
							'label' => __('Facebook URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
						),
						array(
							'type' => 'textbox',
							'name' => 'twitter_link',
							'label' => __('Twitter URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						array(
							'type' => 'textbox',
							'name' => 'googleplus_link',
							'label' => __('Google+ URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						array(
							'type' => 'textbox',
							'name' => 'youtube_link',
							'label' => __('Youtube URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						array(
							'type' => 'textbox',
							'name' => 'pinterest_link',
							'label' => __('Pinterest URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						array(
							'type' => 'textbox',
							'name' => 'dribble_link',
							'label' => __('Dribbble URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						array(
							'type' => 'textbox',
							'name' => 'instagram',
							'label' => __('Instagram', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						array(
							'type' => 'textbox',
							'name' => 'flickr',
							'label' => __('Flickr URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						
						array(
							'type' => 'textbox',
							'name' => 'github_link',
							'label' => __('github URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						array(
							'type' => 'textbox',
							'name' => 'linkedin_link',
							'label' => __('linkedin URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						
						array(
							'type' => 'textbox',
							'name' => 'tumblr_link',
							'label' => __('tumblr URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						array(
							'type' => 'textbox',
							'name' => 'vimeo_link',
							'label' => __('vimeo URL', 'zatolab'),
							'description' => __('Put the link here', 'zatolab'),
							
						),
						
					),
				),
			),
		),
		
		array(
			'title' => __('Typography', 'zatolab'),
			'name' => 'typography',
			'icon' => 'font-awesome:fa-font',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Use Custom Font', 'zatolab'),
					'name' => 'custom_font',
					'fields' => array(
						array(
							'type' => 'toggle',
							'name' => 'usecustomfont',
							'label' => __('Use Custom Font', 'zatolab'),
							'description' => __('Use custom font from google webfonts or not?', 'zatolab'),
						),
					),
				),
				array(
					'type' => 'notebox',
					'name' => 'nb_1',
					'label' => __('<strong>Line-height Help!</strong>', 'zatolab'),
					'description' => __('Are you confuse how to set the ratio of the line-height and font-size? Just use this tool to make your life easier: <a href="http://www.pearsonified.com/typography/">Golden Ratio Typography Calculator</a>. Just remember that you need to fill the content width with <strong>640</strong>', 'zatolab'),
					'status' => 'normal',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
				),
				array(
					'type' => 'section',
					'title' => __('Body Font', 'zatolab'),
					'name' => 'body_font',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						
						array(
							'type' => 'select',
							'name' => 'body_font_face',
							'label' => __('Font Face', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							
						),
						array(
							'type' => 'radiobutton',
							'name' => 'body_font_weight',
							'label' => __('Font Weight', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'body_font_face',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'body_font_style',
							'label' => __('Font Style', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'body_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),
						),
						
						array(
							'type'    => 'slider',
							'name'    => 'body_font_size',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '16',
						),
						array(
							'type'    => 'slider',
							'name'    => 'body_font_line_height',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '',
							'step'    => '0.1',
						),
					),
				),//END BODY FONT
				array(
					'type' => 'section',
					'title' => __('Heading Font', 'zatolab'),
					'description' => 'This font will affect to H1 to H6 font family',
					'name' => 'h1_font',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						
						array(
							'type' => 'select',
							'name' => 'h1_font_face',
							'label' => __('Heading Font Face', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							
						),

						array(
							'type' => 'radiobutton',
							'name' => 'h1_font_weight',
							'label' => __('Font Weight', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'h1_font_face',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'h1_font_style',
							'label' => __('Font Style', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'h1_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),
						),

					),
				),//Heading Font
				
				array(
					'type' => 'section',
					'title' => __('Post Title Size', 'zatolab'),
					'name' => 'post_title',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						
						array(
							'type'    => 'slider',
							'name'    => 'post_tit_size',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '38',
						),
						array(
							'type'    => 'slider',
							'name'    => 'post_tit_line_size',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '',
							'step'    => '0.1',
						),
					),
				),
				array(
					'type' => 'section',
					'title' => __('H1 Font Size', 'zatolab'),
					'name' => 'h1_font_s',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						
						array(
							'type'    => 'slider',
							'name'    => 'h1_font_size_b',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '38',
						),
						array(
							'type'    => 'slider',
							'name'    => 'h1_font_line_height_b',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '',
							'step'    => '0.1',
						),
					),
				),// H1
				array(
					'type' => 'section',
					'title' => __('H2 Font Size', 'zatolab'),
					'name' => 'h2_font',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						
						array(
							'type'    => 'slider',
							'name'    => 'h2_font_size',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '30',
						),
						array(
							'type'    => 'slider',
							'name'    => 'h2_font_line_height',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '',
							'step'    => '0.1',
						),
					),
				),// H2
				
				array(
					'type' => 'section',
					'title' => __('H3 Fonts', 'zatolab'),
					'name' => 'h3_font',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						array(
							'type'    => 'slider',
							'name'    => 'h3_font_size',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '26',
						),
						array(
							'type'    => 'slider',
							'name'    => 'h3_font_line_height',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '',
							'step'    => '0.1',
						),
					),
				),//h3
				array(
					'type' => 'section',
					'title' => __('H4 Fonts', 'zatolab'),
					'name' => 'h4_font',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						
						array(
							'type'    => 'slider',
							'name'    => 'h4_font_size',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '20',
						),
						array(
							'type'    => 'slider',
							'name'    => 'h4_font_line_height',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '',
							'step'    => '0.1',
						),
					),
				),//h4
				array(
					'type' => 'section',
					'title' => __('H5 Fonts', 'zatolab'),
					'name' => 'h5_font',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						array(
							'type'    => 'slider',
							'name'    => 'h5_font_size',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '16',
						),
						array(
							'type'    => 'slider',
							'name'    => 'h5_font_line_height',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '18',
							'step'    => '0.1',
						),
					),
				),//h5
				array(
					'type' => 'section',
					'title' => __('H6 Fonts', 'zatolab'),
					'name' => 'h6_font',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						
						array(
							'type'    => 'slider',
							'name'    => 'h6_font_size',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '16',
						),
						array(
							'type'    => 'slider',
							'name'    => 'h6_font_line_height',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '',
							'step'    => '0.1',
						),
					),
				),//h6

				/* Footer Widget Font Heading */
				array(
					'type' => 'section',
					'title' => __('Footer Widget Title Font', 'zatolab'),
					'name' => 'fwidtit_font',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						
						array(
							'type' => 'select',
							'name' => 'fwidtit_font_face',
							'label' => __('Font Face', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							
						),
						array(
							'type' => 'radiobutton',
							'name' => 'fwidtit_font_style',
							'label' => __('Font Style', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'fwidtit_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'fwidtit_font_weight',
							'label' => __('Font Weight', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'fwidtit_font_face',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type'    => 'slider',
							'name'    => 'fwidtit_font_size',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '16',
						),
						array(
							'type'    => 'slider',
							'name'    => 'fwidtit_font_line_height',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '',
							'step'    => '0.1',
						),
					),
				),//END Footer Widget FONT

				array(
					'type' => 'section',
					'title' => __('Sidebar Widget Title Font', 'zatolab'),
					'name' => 'sidwidtit_font',
					'dependency' => array(
						'field' => 'usecustomfont',
						'function' => 'vp_dep_boolean',
					),
					'fields' => array(
						
						array(
							'type' => 'select',
							'name' => 'sidwidtit_font_face',
							'label' => __('Font Face', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'function',
										'value' => 'vp_get_gwf_family',
									),
								),
							),
							
						),
						array(
							'type' => 'radiobutton',
							'name' => 'sidwidtit_font_style',
							'label' => __('Font Style', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'sidwidtit_font_face',
										'value' => 'vp_get_gwf_style',
									),
								),
							),
							'default' => array(
								'{{first}}',
							),
						),
						array(
							'type' => 'radiobutton',
							'name' => 'sidwidtit_font_weight',
							'label' => __('Font Weight', 'zatolab'),
							'items' => array(
								'data' => array(
									array(
										'source' => 'binding',
										'field' => 'sidwidtit_font_face',
										'value' => 'vp_get_gwf_weight',
									),
								),
							),
						),
						array(
							'type'    => 'slider',
							'name'    => 'sidwidtit_font_size',
							'label'   => __('Font Size (px)', 'zatolab'),
							'min'     => '5',
							'max'     => '100',
							'default' => '16',
						),
						array(
							'type'    => 'slider',
							'name'    => 'sidwidtit_font_line_height',
							'label'   => __('Line Height (px)', 'zatolab'),
							'min'     => '0',
							'max'     => '100',
							'default' => '',
							'step'    => '0.1',
						),
					),
				),// Sidebar Font
				
			),
		),//END Typography
		
		
		/* oooooooooooooooooooooooooooooooooooooooo
		CUSTOM CODE
		ooooooooooooooooooooooooooooooooooooooooo*/
		array(
			'title' => __('Custom Codes', 'zatolab'),
			'name' => 'custom_codes',
			'icon' => 'font-awesome:fa-code',
			'controls' => array(
				array(
					'type' => 'codeeditor',
					'name' => 'custom_css',
					'label' => __('Custom CSS', 'zatolab'),
					'description' => __('Write your custom css here.', 'zatolab'),
					'theme' => 'github',
					'mode' => 'css',
				),
				array(
					'type' => 'codeeditor',
					'name' => 'customscript',
					'label' => __('Custom Javascript', 'zatolab'),
					'description' => __('Put the javascript code. DO NOT include script tag', 'zatolab'),
					'theme' => 'github',
					'mode' => 'javascript',
				),
				array(
					'type' => 'codeeditor',
					'name' => 'tracker',
					'label' => __('Tracker Script', 'zatolab'),
					'description' => __('Put the tracker code such as google analythic here', 'zatolab'),
					'theme' => 'github',
					'mode' => 'html',
				),
			),
		),
		
		
		
		/* oooooooooooooooooooooooooooooooooooooooo
		FOOTER
		ooooooooooooooooooooooooooooooooooooooooo*/
		array(
			'title' => __('Footer', 'zatolab'),
			'name' => 'footer',
			'icon' => 'font-awesome:fa-gear',
			'controls' => array(
			
				array(
					'type' => 'textbox',
					'name' => 'footer_copyright',
					'label' => __('Copyright text', 'zatolab'),
					'description' => __('Write your copyright notice here', 'zatolab'),
					'default' => __('Copyright &copy; 2014 Blog Name. All rights reserved', 'zatolab'),
				),
			),
		),

		/* oooooooooooooooooooooooooooooooooooooooo
		Translate
		ooooooooooooooooooooooooooooooooooooooooo*/
		array(
			'title' => __('Translate', 'zatolab'),
			'name' => 'translation',
			'icon' => 'font-awesome:fa-globe',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Translate Strings', 'zatolab'),
					'name' => 'translates',
					'description' => __('Translate all Default Theme Text Strings', 'zatolab'),
					'fields' => array(
						/*  TRANSLATION  */
						array(
							'type' => 'textbox',
							'name' => 'lang_menu',
							'label' => 'Menu',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_search',
							'label' => 'Search',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_closesearch',
							'label' => 'Close Search',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_sharewhatsnew',
							'label' => 'Share what\'s new...',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_title',
							'label' => 'Title:',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_content',
							'label' => 'Content:',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_createpost',
							'label' => 'Create Post',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_cancel',
							'label' => 'Cancel',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_otherpostby',
							'label' => 'Other posts by',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_feedbacks',
							'label' => 'Feedbacks',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_followme',
							'label' => 'Follow Me',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_related',
							'label' => 'Related Articles',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_readmore',
							'label' => 'Read More',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_port_prev',
							'label' => 'Previous Project',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_port_next',
							'label' => 'Next Project',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_close',
							'label' => 'Close',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_projectinfo',
							'label' => 'Project Info',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_portlink',
							'label' => 'Launch Project',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_allowedfiles',
							'label' => 'Allowed Files',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_sharenew',
							'label' => 'Share What\'s new',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_postitle',
							'label' => 'Post Title',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_gallerytype',
							'label' => 'Gallery Type',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_gallerytype',
							'label' => 'Gallery Type',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_slide',
							'label' => 'Slide',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_photogrid',
							'label' => 'Grid Gallery',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_justified',
							'label' => 'Justified Gallery',
						),

						array(
							'type' => 'textbox',
							'name' => 'lang_dropimage',
							'label' => 'Drop Image Here',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_or',
							'label' => 'or',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_uploadfiles',
							'label' => 'Upload Files',
						),

						array(
							'type' => 'textbox',
							'name' => 'lang_removeimage',
							'label' => 'Remove Featured Images',
						),

						/**/
						array(
							'type' => 'textbox',
							'name' => 'lang_home',
							'label' => 'Home',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_archivebycategory',
							'label' => 'Archive by Category "%s"',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_searchresultsfor',
							'label' => 'Search Results for "%s"',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_posttagged',
							'label' => 'Posts Tagged "%s"',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_articlespostedby',
							'label' => 'Articles Posted by %s',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_commoderate',
							'label' => 'Your comment is awaiting moderation.',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_reply',
							'label' => 'Reply to',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_on',
							'label' => 'on',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_anonymous',
							'label' => 'Anonymous',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_loading',
							'label' => 'Loading',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_pickimage',
							'label' => 'Pick Gallery Images',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_addimage',
							'label' => 'Add Images',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_pagednumb',
							'label' => 'Page %s',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_cat',
							'label' => 'Category:',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_categories',
							'label' => 'Categories',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_post_thumb',
							'label' => 'Featured Image',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_albums',
							'label' => 'Albums',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_photos',
							'label' => 'Photos',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_arch',
							'label' => 'Archive for',
						),

						array(
							'type' => 'textbox',
							'name' => 'lang_dailyarch',
							'label' => 'Daily Archives: %s',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_monthlyarch',
							'label' => 'Monthly Archives: %s',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_yearlyarch',
							'label' => 'Yearly Archives: %s',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_comments',
							'label' => 'Comments',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_views',
							'label' => 'Views',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_title2',
							'label' => 'Title',
							'description' => 'It\'s for an option in post sorter (frontend)',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_shortby',
							'label' => 'Sort by:',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_go',
							'label' => 'Go',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_date',
							'label' => 'Date',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_view',
							'label' => 'View: ',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_respond',
							'label' => 'Respond ',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_onerespond',
							'label' => 'One Response ',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_responses',
							'label' => 'Responses ',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_commentnavigation',
							'label' => 'Comment Navigation',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_oldercomments',
							'label' => 'Older Comments',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_newercomments',
							'label' => 'Newer Comments',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_commentsclosed',
							'label' => 'Comments are closed',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_logged_in_as',
							'label' => 'Logged in as',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_name',
							'label' => 'Name',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_email',
							'label' => 'Email',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_website',
							'label' => 'Website',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_submitcom',
							'label' => 'Submit Comment',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_mustbe',
							'label' => 'You must be ',
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_login',
							'label' => 'logged in'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_topostcom',
							'label' => 'to post a comment.'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_postauthor',
							'label' => 'Written by'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_in',
							'label' => 'In'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_share',
							'label' => 'Share'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_tags',
							'label' => 'Tagged with: '
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_more',
							'label' => 'Continue Reading'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_notfound_des',
							'label' => 'The page that you\'re looking for is not found. Please check if the url is the right one'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_prev_alb',
							'label' => 'Older Album'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_next_alb',
							'label' => 'Newer Album'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_uploaded',
							'label' => 'Uploaded on'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_prev_post',
							'label' => 'Older post'
						),
						array(
							'type' => 'textbox',
							'name' => 'lang_next_post',
							'label' => 'Newer post'
						),
						
						/*  END TRANSLATION  */
					),
				),
			),
		),
		
	)
);

/**
 *EOF
 */