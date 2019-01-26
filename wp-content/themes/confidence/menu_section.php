
	<!-- Navigation Bar Starts -->
	<div class="navbar navbar-default  <?php  if ( ! is_front_page() ) : ?> navbar-colored <?php endif; ?>" role="navigation">
		<div class="container">
		<div class="row">
			<div class="navbar-header-off col-lg-3 col-md-12 col-sm-12 centered-item">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<?php if (esc_url( ot_get_option( 'logoimg' ) )) : ?>
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( ot_get_option( 'logoimg' ) ) ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="img-responsive"></a> 
				<?php  else : ?>
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri() . '/images/logo.png';?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="img-responsive"></a> 
				<?php endif; ?>
			</div>
			<div class="navbar-collapse collapse col-lg-9 col-md-12 col-sm-12">
			    <?php
					wp_nav_menu( array(
						'menu'              => 'main-menu',
						'theme_location'    => 'primary',
						'depth'             => 4,
						'container'         => '',
						'container_class'   => 'collapse navbar-collapse topnav',
						'menu_class'        => 'nav navbar-nav navbar-right',
						'menu_id'		=> '',
						'echo' => true,
						'fallback_cb'       => 'Ninetheme_Confidence_Navwalker::fallback',
						'walker'            => new Ninetheme_Confidence_Navwalker())
					);
				?>
			</div>
			<!--/.nav-collapse --> 
		</div>
		</div>
	</div>
	<!--// Navbar Ends--> 
	