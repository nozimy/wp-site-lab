<?php
/**
 * The template for displaying the footer.
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>
        <footer class="humble-footer">

            <?php if ( is_active_sidebar( 'instagram_widget' )  ) : ?>
                <?php dynamic_sidebar( 'instagram_widget' ); ?>
            <?php endif; ?>

            <?php if(get_theme_mod('footer_logo')) : ?>
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title=""><img src="<?php echo esc_url(get_theme_mod('footer_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
            </div>
            <?php endif; ?>

            <p><?php echo wp_kses_post(get_theme_mod('footer_copyright', 'Copyright &copy; 2016 Humble. All rights reserved.')); ?></p>

        </footer><!-- Footer -->

    </div> <!-- wrapper -->

    <?php if(get_theme_mod('footer_backtotop')) : ?>
    <div class="hidden-sm hidden-xs">
        <div class="scroll-up">
            <a href="#"><i class="fa fa-angle-up"></i></a>
        </div>
    </div>
    <?php endif; ?>

	<?php wp_footer();?>

</body>
</html>
