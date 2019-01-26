<?php 
	
/**
 * Register three Dichan widget areas.
 *
 * @since Dichan 1.0
 *
 * @return void
 */
function zatolab_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'zatolab' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the right.', 'zatolab' ),
		'before_widget' => '<aside id="sidewid-%1$s" class="zl_m_widget_item %2$s">',
		'after_widget'  => '</div></aside><div class="clear"></div>',
		'before_title'  => '<h3 class="zl_m_widgetit"><span>',
		'after_title'   => '</span></h3><div class="zl_m_w_inner">',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'zatolab' ),
		'id'            => 'footer-widget',
		'description'   => __( 'Main sidebar that appears on the right.', 'zatolab' ),
		'before_widget' => '<div class="large-12 column" id="foowid-%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="zl_foowidtit"><span>',
		'after_title'   => '</span></h4>',
	) );
	
}
add_action( 'widgets_init', 'zatolab_widgets_init' );

?>