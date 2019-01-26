
<!-- Mobile Sidebar and Menu -->
<div class="zl_m_sidebar" id="zl_m_sidebar">
	<!-- Wrapper for close button and Social icons -->
	<div class="zl_cl_n_scl">
		<!-- Social -->
		<div class="zl_m_scl_wrp">
			<ul>
				<?php 
				$facebook = zl_option('facebook_link');
				$twitter = zl_option('twitter_link');
				$googleplus = zl_option('googleplus_link');
				$youtube = zl_option('youtube_link');
				$pinterest = zl_option('pinterest_link');
				$dribble = zl_option('dribble_link');
				$github = zl_option('github_link');
				$linkedin = zl_option('linkedin_link');
				$rss = zl_option('rss_link');
				$tumblr = zl_option('tumblr_link');
				$vimeo_link = zl_option('vimeo_link');
				$instagram = zl_option('instagram');
				$flickr = zl_option('flickr');
			
				if($facebook){ echo '<li><a href="'.$facebook.'" class="i-facebook"><span class="dashicons dashicons-facebook-alt"></span></a></li>';}
				if($twitter){ echo '<li><a href="'.$twitter.'" class="i-twitter"><span class="dashicons dashicons-twitter"></span></a></li>';}
				if($googleplus){ echo '<li><a href="'.$googleplus.'" class="i-google-plus"><span class="dashicons dashicons-googleplus"></span></a></li>';}
				if($instagram){ echo '<li><a href="'.$instagram.'" class="i-instagram"><span class="dashicons dashicons-instagram"></span></a></li>';}
				if($youtube){ echo '<li><a href="'.$youtube.'" class="i-youtube"><span class="dashicons dashicons-video-alt3"></span></a></li>';}
				if($pinterest){ echo '<li><a href="'.$pinterest.'" class="i-pinterest"><span class="dashicons dashicons-pinterest"></span></a></li>';}
				if($dribble){ echo '<li><a href="'.$dribble.'" class="i-dribbble"><span class="dashicons dashicons-dribbble"></span></a></li>';}
				if($github){ echo '<li><a href="'.$github.'" class="i-github"><span class="dashicons dashicons-github"></span></a></li>';}
				if($linkedin){ echo '<li><a href="'.$linkedin.'" class="i-linkedin"><span class="dashicons dashicons-linkedin"></span></a></li>';}
				if($tumblr){ echo '<li><a href="'.$tumblr.'" class="i-tumblr"><span class="dashicons dashicons-tumblr"></span></a></li>';}
				if($vimeo_link){ echo '<li><a href="'.$vimeo_link.'" class="i-vimeo"><span class="dashicons dashicons-vimeo-square"></span></a></li>';}
				if($flickr){ echo '<li><a href="'.$flickr.'" class="i-flickr"><span class="dashicons dashicons-flickr"></span></a></li>';}
				?>
			</ul>
		</div> <!-- End .zl_m_scl_wrp -->
		
		<!-- Close -->
		<div class="zl_m_cls_wrp"></div> <!-- End .zl_m_cls_wrp -->
	</div> <!-- End .cl_n_scl -->
	<div class="clear"></div>
	
	<!-- Logo and Avatar Picture -->
	<div class="zl_m_identity">
		<!-- Avatar -->
		<div class="zl_m_ava">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php
			$profilephoto = zl_option('profilephoto');
			if ($profilephoto == "") { ?>
				<img src="<?php echo get_template_directory_uri();?>/lib/img/avatarr.jpg" alt="profile" class="circle" width="160" />
			<?php }  else { ?>
				<img src="<?php echo $profilephoto?>" alt="profile" class="circle"/>
			<?php } ?>
			</a>
		</div> <!-- End .zl_m_ava -->
		
		<!-- Logo -->
		<div class="zl_mlogo">
			<?php 
				$logo = zl_option('logo','');
				if ($logo) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('title');?>"/></a>
			<?php } else { ?>
				<h1 class="zl_logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('title');?></a>
				</h1>
			<?php } ?>
		</div>
	</div> <!-- End .zl_m_logo -->
	<div class="clear"></div>
	
	<!-- Mobile Search Form -->
	<div class="zl_m_src">
		<div class="zl_m_src_inner">
			<form action="<?php echo home_url(); ?>" method="get">
				<input type="text" name="s" />
			</form>
			<div class="i-src"></div>
		</div> <!-- End .zl_m_src_inner -->
	</div> <!-- End .zl_m_src -->
	<div class="clear"></div>
	
	<!-- Menu Wrapper -->
	<h3 class="zl_m_widgetit"><span><?php echo zl_option('lang_menu', __('Menu', 'zatolab')); ?></span></h3>
	<div class="zl_m_menu_wrap">
		<ul class="zl_m_menu">
			<?php wp_nav_menu( array( 'container'=> false, 'items_wrap' => '%3$s', 'theme_location' => 'primary', 'fallback_cb'=> 'zl_fallbackmenu') ); ?>
		</ul><!-- End .zl_m_menu -->
	</div> <!-- End .zl_m_menu_wrap -->
	<div class="clear"></div>
	
	<?php 
	/*
	<div class="zl_m_widget">
		<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-1') ) : else : ?><?php endif; ?>
	</div>
	*/
	 ?>

</div> <!-- End .zl_m_sidebar -->
<div class="zl_overlay_sidebar"></div>