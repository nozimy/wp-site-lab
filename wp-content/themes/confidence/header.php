	<!DOCTYPE html>
	<html <?php language_attributes(); ?> > 
	
	<head>

	<!-- Meta UTF8 charset -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	

	<!-- viewport settings -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>
		
	</head>

	<!-- BODY START=========== -->
	<body <?php body_class(); ?>>
	
	<?php if ( ot_get_option('preloader') == 'on') : ?>
	<div id="preview-area">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="site-container">