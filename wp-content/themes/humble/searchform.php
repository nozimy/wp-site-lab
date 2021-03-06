<?php
/**
 * Humble Search Form.
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
 ?>
 <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" placeholder="<?php echo esc_attr_x( 'Type and hit enter...', 'placeholder', 'humble' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
       	<input class="button" type="submit" value="Search" />
 </form>
