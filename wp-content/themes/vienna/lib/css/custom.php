<?php 
	if (function_exists('zl_option')) {
		$clrscheme = zl_option('colorscheme');
		$sidebar = zl_option('sidebar_clr');
		$customcss = zl_option('custom_css');
		$bg_colorheader = zl_option('bg_header');
		$bg_imageheader = zl_option('bg_headerimg');
		$bg_imageopacity = zl_option('bg_imageopacity');
		$navbar_color = zl_option('navbar_color');
		$navbar_text_color = zl_option('navbar_text_color');
		$footer_bg = zl_option('footer_bg');
		$footer_txtclr = zl_option('footer_txtclr');
		$footer_linkclr = zl_option('footer_linkclr');
		$copyright_bg = zl_option('copyright_bg');
		$copyright_txtclr = zl_option('copyright_txtclr');
		$copyright_linkclr = zl_option('copyright_linkclr');
		$stickymenu =  zl_option('stickymenu');
	}
	
	function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   return implode(",", $rgb); // returns the rgb values separated by commas
	   //return $rgb; // returns an array with the rgb values
	}
?>

body{
	background-color:<?php echo vp_option('zl_option.bg_clr');?>;
	background-image:url("<?php echo vp_option('zl_option.bg_img');?>");
	background-repeat:<?php echo vp_option('zl_option.bg_rpt');?>;
	background-position:<?php echo vp_option('zl_option.bg_pos');?>;
	background-attachment:<?php echo vp_option('zl_option.bg_att');?>;
}
.zl_header{
	background: <?php echo $bg_colorheader.' ';   if($bg_imageheader){ echo "url('".$bg_imageheader."')"; } ; ?> <?php echo zl_option('subhead_bg_pos'); ?>;
	<?php if($bg_imageheader){ ?>
	<?php if( 'no-repeat' == zl_option('subhead_bg_rpt') ){ ?>
	background-size:100% auto;
	<?php } ?>
	background-repeat: <?php echo zl_option('subhead_bg_rpt'); ?>;
	background-attachment: <?php echo zl_option('subhead_bg_att'); ?>;
	<?php } ?>
}
.zl_header:before{
	background: <?php echo $bg_colorheader.' ';?>;
	<?php if(empty($bg_imageopacity)){ ?>
	opacity:0;
	<?php } else { ?>
	opacity:<?php echo $bg_imageopacity; ?>;
	<?php } ?>
}

/* oooooooooooooooooooooooooo 
FOOTER Bar Custom Style 
oooooooooooooooooooooooooo */
.zl_footer{
	<?php if($footer_bg): ?>
	background: <?php echo $footer_bg; ?>;
	<?php endif; ?>
	<?php if($footer_txtclr): ?>
	color: <?php echo $footer_txtclr; ?>;
	<?php endif; ?>
}
.zl_footer .owl-item ul li{
	<?php if($footer_txtclr): ?>
	border-bottom: 1px solid rgba(<?php echo hex2rgb($footer_txtclr); ?>,.1)!important;
	<?php endif; ?>
}
<?php if($footer_linkclr): ?>
.zl_footer .owl-item ul a{
	color: <?php echo $footer_linkclr; ?>;
}
<?php endif; ?>
<?php if($footer_txtclr): ?>
.zl_foowidtit{
	color: <?php echo $footer_txtclr; ?>;
}
.ballboy-pagination a{
	color: <?php echo $footer_txtclr; ?>;
	-webkit-box-shadow: inset 0 0 0 1px <?php echo $footer_txtclr; ?>;
	box-shadow: inset 0 0 0 1px <?php echo $footer_txtclr; ?>;
}
<?php endif; ?>

.i-src:before, .i-src:after{
border-color:<?php echo $navbar_text_color; ?>;
}
.i-src:after{
	background:<?php echo $navbar_text_color; ?>;
}


/* oooooooooooooooooooooooooo 
C O P Y R I G H T Bar Custom Style 
oooooooooooooooooooooooooo */
.zl_copyright{
	<?php if($copyright_bg): ?>
	background: <?php echo $copyright_bg; ?>;
	<?php endif; ?>
	<?php if($copyright_txtclr): ?>
	color: <?php echo $copyright_txtclr; ?>;
	<?php endif; ?>
}


<?php if($copyright_linkclr): ?>
.zl_copyright ul a{
	color: <?php echo $copyright_linkclr; ?>;
}
<?php endif; ?>



<?php
list($r, $g, $b) = sscanf($clrscheme, "#%02x%02x%02x");
if($clrscheme){
?>

/* .zl_gal_overlay, .zl_widget{
	background:rgba(<?php /*echo $r.','.$g.','.$b.', .8'*/ ?>);
}*/

a{
	text-decoration:none;
}
a{
	text-decoration:none;
	color:<?php echo $clrscheme; ?>;
}

.zl_mainhead{
	border-top:5px solid <?php echo $clrscheme; ?>;
}

.zl_the_menu > li:hover > a,
.zl_profilebar .zl_breadcrumbs a:hover,
.postnav a:hover,
.post-like .liked, .post-like .alreadyliked, .post-like .prevliked, .post-like .pastliked,
.zl_post_id_meta li:hover a,
.comment-author a,
a.comment-reply-link:hover,
.relatedposts .column h4.entry-title a:hover,
.zl_port_nav li:hover,
.zl_port_nav li a:hover,
.zl_mainmenu ul li.current-menu-item > a
{
	color:<?php echo $clrscheme; ?>;
}
#source a.current, #source a:hover,
.authorlinks li a:hover,
.comment-reply-link:hover,
.comment-author a:hover,
.zl_mainmenu > li.current-menu-ancestor > a
{
	color:<?php echo $clrscheme; ?>;
	border-color:<?php echo $clrscheme; ?>;
}
.zl_posttags a:hover{
	background: <?php echo $clrscheme; ?>;
	border:1px solid <?php echo $clrscheme; ?>;
	color: #fff;
}

/* Transparent Overlay */
.zl_profilecon:hover > a, 
.zl_profilecon.active > a, ins
{
	background:rgba(<?php echo $r.','.$g.','.$b.', .7' ?>);
}
.postgallery .owl-item:before{
	background:rgba(<?php echo hex2rgb($clrscheme); ?>, .5);
}
.zl_related_thumb:hover:before, .zl_square-grid > a:after, .swipeboxEx > a:before{
	background:rgba(<?php echo $r.','.$g.','.$b.', .8' ?>);
}
.zl_porto_itemwrap:hover .zl_porto_thumb{
	background:rgba(<?php echo $r.','.$g.','.$b.', .8' ?>);
}
.zl_albumthumb:before, .zl_albumthumb:after{
	background:<?php echo $clrscheme; ?>;
	background:rgba(<?php echo $r.','.$g.','.$b.', .8' ?>);
}
.postgallery .owl-dots .owl-dot.active{
	background:<?php echo $clrscheme; ?>;
	-webkit-box-shadow: inset 0 0 0 1px <?php echo $clrscheme; ?>;
	box-shadow: inset 0 0 0 1px <?php echo $clrscheme; ?>;
}


.zl_the_menu ul > li:hover > a{
	color:<?php echo $clrscheme; ?>
}
.zl_the_menu ul:before,
.zl_post_id_meta li:before,
.fwstyle,
.zl_the_menu ul li:hover:before,
#share_button li a:hover,
.menu_option li a,
.postgallery.owl-theme .owl-controls .owl-nav div:hover,
.zl_header_3 .zl_mainmenu > li > a:after,
.browse_order:hover,
.zl_m_navbar,
.zl_m_menu li a .icon, .zl_m_menu li a .dashicons, .zl_m_menu li a .entypo,
.pace
{
	background:<?php echo $clrscheme; ?>;
}
#wp-calendar caption, .bypostauthor .zl_comment_content { 
	border: 1px solid <?php echo $clrscheme; ?>;
}
.post.sticky .zl_loop{
	border:3px solid <?php echo $clrscheme; ?>;
}
#wp-calendar thead th{
	background: <?php echo $clrscheme; ?>;
	border: 1px solid <?php echo $clrscheme; ?>;
}
.zl_post_readmore.close{
	background: <?php echo $clrscheme; ?>;
	border: 2px solid <?php echo $clrscheme; ?>;
}
.zl_mainmenu > li:hover > a,
.fword,
#respond input[type='text']:focus, #respond input[type='email']:focus, #respond input[type='password']:focus, #respond input[type='url']:focus, #respond textarea:focus
{
	border-color:<?php echo $clrscheme; ?>;
}
.zl_mainmenu ul li:first-child:hover:before{
	border-color:transparent transparent <?php echo $clrscheme; ?> transparent
}
.zl_mainmenu ul ul li:first-child:hover:before{
	border-color: transparent <?php echo $clrscheme; ?> transparent transparent;
}
.zl_mainmenu ul li:hover > a,
.zl_footer .tags a:hover, .tags a:hover,
.btn.submit,
.postMode .zl_post_format_opt ul li label.checked
{
	background:<?php echo $clrscheme; ?>;
	color:#fff;
}
.btn.submit{
	border-color:<?php echo $clrscheme; ?>;
}
.zl_postdetails h3.entry-title a:hover, h3.entry-title a:hover,
.zl_morepost a:hover
{
	color:<?php echo $clrscheme; ?>;
}
.zl_morepost a:hover{
	border-color:<?php echo $clrscheme; ?>;
}
.zl_widget input[type="submit"],
.menu_option li a:hover
{
	background: <?php echo $clrscheme; ?>;
}
.zl_singlecategories a{
	background: <?php echo $clrscheme; ?>;
}
.zl_the_timelinegrid li .zl_timelinedate:before{
	background: <?php echo $clrscheme; ?>;
}
.zl_commentform input[type="submit"]:hover, 
.comment-respond input[type="submit"]:hover
{
	background: <?php echo $clrscheme; ?>!important;
	color: #fff;
}
.btn:hover, input[type="submit"]:hover{
	background: <?php echo $clrscheme; ?>!important;
	border-color:<?php echo $clrscheme; ?>!important;
}
.zl_footer input[type="submit"]{
	background: <?php echo $clrscheme; ?>;
}
.zl_post_thumb:before,
.zl_gal_inner:before{
	background: rgba(<?php echo hex2rgb($clrscheme); ?>,0.7);
}
.zl_post_readmore.is_single:hover, .zl_post_readmore:hover {
	background: <?php echo $clrscheme; ?>;
	border: 2px solid <?php echo $clrscheme; ?>;
}
.conentry h1, .conentry h2, .conentry h3, .conentry h4, .conentry h5, .conentry h6{
	border-color:<?php echo $clrscheme; ?>
}
.format-chat .conentry p:nth-of-type(2n+1){
	background:rgba(<?php echo hex2rgb($clrscheme); ?>, .5);
}

@-webkit-keyframes load6 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.42em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.44em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.46em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.477em #ffffff;
  }
  5%,
  95% {
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.42em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.44em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.46em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.477em #ffffff;
  }
  30% {
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.51em -0.66em 0 -0.42em <?php echo $clrscheme; ?>, -0.75em -0.36em 0 -0.44em <?php echo $clrscheme; ?>, -0.83em -0.03em 0 -0.46em <?php echo $clrscheme; ?>, -0.81em 0.21em 0 -0.477em #ffffff;
  }
  55% {
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.29em -0.78em 0 -0.42em <?php echo $clrscheme; ?>, -0.43em -0.72em 0 -0.44em <?php echo $clrscheme; ?>, -0.52em -0.65em 0 -0.46em <?php echo $clrscheme; ?>, -0.57em -0.61em 0 -0.477em #ffffff;
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.42em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.44em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.46em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.477em #ffffff;
  }
}
@keyframes load6 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.42em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.44em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.46em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.477em #ffffff;
  }
  5%,
  95% {
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.42em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.44em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.46em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.477em #ffffff;
  }
  30% {
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.51em -0.66em 0 -0.42em <?php echo $clrscheme; ?>, -0.75em -0.36em 0 -0.44em <?php echo $clrscheme; ?>, -0.83em -0.03em 0 -0.46em <?php echo $clrscheme; ?>, -0.81em 0.21em 0 -0.477em #ffffff;
  }
  55% {
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.29em -0.78em 0 -0.42em <?php echo $clrscheme; ?>, -0.43em -0.72em 0 -0.44em <?php echo $clrscheme; ?>, -0.52em -0.65em 0 -0.46em <?php echo $clrscheme; ?>, -0.57em -0.61em 0 -0.477em #ffffff;
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
    box-shadow: -0.11em -0.83em 0 -0.4em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.42em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.44em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.46em <?php echo $clrscheme; ?>, -0.11em -0.83em 0 -0.477em #ffffff;
  }
}




/* arfa update */

.zl_navbar,
button,
.zl_post_detail .zl_post_icon,
.zl_pagination li a.current,
.zl_footer .owl-controls .owl-dots div.owl-dot:hover, 
.zl_footer .owl-controls .owl-dots div.owl-dot.active,
.zl_backtotop span.dashicons,
::selection,
.zl_post_format_opt ul li label:hover,
.searchbar{
	background: <?php echo $clrscheme; ?>;
}

.zl_mainmenu > li.current_page_item > a {
	background: <?php echo $clrscheme; ?>;
	border: 2px solid <?php echo $clrscheme; ?>;
}

.zl_post_detail .zl_post_icon:before{
	border-right: 7px solid <?php echo $clrscheme; ?>;
	border-top: 7px solid <?php echo $clrscheme; ?>;
}
.zl_post_id_meta li:hover .dashicons,
.sorter a.currents, .sorter a:hover,
.zl_post_detail h3.entry-title a:hover{
	color:<?php echo $clrscheme; ?>;
}
.zl_foowidtit span{
	border-bottom: 1px solid <?php echo $clrscheme; ?>;
}
.zl_logo a:hover,
.menubutton a,
.searchbar a:hover,.searchbar a{
	color:#FFF;
}

<?php } ?>

<?php if($navbar_color) { ?>
	.zl_navbar, .is-sticky #sticker .zlmainheader, .zl_header_3 .is-sticky #sticker .zlmainheader{
		background: <?php echo $navbar_color; ?>;
	}

	.zl_navbar a,
	.is-sticky #sticker .zlmainheader a,
	.zl_header_3 .is-sticky #sticker .zlmainheader a
	{
		color:<?php echo $navbar_text_color; ?>;
	}
	#zl_trigger{
		border-color:<?php echo $navbar_text_color; ?>!important;
	}
	#zl_trigger:before{
		background:<?php echo $navbar_text_color; ?>!important;
	}
<?php } ?>

<?php 
/*Typography Settings */
	$usecustomfont = zl_option('usecustomfont');
	if ($usecustomfont == "1") {
?>
/*  Typography  */
<?php if(zl_option('body_font_face')){ ?>
body{
	font-family:<?php echo vp_option('zl_option.body_font_face');?>!important;
	font-weight: <?php echo vp_option('zl_option.body_font_weight');?>;
	font-size:<?php echo vp_option('zl_option.body_font_size');?>px!important;
	line-height:<?php echo vp_option('zl_option.body_font_line_height');?>px!important;
}
.conentry p{
	font-size:<?php echo vp_option('zl_option.body_font_size');?>px!important;
	line-height:<?php echo vp_option('zl_option.body_font_line_height');?>px!important;
}
<?php } ?>

h1, h2, h3, h4, h5, h6,
h2.entry-title, h1.entry-title, h3.entry-title, .entry-title,  #the_title
{
	font-family:<?php echo vp_option('zl_option.h1_font_face');?>!important;
	font-weight: <?php echo vp_option('zl_option.h1_font_weight');?>!important;
	font-style: <?php echo vp_option('zl_option.h1_font_style');?>;
}
h2.entry-title, h3.entry-title, h1.entry-title{
	font-size:<?php echo vp_option('zl_option.post_tit_size');?>px!important;
	line-height: <?php echo vp_option('zl_option.post_tit_line_size');?>px;
	
}
<?php if(vp_option('zl_option.post_tit_line_size')){ ?>
.zl_post_detail .entry-title{
	margin-top: <?php echo vp_option('zl_option.post_tit_size') - vp_option('zl_option.post_tit_line_size') - 1 ;?>px!important;
}
<?php } ?>
.conentry h1{
	font-size: <?php echo vp_option('zl_option.h1_font_size_b');?>px;
	line-height: <?php echo vp_option('zl_option.h1_font_line_height_b');?>px;
}
.conentry h2{
	font-size: <?php echo vp_option('zl_option.h2_font_size_b');?>px;
	line-height: <?php echo vp_option('zl_option.h2_font_line_height');?>px;
}
.conentry h3{
	font-size: <?php echo vp_option('zl_option.h3_font_size');?>px;
	line-height: <?php echo vp_option('zl_option.h3_font_line_height');?>px;
}
.conentry h4{
	font-size: <?php echo vp_option('zl_option.h4_font_size');?>px;
	line-height: <?php echo vp_option('zl_option.h4_font_line_height');?>px;
}
.conentry h5{
	font-size: <?php echo vp_option('zl_option.h5_font_size');?>px;
	line-height: <?php echo vp_option('zl_option.h5_font_line_height');?>px;
}
.conentry h6{
	font-size: <?php echo vp_option('zl_option.h6_font_size');?>px;
	line-height: <?php echo vp_option('zl_option.h6_font_line_height');?>px;
}

.zl_foowidtit{
	font-family:<?php echo vp_option('zl_option.fwidtit_font_face');?>!important;
	font-weight:<?php echo vp_option('zl_option.fwidtit_font_weight');?>!important;
	font-style:<?php echo vp_option('zl_option.fwidtit_font_style');?>!important;
	font-size:<?php echo vp_option('zl_option.fwidtit_font_size');?>px!important;
	line-height:<?php echo vp_option('zl_option.fwidtit_font_line_height');?>px!important;
}
h3.zl_widgetit{
	font-family:<?php echo vp_option('zl_option.sidwidtit_font_face');?>!important;
	font-weight:<?php echo vp_option('zl_option.sidwidtit_font_weight');?>!important;
	font-style:<?php echo vp_option('zl_option.sidwidtit_font_style');?>!important;
	font-size:<?php echo vp_option('zl_option.sidwidtit_font_size');?>px!important;
	line-height:<?php echo vp_option('zl_option.si_fontdwidtit_font_line_height');?>!important;
}
<?php } ?>
/* below is custom css */
<?php echo $customcss; ?>