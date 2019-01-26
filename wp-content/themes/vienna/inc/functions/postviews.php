<?php 
/*-----------------------------------------------------------------------------------*/
// Ad Post view count
/*-----------------------------------------------------------------------------------*/
// function to display number of posts.
function zl_getPostViews($postID){
	$count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

// function to count views.
function zl_setPostViews($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'zl_posts_column_views');
add_action('manage_posts_custom_column', 'zl_posts_custom_column_views',5,2);
function zl_posts_column_views($defaults){
    $defaults['post_views'] = __('Views', 'zatolab');
    return $defaults;
}
function zl_posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
        echo zl_getPostViews(get_the_ID());
    }
}
?>