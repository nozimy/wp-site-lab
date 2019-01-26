<?php 
$show_authorinfo = zl_option('show_authorinfo');
if( 1 == $show_authorinfo){

?>
<!-- Author Info -->
<div class="row authorow">
	<div class="zl_profilebar extrabar zl_authorbox">
		<div class="row">
			<div class="medium-2 column">
				<div class="authorava text-center">
					<?php echo get_avatar( get_the_author_meta('email') , 100 ); ?>
				</div>
			</div>
			<div class="medium-10 column">
				<h3><?php echo get_the_author_meta('display_name'); ?></h3>
			<p><?php  echo get_the_author_meta('description'); ?></p>
			<ul class="authorlinks">
				<?php 
				$rss_url = get_the_author_meta( 'rss_url' );
				if ( $rss_url && $rss_url != '' ) {
					echo '<li class="rss"><a href="' . esc_url($rss_url) . '">RSS</li>';
				}
								
				$google_profile = get_the_author_meta( 'google_profile' );
				if ( $google_profile && $google_profile != '' ) {
					echo '<li class="google"><a href="' . esc_url($google_profile) . '" rel="author">Google+</a></li>';
				}
								
				$twitter_profile = get_the_author_meta( 'twitter_profile' );
				if ( $twitter_profile && $twitter_profile != '' ) {
					echo '<li class="twitter"><a href="' . esc_url($twitter_profile) . '">Twitter</a></li>';
				}
								
				$facebook_profile = get_the_author_meta( 'facebook_profile' );
				if ( $facebook_profile && $facebook_profile != '' ) {
					echo '<li class="facebook"><a href="' . esc_url($facebook_profile) . '">Facebook</a></li>';
				}
								
				$linkedin_profile = get_the_author_meta( 'linkedin_profile' );
				if ( $linkedin_profile && $linkedin_profile != '' ) {
					   echo '<li class="linkedin"><a href="' . esc_url($linkedin_profile) . '">LinkedIn</a></li>';
				}
			?>
			</ul>
			<div class="clear"></div>
			<div class="zl_morepost">
				<?php echo zl_option('lang_otherpostby', __('Other posts by', 'zatolab'));?> <?php the_author_posts_link(); ?>
			</div>
			<div class="clear"></div>
			</div>
		</div>
	</div>
</div>
<?php } ?>