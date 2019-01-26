<?php 
	$stickymenu = zl_option('stickymenu','');
	if($stickymenu){ $fixed = 'id="sticker" '; } else { $fixed=''; }
?>


<div class="zl_header_3">
	<!-- oooooooooooooooooooooooooooooooooo
		MAIN MENU
	oooooooooooooooooooooooooooooooooooo-->
	
	<div <?php echo $fixed; ?>>
		<div class="row zlmainheader">
			<!-- Search Form -->
			<div class="medium-11 column">
				<div class="zl_searchform_2">
					<form action="<?php echo home_url(); ?>" method="get">
						<input type="text" name="s" id="s" />
					</form>
				</div>
			</div>
			<!-- Logo -->
			<div class="medium-3 column text-left hws noleftpad">
				<?php 
					$logo = zl_option('logo','');
					if ($logo) { ?>
					 <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zl_logo" src="<?php echo $logo; ?>" alt="<?php bloginfo('title');?>"/></a>
				<?php } else { ?>
					<h1 class="zl_logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('title');?></a>
					</h1>
				<?php } ?>
				<meta itemprop="name" content="<?php bloginfo('title');?>">
			</div>
			
			<div class="medium-8 column text-right norightpad">
				<div class="zl_navigation hws">
					<div class="row">
						<ul class="zl_mainmenu">
							<?php wp_nav_menu( array( 'container'=> false, 'items_wrap' => '%3$s', 'theme_location' => 'primary', 'fallback_cb'=> 'zl_fallbackmenu') ); ?>
						</ul>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="medium-1 column text-right norightpad">
				<a id="searchtrigger2" class="tooltip hws" title="<?php echo zl_option('lang_search',__('Search', 'zatolab'));?>">
					<i class="i-src"></i>
				</a>
				<a href="#" id="hidesearch" class="tooltip" title="<?php echo zl_option('lang_closesearch',__('Close Search', 'zatolab'));?>">
					<span class="dashicons dashicons-no-alt"></span>
				</a>
			</div>
		</div>
	</div>
</div>