<?php
/**
 * The template for displaying search results.
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
 get_header(); ?>

		<div id="humble-content" class="section">

            <div class="archive-title-wrap">

                <span><?php echo esc_html__( 'Search Results For', 'humble' ); ?></span>

                <h1><?php echo esc_html( get_search_query() ); ?></h1>

            </div>

			<div class="block">

				<div class="container">

					<div class="row">

						<main id="main" class="<?php echo esc_attr(humble_content_class());?>">

							<div class="humble-blog">

								<div class="<?php echo esc_attr(humble_post_class());?>">

										<?php if ( have_posts() ) {

											global $wp_query;

											// First Post Standard Then Grid or List
											if ( ( get_theme_mod( 'archive_layout', 'std' ) === '1std&grid'  || get_theme_mod( 'archive_layout', 'std' ) === '1std&list' ) && ! is_paged() ) {
												the_post();
                                                get_template_part( 'parts/content' );
											}
											/**
											 * Grid post style
											 */
											if ( get_theme_mod( 'archive_layout', 'std' ) === 'grid' || get_theme_mod( 'archive_layout', 'std' ) === '1std&grid' ) { ?>
                                                <div class="masonary">
    												<?php while ( have_posts() ) {
    													the_post();
                                                        get_template_part( 'parts/content', 'grid' );
    												} ?>
                                                </div>
                                            <?php
											}
											/**
											 * List post style
											 */
											else if ( get_theme_mod( 'archive_layout', 'std' ) === 'list' || get_theme_mod( 'archive_layout', 'std' ) === '1std&list' ) {
												while ( have_posts() ) {
													the_post();
													get_template_part( 'parts/content', 'list' );
												}
											}
                                            /**
											 * Standard post style
											 */
											else {
												while ( have_posts() ) {
													the_post();
													get_template_part( 'parts/content' );
												}
											}
                                            /**
											 * Page Navigation
											 */
											humble_pagination();

										} else {
                                        /**
                                         * Content None
                                         */
											get_template_part( 'parts/content', 'none' );
										}
                                    ?>

                                </div>

							</div>

						</main>

						<aside class="<?php echo esc_attr(humble_sidebar_class());?>">

							<?php get_sidebar();?>

						</aside>

					</div>

				</div>

			</div>

		</div>

<?php get_footer(); ?>
