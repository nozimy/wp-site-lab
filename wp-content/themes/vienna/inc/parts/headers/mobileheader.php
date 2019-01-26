<!-- Mobile Navigation Bar -->
<div class="zl_m_navbar" id="zl_m_navbar">
	<!-- Menu Trigger -->
	<div class="zl_m_menu_btn">
		<a href="#" class="zl_m_menu_trig">&nbsp;</a>
	</div>
	
	<!-- Mobile Logo -->
	<div class="zl_m_logo">
		<?php 
			$logo = zl_option('logo','');
			if ($logo) { ?>
			 <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zl_logo" src="<?php echo $logo; ?>" alt="<?php bloginfo('title');?>"/></a>
		<?php } else { ?>
			<h1 class="m_zl_logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('title');?></a>
			</h1>
		<?php } ?>
	</div>
</div>
