<?php
/**
 * Humble Customizer
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */

function Humble_Customize_Register( $wp_customize ) {

	/* ------------------------------------------------ */
	/* ADD CUSTOM SECTIONS
	/* ------------------------------------------------ */

	// General Section
	$wp_customize->add_section( 'general', array(
		'priority'    => 1001,
		'title'       => esc_html__( 'General Options', 'humble' ),
	) );

	// Header Section
	$wp_customize->add_section( 'header', array(
		'priority'    => 1002,
		'title'       => esc_html__( 'Header Options', 'humble' ),
	) );

	// Slider Options
	$wp_customize->add_section( 'featured', array(
		'priority'    => 1003,
		'title'       => esc_html__( 'Featured Slider Options', 'humble' ),
	) );

	// Post Options
	$wp_customize->add_section( 'post', array(
		'priority'    => 1004,
		'title'       => esc_html__( 'Post Options', 'humble' ),
	) );

	// Social Options
	$wp_customize->add_section( 'social', array(
		'priority'    => 1005,
		'title'       => esc_html__( 'Social Media', 'humble' ),
	) );

	// Page Options
	$wp_customize->add_section( 'page', array(
		'priority'    => 1006,
		'title'       => esc_html__( 'Page Options', 'humble' ),
	) );

	// Footer Options
	$wp_customize->add_section( 'footer', array(
		'priority'    => 1007,
		'title'       => esc_html__( 'Footer Options', 'humble' ),
	) );

	// Color Options
	$wp_customize->add_section( 'colors', array(
		'priority'    => 1008,
		'title'       => esc_html__( 'Color Options', 'humble' ),
	) );

	// Custom Code
	$wp_customize->add_section( 'code', array(
		'priority'    => 1009,
		'title'       => esc_html__( 'Custom Codes', 'humble' ),
	) );


	/* ------------------------------------------------ */
	/* GENERAL SECTION SETTINGS
	/* ------------------------------------------------ */

	// Home Post Layout
	$wp_customize->add_setting( 'home_layout', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => 'std',
	) );

	// Archive Post Layout
	$wp_customize->add_setting( 'archive_layout', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => 'std',
	) );

	// Home Sidebar Layout
	$wp_customize->add_setting( 'humble_sidebar', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => 'r_sidebar',
	) );

	/* ------------------------------------------------ */
	/* HEADER SECTION SETTINGS
	/* ------------------------------------------------ */

	// Header Logo
	$wp_customize->add_setting( 'header_logo', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Header Logo Padding Top
	$wp_customize->add_setting( 'header_padding_top', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '60',
	) );


	// Header Logo Padding Bottom
	$wp_customize->add_setting( 'header_padding_bottom', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '60',
	) );


	// Header Social Icons
	$wp_customize->add_setting( 'header_social', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Header Search
	$wp_customize->add_setting( 'header_search', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Header Sidemenu
	$wp_customize->add_setting( 'header_sidemenu', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Sticky Nav
	$wp_customize->add_setting( 'sticky_nav', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );


	/* ------------------------------------------------ */
	/* FEATURED SECTION SETTINGS
	/* ------------------------------------------------ */

	// Carousel Show/Hide
	$wp_customize->add_setting( 'featured_area', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Featured Area Layout
	$wp_customize->add_setting( 'featured_layout', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => 'carousel'
	) );

	// Featured Post QTY
	$wp_customize->add_setting( 'featured_qty', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '5'
	) );



	/* ------------------------------------------------ */
	/* POST SECTION SETTINGS
	/* ------------------------------------------------ */

	// Featured Text
	$wp_customize->add_setting( 'sticky_text', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => 'Sticky'
	) );

	// Post Excerpt
	$wp_customize->add_setting( 'post_excerpt', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Post Date
	$wp_customize->add_setting( 'post_date', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Post Category
	$wp_customize->add_setting( 'post_cat', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Post Comments
	$wp_customize->add_setting( 'post_comments', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Post Author
	$wp_customize->add_setting( 'post_author', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Post Tags
	$wp_customize->add_setting( 'post_tags', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Post Share
	$wp_customize->add_setting( 'post_share', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Author Box
	$wp_customize->add_setting( 'author_box', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	// Related Posts
	$wp_customize->add_setting( 'related_posts', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );


	/* ------------------------------------------------ */
	/* SOCIAL SECTION SETTINGS
	/* ------------------------------------------------ */

	// Facebook
	$wp_customize->add_setting( 'social_facebook', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Twitter
	$wp_customize->add_setting( 'social_twitter', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Instagram
	$wp_customize->add_setting( 'social_instagram', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Pinterest
	$wp_customize->add_setting( 'social_pinterest', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Google Plus
	$wp_customize->add_setting( 'social_google', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Tumblr
	$wp_customize->add_setting( 'social_tumblr', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Youtube
	$wp_customize->add_setting( 'social_youtube', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Vimeo
	$wp_customize->add_setting( 'social_vimeo', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Dribbble
	$wp_customize->add_setting( 'social_dribbble', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Linkedin
	$wp_customize->add_setting( 'social_linkedin', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Bloglovin
	$wp_customize->add_setting( 'social_bloglovin', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// VK
	$wp_customize->add_setting( 'social_vk', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Etsy
	$wp_customize->add_setting( 'social_etsy', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );


	/* ------------------------------------------------ */
	/* FOOTER SECTION SETTINGS
	/* ------------------------------------------------ */

	// Footer Logo
	$wp_customize->add_setting( 'footer_logo', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '',
	) );

	// Footer Copyright Left
	$wp_customize->add_setting( 'footer_copyright', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => 'Copyright &copy; 2016 Humble. All rights reserved'
	) );

	// Footer Back To Top Button
	$wp_customize->add_setting( 'footer_backtotop', array(
		'sanitize_callback' => 'humble_sanitize_checkbox',
		'type'              => 'theme_mod',
		'default'           => false
	) );

	/* ------------------------------------------------ */
	/* COLORS SECTION SETTINGS
	/* ------------------------------------------------ */

	// Accent Color
	$wp_customize->add_setting( 'color_accent', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '#af7b64'
	) );

	// Footer Background Color
	$wp_customize->add_setting( 'color_footer_bg', array(
		'sanitize_callback' => 'humble_sanitize_callback',
		'type'              => 'theme_mod',
		'default'           => '#151515'
	) );

	/* ------------------------------------------------ */
	/* HOME SECTION CONTROLS
	/* ------------------------------------------------ */

	// Homepage Post Layout
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'home_layout', array(
		'settings'    => 'home_layout',
		'priority'    => 10,
		'section'     => 'general',
		'label'       => esc_html__( 'Homepage Post Layout', 'humble' ),
		'type'        => 'radio',
		'choices'     => array(
			'grid'        => esc_html__( 'Grid', 'humble' ),
			'list'        => esc_html__( 'List', 'humble' ),
			'std'         => esc_html__( 'Standard', 'humble' ),
			'1std&grid'   => esc_html__( 'Standard First & Grid', 'humble' ),
			'1std&list'   => esc_html__( 'Standard First & List', 'humble' ),
		),
	) ) );

	// Homepage Post Layout
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'archive_layout', array(
		'settings'    => 'archive_layout',
		'priority'    => 20,
		'section'     => 'general',
		'label'       => esc_html__( 'Archive Post Layout', 'humble' ),
		'type'        => 'radio',
		'choices'     => array(
			'grid'        => esc_html__( 'Grid', 'humble' ),
			'list'        => esc_html__( 'List', 'humble' ),
			'std'         => esc_html__( 'Standard', 'humble' ),
			'1std&grid'   => esc_html__( 'Standard First & Grid', 'humble' ),
			'1std&list'   => esc_html__( 'Standard First & List', 'humble' ),
		),
	) ) );

	// Homepage Sidebar Layout
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'humble_sidebar', array(
		'settings'    => 'humble_sidebar',
		'priority'    => 30,
		'section'     => 'general',
		'label'       => esc_html__( 'Homepage Sidebar Layout', 'humble' ),
		'type'        => 'radio',
		'choices'     => array(
			'r_sidebar'    => esc_html__( 'Sidebar Right', 'humble' ),
			'l_sidebar'    => esc_html__( 'Sidebar Left', 'humble' ),
			'no_sidebar'   => esc_html__( 'Full Width', 'humble' ),
		),
	) ) );


	/* ------------------------------------------------ */
	/* HEADER SECTION CONTROLS
	/* ------------------------------------------------ */

	//Header Logo
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo', array(
		'settings'    => 'header_logo',
		'priority'    => 10,
		'section'     => 'header',
		'label'       => esc_html__( 'Custom Logo', 'humble' ),
	) ) );

	// Header Logo Padding Top
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_padding_top', array(
		'settings'    => 'header_padding_top',
		'priority'    => 20,
		'section'     => 'header',
		'label'       => esc_html__( 'Logo Padding Top (px)', 'humble' ),
		'type'        => 'number',
	) ) );

	// Header Logo Padding Bottom
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_padding_bottom', array(
		'settings'    => 'header_padding_bottom',
		'priority'    => 30,
		'section'     => 'header',
		'label'       => esc_html__( 'Logo Padding Bottom (px)', 'humble' ),
		'type'        => 'number',
	) ) );

	// Header Social Icons
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_social', array(
		'settings'    => 'header_social',
		'priority'    => 40,
		'section'     => 'header',
		'label'       => esc_html__( 'Hide Social Icons', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Header Search
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_search', array(
		'settings'    => 'header_search',
		'priority'    => 50,
		'section'     => 'header',
		'label'       => esc_html__( 'Hide Search Icon', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Header Sidemenu
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_sidemenu', array(
		'settings'    => 'header_sidemenu',
		'priority'    => 60,
		'section'     => 'header',
		'label'       => esc_html__( 'Hide Sidemenu', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Sticky Nav
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sticky_nav', array(
		'settings'    => 'sticky_nav',
		'priority'    => 70,
		'section'     => 'header',
		'label'       => esc_html__( 'Turn OFF Sticky Nav', 'humble' ),
		'type'        => 'checkbox',
	) ) );


	/* ------------------------------------------------ */
	/* FEATURED SECTION CONTROLS
	/* ------------------------------------------------ */

	// Featured Show/Hide
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'featured_area', array(
		'settings'    => 'featured_area',
		'priority'    => 10,
		'section'     => 'featured',
		'label'       => esc_html__( 'Show Carousel', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Featured Area Layout
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'featured_layout', array(
		'settings'    => 'featured_layout',
		'priority'    => 20,
		'section'     => 'featured',
		'label'       => esc_html__( 'Featured Area Layout', 'humble' ),
		'type'        => 'radio',
		'choices'     => array(
			'carousel'    => esc_html__( 'Carousel', 'humble' ),
			'slider'      => esc_html__( 'Boxed Slider', 'humble' ),
			'fullwidth'   => esc_html__( 'Fullwidth Slider', 'humble' ),
		),
	) ) );

	// Featured Post Qty
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'featured_qty', array(
		'settings'    => 'featured_qty',
		'priority'    => 30,
		'section'     => 'featured',
		'label'       => esc_html__( 'Slide Qty', 'humble' ),
		'description' => esc_html__( 'Number of posts to show on featured area.', 'humble' ),
		'type'        => 'number',
	) ) );


	/* ------------------------------------------------ */
	/* POST SECTION CONTROLS
	/* ------------------------------------------------ */

	// Custom Sticky Text
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'sticky_text', array(
		'settings'    => 'sticky_text',
		'priority'    => 10,
		'section'     => 'post',
		'label'       => esc_html__( 'Custom Sticky Text', 'humble' ),
		'type'        => 'text',
	) ) );

	// Post Excerpt
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_excerpt', array(
		'settings'    => 'post_excerpt',
		'priority'    => 20,
		'section'     => 'post',
		'label'       => esc_html__( 'Use Post Excerpt', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Post Date
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_date', array(
		'settings'    => 'post_date',
		'priority'    => 30,
		'section'     => 'post',
		'label'       => esc_html__( 'Hide Post Date', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Post Category
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_cat', array(
		'settings'    => 'post_cat',
		'priority'    => 40,
		'section'     => 'post',
		'label'       => esc_html__( 'Hide Post Category', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Post Comments
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_comments', array(
		'settings'    => 'post_comments',
		'priority'    => 50,
		'section'     => 'post',
		'label'       => esc_html__( 'Hide Post Comments', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Post Author
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_author', array(
		'settings'    => 'post_author',
		'priority'    => 60,
		'section'     => 'post',
		'label'       => esc_html__( 'Hide Post Author', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Post Tags
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_tags', array(
		'settings'    => 'post_tags',
		'priority'    => 70,
		'section'     => 'post',
		'label'       => esc_html__( 'Hide Post Tags', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Post Share Icons
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'post_share', array(
		'settings'    => 'post_share',
		'priority'    => 80,
		'section'     => 'post',
		'label'       => esc_html__( 'Hide Post Share Icons', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Author Box
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'author_box', array(
		'settings'    => 'author_box',
		'priority'    => 90,
		'section'     => 'post',
		'label'       => esc_html__( 'Hide Author Box', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	// Post Share Icons
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'related_posts', array(
		'settings'    => 'related_posts',
		'priority'    => 100,
		'section'     => 'post',
		'label'       => esc_html__( 'Hide Related Posts', 'humble' ),
		'type'        => 'checkbox',
	) ) );


	/* ------------------------------------------------ */
	/* SOCIAL SECTION CONTROLS
	/* ------------------------------------------------ */

	// Facebook
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_facebook', array(
		'settings'    => 'social_facebook',
		'priority'    => 10,
		'section'     => 'social',
		'label'       => esc_html__( 'Facebook', 'humble' ),
		'type'        => 'text',
	) ) );

	// Twitter
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_twitter', array(
		'settings'    => 'social_twitter',
		'priority'    => 20,
		'section'     => 'social',
		'label'       => esc_html__( 'Twitter', 'humble' ),
		'type'        => 'text',
	) ) );

	// Instagram
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_instagram', array(
		'settings'    => 'social_instagram',
		'priority'    => 30,
		'section'     => 'social',
		'label'       => esc_html__( 'Instagram', 'humble' ),
		'type'        => 'text',
	) ) );

	// Pinterest
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_pinterest', array(
		'settings'    => 'social_pinterest',
		'priority'    => 40,
		'section'     => 'social',
		'label'       => esc_html__( 'Pinterest', 'humble' ),
		'type'        => 'text',
	) ) );

	// Google Plus
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_google', array(
		'settings'    => 'social_google',
		'priority'    => 50,
		'section'     => 'social',
		'label'       => esc_html__( 'Google Plus', 'humble' ),
		'type'        => 'text',
	) ) );

	// Tumblr
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_tumblr', array(
		'settings'    => 'social_tumblr',
		'priority'    => 60,
		'section'     => 'social',
		'label'       => esc_html__( 'Tumblr', 'humble' ),
		'type'        => 'text',
	) ) );

	// Youtube
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_youtube', array(
		'settings'    => 'social_youtube',
		'priority'    => 70,
		'section'     => 'social',
		'label'       => esc_html__( 'Youtube', 'humble' ),
		'type'        => 'text',
	) ) );

	// Vimeo
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_vimeo', array(
		'settings'    => 'social_vimeo',
		'priority'    => 80,
		'section'     => 'social',
		'label'       => esc_html__( 'Vimeo', 'humble' ),
		'type'        => 'text',
	) ) );

	// Dribbble
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_dribbble', array(
		'settings'    => 'social_dribbble',
		'priority'    => 90,
		'section'     => 'social',
		'label'       => esc_html__( 'Dribbble', 'humble' ),
		'type'        => 'text',
	) ) );

	// LinkedIn
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_linkedin', array(
		'settings'    => 'social_linkedin',
		'priority'    => 100,
		'section'     => 'social',
		'label'       => esc_html__( 'LinkedIn', 'humble' ),
		'type'        => 'text',
	) ) );

	// Bloglovin
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_bloglovin', array(
		'settings'    => 'social_bloglovin',
		'priority'    => 110,
		'section'     => 'social',
		'label'       => esc_html__( 'Bloglovin', 'humble' ),
		'type'        => 'text',
	) ) );

	// VK
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_vk', array(
		'settings'    => 'social_vk',
		'priority'    => 120,
		'section'     => 'social',
		'label'       => esc_html__( 'Vkontakte', 'humble' ),
		'type'        => 'text',
	) ) );

	// Etsy
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_etsy', array(
		'settings'    => 'social_etsy',
		'priority'    => 130,
		'section'     => 'social',
		'label'       => esc_html__( 'Etsy', 'humble' ),
		'type'        => 'text',
	) ) );


	/* ------------------------------------------------ */
	/* FOOTER SECTION CONTROLS
	/* ------------------------------------------------ */

	//Footer Logo
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
		'settings'    => 'footer_logo',
		'priority'    => 10,
		'section'     => 'footer',
		'label'       => esc_html__( 'Footer Logo', 'humble' ),
	) ) );

	//Footer Copyright Left
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_copyright', array(
		'settings'    => 'footer_copyright',
		'priority'    => 20,
		'section'     => 'footer',
		'label'       => esc_html__( 'Copyright Text', 'humble' ),
		'type'        => 'textarea',
	) ) );

	// Footer Back To Top Button
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'footer_backtotop', array(
		'settings'    => 'footer_backtotop',
		'priority'    => 30,
		'section'     => 'footer',
		'label'       => esc_html__( 'Show Back To Top Button', 'humble' ),
		'type'        => 'checkbox',
	) ) );

	/* ------------------------------------------------ */
	/* COLORS SECTION CONTROLS
	/* ------------------------------------------------ */

	// Accent Color
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_accent', array(
		'settings'    => 'color_accent',
		'priority'    => 10,
		'section'     => 'colors',
		'label'       => esc_html__( 'Accent Color', 'humble' ),
	) ) );

	// Background Color
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color_footer_bg', array(
		'settings'    => 'color_footer_bg',
		'priority'    => 50,
		'section'     => 'colors',
		'label'       => esc_html__( 'Footer Background Color', 'humble' ),
	) ) );

 	/* ------------------------------------------------ */
 	/* CUSTOM CODE SECTION CONTROLS
 	/* ------------------------------------------------ */

 	// Custom Css
 	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'code_custom_css', array(
 		'settings'    => 'code_custom_css',
 		'priority'    => 10,
 		'section'     => 'code',
 		'description' => esc_html__( 'Custom CSS', 'humble' ),
 		'type'        => 'textarea',
 	) ) );

    // Remove Sections
	$wp_customize->remove_section( 'nav');
	$wp_customize->remove_section( 'static_front_page');
}

/* Sanitize nonnegative integer */
function humble_sanitize_number( $value ) {
	$value = absint( $value );
	if ( ! $value )
		$value = '';
	return $value;
}

/* Sanitize the checkbox */
function humble_sanitize_checkbox( $value ) {
	if ( 0 == $value )
		return false;
	else
		return true;
}

function humble_sanitize_callback( $value ) {
	return $value;
}

add_action( 'customize_register', 'Humble_Customize_Register' );

?>
