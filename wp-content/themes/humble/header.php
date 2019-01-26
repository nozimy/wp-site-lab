<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<div class="wrapper">

		<header class="humble-header">

			<div class="logobar">

				<?php if(!get_theme_mod('header_sidemenu')) : ?>
				<a class="sidemenu-btn" href="#" title=""><i class="icon_menu"></i></a>
				<?php endif; ?>

				<div class="logo">
					<a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php bloginfo('name') ?>">
                        <?php if(!get_theme_mod('header_logo')) : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>">
                        <?php else: ?>
                        <img src="<?php echo esc_url(get_theme_mod('header_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                        <?php endif; ?>
                    </a>
				</div>

				<div class="additional-acts">

					<?php if(!get_theme_mod('header_search')) : ?>
					<div class="top-search">
						<a class="open-search" href="#" title=""><i class="icon_search"></i></a>
						<?php get_template_part('parts/header/header-searchform'); ?>
					</div>
					<?php endif; ?>

					<?php if(!get_theme_mod('header_social')) : ?>
					<div class="socials">
						<?php if(get_theme_mod('social_facebook')) : ?><a href="<?php echo esc_url(get_theme_mod('social_facebook')); ?>" target="_blank"><i class="fa fa-facebook"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_twitter')) : ?><a href="<?php echo esc_url(get_theme_mod('social_twitter')); ?>" target="_blank"><i class="fa fa-twitter"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_instagram')) : ?><a href="<?php echo esc_url(get_theme_mod('social_instagram')); ?>" target="_blank"><i class="fa fa-instagram"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_pinterest')) : ?><a href="<?php echo esc_url(get_theme_mod('social_pinterest')); ?>" target="_blank"><i class="fa fa-pinterest"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_google')) : ?><a href="<?php echo esc_url(get_theme_mod('social_google')); ?>" target="_blank"><i class="fa fa-google-plus"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_tumblr')) : ?><a href="<?php echo esc_url(get_theme_mod('social_tumblr')); ?>" target="_blank"><i class="fa fa-tumblr"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_youtube')) : ?><a href="<?php echo esc_url(get_theme_mod('social_youtube')); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_vimeo')) : ?><a href="<?php echo esc_url(get_theme_mod('social_vimeo')); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_dribbble')) : ?><a href="<?php echo esc_url(get_theme_mod('social_dribbble')); ?>" target="_blank"><i class="fa fa-dribbble"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_linkedin')) : ?><a href="<?php echo esc_url(get_theme_mod('social_linkedin')); ?>" target="_blank"><i class="fa fa-linkedin"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_bloglovin')) : ?><a href="<?php echo esc_url(get_theme_mod('social_bloglovin')); ?>" target="_blank"><i class="fa fa-heart"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_vk')) : ?><a href="<?php echo esc_url(get_theme_mod('social_vk')); ?>" target="_blank"><i class="fa fa-vk"></i></a><?php endif; ?>
						<?php if(get_theme_mod('social_etsy')) : ?><a href="<?php echo esc_url(get_theme_mod('social_etsy')); ?>" target="_blank"><i class="fa fa-etsy"></i></a><?php endif; ?>
					</div>
					<?php endif; ?>

				</div>

			</div><!-- Logobar -->

			<div class="nav-height"></div>

			<nav class="humble-nav <?php if(!get_theme_mod('sticky_nav')) : ?>stick<?php endif; ?>">

				<?php humble_menu('main-menu'); ?>

			</nav>

		</header><!-- Header -->

		<div class="sidemenu">

			<a class="close-menu" href="#" title=""><i class="icon_close"></i></a>

			<?php humble_menu('side-menu'); ?>

		</div><!-- Sidemenu -->
