<style type="text/css">
/* CSS Generated from theme options */
<?php
	global $ecobox_data;

	$theme_options_styles = '';

	$typography_footer_heading = $ecobox_data['typography-footer-heading'];
	if ( $typography_footer_heading['color'] != '' ) {
		$theme_options_styles .= '
		.widget__footer .widget-title:before {
			border-right: 2px solid ' . $typography_footer_heading['color'] . ';
			border-left: 1px solid ' . $typography_footer_heading['color'] . ';
		}
		.widget__footer .widget-title:after {
			border-right: 4px solid ' . $typography_footer_heading['color'] . ';
			border-left: 3px solid ' . $typography_footer_heading['color'] . ';
		}';
	}
	

	$header_bg_retina = $ecobox_data['header-bg-retina-img'];
	if ( $header_bg_retina['url'] != '' ) {
		$theme_options_styles .= '
			only screen and (-webkit-min-device-pixel-ratio: 2),
			only screen and (   min--moz-device-pixel-ratio: 2),
			only screen and (     -o-min-device-pixel-ratio: 2/1),
			only screen and (        min-device-pixel-ratio: 2),
			only screen and (                min-resolution: 192dpi),
			only screen and (                min-resolution: 2dppx) {
				.top-wrapper {
					background-image: '.$header_bg_retina['url'].';
				}
		}';
	}

	$header_bg_retina_size = $ecobox_data['header-bg-retina-img-dimensions'];
	if ( $header_bg_retina_size['width'] != 'px' && $header_bg_retina_size['height'] != 'px' ) {
		$theme_options_styles .= '
			only screen and (-webkit-min-device-pixel-ratio: 2),
			only screen and (   min--moz-device-pixel-ratio: 2),
			only screen and (     -o-min-device-pixel-ratio: 2/1),
			only screen and (        min-device-pixel-ratio: 2),
			only screen and (                min-resolution: 192dpi),
			only screen and (                min-resolution: 2dppx) {
				.top-wrapper {
					background-size: '.$header_bg_retina_size['width'].' '.$header_bg_retina_size['height'].';
				}
		}';
	}

	if( $theme_options_styles ){
		// ensure consistent line endings
		$s = str_replace("\r\n", "\n", $theme_options_styles);
		$s = str_replace("\r", "\n", $s);
		// Don't allow out-of-control blank lines
		$s = preg_replace("/\n{2,}/", "\n\n", $s);
		echo $s;
	}

?>
</style>