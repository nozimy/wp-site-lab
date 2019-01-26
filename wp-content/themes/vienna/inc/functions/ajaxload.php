<?php

/**
 * Ajax Gallery
 * V.1.0
 * 
 */
function myAjaxGallery(){

    $postID = $_POST['id'];
    if (isset($_POST['id'])){
        $post_id = $_POST['id'];
    }else{
        $post_id = "";
    }

    global $post;
    $post = get_post($postID);
    $img_url = wp_get_attachment_url($postID);
    $currenturl = get_the_permalink($postID);
    $title = get_the_title($postID);

    $response = array( 
        'sucess' => true, 
        'post' => $post,
        'id' => $postID , 
        'img_url' => $img_url , 
        'thisurl' => $currenturl , 
        'title' => $title , 
    );
    
    
    // generate the response
    print json_encode($response);

    // IMPORTANT: don't forget to "exit"
    exit;
}

add_action('wp_ajax_nopriv_zl_gallery', 'myAjaxGallery');
add_action('wp_ajax_zl_gallery', 'myAjaxGallery');


/**
 * Portfolio Ajax Loader
 * V.1.0
 * 
 */
function portfolioGallery(){

   
    ob_start();
    global $post;
    $postID = $_POST['id'];
    if (isset($_POST['id'])){
        $post_id = $_POST['id'];
    }else{
        $post_id = "";
    }
    $post = get_post($postID);
    $img_url = wp_get_attachment_url(get_post_thumbnail_id($postID));
    $currenturl = get_the_permalink($postID);
    $title = get_the_title($postID);
    //Include the file
    require 'portfoliodetail.php';
    $html = ob_get_clean();
    $response = array( 
        'sucess' => true, 
        'post' => $post,
        'id' => $postID , 
        'img_url' => $img_url , 
        'thisurl' => $currenturl , 
        'title' => $title , 
        'html' => $html , 
    );
    
    
    // generate the response
    print json_encode($response);

    // IMPORTANT: don't forget to "exit"
    exit;
}

add_action('wp_ajax_nopriv_zl_portfolio', 'portfolioGallery');
add_action('wp_ajax_zl_portfolio', 'portfolioGallery');




 
 
 
 ?>