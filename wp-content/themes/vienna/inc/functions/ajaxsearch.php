<?php 


function my_search() {
		$term = strtolower( $_GET['term'] );
		$suggestions = array();
		
		$loop = new WP_Query( 's=' . $term );
		if($loop->have_posts()){
			while( $loop->have_posts() ) {
				$loop->the_post();
				$suggestion = array();
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url( $thumb,'full' ); 
				$image = zl_theme_thumb($img_url, 80, 80, 'c', false);
				$suggestion['label'] = get_the_title();
				$suggestion['link'] = get_permalink();
				$suggestion['desc'] = get_the_excerpt();
				/*if($image){
					$suggestion['thumb'] = $image;
				} else {
					$suggestion['thumb'] = 'http://placehold.it/100x100/000000/000000';
				}*/
				$suggestion['thumb'] = $image;
				$suggestions[] = $suggestion;
			}
		} else {
			$suggestion['label'] = 'There are no keyword of "'.$term.'"';
			$suggestion['link'] = '?s='.$term;
			$suggestion['desc'] = 'Please try with different keyword';
			$suggestions[] = $suggestion;
		}
		
		wp_reset_query();
    	
    	
    	$response = json_encode( $suggestions );
    	echo $response;
    	exit();
}

add_action( 'wp_ajax_my_search', 'my_search' );
add_action( 'wp_ajax_nopriv_my_search', 'my_search' );