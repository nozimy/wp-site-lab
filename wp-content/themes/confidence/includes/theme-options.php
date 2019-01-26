<?php
/**
 * Initialize the custom Theme Options.
 */
add_action( 'init', 'ninetheme_confidence_custom_theme_options' );
/**
 * Build the custom settings & update OptionTree.
 *
 * @return    void
 * @since     2.3.0
 */
function ninetheme_confidence_custom_theme_options() {
  /* OptionTree is not loaded yet, or this is not an admin request */
  if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
    return false;
  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( ot_settings_id(), array() );

  $custom_settings = array(
    'contextual_help' => array(
      'sidebar'       => ''
    ),
    'sections'        => array(
		array(
		'id'          => 'preloader',
		'title'       => 'Preloader options'
		),
		array(
		'id'          => 'logo_options',
		'title'       => 'Logo options'
		),
		array(
		'id'          => 'css',
		'title'       => 'Custom CSS & JS'
		),
		array(
		'id'          => 'sidebars',
		'title'       => 'Theme sidebars'
		),
		array(
        'id'          => 'sidebars_settings',
        'title'       => 'Theme Sidebar Colors'
		),
		array(
		'id'          => 'colors',
		'title'       => 'Header colors'
		),
		array(
		'id'          => 'menu_colors',
		'title'       => 'Menu colors'
		),
		array(
		'id'          => 'generalcolors',
		'title'       => 'General colors'
		),

		array(
		'id'          => 'header',
		'title'       => 'Header/Menu options'
		),
		array(
		'id'          => 'footercolor',
		'title'       => 'Footer bottom colors'
		),
		array(
		'id'          => 'footertopcolor',
		'title'       => 'Footer top colors'
		),
		array(
		'id'          => 'copyrightcolor',
		'title'       => 'Copyright colors'
		),
		array(
		'id'          => 'breadcrumb',
		'title'       => 'Breadcrumb'
		),
		array(
		'id'          => 'copyright',
		'title'       => 'Footer'
		),
		array(
		'id'          => 'f_social',
		'title'       => 'Footer social'
		),
		array(
		'id'          => 'teampage',
		'title'       => 'Team Page'
		),

    ),
    'settings'        => array(


	/** TEAM SETTINGS.   **/

	array(
        'id'          => 'teamcolumn',
        'label'       => 'Team member column ',
        'desc'        => 'You can use this option for member column number',
        'type'        => 'numeric-slider',
		'min_max_step'=> '3,12',
        'section'     => 'teampage',
		'operator'    => 'and'
	),
	/** SIDEBAR SETTINGS.   **/

	array(
		'id'          => 'confidence_sidebarwidgetbgcolor',
		'label'       => esc_html__( 'Sidebar widget background color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebarwidgetgeneralcolor',
		'label'       => esc_html__( 'Sidebar widget general color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebarwidgettitlecolor',
		'label'       => esc_html__( 'Sidebar widget title color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebarwidgettitlebottomlinecolor',
		'label'       => esc_html__( 'Sidebar widget title bottom line color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebarlinkcolor',
		'label'       => esc_html__( 'Sidebar link title color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebarlinkhovercolor',
		'label'       => esc_html__( 'Sidebar link title hover color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebartagcloudlinkcolor',
		'label'       => esc_html__( 'Sidebar tag cloud link color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebartagcloudlinkhovercolor',
		'label'       => esc_html__( 'Sidebar tag cloud link hover color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebartagcloudlinkbgcolor',
		'label'       => esc_html__( 'Sidebar tag cloud link background color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebartagcloudlinkbghovercolor',
		'label'       => esc_html__( 'Sidebar tag cloud link background hover color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebarsearchsubmitbgcolor',
		'label'       => esc_html__( 'Sidebar search submit background color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebarsearchsubmitbghovercolor',
		'label'       => esc_html__( 'Sidebar search submit background hover color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebarsearchsubmittextcolor',
		'label'       => esc_html__( 'Sidebar search submit text color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),
	array(
		'id'          => 'confidence_sidebarsearchsubmittexthovercolor',
		'label'       => esc_html__( 'Sidebar search submit text hover color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'sidebars_settings'
	),

   array(
      'id'          => 'confidence_breadcrumb_v',
      'label'       => esc_html__( 'Theme preloader', 'confidence' ),
      'desc'        => sprintf( esc_html__( 'Please choose preloader %s or %s.', 'confidence' ), '<code>on</code>', '<code>off</code>' ),
      'std'         => 'off',
      'type'        => 'on-off',
      'section'     => 'breadcrumb'
  ),

	array(
        'id'          => 'headerpaddingtop',
        'label'       => 'Theme breadcrumb padding top',
        'desc'        => 'You can use this option for header breadcrumb padding top',
        'type'        => 'numeric-slider',
		'min_max_step'=> '110,400',
        'section'     => 'breadcrumb',
		'operator'    => 'and'
	),
	array(
        'id'          => 'headerpaddingbottom',
        'label'       => 'Theme breadcrumb padding bottom',
        'desc'        => 'You can use this option for header breadcrumb padding bottom',
        'type'        => 'numeric-slider',
		'min_max_step'=> '20,200',
        'section'     => 'breadcrumb',
		'operator'    => 'and'
	),
	array(
		'id'          => 'headertextcolor',
		'label'       => esc_html__( 'Theme breadcrumb text color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'breadcrumb'
	),
	array(
		'id'          => 'headerbgcolor',
		'label'       => esc_html__( 'Theme breadcrumb background color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'breadcrumb'
	),
	array(
        'id'          => 'headerbgimage',
        'label'       => 'Header breadcrumb background image',
        'desc'        => 'You can use header breadcrumb background image for parallax or leave blank',
        'type'        => 'upload',
        'section'     => 'breadcrumb'
	),
	array(
        'id'          => 'headerbgopa',
        'label'       => esc_html__( 'Theme header background opacity color ', 'confidence' ),
        'desc'        => sprintf( esc_html__( 'Please select color', 'confidence' ), '<code>ot-colorpicker-opacity</code>', '<code>$args</code>' ),
        'type'        => 'colorpicker-opacity',
        'section'     => 'colors'
	),

	array(
		'id'          => 'menu_bg',
		'label'       => esc_html__( 'Theme header right menu background color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
	),

	array(
		'id'          => 'menu_dot',
		'label'       => esc_html__( 'Theme header right menu item left dot color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
	),

	array(
		'id'          => 'menuactive',
		'label'       => esc_html__( 'Theme header active menu item color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
	),

	array(
		'id'          => 'menucolor',
		'label'       => esc_html__( 'Theme header menu item color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'std'        => '#fff',
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
	),

	array(
		'id'          => 'menuhovercolor',
		'label'       => esc_html__( 'Theme header menu item hover color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
	),

	array(
		'id'          => 'menudropdown',
		'label'       => esc_html__( 'Theme header menu dropdown background color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
	),
	array(
		'id'          => 'menudropdownitem',
		'label'       => esc_html__( 'Theme header menu dropdown item color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
	),

		array(
		'id'          => 'menudropdownitemhover',
		'label'       => esc_html__( 'Theme header menu dropdown item hover background color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
		),


		array(
		'id'          => 'menu_last_bg',
		'label'       => esc_html__( 'Theme header menu last item background color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
		),

		array(
		'id'          => 'menu_last_c',
		'label'       => esc_html__( 'Theme header menu last item text color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'menu_colors'
		),

		 array(
        'id'          => 'footerbgimage',
        'label'       => esc_html__( 'Footer background pattern', 'confidence' ),
		'desc'        => esc_html__( 'You can use mini pattern image', 'confidence' ),
        'type'        => 'background',
        'section'     => 'footercolor'
		),

		array(
		'id'          => 'footertopbg',
		'label'       => esc_html__( 'Theme footer background color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footercolor'
		),
		array(
		'id'          => 'footertoptext',
		'label'       => esc_html__( 'Theme footer inner text color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footercolor'
		),
		array(
		'id'          => 'footertophcolor',
		'label'       => esc_html__( 'Theme footer widget heading color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footercolor'
		),
		array(
		'id'          => 'footertoplinecolor',
		'label'       => esc_html__( 'Theme footer widget heading line color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footercolor'
		),

		array(
		'id'          => 'footertoplinkcolor',
		'label'       => esc_html__( 'Theme footer widget link color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footercolor'
		),

		array(
		'id'          => 'footertopfirstbg',
		'label'       => esc_html__( 'Theme footer background color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footertopcolor'
		),

		array(
		'id'          => 'footertopfirsthcolor',
		'label'       => esc_html__( 'Theme footer column heading color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footertopcolor'
		),
		array(
		'id'          => 'footertopfirstlinkcolor',
		'label'       => esc_html__( 'Theme footer column text color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footertopcolor'
		),
		array(
		'id'          => 'footertopiconcolor',
		'label'       => esc_html__( 'Theme footer  top social icon color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footertopcolor'
		),

		array(
		'id'          => 'footertopinputbg',
		'label'       => esc_html__( 'Theme footer newsletter mail input background color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footertopcolor'
		),

		array(
		'id'          => 'footertopinputbordercolor',
		'label'       => esc_html__( 'Theme footer newsletter mail input border color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footertopcolor'
		),

		array(
		'id'          => 'footertopsubmitbg',
		'label'       => esc_html__( 'Theme footer newsletter submit button background color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footertopcolor'
		),

		array(
		'id'          => 'footertopsubmitcolor',
		'label'       => esc_html__( 'Theme footer newsletter submit button  color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'footertopcolor'
		),

		array(
		'id'          => 'copyrightbg',
		'label'       => esc_html__( 'Theme footer copyright background color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'copyrightcolor'
		),

		array(
		'id'          => 'copyrightlink',
		'label'       => esc_html__( 'Theme footer copyright text color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'copyrightcolor'
		),

		array(
		'id'          => 'copyright_icon_bg',
		'label'       => esc_html__( 'Theme footer copyright icon background color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'copyrightcolor'
		),

		array(
		'id'          => 'copyright_icon_text_color',
		'label'       => esc_html__( 'Theme footer copyright icon text color ', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'copyrightcolor'
		),



	  array(
		'id'          => 'themecolor1',
		'label'       => esc_html__( 'Theme first color 1', 'confidence' ),
		'desc'        => esc_html__( 'Please select color 1', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'generalcolors'
		),

		array(
		'id'          => 'themecolor2',
		'label'       => esc_html__( 'Theme second color 2', 'confidence' ),
		'desc'        => esc_html__( 'Please select color 2', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'generalcolors'
		),

		array(
		'id'          => 'themecolor3',
		'label'       => esc_html__( 'Theme second color 3', 'confidence' ),
		'desc'        => esc_html__( 'Please select color 3', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'generalcolors'
		),

		 array(
        'id'          => 'prayerslayout',
        'label'       => esc_html__( 'Prayers Page Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose Prayers Page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),
		 array(
        'id'          => 'sermonlayout',
        'label'       => esc_html__( 'Sermon Page Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose Sermon Page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),
	  array(
        'id'          => 'ministrylayout',
        'label'       => esc_html__( 'Ministry Page Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose Ministry Page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),
	   array(
        'id'          => 'programlayout',
        'label'       => esc_html__( 'Program Page Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose Program Page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),
		 array(
        'id'          => 'causessingle',
        'label'       => esc_html__( 'Causes Page Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose Causes  page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),

	   array(
        'id'          => 'forumlayout',
        'label'       => esc_html__( 'Buddypress Page Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose Buddypress  page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),

	   array(
        'id'          => 'teamlayout',
        'label'       => esc_html__( 'Team Page Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose team  page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),

		 array(
        'id'          => 'bloglayout',
        'label'       => esc_html__( 'Blog Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose blog page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),
	   array(
        'id'          => 'pagelayout',
        'label'       => esc_html__( 'Default Page Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose default page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),
		array(
        'id'          => 'searchlayout',
        'label'       => esc_html__( 'Search page Layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose search page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),

	  array(
        'id'          => 'postlayout',
        'label'       => esc_html__( 'Blog single page layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose post page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),

	   array(
        'id'          => 'archivelayout',
        'label'       => esc_html__( 'archive page layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose archive page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),

	   array(
        'id'          => '404layout',
        'label'       => esc_html__( '404 page layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose 404 page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),
	array(
        'id'          => 'woosingle',
        'label'       => esc_html__( 'Shop single page layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose Shop single page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),
array(
        'id'          => 'woopage',
        'label'       => esc_html__( 'Shop  page layout', 'confidence' ),
        'desc'        => esc_html__( 'Please choose shop  page layout type', 'confidence' ),
        'std'         => 'right-sidebar',
        'type'        => 'radio-image',
        'section'     => 'sidebars'
      ),

	 array(
        'id'          => 'preloader',
        'label'       => esc_html__( 'Theme preloader', 'confidence' ),
        'desc'        => sprintf( esc_html__( 'Please choose preloader %s or %s.', 'confidence' ), '<code>on</code>', '<code>off</code>' ),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'preloader'
	),

	array(
		'id'          => 'pre_bg',
		'label'       => esc_html__( 'Preloader background color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'preloader'
	),
	array(
		'id'          => 'pre_bubble_bg',
		'label'       => esc_html__( 'Preloader bubble background color', 'confidence' ),
		'desc'        => esc_html__( 'Please select color', 'confidence' ),
		'type'        => 'colorpicker',
		'section'     => 'preloader'
	),

	array(
        'id'          => 'logoimg',
        'label'       => 'Upload logo image',
        'desc'        => 'Upload logo image',
        'type'        => 'upload',
        'section'     => 'logo_options'
      ),

	array(
        'id'          => 'headerheight',
        'label'       => 'Page Header  section height',
        'desc'        => 'You can use this option for header  section height with keyboard arrows',
        'type'        => 'numeric-slider',
		'min_max_step'=> '85,600',
        'section'     => 'header',
		'operator'    => 'and'
      ),
	  array(
        'id'          => 'headermenuheight',
        'label'       => 'Page Header menu section height',
        'desc'        => 'You can use this option for header menu section height with keyboard arrows',
        'type'        => 'numeric-slider',
		'min_max_step'=> '25,200',
        'section'     => 'header',
		'operator'    => 'and'
      ),

	array(
        'id'          => 'rightmenumargin',
        'label'       => 'Header right menu margin top',
        'desc'        => 'You can use this option for header right menu margin top with keyboard arrows',
        'type'        => 'numeric-slider',
		'min_max_step'=> '17,300',
        'section'     => 'header',
		'operator'    => 'and'
    ),

	array(
        'id'          => 'header_logo_dimension',
        'label'       => esc_html__( 'Logo image width and height', 'confidence' ),
        'desc'        => esc_html__( 'The Dimension option type is used to set width and height values.', 'confidence' ),
        'type'        => 'dimension',
        'section'     => 'logo_options'
	),
	array(
        'id'          => 'header_margin_logo',
        'label'       => esc_html__( 'Logo margin values', 'confidence' ),
        'desc'        => esc_html__( 'The Spacing option type is used to set spacing values such as padding or margin in the form of top, right, bottom, and left.', 'confidence' ),
        'type'        => 'spacing',
        'section'     => 'logo_options'
	),
	array(
        'id'          => 'header_padding_logo',
        'label'       => esc_html__( 'Logo padding values', 'confidence' ),
        'desc'        => esc_html__( 'The Spacing option type is used to set spacing values such as padding or margin in the form of top, right, bottom, and left.', 'confidence' ),
        'type'        => 'spacing',
        'section'     => 'logo_options'
	),
	array(
        'id'          => 'additionalcss',
        'label'       => 'additional css',
        'desc'        => 'You can add additional css ',
        'type'        => 'css',
        'section'     => 'css'
    ),
	array(
        'id'          => 'additional_1200_css',
        'label'       => 'Max width 1200px',
        'desc'        => 'You can add responsive css for max width 1200px',
        'type'        => 'css',
        'section'     => 'css'
    ),
	array(
        'id'          => 'additional_992_css',
        'label'       => 'Max width 992px',
        'desc'        => 'You can add responsive css for max width 992px',
        'type'        => 'css',
        'section'     => 'css'
    ),
	array(
        'id'          => 'additional_767_css',
        'label'       => 'Max width 767px',
        'desc'        => 'You can add responsive css for max width 767px',
        'type'        => 'css',
        'section'     => 'css'
    ),
	array(
        'id'          => 'additional_480_css',
        'label'       => 'Max width 480px',
        'desc'        => 'You can add responsive css for max width 480px',
        'type'        => 'css',
        'section'     => 'css'
    ),
	array(
        'id'          => 'additionaljs',
        'label'       => 'additional js',
        'desc'        => 'You can add additional css ',
        'type'        => 'css',
        'section'     => 'css'
    ),

	array(
        'id'          => 'footernewsletter',
        'label'       => esc_html__( 'footer newsletter section', 'confidence' ),
        'desc'        => sprintf( esc_html__( 'Please choose footer newsletter section %s or %s.', 'confidence' ), '<code>on</code>', '<code>off</code>' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'copyright'
	),


	array(
        'id'          => 'footerwd',
        'label'       => esc_html__( 'footer widgetize section', 'confidence' ),
        'desc'        => sprintf( esc_html__( 'Please choose footer widgetize section %s or %s.', 'confidence' ), '<code>on</code>', '<code>off</code>' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'copyright'
	),

	array(
        'id'          => 'footerpowereds',
        'label'       => esc_html__( 'footer copyright section', 'confidence' ),
        'desc'        => sprintf( esc_html__( 'Please choose footer copyright section %s or %s.', 'confidence' ), '<code>on</code>', '<code>off</code>' ),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'copyright'
	),
	array(
        'id'          => 'footerphone',
        'label'       => 'Footer top adress phone number',
        'desc'        => 'Footer top adress phone number',
        'std'         => '+985 985 985 85',
        'type'        => 'text',
        'section'     => 'copyright'
    ),
	array(
        'id'          => 'footerfax',
        'label'       => 'Footer top adress fax number',
        'desc'        => 'Footer top adress fax number',
        'std'         => '+985 985 985 85',
        'type'        => 'text',
        'section'     => 'copyright'
    ),
	array(
        'id'          => 'footermail',
        'label'       => 'Footer top adress mail',
        'desc'        => 'Footer top adress mail',
        'std'         => 'support@charity.com',
        'type'        => 'text',
        'section'     => 'copyright'
      ),

	  array(
        'id'          => 'footerpowered',
        'label'       => 'Footer powered',
        'desc'        => 'Footer powered',
        'std'         => 'Launch beautiful, responsive websites faster with themes',
        'type'        => 'text',
        'section'     => 'copyright'
      ),

	   array(
        'id'          => 'social',
        'label'       => 'Footer Social Icons',
        'desc'        => 'Footer Social Icons',
        'type'        => 'list-item',
        'section'     => 'f_social',
        'settings'    => array(

          array(
            'id'          => 'social_text',
            'label'       => 'social icon name',
            'desc'        => 'Enter font awesome social icon name',
			'type'        => 'text'
          ),
          array(
            'id'          => 'social_link',
            'label'       => 'Link',
            'desc'        => 'Enter font awesome social share link',
			'type'        => 'text'
           ),
        )
      ),

    )
  );

 /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings );
  }

  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;

}
