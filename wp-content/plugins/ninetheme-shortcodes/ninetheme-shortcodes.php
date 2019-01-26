<?php
/*
Plugin Name: Confidence Shortcodes
Plugin URI: http://themeforest.net/user/Ninetheme
Description: Shortcodes for Ninetheme WordPress Themes - Confidence Version
Version: 1.1
Author: Ninetheme
Author URI: http://themeforest.net/user/Ninetheme
*/


/* set the [ckhp-tribe-events] shortcode */
function ckhp_get_tribe_events($atts) {
	if ( !function_exists( 'tribe_get_events' ) ) { 
		return;
	}
	global $wp_query, $tribe_ecp, $post;
	$output='';
	$ckhp_event_tax = '';
	
	extract(shortcode_atts(array(
       	'bg_black'      => '',
       	'posts'      => '3',
       	'categories' => 'all',
		'excerpt_size' => '50',
		'post_types' => 'causes',
		'buttonlink' => '',
		'buttontext' => '',
		'heading' => '',
		'ckhp_cat' => '',
		'ckhp_number' => '',
		'no_upcoming_events' => '',
		'slogan' => ''
    ), $atts));

	if ( $ckhp_cat ) {
		$ckhp_event_tax = array( 
			array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'slug',
				'terms' => $ckhp_cat
			) 
		);
	}

	$posts = tribe_get_events(apply_filters('tribe_events_list_widget_query_args', array(
			'eventDisplay' => 'list',
			'posts_per_page' => $ckhp_number,
			'tax_query'=> $ckhp_event_tax
	)));
	
	if ( $posts && !$no_upcoming_events) {

	$output .= '<div class="p_top_bottom_60_off event-list-section">';
	$output .= ' <div class="container event-list">';
	$output .= ' <div class="row">';
	$output .= '  <div class="col-md-12-off events-container">';
	$output .= ' <div class="owl-carousel">';
		
		foreach( $posts as $post ) :
			setup_postdata( $post );
		
			$output .= '<div class="el-block item">';
			
				$time_format = get_option( 'time_format', Tribe__Events__Date_Utils::TIMEFORMAT );
				$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );
				$start_datetime = tribe_get_start_date();
				$tribe_the_excerpt = tribe_events_get_the_excerpt (); // short content
				$start_date = tribe_get_start_date( null, false ); 
				$start_time = tribe_get_start_date( null, false, $time_format );
				$start_ts = tribe_get_start_date( null, false, Tribe__Events__Date_Utils::DBDATEFORMAT );
				$end_datetime = tribe_get_end_date();
				$end_date = tribe_get_end_date( null, false );
				$end_time = tribe_get_end_date( null, false, $time_format );
				$end_ts = tribe_get_end_date( null, false, Tribe__Events__Date_Utils::DBDATEFORMAT );
				$thumb = get_post_thumbnail_id($post->ID);
				$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ,'full' ); 
				$image = aq_resize( $img_url, 360,  true ); 

			
				if($image != ''){	$output .= '<img src="'.$image.'" alt="' . get_the_title() . '" class="img-responsive"/>';}

			$output .= '<div class="p_left_right_20">';
			if($image == ''){	$output .= ' <h5 class="clearfix m_top_20"></h5>'; }
			$output .= ' <h6 class="m_top_20 nowrap-ellipsis">' . get_the_title(). '</h6>';
			$output .= ' <h4 class="event-date-container"><span class="event-date">'. __('Start Date : ','benafactor') .'</span> ' . $start_date . ' </h4>';
			$output .= ' <h4 class="m_bottom_20 event-date-container"><span class="event-date">'. __('End Date : ','benafactor') .'</span>' . $end_date . ' </h4>';
			$output .= '<p class="m_bottom_20 m_top_20">' . substr(tribe_events_get_the_excerpt(), 0, $excerpt_size) . '</p>';
				$output .= ' <p>
			<a href="'.tribe_get_event_link().'" role="button" class="btn more">'.__( 'read more', 'confidence' ) .'
			<i class="fa fa-long-arrow-right "></i></a></p>';
			$output .= '  </div>';
			$output .= '  </div>';
			
			/* item end */
			
		endforeach;
		
	} else { //No Events were Found
	} // endif
	
	$output .= ' </div>';
     $output .= ' </div>';
   $output .= ' </div>';
  $output .= '</div>';
$output .= '</div>';

	
	wp_reset_query();
	return $output;
}
add_shortcode('events_slider', 'ckhp_get_tribe_events'); // link new function to shortcode name

/*-----------------------------------------------------------------------------------*/
/*	Latest Blog
/*-----------------------------------------------------------------------------------*/

function confidence_vc_post_type_carousel($atts){
	extract(shortcode_atts(array(
       	'bg_black'      => '3',
       	'posts'      => '3',
       	'categories' => 'all',
		'excerpt_size' => '130',
		'post_types' => 'causes',
		'buttonlink' => '',
		'buttontext' => '',
		'heading' => '',
		'slogan' => ''
    ), $atts));
    
	$args = array(
		'post_type' => ''.$post_types.'',
		'posts_per_page' => $posts,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
    
    if($categories != 'all'){
    	$str = $categories;
    	$arr = explode(',', $str);
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'slug',
			'terms' 	=> $arr
		);
	}

    query_posts( $args );
	
    $output = '';
	$output .= '<div class="p_top_bottom_60_off event-list-section">
	<div class="container event-list">
	<div class="row">
	<div class="col-md-12-off events-container">
	<div class="owl-carousel">';

	
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) :
	while ($my_query->have_posts()) : $my_query->the_post();
	
		$output .= '<div class="el-block item">';
			
			$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ,'full' );
			$image = aq_resize( $img_url, 360, true );

			if($image != ''){
				$output .= '<div class="image-container">';				
				$output .= '<img src="'. $image .'" alt="' . get_the_title() . '" class="img-responsive sa"/>';
				$output .= '</div>';
			}
			$output .= '<div class="p_left_right_20">';
				$output .= '<h6 class="nowrap-ellipsis">' . get_the_title() . '</h6>';
				$output .= '<h6 class="time">' . get_the_time('F j, Y') . '</h6>';
				$output .= '<p class="m_bottom_20">' . substr(get_the_excerpt(), 0, $excerpt_size) . '</p>';
				$output .= ' <p>
				<a href="'.get_permalink().'" role="button" class="btn more">'.__( 'read more', 'confidence' ) .'
				<i class="fa fa-long-arrow-right "></i></a></p>';				
			$output .= '</div>';
		$output .= '</div>';
		endwhile; 
		wp_reset_query();
		endif;
		
		$output .='</div></div></div></div></div>';
	return $output;
}
add_shortcode('vc_post_type_carousel', 'confidence_vc_post_type_carousel');

/*-----------------------------------------------------------------------------------*/
/*	Latest Blog
/*-----------------------------------------------------------------------------------*/

function confidence_vc_post_type($atts){
	extract(shortcode_atts(array(
       	'posts'      	=> '3',
       	'categories' 	=> 'all',
		'excerpt_size' 	=> '130',
		'post_types' 	=> 'causes',
		'buttonlink' 	=> '',
		'buttontext' 	=> '',
		'heading' 		=> '',
		'slogan' 		=> ''
     ), $atts));
	
	$args = array(
		'post_type' => ''.$post_types.'',
		'posts_per_page' => $posts,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
    
    if($categories != 'all'){
    	$str = $categories;
    	$arr = explode(',', $str);
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'slug',
			'terms' 	=> $arr
		);
	}

    query_posts( $args );
	
    $output = '';
	$output .= ' <section class="custom-post-type">';
	$output .= ' <div class="container">';
	$output .= ' <div class="row">';
	$output .= ' <div class="clearfix"></div>';
		
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) :
	while ($my_query->have_posts()) : $my_query->the_post();

		$output .= ' <div class="col-md-4 m_bottom_50">'; 
			$output .= ' <div class="custom-inner">'; 
			$img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ,'full' );
			$image = aq_resize( $img_url, 360, true );

			if($image != ''){
				$output .= '<img src="'. $image .'" alt="' . get_the_title() . '" class="img-responsive"/>';
			}

			$output .= ' <div class="content-inner">'; 
				$output .= '<h6 class="nowrap-ellipsis">' . get_the_title() . '</h6>';
				$output .= '<h6 class="time">' . get_the_time('F j, Y') . '</h5>';
				$output .= '<p class="m_bottom_20">' . substr(get_the_excerpt(), 0, $excerpt_size) . '</p>';
				$output .= ' <p><a href="'.get_permalink().'" role="button" class="btn more">'.__( 'read more', 'confidence' ) .'<i class="fa fa-long-arrow-right "></i></a></p>';				
			$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
	
	endwhile;
	endif;
	wp_reset_query();
		
			$output .='</div>';
		$output .='</div>';
	$output .='</section>';
	return $output;
}
add_shortcode('vc_post_type', 'confidence_vc_post_type');

/*-----------------------------------------------------------------------------------*/
/*	h heading
/*-----------------------------------------------------------------------------------*/

function confidence_vc_heading( $atts, $content = null ) {	
    extract( shortcode_atts(array( 
	'id'  => '',
	'heading'  => '',
	'transform'  => 'uppercase',
	'slogan'  => '',
	'number'  => '4',
	'headingcolor' => '',
	'slogancolor' => '',
	'dotcolor' => '',
	"align"  => 'center'
    ), $atts) ); 
  
	$output = '';
	$output .= '<style scoped>';
	$output .= '#'. esc_attr($id) . '.heading-container .section-heading {color: '. esc_attr($headingcolor) . '}';
	$output .= '#'. esc_attr($id) . '.heading-container .section-slogan {color: '. esc_attr($slogancolor) . '}';
	$output .= '#'. esc_attr($id) . '.heading-container .section-heading:before {border-color: '. esc_attr($dotcolor) . '}';
	
	$output .= '</style>';
	$output .= '<div id="'. esc_attr($id) . '"class="align-'. esc_attr($align) . ' '. esc_attr($transform) . ' heading-container">';
	if($heading != ''){ $output .= '<h'. esc_attr($number) . ' class="section-heading">'. esc_html($heading) . '</h'. esc_attr($number) . '>';}
	if($slogan != ''){ $output .= '<p class="section-slogan">'. esc_html($slogan) . '</p>';}
	$output .= '</div>';

	return $output;
}

add_shortcode('vc_heading', 'confidence_vc_heading');

/*-----------------------------------------------------------------------------------*/
/*	h elements
/*-----------------------------------------------------------------------------------*/

function confidence_vc_h_elements( $atts, $content = null ) {	
    extract( shortcode_atts(array( 
	'id'  => '',
	'heading'  => '',
	'transform'  => 'uppercase',
	'slogan'  => '',
	'number'  => '4',
	'headingcolor' => '',
	'slogancolor' => '',
	'dotcolor' => '',
	"align"  => 'center'
    ), $atts) ); 
  
	$output = '';
	$output .= '<style scope>';
	$output .= '#'. esc_attr($id) . '.section-headings {color: '. esc_attr($headingcolor) . '}';
	$output .= '</style>';
	if($heading != ''){ $output .= '<h'. esc_attr($number) . ' id="'. esc_attr($number) . '" class="white-color section-headings">'. esc_html($heading) . '</h'. esc_attr($number) . '>';}

	return $output;
}

add_shortcode('h_elements', 'confidence_vc_h_elements');

/*-----------------------------------------------------------------------------------*/
/*	Latest Blog
/*-----------------------------------------------------------------------------------*/

function confidence_vc_post_type_list($atts){
	extract(shortcode_atts(array(
       	'posts'      => '3',
       	'categories' => 'all',
		'excerpt_size' => '130',
		'post_types' => 'causes',
		'section_id' => '',
		'headingcolor' => '',
		'linkcolor' => '',
		'timecolor' => '',
		'textcolor' => '',
		'heading' => ''
    ), $atts));
    
	$args = array(
		'post_type' => ''.$post_types.'',
		'posts_per_page' => $posts,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
    
    if($categories != 'all'){
    	$str = $categories;
    	$arr = explode(',', $str);
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'slug',
			'terms' 	=> $arr
		);
	}
	
    $output = '';
	$output .= '<style scope>';
	$output .= '.custom-list-heading h4 {color: '. esc_attr($headingcolor) . '}';
	$output .= '.custom-list-heading h5 a {color: '. esc_attr($linkcolor) . '}';
	$output .= '.custom-list-heading .time {color: '. esc_attr($timecolor) . '}';
	$output .= '.custom-list-heading p {color: '. esc_attr($textcolor) . '}';
	$output .= '</style>';
	$output .= ' <div id="'. esc_attr($section_id) . '" class="custom-list-container">';
	
	if($heading != ''){
		$output .= '<div class="m_bottom_40">';
			$output .= '<div class="custom-list-heading">';
				$output .= ' <h4 class="uppercase white-color">'. esc_html($heading) . ' </h4>'; 
			$output .= ' </div>';
		$output .= ' </div>';
	}
	
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) :
	while ($my_query->have_posts()) : $my_query->the_post();

			$output .= ' <div class="m_bottom_25">'; 
				$output .= '<h5><a href="'.get_permalink().'">' . get_the_title() . '</a></h5>';
				$output .= '<h6 class="time">' . get_the_time('F j, Y') . '</h5>';
				$output .= '<p class="m_bottom_40">' . substr(get_the_excerpt(), 0, $excerpt_size) . '</p>';
			$output .= '</div>';
	
	endwhile; 
	else:
	$output ='';
	$output .= "please add custom post types";
	endif;

    wp_reset_query();
		
	$output .='</div>';

	return $output;
}
add_shortcode('vc_post_type_list', 'confidence_vc_post_type_list');

/*-----------------------------------------------------------------------------------*/
/*	confidence testi contianer
/*-----------------------------------------------------------------------------------*/

function confidence_vc_bible_container( $atts, $content = null ) {	
    extract( shortcode_atts(array( 
       "color"  => ''
    ), $atts) ); 


    $output = '';
	$output .= '<style scope>';
	$output .= '.tst-container.white blockquote, .tst-container.white small, .tst-container.white h4 {color: '. esc_attr($color) . '}';
	$output .= '</style>';
	$output .= ' <div class="blockquote-container event-list tst-container white">';
		$output .= '<div class="row-off">';
			$output .= ' <div class="col-md-12">';
				$output .= '<div class="owl-carousel2">';
					$output .= ' '. do_shortcode($content) . '';
				$output .= ' </div>';
			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';
return $output;
}

add_shortcode('vc_bible_container', 'confidence_vc_bible_container');

/*-----------------------------------------------------------------------------------*/
/*	confidence tesi item
/*-----------------------------------------------------------------------------------*/

function confidence_vc_bible( $atts, $content = null ) {	
    extract( shortcode_atts(array( 
       "description"  => '',
       "name"  => '',
       "company"  => '',
       "testi_img"  => ''
    ), $atts) ); 
	
	$output = '';
	$output .= ' <div class="item">';
		$output .= '<blockquote class="blockquote-centered">';
			
			$testi_img = wp_get_attachment_url( $testi_img,'full' );
			$image = aq_resize( $testi_img, 120, 120, true ); 
			if($image != ''){	$output .= '<img src="'.$image.'" alt="' . get_the_title() . '" class="img-responsive"/>';}

			$output .= '  '. esc_attr($description) . '<small class="t-name uppercase">'. esc_html($name) . '</small> ';
			$output .= '<span class="t-company">'. esc_html($company) . '</span> ';
			
		$output .= ' </blockquote>';
	$output .= '</div>';
	return $output;
}

add_shortcode('vc_bible', 'confidence_vc_bible');

/*-----------------------------------------------------------------------------------*/
/*	confidence tesi item
/*-----------------------------------------------------------------------------------*/

function confidence_vc_contact( $atts, $content = null ) {	
    extract( shortcode_atts(array( 
		"heading"  => '',
		"adress"  => '',
		"phone"  => '',
		"fax"  => '',
		"hr"  => '',
		"mail"  => ''
    ), $atts) ); 
  
   $output = '';

		if($heading != ''){
			$output .= '<div class="col-md-6-off"><h5>'. esc_html($heading) . '</h5>';
		}
		$output .= '<div class="row">';
			if($adress != ''){
				 $output .= '<div class="col-lg-6">';
			 $output .= ''. esc_attr($adress) . '';
			 $output .= '</div>';
			}
			 $output .= '<div class="col-lg-6">';
			if($phone != ''){
			 $output .= '	<div class="information">'. esc_html($phone) . '</div>';
			}
			if($heading != ''){ 
			$output .= '<div class="information">'. esc_html($fax) . '</div>';
			}
		if($mail != ''){	
		$output .= ' <a href="mailto:'. esc_attr($mail) . '">'. esc_html($mail) . '</a>';
		}
			 $output .= '</div>';
			 $output .= '</div>';
		if($hr != 'hidden'){	 $output .= '<hr>'; }
	 $output .= '</div>';
		
	return $output;
}

add_shortcode('vc_contact', 'confidence_vc_contact');



/*-----------------------------------------------------------------------------------*/
/*	confidence services container
/*-----------------------------------------------------------------------------------*/

function confidence_vc_counter_container( $atts, $content = null ) {	
    $out = '';
	$out .= ' <div id="milestone" class="milestone">';
		$out .= '<div class="container_off">';
		 $out .= '<div class="row_off">';
			 $out .= '<div class="col-lg-9 col-lg-offset-2 text-center">';
				$out .= ' <div class="row">';
				   $out .= ''. do_shortcode($content) . '';  
				$out .= ' </div>';
			 $out .= '</div>';
		 $out .= '</div>';
		$out .= ' </div>';
	$out .= '</div>';
	return $out;	
}

add_shortcode('vc_counter_container', 'confidence_vc_counter_container');

/*-----------------------------------------------------------------------------------*/
/*	confidence milestone
/*-----------------------------------------------------------------------------------*/

function confidence_vc_milestone( $atts, $content = null ) {	
    extract( shortcode_atts(array(       
        "data"      => '',
        "dataspeed"   => '',
        "heading"   => '',
		'icon_fontawesome'      => '',	
        "icon"   => ''
    ), $atts) ); 
	
	$out = '';
	$out .= '<div class="fact col-xs-12 col-md-6 col-sm-6 col-lg-3">';
	$out .= '<h6 class="timer" data-to="'.$data.'" data-speed="'.$dataspeed.'"></h6>';
	$out .= '<p>'.$heading.'</p>';
	$out .= '<div class="i_container">';
	if($icon_fontawesome == true) {
		$out .= '<i class="'.$icon_fontawesome.'"></i>';
	}
	$out .= '</div>';
	$out .= '</div>';
	return $out;	
}

add_shortcode('vc_milestone', 'confidence_vc_milestone');
?>