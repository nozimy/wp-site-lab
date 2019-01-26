<?php
	/**
	 * Template name: Demo
	 **/
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php
		/**
		 * Display page preloader
		 * this function located at /wproto/helper/front.php
		 **/
		wplab_unicum_front::preloader();
	?>

	<!--
		Main wrapper
	-->
	<div id="wrap">

		<!--
			For demo purposes only
		-->
		<div id="demo-sections">
		
			<!--
				Agency demo
			-->
			<div class="demo-creative">
			
				<div class="container">
					<div class="row">
						<div class="col col-md-5 col-lg-4">
						
							<div class="text">
								<a href="<?php echo get_permalink( 6 ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/logo@2x.png" alt="Unicum - Premium HTML template" /></a>
							
								<h3><a href="<?php echo get_permalink( 6 ); ?>">Creative Agency</a></h3>
							
								<a href="<?php echo get_permalink( 6 ); ?>" class="button green">Live Preview</a>
							</div>
						
						</div>
						<div class="col col-md-7 col-lg-8 hidden-sm">
						
							<div class="images">
								<img class="phone" src="<?php echo get_template_directory_uri(); ?>/images/01_agency_iphone.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/01_agency_iphone@2x.png" width="289" alt="" />
								<img class="browser" src="<?php echo get_template_directory_uri(); ?>/images/01_agency_browser.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/01_agency_browser@2x.png" width="639" alt="" />
							</div>
						
						</div>
					</div>
				</div>
			
			</div>
			
			<!--
				App landing page demo
			-->
			<div class="demo-app">
			
				<div class="container">
					<div class="row">
						<div class="col col-md-5 col-lg-4">
						
							<div class="text">
								<a href="<?php echo get_permalink( 8 ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-orange.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/logo-orange@2x.png" alt="Unicum - Premium HTML template" /></a>
							
								<h3><a href="<?php echo get_permalink( 8 ); ?>">App Showcase</a></h3>
							
								<a href="<?php echo get_permalink( 8 ); ?>" class="button orange">Live Preview</a>
							</div>
						
						</div>
						<div class="col col-md-7 col-lg-8 hidden-sm">
						
							<div class="images">
								<img class="phone" src="<?php echo get_template_directory_uri(); ?>/images/02_app_iphone.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/02_app_iphone@2x.png" width="289" alt="" />
								<img class="browser" src="<?php echo get_template_directory_uri(); ?>/images/02_app_browser.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/02_app_browser@2x.png" width="639" alt="" />
							</div>
							
						</div>
					</div>
				</div>
			
			</div>
			
			<!--
				Personal / CV demo
			-->
			<div class="demo-personal">
			
				<div class="container">
					<div class="row">
						<div class="col col-md-5 col-lg-4">
						
							<div class="text">
								<a href="<?php echo get_permalink( 10 ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-yellow.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/logo-yellow@2x.png" alt="Unicum - Premium HTML template" /></a>
							
								<h3><a href="<?php echo get_permalink( 10 ); ?>">Personal Page</a></h3>
							
								<a href="<?php echo get_permalink( 10 ); ?>" class="button yellow">Live Preview</a>
							</div>
						
						</div>
						<div class="col col-md-7 col-lg-8 hidden-sm">
						
							<div class="images">
								<img class="phone" src="<?php echo get_template_directory_uri(); ?>/images/03_personal_iphone.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/03_personal_iphone@2x.png" width="289" alt="" />
								<img class="browser" src="<?php echo get_template_directory_uri(); ?>/images/03_personal_browser.png" data-at2x="<?php echo get_template_directory_uri(); ?>/images/03_personal_browser@2x.png" width="639" alt="" />
							</div>
						
						</div>
					</div>
				</div>
			
			</div>
		
		</div>

	
	</div>

	<?php
		/**
		 * Information for developers, DB queries count, page loading speed
		 * this function located at /wproto/helper/front.php
		 **/
		wplab_unicum_front::dev_info();
	?>
	
	<?php wp_footer(); ?>
</body>
</html>