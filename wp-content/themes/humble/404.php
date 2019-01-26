<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
 get_header(); ?>

<div class="section">

    <div class="block">

        <div class="container">

            <div class="row">

                <main id="main" class="col-md-12">

					<div class="error-page">

						<h1><?php esc_html_e( '404', 'humble' ); ?></h1>

						<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'humble' ); ?></p>

                        <p><a class="backtohome" href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e( 'Back To Homepage', 'humble' ); ?></a></p>

					</div>

                 </main>

            </div>

         </div>

     </div>

</div>

<?php get_footer(); ?>
