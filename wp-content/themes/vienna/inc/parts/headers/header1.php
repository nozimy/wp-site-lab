				<?php 
					$stickymenu = zl_option('stickymenu','');
					if($stickymenu){ $fixed = 'id="sticker" '; }else{ $fixed=''; }
				?>

				<!-- NAVBAR -->
				<div class="zl_navbar_wrap headerdefault">
					<div <?php echo $fixed; ?>>
						<div class="zl_navbar">
							<div class="row">
								<!-- oooooooooooooooooooooooooooooooooo
									Menu Trigger Button
								oooooooooooooooooooooooooooooooooooo-->
								<div class="small-1 column menubutton nogap">
									<a id="zl_trigger" class="tooltip" title="<?php echo esc_attr(zl_option('lang_menu',__('Menu', 'zatolab')));?>">
										
									</a>
								</div>
								<!-- oooooooooooooooooooooooooooooooooo
									Logo 
								oooooooooooooooooooooooooooooooooooo-->
								<div class="small-10 column text-center">
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
								<!-- oooooooooooooooooooooooooooooooooo
									Search Trigger Button 
								oooooooooooooooooooooooooooooooooooo-->
								<div class="small-1 column text-right menubutton norightgap">
									<a id="searchtrigger" >
										<i class="i-src tooltip" title="<?php echo esc_attr( zl_option('lang_search',__('Search', 'zatolab')) );?>"></i>
									</a>
								</div>
							</div>
							
							<!-- oooooooooooooooooooooooooooooooooo
									Search Bar
								oooooooooooooooooooooooooooooooooooo-->
							<div class="searchbar">
								<div class="row">
									<form action="<?php echo home_url(); ?>" method="get">
										<input type="text" name="s" id="s" autocomplete="off"/>
									</form>
									<a id="closesearch"><span class="dashicons dashicons-no-alt"></span></a>
								</div>
							</div>
						</div>
						<div class="clear"></div>
						
						<!-- oooooooooooooooooooooooooooooooooo
							MAIN MENU
						oooooooooooooooooooooooooooooooooooo-->
						<div class="zl_navigation">
							<div class="row">
								<ul class="zl_mainmenu">
									<?php wp_nav_menu( array( 'container'=> false, 'items_wrap' => '%3$s', 'theme_location' => 'primary', 'fallback_cb'=> 'zl_fallbackmenu') ); ?>
								</ul>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				
				
				