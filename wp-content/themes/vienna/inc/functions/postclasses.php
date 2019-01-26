<?php 

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since Dichan 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function zatolab_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'zatolab_post_classes' );

?>