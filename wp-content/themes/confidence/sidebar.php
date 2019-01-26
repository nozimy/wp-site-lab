<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage confidence
 * @since confidence 1.0
 */

if (  is_active_sidebar( 'sidebar-1' )  ) : ?>


		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<div id="widget-area" class="widget-area col-lg-3 col-md-3 col-sm-3 sidebar">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>


<?php endif; ?>
