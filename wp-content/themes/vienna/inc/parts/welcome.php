<?php 
	$welcome_headline = zl_option('welcome_headline');
	$welcome_msg = zl_option('welcome_msg');
 ?>
<div class="zl_welcome text-center desktoponly">
	<h1><?php echo $welcome_headline; ?></h1>
	<?php if($welcome_msg){ ?>
		<h3><?php echo $welcome_msg; ?></h3>
	<?php } ?>
</div>