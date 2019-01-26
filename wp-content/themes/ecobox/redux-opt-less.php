<?php

if (class_exists('WPLessPlugin')){
	$less = WPLessPlugin::getInstance();

	$less->setVariables(array(
		'brand-primary'                 => '#77bb97',
		'brand-secondary'               => '#f7764d',
		'brand-tertiary'                => '#bf5a68',
		'brand-quaternary'              => '#ecede6',
		'brand-quinary'                 => '#fdfdfa',
		'brand-bg'                      => '#f0f1e6',

		'body-bg'                       => '#fbfcf0',
		'header-bg-image'               => 'none',
		'header-bg-image-size'          => 'inherit',
		'header-bg-color'               => '#926341',
		'header-bg-position'            => 'left top',
		'header-bg-attachment'          => 'fixed',
		'header-bg-image-retina'        => 'none',

		'navbar-brand-width'            => '140px',
		'navbar-brand-height'           => '80px',

		'navbar-bg'                     => '#fdffe8',
		'nav-dropdown-bg'               => '#180902',
		'nav-dropdown-link-color'       => '#a2948e',
		'nav-dropdown-link-hover-color' => '#fdffe8',
		'navbar-link-bg'                => '#fdffe8',
		'navbar-link-hover-bg'          => '#f1f3dc',
		'navbar-link-active-bg'         => '#fdffe8',
		
		'text-color'                    => '#3f5348',
		'font-size-base'                => '13px',
		'line-height-computed'          => '21px',
		'font-size-h1'                  => '30px',
		'font-size-h2'                  => '24px',
		'font-size-h3'                  => '18px',
		'font-size-h4'                  => '16px',
		'font-size-h5'                  => '14px',
		'font-size-h6'                  => '12px',

		'page-header-title-color'       => '#3a1504',
		'page-header-link-color'        => '#b9957b',
		'page-header-link-color-hover'  => '#fdffe8',

		'footer-bg'                     => '#243029',
		'footer-text-color'             => '#96a39c',
		'footer-link-color'             => '#5d7568',
		'footer-link-color-hover'       => '@brand-primary',
		'footer-btn-bg'                 => '#3f5247',
		'footer-btn-bg-hover'           => '@brand-primary',
		'footer-btn-color'              => '#fdffe8',
		'footer-btn-color-hover'        => '#fdffe8',
		'footer-hr-color'               => '#3f5348',
		'copyright-bg'                  => '#1c2721',
		'copyright-color'               => '#39443e',
	));

	// get options and set custom variables
	global $ecobox_data;

	// Logo
	if ($ecobox_data['logo-dimensions']['width']) {
		$less->addVariable('navbar-brand-width',$ecobox_data['logo-dimensions']['width']);
	}
	if ($ecobox_data['logo-dimensions']['height']) {
		$less->addVariable('navbar-brand-height',$ecobox_data['logo-dimensions']['height']);
	}

	// Typography
	if ($ecobox_data['typography-body']['color']) {
		$less->addVariable('text-color',$ecobox_data['typography-body']['color']);
	}
	if ($ecobox_data['typography-body']['font-size']) {
		$less->addVariable('font-size-base',$ecobox_data['typography-body']['font-size']);
	}
	if ($ecobox_data['typography-body']['line-height']) {
		$less->addVariable('line-height-computed',$ecobox_data['typography-body']['line-height']);
	}
	if ($ecobox_data['typography-h1']['font-size']) {
		$less->addVariable('font-size-h1',$ecobox_data['typography-h1']['font-size']);
	}
	if ($ecobox_data['typography-h2']['font-size']) {
		$less->addVariable('font-size-h2',$ecobox_data['typography-h2']['font-size']);
	}
	if ($ecobox_data['typography-h3']['font-size']) {
		$less->addVariable('font-size-h3',$ecobox_data['typography-h3']['font-size']);
	}
	if ($ecobox_data['typography-h4']['font-size']) {
		$less->addVariable('font-size-h4',$ecobox_data['typography-h4']['font-size']);
	}
	if ($ecobox_data['typography-h5']['font-size']) {
		$less->addVariable('font-size-h5',$ecobox_data['typography-h5']['font-size']);
	}
	if ($ecobox_data['typography-h6']['font-size']) {
		$less->addVariable('font-size-h6',$ecobox_data['typography-h6']['font-size']);
	}
	if ($ecobox_data['typography-page-heading']['color']) {
		$less->addVariable('page-header-title-color',$ecobox_data['typography-page-heading']['color']);
	}


	// Colors
	if ($ecobox_data['brand-primary']) {
		$less->addVariable('brand-primary',$ecobox_data['brand-primary']);
	}
	if ($ecobox_data['brand-secondary']) {
		$less->addVariable('brand-secondary',$ecobox_data['brand-secondary']);
	}
	if ($ecobox_data['brand-tertiary']) {
		$less->addVariable('brand-tertiary',$ecobox_data['brand-tertiary']);
	}
	if ($ecobox_data['brand-quaternary']) {
		$less->addVariable('brand-quaternary',$ecobox_data['brand-quaternary']);
	}
	if ($ecobox_data['brand-quinary']) {
		$less->addVariable('brand-quinary',$ecobox_data['brand-quinary']);
	}
	if ($ecobox_data['brand-bg']) {
		$less->addVariable('brand-bg',$ecobox_data['brand-bg']);
	}

	// Body
	if ($ecobox_data['body-bg']['background-color']) {
		$less->addVariable('body-bg',$ecobox_data['body-bg']['background-color']);
	}

	// Header
	if ($ecobox_data['header-bg']['background-image']) {
		$less->addVariable('header-bg-image',$ecobox_data['header-bg']['background-image']);
	}
	if ($ecobox_data['header-bg']['background-size']) {
		$less->addVariable('header-bg-image-size',$ecobox_data['header-bg']['background-size']);
	}
	if ($ecobox_data['header-bg']['background-color']) {
		$less->addVariable('header-bg-color',$ecobox_data['header-bg']['background-color']);
	}
	if ($ecobox_data['header-bg']['background-position']) {
		$less->addVariable('header-bg-position',$ecobox_data['header-bg']['background-position']);
	}
	if ($ecobox_data['header-bg']['background-attachment']) {
		$less->addVariable('header-bg-attachment',$ecobox_data['header-bg']['background-attachment']);
	}
	if ($ecobox_data['header-bg-retina-img']['url']) {
		$less->addVariable('header-bg-image-retina',$ecobox_data['header-bg-retina-img']['url']);
	}

	// Breadcrumbs
	if ($ecobox_data['page-header-link-color']['regular']) {
		$less->addVariable('page-header-link-color',$ecobox_data['page-header-link-color']['regular']);
	}
	if ($ecobox_data['page-header-link-color']['hover']) {
		$less->addVariable('page-header-link-color-hover',$ecobox_data['page-header-link-color']['hover']);
	}

	// Navigation
	if ($ecobox_data['navbar-bg']) {
		$less->addVariable('navbar-bg',$ecobox_data['navbar-bg']);
	}
	if ($ecobox_data['nav-dropdown-bg']) {
		$less->addVariable('nav-dropdown-bg',$ecobox_data['nav-dropdown-bg']);
	}
	if ($ecobox_data['nav-dropdown-link-color']['regular']) {
		$less->addVariable('nav-dropdown-link-color',$ecobox_data['nav-dropdown-link-color']['regular']);
	}
	if ($ecobox_data['nav-dropdown-link-color']['hover']) {
		$less->addVariable('nav-dropdown-link-hover-color',$ecobox_data['nav-dropdown-link-color']['hover']);
	}
	if ($ecobox_data['navbar-link-bg']['regular']) {
		$less->addVariable('navbar-link-bg',$ecobox_data['navbar-link-bg']['regular']);
	}
	if ($ecobox_data['navbar-link-bg']['hover']) {
		$less->addVariable('navbar-link-hover-bg',$ecobox_data['navbar-link-bg']['hover']);
	}
	if ($ecobox_data['navbar-link-bg']['active']) {
		$less->addVariable('navbar-link-active-bg',$ecobox_data['navbar-link-bg']['active']);
	}


	// Footer
	if ($ecobox_data['footer-bg']) {
		$less->addVariable('footer-bg',$ecobox_data['footer-bg']);
	}
	if ($ecobox_data['footer-text-color']) {
		$less->addVariable('footer-text-color',$ecobox_data['footer-text-color']);
	}
	if ($ecobox_data['footer-link-color']['regular']) {
		$less->addVariable('footer-link-color',$ecobox_data['footer-link-color']['regular']);
	}
	if ($ecobox_data['footer-link-color']['hover']) {
		$less->addVariable('footer-link-color-hover',$ecobox_data['footer-link-color']['hover']);
	}
	if ($ecobox_data['footer-btn-bg']['regular']) {
		$less->addVariable('footer-btn-bg',$ecobox_data['footer-btn-bg']['regular']);
	}
	if ($ecobox_data['footer-btn-bg']['hover']) {
		$less->addVariable('footer-btn-bg-hover',$ecobox_data['footer-btn-bg']['hover']);
	}
	if ($ecobox_data['footer-btn-color']['regular']) {
		$less->addVariable('footer-btn-color',$ecobox_data['footer-btn-color']['regular']);
	}
	if ($ecobox_data['footer-btn-color']['hover']) {
		$less->addVariable('footer-btn-color-hover',$ecobox_data['footer-btn-color']['hover']);
	}
	if ($ecobox_data['footer-hr-color']) {
		$less->addVariable('footer-hr-color',$ecobox_data['footer-hr-color']);
	}
	if ($ecobox_data['copyright-bg']) {
		$less->addVariable('copyright-bg',$ecobox_data['copyright-bg']);
	}
	if ($ecobox_data['copyright-color']) {
		$less->addVariable('copyright-color',$ecobox_data['copyright-color']);
	}		
}
?>