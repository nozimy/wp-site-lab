<?php
/**
 * Main Sidebar Template
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
 ?>

<?php if ( is_active_sidebar( 'main_sidebar' )  ) : ?>
		<?php dynamic_sidebar( 'main_sidebar' ); ?>
<?php endif; ?>
