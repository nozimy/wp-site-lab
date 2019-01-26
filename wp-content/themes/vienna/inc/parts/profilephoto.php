<!-- Profile Photo -->
<div class="zl_profilecon" id="outer_container">
	<?php
	$profilephoto = zl_option('profilephoto');
	if ($profilephoto == "") { ?>
		<img src="<?php echo get_template_directory_uri();?>/lib/img/avatarr.jpg" alt="profile" class="circle" width="160" />
	<?php }  else { ?>
		<img src="<?php echo $profilephoto?>" alt="profile" class="circle"/>
	<?php } ?>
	
	<a class="menu_button tooltip" title="<?php echo zl_option('lang_followme', __('Follow Me', 'zatolab'));?>">
		<span class="labelfollow">
			+
		</span>
	</a>
	<ul class="menu_option" data-angle="<?php echo zl_option('circle_angle', '330'); ?>">
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
	
		if($facebook){ echo '<li><a href="'.$facebook.'" class="i-facebook"><span class="sicon-facebook-squared"></span></a></li>';}
		if($twitter){ echo '<li><a href="'.$twitter.'" class="i-twitter"><span class="dashicons dashicons-twitter"></span></a></li>';}
		if($googleplus){ echo '<li><a href="'.$googleplus.'" class="i-google-plus"><span class="dashicons dashicons-googleplus"></span></a></li>';}
		if($instagram){ echo '<li><a href="'.$instagram.'" class="i-instagram"><span class="sicon-instagram"></span></a></li>';}
		if($youtube){ echo '<li><a href="'.$youtube.'" class="i-youtube"><span class="dashicons dashicons-video-alt3"></span></a></li>';}
		if($pinterest){ echo '<li><a href="'.$pinterest.'" class="i-pinterest"><span class="sicon-pinterest"></span></a></li>';}
		if($dribble){ echo '<li><a href="'.$dribble.'" class="i-dribbble"><span class="sicon-dribbble"></span></a></li>';}
		if($github){ echo '<li><a href="'.$github.'" class="i-github"><span class="sicon-github"></span></a></li>';}
		if($linkedin){ echo '<li><a href="'.$linkedin.'" class="i-linkedin"><span class="sicon-linkedin"></span></a></li>';}
		if($tumblr){ echo '<li><a href="'.$tumblr.'" class="i-tumblr"><span class="sicon-tumblr"></span></a></li>';}
		if($vimeo_link){ echo '<li><a href="'.$vimeo_link.'" class="i-vimeo"><span class="sicon-vimeo"></span></a></li>';}
		if($flickr){ echo '<li><a href="'.$flickr.'" class="i-flickr"><span class="sicon-flickr"></span></a></li>';}
	?>
	  
	</ul>
</div>
<?php 
	/*<li><a href="#"><span class="dashicons dashicons-twitter"></span></a></li>
	  <li><a href="#"><span class="dashicons dashicons-facebook-alt"></span></a></li>
	  <li><a href="#"><span class="dashicons dashicons-googleplus"></span></a></li>
	  <li><a href="#"><span class="dashicons dashicons-wordpress"></span></a></li>
	  <li><a href="#"><span class="dashicons dashicons-rss"></span></a></li>
	  <li><a href="#"><span class="dashicons dashicons-video-alt3"></span></a></li>*/
 ?>
				
				