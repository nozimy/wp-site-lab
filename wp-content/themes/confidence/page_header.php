
<!-- Navigation Bar Starts page_header.php -->
<div class="navbar navbar-default navbar-fixed-top navbar-colored" role="navigation">
	<div class="container">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
		<?php if (esc_url( get_theme_mod( 'logo' ) )) : ?>
		<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_mod( 'logo' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="img-responsive"></a> 
		<?php  else : ?>
		<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="http://placehold.it/176x55&text=logo" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="img-responsive"></a> 
		<?php endif; ?>
		</div>
		<div class="navbar-collapse collapse">
			<?php
				wp_nav_menu( array(
					'menu'              => 'main-menu',
					'theme_location'    => 'primary',
					'depth'             => 4,
					'container'         => '',
					'container_class'   => 'collapse navbar-collapse topnav',
					'menu_class'        => 'nav navbar-nav navbar-right',
					'menu_id'		=> '',
					'fallback_cb'       => 'Ninetheme_Confidence_Navwalker::fallback',
					'walker'            => new Ninetheme_Confidence_Navwalker())
				);
			?>
		</div> <!--/.nav-collapse --> 
	</div>
</div> <!--// Navbar Ends--> 
	