<article class="post">
	<div class="zl_loop">
		<div class="zl_post_detail">
			
			<div class="row">
				<!-- Detail -->
				<div class="large-12 column">
					<header>
						<h1 class="entry-title">
							<?php 
								if(zl_option('notfoundtitle')){
									echo zl_option('notfoundtitle');
								} else {
									echo zl_option('lang_notfound', __('Not Found', 'zatolab'));
								}
							?>
						</h1>
						<hr/>
					</header>
					
					<?php 
					$customnotfound = zl_option('message404');
					if($customnotfound){
						echo $customnotfound;
					} else {
						echo zl_option('lang_notfound_des', __('The page that you\'re looking for is not found. Please check if the url is the right one', 'zatolab'));
					}
					 ?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<!-- end .zl_loop -->
</article>