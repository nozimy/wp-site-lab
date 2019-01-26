<?php
/**
 * The template for displaying archive pages.
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

            <?php
                if ( is_category() ) :
                    echo _e( '<span>Category</span>', 'humble' );
                    printf( __( '<h1>%s</h1>', 'humble' ), single_cat_title('', false) );

                elseif ( is_author() ) :
                    echo _e( '<span>All Posts By</span>', 'humble' );
                    printf( __( '<h1>%s</h1>', 'humble' ), get_the_author() );

                elseif ( is_day() ) :
                    echo _e( '<span>Daily Archives</span>', 'humble' );
                    printf( __( '<h1>%s</h1>', 'humble' ), get_the_date() );

                elseif ( is_month() ) :
                    echo _e( '<span>Monthly Archives</span>', 'humble' );
                    printf( __( '<h1>%s</h1>', 'humble' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'humble' ) ) );

                elseif ( is_year() ) :
                    echo _e( '<span>Yearly Archives</span>', 'humble' );
                    printf( __( '<h1>%s</h1>', 'humble' ), get_the_date( _x( 'Y', 'yearly archives date format', 'humble' ) ) );

                else :
                    _e( '<h1>Archives</h1>', 'humble' );

                endif;
            ?>

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
