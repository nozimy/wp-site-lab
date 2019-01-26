<?php
/*-----------------------------------------------------------------------------------*/
/*	Define Metabox Fields
/*-----------------------------------------------------------------------------------*/

if (class_exists('RevSlider')) {
	$theslider     = new RevSlider();
	$arrSliders = $theslider->getArrSliders();
	$arrA     = array();
	$arrT     = array();
	foreach($arrSliders as $slider){
		$arrA[]     = $slider->getAlias();
		$arrT[]     = $slider->getTitle();
	}
	if($arrA && $arrT){
		$all_rev_sliders = array_combine($arrA, $arrT);
	}
	else {
		$all_rev_sliders[0] = 'No Sliders Found';
	}
}

$prefix = 'ecobox_';

if(class_exists('RevSlider')) {

	$meta_box_pages = array(
		'id' => 'ecobox-meta-box-pages',
		'title' =>  __('Page Appearance', 'ecobox'),
		'page' => 'page',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
			   'name' => __('Page Title', 'ecobox'),
			   'desc' => __('You can enable or disable page title.', 'ecobox'),
			   'id' => $prefix . 'page_title',
			   'type' => 'select',
			   'options' => array('Show', 'Hide'),
			),
			array(
			   'name' => __('Slider', 'ecobox'),
			   'desc' => __('You can enable or disable slider.', 'ecobox'),
			   'id' => $prefix . 'page_slider',
			   'type' => 'select',
			   'std' => 'Hide',
			   'options' => array('Hide', 'Show'),
			),
			array(
				'name' => __('Select Slider', 'ecobox'),
				'desc' => __('Choose which slider to display.', 'ecobox'),
				'id' => $prefix . 'page_slider_select',
				'type' => 'select',
				'std' => 'Select Slider',
				'options' => $all_rev_sliders
			)
		)
	);

} else {

	$meta_box_pages = array(
		'id' => 'ecobox-meta-box-pages',
		'title' =>  __('Page Appearance', 'ecobox'),
		'page' => 'page',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
			   'name' => __('Page Title', 'ecobox'),
			   'desc' => __('You can enable or disable page title.', 'ecobox'),
			   'id' => $prefix . 'page_title',
			   'type' => 'select',
			   'options' => array('Show', 'Hide')
			),
			array(
			   'name' => __('Slider', 'ecobox'),
			   'desc' => __('You can enable or disable slider.', 'ecobox'),
			   'id' => $prefix . 'page_slider',
			   'type' => 'select',
			   'std' => 'Hide',
			   'options' => array('Hide', 'Show')
			)
		)
	);

}

add_action('admin_menu', 'ecobox_add_box_pages');


/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/
 
function ecobox_add_box_pages() {
	global $meta_box_pages;

	// Get the Post ID
	if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
	elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
	if( !isset( $post_id ) ) return;

	add_meta_box($meta_box_pages['id'], $meta_box_pages['title'], 'ecobox_show_box_pages', $meta_box_pages['page'], $meta_box_pages['context'], $meta_box_pages['priority']);
	
}


/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function ecobox_show_box_pages() {
	global $meta_box_pages, $post;
 	
	// Use nonce for verification
	echo '<input type="hidden" name="ecobox_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_pages['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;

			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;
			
			//If Select	
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select id="' . $field['id'] . '" name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break; 
			
		}

	}
 
	echo '</table>';
}
 
add_action('save_post', 'ecobox_save_data_pages');


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function ecobox_save_data_pages($post_id) {
	global $meta_box_pages;
 
	// verify nonce
	if ( !isset($_POST['ecobox_meta_box_nonce']) || !wp_verify_nonce( $_POST['ecobox_meta_box_nonce'], basename(__FILE__) )) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($meta_box_pages['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
}