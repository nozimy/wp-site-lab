<!doctype html>
<html class="no-js"  <?php language_attributes(); ?>>
	<head>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta charset="UTF-8" />
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<!-- For third-generation iPad with high-resolution Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo zl_option('favicon_144'); ?>">
		<!-- For iPhone with high-resolution Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo zl_option('favicon_114'); ?>">
		<!-- For first- and second-generation iPad: -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo zl_option('favicon_72'); ?>">
		<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo zl_option('favicon_57'); ?>">
		<link rel="shortcut icon" href="<?php echo zl_option('favicon'); ?>" type="image/x-icon" />
		
		<?php wp_head();?>
	</head>
	<body <?php body_class(); ?>>
	
	<?php
    if (zl_option('usevsidebar') == "1"){ ?>
    <div id="secondary_vertical" class="main-header-scrollbar">

        <?php
        $show_sidebar = zl_option('show_widget');
        if($show_sidebar==1){ ?>
            <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('vl-sidebar') ) : else : ?><?php endif; ?>
        <?php } ?>

    </div>
    <?php } ?>
	<?php 
		global $is_iphone, $is_safari;
		if ( $is_safari && stripos($_SERVER['HTTP_USER_AGENT'], 'mobile') !== false )$is_iphone = true;
  		
		if ( wp_is_mobile() ) {
			$mobileclass = 'is_mobile';
		} else  {
			$mobileclass = 'notmobile';
		}
		//echo $mobileclass;
	 ?>
	<div class="mp-pusher <?php echo $mobileclass; ?>" id="page">
		<div class="mobileonly">
			<?php get_template_part('inc/parts/headers/mobileheader'); ?>
		</div>
		<!-- oooooooooooooooooooooooooooooooooo
			HEADER
		oooooooooooooooooooooooooooooooooooo-->
		<?php 
		$featuredmodel = zl_option('featuredmodel', 'welcomessage');
		$show_featured = zl_option('show_featured');
		if( 'featuredpost' == $featuredmodel){
			$featuretype = 'zlheadgrid';
		} else if('welcomessage' == $featuredmodel){
			$featuretype = 'zlheadwelcome';
		}
		?>
		<header id="zl_main_header">
			<div class="zl_header <?php echo $featuretype; ?>">
				<div class="desktoponly">
					<?php 
					$header = zl_option('header', 'header1');
					if(!empty($header)){
						get_template_part('inc/parts/headers/'.$header); 
					} else {
						get_template_part('inc/parts/headers/header1'); 
					} ?>
				</div>
				
				<!-- oooooooooooooooooooooooooooooooooo
					Image Grid
				oooooooooooooooooooooooooooooooooooo-->
				<?php 
				if( 1 == $show_featured){
				 ?>
				<div class="zl_imagegrid <?php if(!is_home()){ echo 'is_single'; } ?>">
					<?php 
					if( 'featuredpost' == $featuredmodel){
						get_template_part('inc/parts/featured'); 
					} else if('welcomessage' == $featuredmodel){
						if(is_home()){
							get_template_part('inc/parts/welcome'); 
						}
					}
					?>
				</div>
				<?php } else { ?>
				<div class="zl_imagegrid <?php if(!is_home()){ echo 'is_single'; } else {echo 'this_home';}?>">

				</div>
				<?php } ?>
				<?php get_template_part('inc/parts/profilephoto');?>
			</div>
		</header>
		
