<?php
/**
 * The template part for displaying page content
 *
 * @package    Humble
 * @version    1.5
 * @author     Elite Layers <admin@elitelayers.com>
 * @copyright  Copyright (c) 2017, Elite Layers
 * @link       http://demo.elitelayers.com/humble/
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2 or later
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

    <?php if(has_post_thumbnail()) : ?>

    	<div class="post-media">

            <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_post_thumbnail('humble_base_thumb'); ?></a>

        </div>

	<?php endif; ?>

    <div class="post-content">

        <?php the_content();?>

        <?php
          wp_link_pages( array(
            'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'humble' ),
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
          ) );
        ?>

    </div>

    <?php comments_template( '', true );  ?>

</article>
