<?php

/**
 * TGM Init Class
 */
include_once ('class-tgm-plugin-activation.php');

function starter_plugin_register_required_plugins() {

	$plugins = array(
		array(
			'name' 		=> 'Redux Framework',
			'slug' 		=> 'redux-framework',
			'required' 	=> true,
		),
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> true,
		),
		array(
			'name'     				=> 'Revolution Slider',
			'slug'     				=> 'revslider',
			'source'   				=> get_template_directory_uri() . '/inc/plugins/revslider.zip',
			'required' 				=> false,
			'version' 				=> '4.6.4',
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		array(
			'name'      => 'DF Shortcodes',
			'slug'      => 'df-shortcodes-master',
			'source'    => PARENT_URL . '/inc/plugins/df-shortcodes.zip',
			'required'  => true,
			'version'   => '1.2.3'
		),
		array(
      'name'      => 'Envato WordPress Toolkit',
      'slug'      => 'envato-wordpress-toolkit-master',
      'required'  => false,
      'source'         => 'https://github.com/envato/envato-wordpress-toolkit/archive/master.zip', 
      // 'required'           => true, // If false, the plugin is only 'recommended' instead of required
      'version'            => '1.7.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
      // 'force_activation'       => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
      // 'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
      'external_url'       => true, // If set, overrides default API URL and points to an external URL
    ),
	);

	$config = array(
		'id'           => 'ecobox__tgmpa',      // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => PARENT_URL . '/inc/plugins/',  // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'starter_plugin_register_required_plugins' );