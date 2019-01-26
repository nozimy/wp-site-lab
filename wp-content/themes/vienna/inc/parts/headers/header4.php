<?php 
	$stickymenu = zl_option('stickymenu','');
	if($stickymenu){ $fixed = 'id="sticker" '; } else { $fixed=''; }
?>

<div class="zl_header_3 zl_header_4">
	<!-- oooooooooooooooooooooooooooooooooo
		MAIN MENU
	oooooooooooooooooooooooooooooooooooo-->
	
	<div class="zlmainheader">
		
		<!-- Logo -->
		<div class="row">
			<div class="medium-12 column text-center">
				<?php 
					$logo = zl_option('logo');
					if ($logo) { ?>
					 
					 <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zl_logo" src="<?php echo $logo; ?>" alt="<?php bloginfo('title');?>"/></a>

				<?php } else { ?>
					<h1 class="zl_logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('title');?></a>
					</h1>
				<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
		<!-- Search Form -->
		<div class="medium-12 column">
			<div class="zl_searchform_2">
				<form action="<?php echo home_url(); ?>" method="get">
					<input type="text" name="s" id="s" />
				</form>
			</div>
		</div>

		<!-- Menu -->
		<div  <?php echo $fixed; ?> class="zl_navigation hws">
			<ul class="zl_mainmenu text-center">
				<?php wp_nav_menu( array( 'container'=> false, 'items_wrap' => '%3$s', 'theme_location' => 'primary', 'fallback_cb'=> 'zl_fallbackmenu') ); ?>
			</ul>
			<div class="clear"></div>
		</div>
		
		<div class="clear"></div>
	</div>
</div>