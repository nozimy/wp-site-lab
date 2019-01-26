<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12'); ?>>

	<div class="humble-post">

		<div class="post-content notfound">

            <h1><?php echo esc_html_e( 'Nothing Found', 'humble' ); ?></h1>

            <?php if ( is_search() ) : ?>

                <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'humble' ); ?></p>

                <?php get_search_form(); ?>

            <?php else : ?>

                <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'humble' ); ?></p>

                <?php get_search_form(); ?>

            <?php endif; ?>

		</div>

	</div>

</article>
