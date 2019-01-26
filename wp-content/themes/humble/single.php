<?php
/**
 * The template file for single post page.
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
 get_header();
 humble_setPostViews(get_the_ID());
?>

    <div id="humble-content" class="section">

        <div class="block">

            <div class="container">

                <div class="row">

                    <main id="main" class="<?php echo esc_attr(humble_content_class());?>">

                         <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                             <?php get_template_part('parts/content','single'); ?>

                         <?php endwhile; ?>

                         <?php endif; ?>

                     </main>

                     <aside class="<?php echo esc_attr(humble_sidebar_class());?>">
                        <?php get_sidebar();?>
                     </aside>

                </div>

             </div>

         </div>

    </div>

<?php get_footer(); ?>
