<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Ecobox
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php global $ecobox_data; ?>

<?php if($ecobox_data['favicon']): ?>
<link rel="shortcut icon" href="<?php echo $ecobox_data['favicon']['url']; ?>" type="image/x-icon" />
<?php endif; ?>

<?php if($ecobox_data['iphone_icon']): ?>
<!-- For iPhone -->
<link rel="apple-touch-icon-precomposed" href="<?php echo $ecobox_data['iphone_icon']['url']; ?>">
<?php endif; ?>

<?php if($ecobox_data['iphone_icon_retina']): ?>
<!-- For iPhone 4 Retina display -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $ecobox_data['iphone_icon_retina']['url']; ?>">
<?php endif; ?>

<?php if($ecobox_data['ipad_icon']): ?>
<!-- For iPad -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $ecobox_data['ipad_icon']['url']; ?>">
<?php endif; ?>

<?php if($ecobox_data['ipad_icon_retina']): ?>
<!-- For iPad Retina display -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $ecobox_data['ipad_icon_retina']['url']; ?>">
<?php endif; ?>

<?php wp_head(); ?>

<?php if($ecobox_data['ace-editor-css']) { ?>
<!-- Custom CSS -->
<style>
<?php echo $ecobox_data['ace-editor-css']; ?>
</style>
<?php } ?>
</head>

<body <?php body_class(); ?>>
	<div class="top-wrapper">
		
		<!-- Header
		================================================== -->
		<div class="navbar-wrapper">
			<header class="navbar navbar-default navbar-top" id="navbar">
				<div class="container">
					
					<div class="navbar-header">

						<?php if($ecobox_data['logo-standard']['url'] !== "" && $ecobox_data['logo-retina']['url'] !== "") { ?>

							<?php if($ecobox_data['logo-standard']['url'] !== "") { ?>
								<!-- Logo Standard -->
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-standard" rel="home"><img src="<?php echo $ecobox_data['logo-standard']['url']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>" /></a>
							<?php } ?>

							<?php if($ecobox_data['logo-retina']['url'] !== "") { ?>
								<!-- Logo Retina -->
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-retina" rel="home"><img src="<?php echo $ecobox_data['logo-retina']['url']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>" /></a>
							<?php } ?>

						<?php } else { ?>

							<!-- Logo Text Default -->
							<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a>
						<?php } ?>
					</div><!-- .navbar-header -->
					
					<div class="navbar-collapse-holder">

						<div class="clearfix">
							<button type="button" class="navbar-toggle">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

							<?php
							// Main navigation
							function ecobox_nav() {
								if (has_nav_menu('primary')) {
									wp_nav_menu(
									array(
										'theme_location'  => 'primary',
										'menu'            => '', 
										'container'       => 'div', 
										'container_class' => '', 
										'container_id'    => '',
										'menu_class'      => 'flexnav', 
										'menu_id'         => '',
										'echo'            => true,
										'fallback_cb'     => 'wp_page_menu',
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
										'items_wrap'      => '<ul data-breakpoint="992" id="%1$s" class="%2$s">%3$s</ul>',
										'depth'           => 0
										)
									);
								}
							}

							ecobox_nav(); ?>
							
						</div>
					</div><!-- .navbar-collapse-holder -->
				</div><!-- .container -->
			</header><!-- #navbar -->
		</div>

		<?php if(!is_search() && !is_404()) { // search and 404 pages excluded to avoid errors
			$title            = get_post_meta(get_the_ID(), 'ecobox_page_title', true);
			$slider           = get_post_meta(get_the_ID(), 'ecobox_page_slider', true);
			$revslider_select = get_post_meta(get_the_ID(), 'ecobox_page_slider_select', true);

			// Page Heading
			if($title != "Hide") {
				get_template_part('page-header');
			}

			// Slider
			if($slider == "Show" && function_exists('putRevSlider')) { ?>

			<div class="tp-banner-holder">
				<div class="tp-banner-holder-inner">
					<div class="tp-banner-container">
					<?php putRevSlider($revslider_select); ?>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php } elseif(is_search() || is_404()) {
			get_template_part('page-header');
		} ?>

	</div><!-- .top-wrapper -->

	<!-- Content
	================================================== -->
	<main class="main-content" id="content">
		<div class="container">