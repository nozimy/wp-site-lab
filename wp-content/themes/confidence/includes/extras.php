<?php function ninetheme_confidence_custom_styling() { ?>

	<style>

	<?php if( ot_get_option( 'headertextcolor' ) !='' ) : ?>
	.breadcrumbs a,
	.subpage-head.page-header ,
	.subpage-head.page-header h3
	{ color :<?php echo esc_attr(ot_get_option('headertextcolor')); ?> ; }
	<?php endif; ?>

	<?php if( ot_get_option( 'pre_bg' ) !='' ) : ?>
	#preview-area
	{ background-color :<?php echo esc_attr(ot_get_option('pre_bg')); ?> ; }
	<?php endif; ?>

	<?php if( ot_get_option( 'pre_bubble_bg' ) !='' ) : ?>
	.double-bounce1, .double-bounce2
	{ background-color :<?php echo esc_attr(ot_get_option('pre_bubble_bg')); ?> ; }
	<?php endif; ?>

	<?php if( ot_get_option( 'headerbgcolor' ) !='' ) : ?>
	.subpage-head { background-color :<?php echo esc_attr(ot_get_option('headerbgcolor')); ?>; }
	<?php endif; ?>

	.navbar-colored {background-color: <?php echo esc_attr(ot_get_option('headerotherbgcolor')); ?>;}

	<?php if( ot_get_option( 'headerbgimage' ) !='' ) : ?>
	.subpage-head.page-header  {
	  background: url(<?php echo esc_url( ot_get_option( 'headerbgimage' ) ) ?>) no-repeat center center fixed;
	  background-size: cover !important;
	  height: auto !important;
	}
	<?php endif; ?>

	<?php if( ot_get_option( 'headerpaddingtop' ) !='' ) : ?>
	.subpage-head.page-header  {
		padding-top :<?php echo esc_attr(ot_get_option('headerpaddingtop')); ?>px ;
		padding-bottom :<?php echo esc_attr(ot_get_option('headerpaddingbottom')); ?>px ;
	}
	<?php endif; ?>

	<?php if ( ot_get_option('wrapper') == 'on') : ?>
	.site-container {
		max-width: 1240px;
		margin: 30px auto;
		background-color: #FFFFFF;
	}
	.navbar-default {
		max-width: 1240px;
		margin: 30px auto;
		background-color: #FFFFFF;
	}
	<?php endif; ?>

	<?php if ( ot_get_option('confidence_breadcrumb_v') == 'off') : ?>
	.breadcrumbs {
		display: none;
	}
	<?php endif; ?>

	/*2. Logo dimension*/

	<?php $dimensionheader = ot_get_option( 'header_logo_dimension', array() ); ?>
	<?php if($dimensionheader) { ?>
	.navbar-brand img{
	<?php if($dimensionheader['width']) { echo 'width:'.$dimensionheader['width'].''.$dimensionheader['unit'].'';   }else{ echo '';} ?>;
	<?php if($dimensionheader['height']){ echo 'height:'.$dimensionheader['height'].''.$dimensionheader['unit'].''; }else{ echo '';} ?>;}
	<?php } ?>

	<?php $logoheadermargin = ot_get_option( 'header_margin_logo', array() ); ?>
	<?php if($logoheadermargin) { ?>
	.navbar-brand img{
	<?php if($logoheadermargin['top'])    { echo 'margin-top:'.$logoheadermargin['top'].''.$logoheadermargin['unit'].'';       }else{ echo '';} ?>;
	<?php if($logoheadermargin['right'])  { echo 'margin-right:'.$logoheadermargin['right'].''.$logoheadermargin['unit'].'';   }else{ echo '';} ?>;
	<?php if($logoheadermargin['bottom']) { echo 'margin-bottom:'.$logoheadermargin['bottom'].''.$logoheadermargin['unit'].''; }else{ echo '';} ?>;
	<?php if($logoheadermargin['left'])   { echo 'margin-left:'.$logoheadermargin['left'].''.$logoheadermargin['unit'].'';     }else{ echo '';} ?>;}
	<?php } ?>

	<?php $logoheaderpadding = ot_get_option( 'header_padding_logo', array() ); ?>
	<?php if($logoheaderpadding) { ?>
	.navbar-brand img{
	<?php if($logoheaderpadding['top'])    { echo 'padding-top:'.$logoheaderpadding['top'].''.$logoheaderpadding['unit'].'';       }else{ echo '';} ?>;
	<?php if($logoheaderpadding['right'])  { echo 'padding-right:'.$logoheaderpadding['right'].''.$logoheaderpadding['unit'].'';   }else{ echo '';} ?>;
	<?php if($logoheaderpadding['bottom']) { echo 'padding-bottom:'.$logoheaderpadding['bottom'].''.$logoheaderpadding['unit'].''; }else{ echo '';} ?>;
	<?php if($logoheaderpadding['left'])   { echo 'padding-left:'.$logoheaderpadding['left'].''.$logoheaderpadding['unit'].'';     }else{ echo '';} ?>;}
	<?php } ?>


	<?php if( ot_get_option( 'headerheight' ) !='' ) : ?>
	.navbar-default { height:<?php echo esc_attr(ot_get_option('headerheight')); ?>px; }
	<?php endif; ?>
	<?php if( ot_get_option( 'headermenuheight' ) !='' ) : ?>
	.navbar-default .navbar-nav  { margin:<?php echo esc_attr(ot_get_option('headermenuheight')); ?>px 0; }
	<?php endif; ?>
	<?php if( ot_get_option( 'rightmenumargin' ) !='' ) : ?>
	.navbar-default .navbar-nav  { margin-top:<?php echo esc_attr(ot_get_option('rightmenumargin')); ?>px; }
	<?php endif; ?>

	<?php if( current_user_can('administrator')): ?>
		.navbar-default {  margin: 0px auto; }
		.navbar.shrink { margin: 30px auto; }
	<?php endif; ?>

	<?php if( is_customize_preview('administrator')): ?>
		.navbar-default { top: 30px;}
		.navbar.shrink {
		   margin: 0px auto;
		}
	<?php endif; ?>

	<?php if( ot_get_option( 'themecolor1' ) !='' ) : ?>
	.product-info .description .prices > .off-price,
	p.stars a.star-1:after,
	p.stars a.star-2:after,
	p.stars a.star-3:after,
	p.stars a.star-4:after,
	p.stars a.star-5:after,
	.woocommerce-page p.stars a.star-1:after,
	.woocommerce-page p.stars a.star-2:after,
	.woocommerce-page p.stars a.star-3:after,
	.woocommerce-page p.stars a.star-4:after,
	.woocommerce-page p.stars a.star-5:after,
	.event-date,
	.time
	{
	color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>;
	}

	.navbar-default .navbar-nav>.active>a,
	.navbar-default .navbar-nav>.active>a:hover,
	.navbar-default .navbar-nav>.active>a:focus,
	.btn-primary,
	.btn-primary:hover,
	.btn-primary:focus,
	.btn-primary:active,
	.btn-primary.active,
	.open>.dropdown-toggle.btn-primary,
	.social-icon li a:hover,
	.product-info .input-text.qty,
	.product-info .single_add_to_cart_button,
	.reviews_tab .btn-primary,
	.woocommerce .button,
	input.qty,
	.event-container,
	.related-container .section-title h4,
	.author-info,
	.eventTitle,
	.btn-primary,
	.owl-theme .owl-dots .owl-dot.active span,
	.owl-theme .owl-dots .owl-dot:hover span
	{
		background-color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>;
		border-color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>;
	}

	.blog-post-container article.hentry,
	.blog-post-container article.hentry:after
	{

		border-color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>;
	}

	.section-heading:before {
		border-color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>;
	}

	.fact .i_container:after {
		border-left-color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>;
	}


	.fact .i_container:before {
		border-top-color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>;
	}

	.fact .i_container,
	.team-container .eventTitle,
	.comment-form .form-submit input[type="submit"],
	#widget-area #searchform input#searchsubmit		{
		background-color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>;
	}
	.slogan:after {
		border-top-color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>;
	}

	.post-meta-second span i,
	.post-meta-first span i,
	.tribe-events-event-meta .fa,
	.single-tribe_events .fa { color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>; }

	.blockquote-container .section-title h4:after,
	.post-list-type:after,
	.slogan:after,
	.widget .widget-title:after
	{ border-color: <?php echo esc_attr( ot_get_option( 'themecolor1' ) ) ?>; }

	<?php endif; ?>

	<?php if( ot_get_option( 'themecolor2' ) !='' ) : ?>

	.offer .product-info > .add-to-cart 	{ border-color: <?php echo esc_attr( ot_get_option( 'themecolor2' ) ) ?>; }

	#share-buttons i,
	#widget-area .widget_text,
	#widget-area #searchform input[type="text"],
	.owl-theme .owl-dots .owl-dot span,
	.tagcloud a,
	.subpage-head,
	.event-list-button,
	.product .ribbon,
	.comment-form .submit,
	.pager li > a,
	.pager li > span,
	.navbar-default  .navbar-nav  > .active:last-child a,
	.navbar-nav > li:last-child a,
	.woocommerce span.onsale,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt
	{ background-color: <?php echo esc_attr( ot_get_option( 'themecolor2' ) ) ?> !important;}
	#widget-area #searchform input[type="text"],
	.woocommerce-message
	{ border-color: <?php echo esc_attr( ot_get_option( 'themecolor2' ) ) ?> !important;}

	.tagcloud a,
	.pager li > a,
	.pager li > span,
	.event-list-button {border-color: <?php echo esc_attr( ot_get_option( 'themecolor2' ) ) ?>;}

	.btn .more,
	.woocommerce div.product p.price,
	.woocommerce div.product span.price
	{color: <?php echo esc_attr( ot_get_option( 'themecolor2' ) ) ?> !important;}
	<?php endif; ?>

	<?php if( ot_get_option( 'themecolor3' ) !='' ) : ?>

	.slogan,
	.blockquote-container .section-title h4,
	.post-list-type,
	.charity-box .button-causes
	{ background-color: <?php echo esc_attr( ot_get_option( 'themecolor3' ) ) ?>; }
	<?php endif; ?>

	.navbar-default { background-color: <?php echo esc_attr( ot_get_option( 'headerbgopa' ) ) ?>; }
	.navbar-default .navbar-nav { background-color: <?php echo esc_attr( ot_get_option( 'menu_bg' ) ) ?>; }
	.navbar-nav.navbar-right.nav>li:before { border-color: <?php echo esc_attr( ot_get_option( 'menu_dot' ) ) ?>; }
	.navbar-default.shrink { background-color: <?php echo esc_attr( ot_get_option( 'headerbg' ) ) ?>; }
	.navbar-default.shrink {   border-bottom: solid 1px <?php echo esc_attr( ot_get_option( 'headerborder' ) ) ?>; }

	.navbar-default .navbar-nav>.active>a,
	.navbar-default .navbar-nav>.active>a:hover,
	.navbar-default .navbar-nav>.active>a:focus
	{
		color: <?php echo esc_attr( ot_get_option( 'menuactive' ) ) ?> !important;
		border-color: <?php echo esc_attr( ot_get_option( 'menuactive' ) ) ?> !important;
	}

	.navbar-nav.navbar-right.nav>li.active:before {
		border-color: <?php echo esc_attr( ot_get_option( 'menuactive' ) ) ?> !important;
	}

	.navbar-default .navbar-nav>li>a,
	.navbar-default .navbar-nav>.open>a
	{
		color:<?php echo esc_attr( ot_get_option( 'menucolor' ) ) ?> !important;
	}

	.navbar-default .navbar-nav>li>a:hover,
	.navbar-default .navbar-nav>li>a:focus,
	.navbar-default .navbar-nav>li>a:active { color:<?php echo esc_attr( ot_get_option( 'menuhovercolor' ) ) ?>; }

	.navbar-default  .navbar-nav  > .active:last-child a, .navbar-nav > li:last-child a { background-color:<?php echo esc_attr( ot_get_option( 'menu_last_bg' ) ) ?> !important; }
	.navbar-default  .navbar-nav  > .active:last-child a, .navbar-nav > li:last-child a { color:<?php echo esc_attr( ot_get_option( 'menu_last_c' ) ) ?> !important; }

	.navbar-right .dropdown-menu  { background-color: <?php echo esc_attr( ot_get_option( 'menudropdown' ) ) ?>; }
	.navbar-right .dropdown-menu .caret { border: 1px solid <?php echo esc_attr( ot_get_option( 'menudropdownborder' ) ) ?> !important ; }
	.caret { color:  <?php echo esc_attr( ot_get_option( 'menudropdownborder' ) ) ?> !important ; }
	.dropdown-menu>li>a  { color: <?php echo esc_attr( ot_get_option( 'menudropdownitem' ) ) ?>; }
	.dropdown-menu>li>a:hover,
	.dropdown-menu>li>a:focus  { background-color: <?php echo esc_attr( ot_get_option( 'menudropdownitemhover' ) ) ?>; }

	.footer-top.first  { background-color: <?php echo esc_attr( ot_get_option( 'footertopfirstbg' ) ) ?>; }
	.footer-top.first .form-group h5 , .social-heading h5{ color: <?php echo esc_attr( ot_get_option( 'footertopfirsthcolor' ) ) ?> !important; }
	.footer-top.first .form-group p,
	.footer-top.first .form-group span ,
	.footer-top.first .form-group .social-container li { color: <?php echo esc_attr( ot_get_option( 'footertopfirstlinkcolor' ) ) ?> !important; }
	.social-top ul li a .fa{ color: <?php echo esc_attr( ot_get_option( 'footertopiconcolor' ) ) ?> !important; }
	.footer-top.first .form-group .form-group.relative input[type="text"],
	.footer-top.first .form-group .form-group.relative input[type="mail"]
	{
		background-color: <?php echo esc_attr( ot_get_option( 'footertopinputbg' ) ) ?>;
		border-color: <?php echo esc_attr( ot_get_option( 'footertopinputbordercolor' ) ) ?>;
	}

	.footer-top.first .btn-subscribe {
		background-color: <?php echo esc_attr( ot_get_option( 'footertopsubmitbg' ) ) ?>;
		border-color: <?php echo esc_attr( ot_get_option( 'footertopsubmitbg' ) ) ?>;
		color: <?php echo esc_attr( ot_get_option( 'footertopsubmitcolor' ) ) ?>;
	}

	.info.list li .fa {
		background-color: <?php echo esc_attr( ot_get_option( 'copyright_icon_bg' ) ) ?>;
		color: <?php echo esc_attr( ot_get_option( 'copyright_icon_text_color' ) ) ?>;
	}
	<?php
		$blogbg = ot_get_option( 'footerbgimage', array() );
		if( $blogbg !='' ) :
	?>
		footer.footer-top {
		<?php if($blogbg['background-image'])		{ echo 'background-image:url("'.$blogbg['background-image'].'");';	}			else{ echo '';} ?>
		<?php if($blogbg['background-repeat'])		{ echo 'background-repeat:'.$blogbg['background-repeat'].';';}			else{ echo '';} ?>
		<?php if($blogbg['background-color'])		{ echo 'background-color:'.$blogbg['background-color'].';';}			else{ echo '';} ?>
		<?php if($blogbg['background-attachment'])	{ echo 'background-attachment:'.$blogbg['background-attachment'].';';}	else{ echo '';} ?>
		<?php if($blogbg['background-position'])	{ echo 'background-position:'.$blogbg['background-position'].';';}		else{ echo '';} ?>
		<?php if($blogbg['background-size'])		{ echo 'background-size:'.$blogbg['background-size'].';';}				else{ echo '';} ?>
		}
	<?php endif; ?>



	footer.footer-top { color: <?php echo esc_attr( ot_get_option( 'footertoptext' ) ) ?>; }
	footer.footer-top { background-color: <?php echo esc_attr( ot_get_option( 'footertopbg' ) ) ?>; }
	footer.footer-top .widget h5 { color: <?php echo esc_attr( ot_get_option( 'footertophcolor' ) ) ?> !important; }
	footer.footer-top .widget h5:after { border-color: <?php echo esc_attr( ot_get_option( 'footertoplinecolor' ) ) ?> !important; }
	footer .widget ul li a,
	footer .tribe-events-list-widget .duration span { color: <?php echo esc_attr( ot_get_option( 'footertoplinkcolor' ) ) ?> !important; }
	.copyright { background-color: <?php echo esc_attr( ot_get_option( 'copyrightbg' ) ) ?> !important; }
	.copyright,
	.social-icons a{ color: <?php echo esc_attr( ot_get_option( 'copyrightlink' ) ) ?> !important; }

	/*4. sidebar*/
	<?php if ( ot_get_option( 'confidence_sidebarwidgetbgcolor' ) != '') : ?>
	.sidebar .widget {background-color: <?php echo esc_attr( ot_get_option( 'confidence_sidebarwidgetbgcolor' ) ); ?>!important; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebarwidgettitlecolor' ) != '') : ?>
	.sidebar .widget-title{color: <?php echo esc_attr( ot_get_option( 'confidence_sidebarwidgettitlecolor' ) ); ?>!important; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebarwidgettitlebottomlinecolor' ) != '') : ?>
	.sidebar .widget .widget-title:after{border-color: <?php echo esc_attr( ot_get_option( 'confidence_sidebarwidgettitlebottomlinecolor' ) ); ?>!important; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebarwidgetgeneralcolor' ) != '') : ?>
	.sidebar .widget ul{color: <?php echo esc_attr( ot_get_option( 'confidence_sidebarwidgetgeneralcolor' ) ); ?>!important; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebarlinkcolor' ) != '') : ?>
	.sidebar .widget ul li a{color: <?php echo esc_attr( ot_get_option( 'confidence_sidebarlinkcolor' ) ); ?>!important; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebarlinkhovercolor' ) != '') : ?>
	.sidebar .widget ul li a:hover {color: <?php echo esc_attr( ot_get_option( 'confidence_sidebarlinkhovercolor' ) ); ?>!important; }
	<?php endif; ?>

	<?php if ( ot_get_option( 'confidence_sidebartagcloudlinkcolor' ) != '') : ?>
	.sidebar .widget .tagcloud a{color: <?php echo esc_attr( ot_get_option( 'confidence_sidebartagcloudlinkcolor' ) ); ?>!important; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebartagcloudlinkhovercolor' ) != '') : ?>
	.sidebar .widget .tagcloud a:hover{color: <?php echo esc_attr( ot_get_option( 'confidence_sidebartagcloudlinkhovercolor' ) ); ?>!important; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebartagcloudlinkbgcolor' ) != '') : ?>
	.sidebar .widget .tagcloud a{background-color: <?php echo esc_attr( ot_get_option( 'confidence_sidebartagcloudlinkbgcolor' ) ); ?>!important; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebartagcloudlinkbghovercolor' ) != '') : ?>
	.sidebar .widget .tagcloud a:hover{background-color: <?php echo esc_attr( ot_get_option( 'confidence_sidebartagcloudlinkbghovercolor' ) ); ?>!important; }
	<?php endif; ?>

	<?php if ( ot_get_option( 'confidence_sidebarsearchsubmittextcolor' ) != '') : ?>
	#widget-area #searchform input#searchsubmit{color:<?php echo esc_attr( ot_get_option( 'confidence_sidebarsearchsubmittextcolor' ) ); ?>;}
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebarsearchsubmittexthovercolor' ) != '') : ?>
	#widget-area #searchform input#searchsubmit:hover{color: <?php echo esc_attr( ot_get_option( 'confidence_sidebarsearchsubmittexthovercolor' ) ); ?>!important; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebarsearchsubmitbgcolor' ) != '') : ?>
	#widget-area #searchform input#searchsubmit{background-color: <?php echo esc_attr( ot_get_option( 'confidence_sidebarsearchsubmitbgcolor' ) ); ?>; }
	<?php endif; ?>
	<?php if ( ot_get_option( 'confidence_sidebarsearchsubmitbghovercolor' ) != '') : ?>
	#widget-area #searchform input#searchsubmit:hover{background-color: <?php echo esc_attr( ot_get_option( 'confidence_sidebarsearchsubmitbghovercolor' ) ); ?>!important; }
	<?php endif; ?>


	<?php if( ot_get_option( 'additional_1200_css' ) ) { ?>
		@media (max-width: 1200) {
			<?php  echo  ot_get_option( 'additional_1200_css' );  ?>
		}
	<?php } ?>
	<?php if( ot_get_option( 'additional_992_css' ) ) { ?>
		@media (max-width: 992px) {
			<?php  echo  ot_get_option( 'additional_992_css' );  ?>
		}
	<?php } ?>
	<?php if( ot_get_option( 'additional_767_css' ) ) { ?>
		@media (max-width: 767px) {
			<?php  echo  ot_get_option( 'additional_767_css' );  ?>
		}
	<?php } ?>
	<?php if( ot_get_option( 'additional_480_css' ) ) { ?>
		@media (max-width: 480px) {
			<?php  echo  ot_get_option( 'additional_480_css' );  ?>
		}
	<?php } ?>


	<?php if( ot_get_option( 'additionalcss' ) ) {
		echo  ot_get_option( 'additionalcss' ) ;
	} ?>
	</style>

	<?php if ( ot_get_option( 'additionaljs' ) !='' ): ?>
		<script type="text/javascript">
		<?php if(ot_get_option('additionaljs')) { echo  ot_get_option( 'additionaljs' ) ; } ?>
		</script>
	<?php endif; ?>

	<?php }
	add_action('wp_head','ninetheme_confidence_custom_styling');
