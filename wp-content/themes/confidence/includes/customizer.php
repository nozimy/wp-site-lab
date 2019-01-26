<?php
/**
 * Initialize the Theme Customizer.
 */
add_action( 'customize_register', 'ninetheme_confidence_custom_css_classes_customize_register' );
/**
 * Theme Customizer demo code.
 *
 * @return    void
 * @since     2.3.0
 */
function ninetheme_confidence_custom_css_classes_customize_register( $wp_customize ) {
  
  /**
   * Remove built-in options
   */
  $wp_customize->remove_section( 'title_tagline' );
  $wp_customize->remove_section( 'static_front_page' );
  
}