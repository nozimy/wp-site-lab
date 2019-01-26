<?php
/**
 * Template Name: Full Width Page
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

					 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						 <?php get_template_part('parts/content', 'page'); ?>

					 <?php endwhile; ?>

					 <?php endif; ?>

				 </main>

			 </div>

		 </div>

	 </div>

 </div>

<?php get_footer(); ?>
