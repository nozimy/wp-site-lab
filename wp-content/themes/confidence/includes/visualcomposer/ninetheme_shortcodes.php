<?php


/*-----------------------------------------------------------------------------------*/
/*	Shortcode Filter
/*-----------------------------------------------------------------------------------*/

vc_set_as_theme( $disable_updater = false ); 
vc_is_updater_disabled();

function agen_vc_remove_woocommerce() {
    if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        vc_remove_element( 'woocommerce_cart' );
        vc_remove_element( 'woocommerce_checkout' );
        vc_remove_element( 'woocommerce_order_tracking' );
        vc_remove_element( 'woocommerce_my_account' );
        vc_remove_element( 'recent_products' );
        vc_remove_element( 'featured_products' );
        vc_remove_element( 'product' );
        vc_remove_element( 'products' );
        vc_remove_element( 'add_to_cart' );
        vc_remove_element( 'add_to_cart_url' );
        vc_remove_element( 'product_page' );
        vc_remove_element( 'product_category' );
        vc_remove_element( 'product_categories' );
        vc_remove_element( 'sale_products' );
        vc_remove_element( 'best_selling_products' );
        vc_remove_element( 'top_rated_products' );
        vc_remove_element( 'product_attribute' );
        vc_remove_element( 'related_products' );
    }
}
// Hook for admin editor.
add_action( 'vc_build_admin_page', 'agen_vc_remove_woocommerce', 11 );
// Hook for frontend editor.
add_action( 'vc_load_shortcode', 'agen_vc_remove_woocommerce', 11 );

vc_remove_element(  "vc_wp_search");
vc_remove_element(  "vc_wp_meta" );
vc_remove_element(  "vc_wp_recentcomments" );
vc_remove_element(  "vc_wp_calendar" );
vc_remove_element(  "vc_wp_pages" );
vc_remove_element(  "vc_wp_tagcloud" );
vc_remove_element(  "vc_wp_custommenu" );
vc_remove_element(  "vc_wp_text" );
vc_remove_element(  "vc_wp_posts" );
vc_remove_element(  "vc_wp_categories" );
vc_remove_element(  "vc_wp_archives" );
vc_remove_element(  "vc_wp_rss" );
vc_remove_element(  "vc_flickr" );
vc_remove_element(  "vc_facebook" );
vc_remove_element(  "vc_tweetmeme" );
vc_remove_element(  "vc_googleplus" );
vc_remove_element(  "vc_pinterest" );



/*-----------------------------------------------------------------------------------*/
/*	blog
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'events_slider_integrateWithVC' );
function events_slider_integrateWithVC() {
   vc_map( 
		array(
			"name" => esc_html__( "Event slider", "confidence" ),
			"base" => "events_slider",
			"icon"                   => "icon-wpb-row",
			"category" => esc_html__( "Theme", "confidence"),
			"params" => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'heading', 'confidence' ),
					'param_name' => 'heading',
					"description" => esc_html__("Add Your heading", "confidence"),
				),
				 array(
					'type' => 'textfield',
					'heading' => esc_html__( 'slogan', 'confidence' ),
					'param_name' => 'slogan',
					"description" => esc_html__("Add your slogan", "confidence"),
				), 

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'button link', 'confidence' ),
					'param_name' => 'buttonlink',
					"description" => esc_html__("Add your see more button link", "confidence"),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'button text', 'confidence' ),
					'param_name' => 'buttontext',
					"description" => esc_html__("Add your see more button text", "confidence"),
				),
			),
		) 
	);
}class WPBakeryShortCode_events_slider extends WPBakeryShortCode {}

/*-----------------------------------------------------------------------------------*/
/*	blog
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'vc_post_type_integrateWithVC' );
function vc_post_type_integrateWithVC() {
   vc_map( array(
		"name" 		=> esc_html__( "Custom post type", "confidence" ),
		"base" 		=> "vc_post_type",
		"icon"        => "icon-wpb-row",
		"category" 	=> esc_html__( "Theme", "confidence"),
		"params" 		=> array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'heading', 'confidence' ),
            'param_name' => 'heading',
            "description" => esc_html__("Add Your heading", "confidence"),
        ),
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'slogan', 'confidence' ),
            'param_name' => 'slogan',
            "description" => esc_html__("Add your slogan", "confidence"),
        ), 
		
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'button link', 'confidence' ),
            'param_name' => 'buttonlink',
            "description" => esc_html__("Add your see more button link", "confidence"),
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'button text', 'confidence' ),
            'param_name' => 'buttontext',
            "description" => esc_html__("Add your see more button text", "confidence"),
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'post types', 'confidence' ),
            'param_name' => 'post_types',
            "description" => esc_html__("Add your post type slug : causes, team, sermon, prayer, program, ministry", "confidence"),
        ),
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Section ID', 'confidence' ),
            'param_name' => 'sectionid',
            "description" => esc_html__("Add Your Section ID", "confidence"),
        ),
	
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Post Count', 'confidence' ),
            'param_name' => 'posts',
            "description" => esc_html__("Set Post Count", "confidence"),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Category', 'confidence' ),
            'param_name' => 'categories',
            "description" => esc_html__("You can add your custom post type category name.", "confidence"),
        ),
		
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'excerpt size', 'confidence' ),
            'param_name' => 'excerpt_size',
            "description" => esc_html__("Excerpt size for custom post type content text", "confidence"),
        ),


      ),
   ) );
}
class WPBakeryShortCode_vc_post_type extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	blog list
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'vc_post_type__list_integrateWithVC' );
function vc_post_type__list_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Custom list post type", "confidence" ),
      "base" => "vc_post_type_list",
	  "icon"                   => "icon-wpb-row",
	  "category" => esc_html__( "Theme", "confidence"),
      "params" => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'heading', 'confidence' ),
            'param_name' => 'heading',
            "description" => esc_html__("Add Your heading", "confidence"),
        ),

		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'post types', 'confidence' ),
            'param_name' => 'post_types',
            "description" => esc_html__("Add your post type slug : causes, team, sermon, prayer, program, ministry", "confidence"),
        ),
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Section ID', 'confidence' ),
            'param_name' => 'sectionid',
            "description" => esc_html__("Add Your Section ID", "confidence"),
        ),
	
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Post Count', 'confidence' ),
            'param_name' => 'posts',
            "description" => esc_html__("Set Post Count", "confidence"),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Category', 'confidence' ),
            'param_name' => 'categories',
            "description" => esc_html__("You can add your custom post type category name.", "confidence"),
        ),
		
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'excerpt size', 'confidence' ),
            'param_name' => 'excerpt_size',
            "description" => esc_html__("Excerpt size for custom post type content text", "confidence"),
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => esc_html__("heading color", 'confidence'),
            "param_name" => "headingcolor",
            "description" => esc_html__("Add custom heading color", 'confidence'),
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => esc_html__("post heading link color", 'confidence'),
            "param_name" => "linkcolor",
            "description" => esc_html__("Add custom post heading link color", 'confidence'),
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => esc_html__("post time color", 'confidence'),
            "param_name" => "timecolor",
            "description" => esc_html__("Add custom post time color", 'confidence'),
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => esc_html__("post text color", 'confidence'),
            "param_name" => "textcolor",
            "description" => esc_html__("Add custom post text color", 'confidence'),
        ),


      ),
   ) );
}
class WPBakeryShortCode_vc_post_type_list extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	about us 2
/*-----------------------------------------------------------------------------------*/


	vc_map( array(
		"name" 				=> esc_html__("Testimonial", "confidence"),
		"base" 				=> "vc_bible_container",
		"icon"                   => "icon-wpb-row",
		"as_parent"			=> array('only' => 'vc_bible'),
		"content_element"   => true,
		"show_settings_on_create" => true,
		"category" 			=> esc_html__( "Theme", "confidence"),
		"params" 			=> array(
        
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'heading', 'confidence' ),
            'param_name' => 'heading',
            "description" => esc_html__("Add Your heading", "confidence"),
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => esc_html__("text color", "confidence"),
            "param_name" => "color",
            "description" => esc_html__("select text color", "confidence"),
        ),
		
    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => esc_html__("Testimonial item", "confidence"),
    "base" => "vc_bible",
    "content_element" => true,
    "as_child" => array('only' => 'vc_bible_container'), 
    "params" => array(
       
	array(
		"type" => "attach_image",
		"heading" => esc_html__("image", "confidence"),
		"param_name" => "testi_img",
		"description" => esc_html__("Add image", "confidence"),
	),
	array(
		"type" => "textarea",
		"heading" => esc_html__("description", "confidence"),
		"param_name" => "description",
		"description" => esc_html__("Add description", "confidence"),
	),
	
	array(
		"type" => "textfield",
		"heading" => esc_html__("name", "confidence"),
		"param_name" => "name",
		"description" => esc_html__("Add name", "confidence"),
	),
	
	array(
		"type" => "textfield",
		"heading" => esc_html__("company", "confidence"),
		"param_name" => "company",
		"description" => esc_html__("Add company name", "confidence"),
	),

    )
) );


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_vc_bible_container extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_vc_about_two_item extends WPBakeryShortCode {
    }
}


/*-----------------------------------------------------------------------------------*/
/*	blog
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'vc_post_type__carousel_integrateWithVC' );
function vc_post_type__carousel_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Custom post type carousel", "confidence" ),
      "base" => "vc_post_type_carousel",
	  "icon"                   => "icon-wpb-row",
	  "category" => esc_html__( "Theme", "confidence"),
      "params" => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'heading', 'confidence' ),
            'param_name' => 'heading',
            "description" => esc_html__("Add Your heading", "confidence"),
        ),
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'slogan', 'confidence' ),
            'param_name' => 'slogan',
            "description" => esc_html__("Add your slogan", "confidence"),
        ), 
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Background Color', 'confidence' ),
			'param_name' => 'bg_black',
			'value' => array(
				esc_html__( 'Select bg color', 'confidence' ) => 'disable',
				esc_html__( 'white', 'confidence' ) => 'white',
				esc_html__( 'dark', 'confidence' ) => 'dark'
			),
			'description' => esc_html__( 'Select Background Color', 'confidence' ),
		),
		
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'button link', 'confidence' ),
            'param_name' => 'buttonlink',
            "description" => esc_html__("Add your see more button link", "confidence"),
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'button text', 'confidence' ),
            'param_name' => 'buttontext',
            "description" => esc_html__("Add your see more button text", "confidence"),
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'post types', 'confidence' ),
            'param_name' => 'post_types',
            "description" => esc_html__("Add your post type slug : causes, team, sermon, prayer, program, ministry", "confidence"),
        ),
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Section ID', 'confidence' ),
            'param_name' => 'sectionid',
            "description" => esc_html__("Add Your Section ID", "confidence"),
        ),
	
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Post Count', 'confidence' ),
            'param_name' => 'posts',
            "description" => esc_html__("Set Post Count", "confidence"),
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Category', 'confidence' ),
            'param_name' => 'categories',
            "description" => esc_html__("You can add your custom post type category name.", "confidence"),
        ),
		
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'excerpt size', 'confidence' ),
            'param_name' => 'excerpt_size',
            "description" => esc_html__("Excerpt size for custom post type content text", "confidence"),
        ),


      ),
   ) );
}
class WPBakeryShortCode_vc_post_type_carousel extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	contact
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'vc_contact_integrateWithVC' );
function vc_contact_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Contact right", "confidence" ),
      "base" => "vc_contact",
	  "icon"                   => "icon-wpb-row",
	  "category" => esc_html__( "Theme", "confidence"),
      "params" => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'heading', 'confidence' ),
            'param_name' => 'heading',
            "description" => esc_html__("Add Your heading", "confidence"),
        ),
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'adress', 'confidence' ),
            'param_name' => 'adress',
            "description" => esc_html__("Add your adress", "confidence"),
        ), 
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'phone', 'confidence' ),
            'param_name' => 'phone',
            "description" => esc_html__("Add your phone", "confidence"),
        ), 
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'fax', 'confidence' ),
            'param_name' => 'fax',
            "description" => esc_html__("Add your fax", "confidence"),
        ), 
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'mail', 'confidence' ),
            'param_name' => 'mail',
            "description" => esc_html__("Add your mail", "confidence"),
        ), 
		
			
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Bottom hr / line', 'confidence' ),
			'param_name' => 'hr',
			'value' => array(
				esc_html__( 'Select hr visibility', 'confidence' ) => 'disable',
				esc_html__( 'visible', 'confidence' ) => 'visible',
				esc_html__( 'hidden', 'confidence' ) => 'hidden'
			),
			'description' => esc_html__( 'Select hr visibility', 'confidence' ),
		),


      ),
   ) );
}
class WPBakeryShortCode_vc_contact extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	blog
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'vc_heading_integrateWithVC' );
function vc_heading_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Section heading", "confidence" ),
      "base" => "vc_heading",
	  "icon"                   => "icon-wpb-row",
	  "category" => esc_html__( "Theme", "confidence"),
      "params" => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'unique id', 'confidence' ),
            'param_name' => 'id',
            "description" => esc_html__("If you want to use color options please create unique id. example : section1", "confidence"),
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'heading', 'confidence' ),
            'param_name' => 'heading',
            "description" => esc_html__("Add Your heading", "confidence"),
        ),
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'slogan', 'confidence' ),
            'param_name' => 'slogan',
            "description" => esc_html__("Add your slogan", "confidence"),
        ), 
	
		
			
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Heading number', 'confidence' ),
			'param_name' => 'number',
			'value' => array(
				esc_html__( 'Select number', 'confidence' ) => 'disable',
				esc_html__( 'H1', 'confidence' ) => '1',
				esc_html__( 'H2', 'confidence' ) => '3',
				esc_html__( 'H3', 'confidence' ) => '3',
				esc_html__( 'H4', 'confidence' ) => '4',
				esc_html__( 'H5', 'confidence' ) => '5',
				esc_html__( 'H6', 'confidence' ) => '6'
				
			),
			'description' => esc_html__( 'Select heading number', 'confidence' ),
		),	
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Heading align', 'confidence' ),
			'param_name' => 'align',
			'value' => array(
				esc_html__( 'Select align', 'confidence' ) => 'disable',
				esc_html__( 'center', 'confidence' ) => 'center',
				esc_html__( 'left', 'confidence' ) => 'left',
				esc_html__( 'right', 'confidence' ) => 'right'
				
			),
			'description' => esc_html__( 'Select heading number', 'confidence' ),
		),	
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Heading transform', 'confidence' ),
			'param_name' => 'transform',
			'value' => array(
				esc_html__( 'Select transform', 'confidence' ) => 'none',
				esc_html__( 'lowercase', 'confidence' ) => 'lowercase',
				esc_html__( 'uppercase', 'confidence' ) => 'uppercase',
				esc_html__( 'capitalize', 'confidence' ) => 'capitalize'
				
			),
			'description' => esc_html__( 'Select heading number', 'confidence' ),
		),
		
		array(
            "type" => "colorpicker",
            "heading" => esc_html__("heading color", 'confidence'),
            "param_name" => "headingcolor",
            "description" => esc_html__("Add custom heading color", 'confidence'),
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => esc_html__("slogan color", 'confidence'),
            "param_name" => "slogancolor",
            "description" => esc_html__("Add custom slogan color", 'confidence'),
        ),
		
		array(
            "type" => "colorpicker",
            "heading" => esc_html__("heading point left color", 'confidence'),
            "param_name" => "dotcolor",
            "description" => esc_html__("Add custom heading point left color", 'confidence'),
        ),


      ),
   ) );
}
class WPBakeryShortCode_vc_heading extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	about us 1
/*-----------------------------------------------------------------------------------*/


	vc_map( array(
		"name" 				=> esc_html__("Counter", "confidence"),
		"base" 				=> "vc_counter_container",
		"icon"                   => "icon-wpb-row",
		"as_parent"			=> array('only' => 'vc_milestone'),
		"content_element"   => true,
		"show_settings_on_create" => true,
		"category" 			=> esc_html__( "Theme", "confidence"),
		"params" 			=> array(
        // add params same as with any other content element
		
		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Section ID', 'confidence' ),
            'param_name' => 'sectionid',
            "description" => esc_html__("Add Your Section ID", "confidence"),
        ),

    ),
    "js_view" => 'VcColumnView'
) );

vc_map( array(
    "name" => esc_html__("Counter item", "confidence"),
    "base" => "vc_milestone",
    "content_element" => true,
    "as_child" => array('only' => 'vc_counter_container'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        // add params same as with any other content element

	array(
			'type' => 'checkbox',
			'param_name' => 'add_icon',
			'heading' => esc_html__( 'Add icon?', 'confidence' ),
			'description' => esc_html__( 'Add icon next to section title.', 'confidence' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'confidence' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'add_icon',
				'value' => 'true',
			),
			'description' => esc_html__( 'Select icon from library.', 'confidence' ),
		),

	
	array(
		"type" => "textfield",
		"heading" => esc_html__("data end number", "confidence"),
		"param_name" => "data",
		
		"description" => esc_html__("Add Your data end number", "confidence"),
	),
	array(
		"type" => "textfield",
		"heading" => esc_html__("data speed", "confidence"),
		"param_name" => "dataspeed",
		
		"description" => esc_html__("Add Your data speed", "confidence"),
	),
       
	array(
		"type" => "textfield",
		"heading" => esc_html__("counter name", "confidence"),
		"param_name" => "heading",
		
		"description" => esc_html__("Add Your counter name", "confidence"),
	),
       


    )
) );


//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_vc_counter_container extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_vc_milestone extends WPBakeryShortCode {
    }
}

/*-----------------------------------------------------------------------------------*/
/*	blog
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'h_elements_integrateWithVC' );
function h_elements_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "H elements", "confidence" ),
      "base" => "h_elements",
	  "icon"                   => "icon-wpb-row",
	  "category" => esc_html__( "Theme", "confidence"),
      "params" => array(

		 array(
            'type' => 'textfield',
            'heading' => esc_html__( 'unique id', 'confidence' ),
            'param_name' => 'id',
            "description" => esc_html__("If you want to use color options please create unique id. example : section1", "confidence"),
        ),
		
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'text', 'confidence' ),
            'param_name' => 'heading',
            "description" => esc_html__("Add Your text", "confidence"),
        ),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Heading number', 'confidence' ),
			'param_name' => 'number',
			'value' => array(
				esc_html__( 'Select number', 'confidence' ) => 'disable',
				esc_html__( 'H1', 'confidence' ) => '1',
				esc_html__( 'H2', 'confidence' ) => '3',
				esc_html__( 'H3', 'confidence' ) => '3',
				esc_html__( 'H4', 'confidence' ) => '4',
				esc_html__( 'H5', 'confidence' ) => '5',
				esc_html__( 'H6', 'confidence' ) => '6'
				
			),
			'description' => esc_html__( 'Select heading number', 'confidence' ),
		),	
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Heading align', 'confidence' ),
			'param_name' => 'align',
			'value' => array(
				esc_html__( 'Select align', 'confidence' ) => 'disable',
				esc_html__( 'center', 'confidence' ) => 'center',
				esc_html__( 'left', 'confidence' ) => 'left',
				esc_html__( 'right', 'confidence' ) => 'right'
				
			),
			'description' => esc_html__( 'Select heading number', 'confidence' ),
		),	
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Heading transform', 'confidence' ),
			'param_name' => 'transform',
			'value' => array(
				esc_html__( 'Select transform', 'confidence' ) => 'none',
				esc_html__( 'lowercase', 'confidence' ) => 'lowercase',
				esc_html__( 'uppercase', 'confidence' ) => 'uppercase',
				esc_html__( 'capitalize', 'confidence' ) => 'capitalize'
				
			),
			'description' => esc_html__( 'Select heading number', 'confidence' ),
		),
		
		array(
            "type" => "colorpicker",
            "heading" => esc_html__("heading color", 'confidence'),
            "param_name" => "headingcolor",
            "description" => esc_html__("Add custom heading color", 'confidence'),
        ),


      ),
   ) );
}
class WPBakeryShortCode_vc_h_elements extends WPBakeryShortCode {
}


// Filter to replace default css class names for vc_row shortcode and vc_column
add_filter( 'vc_shortcodes_css_class', 'ninetheme_confidence_custom_css_classes', 10, 2 );
function ninetheme_confidence_custom_css_classes( $class_string, $tag ) {
  if ( $tag == 'vc_row_inner' ) { 
    $class_string = str_replace( 'vc_row-fluid', 'nt-fixed container', $class_string );
  }

  return $class_string; 
}


?>