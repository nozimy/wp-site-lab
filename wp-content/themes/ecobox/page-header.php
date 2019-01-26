<?php if(!is_404()) { ?>
<div class="page-header page-header__standard">
	<div class="container">
		<div class="page-title-holder clearfix">

			<?php global $ecobox_data; ?>
			
			<?php 
			// check for WooCommerce. If true, load WooCommerce custom layout
			if (class_exists('woocommerce') && ((is_woocommerce() == "true") || (is_checkout() == "true") || (is_cart() == "true") || (is_account_page() == "true") )){ ?>
			
			<h1>
				<?php if ( is_search() ) : ?>
					<?php printf( __( 'Search Results: &ldquo;%s&rdquo;', 'ecobox' ), get_search_query() ); ?>
				<?php elseif ( is_tax() ) : ?>
					<?php echo single_term_title( "", false ); ?>
				<?php elseif ( is_shop() ) : ?>
					<?php
						$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );

						echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
					?>
				<?php else : ?>
					<?php the_title(); ?>
				<?php endif; ?>
				<?php if ( get_query_var( 'paged' ) ) : ?>
					<?php printf( __( '&nbsp;&ndash; Page %s', 'ecobox' ), get_query_var( 'paged' ) ); ?>
				<?php endif; ?>
			</h1>
			
			<?php // Standard Heading
			} else { ?>

				<?php if(is_home()){ ?>
					<h1><?php echo $ecobox_data['opt-blog-title']; ?></h1>
				<?php } elseif(is_search()) { ?>
					<h1><?php echo sprintf( __( '%s Search Results for ', 'ecobox' ), $wp_query->found_posts ); echo '<span>"' . get_search_query() . '"</span>'; ?></h1>
				
				<?php } elseif ( is_author() ) { ?>
					<?php 
						global $author;
						$userdata = get_userdata($author);
					?>
						<h1><?php echo $userdata->display_name; ?></h1>
						
				<?php } elseif ( is_404() ) { ?>
					<h1><?php printf( __( 'Page not found', 'ecobox' )); ?></h1>
				
				<?php } elseif ( is_category() ) { ?>
					<h1><?php printf( __( 'Category Archives: %s', 'ecobox' ), '<span>"' . single_cat_title( '', false ) . '"</span>' ); ?></h1>
					
				<?php } elseif ( is_tax('portfolio_category') ) { ?>
					<h1><?php $terms_as_text = get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' ) ;
					echo strip_tags($terms_as_text); ?></h1>
				
				<?php } elseif ( is_day() ) { ?>
					<h1><?php printf( __( 'Day: %s', 'ecobox' ), '<span>' . get_the_date() . '</span>' ); ?></h1>
					
				<?php } elseif ( is_month() ) { ?>	
					<h1><?php printf( __( 'Month: %s', 'ecobox' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'ecobox' ) ) . '</span>' ); ?></h1>
					
				<?php } elseif ( is_year() ) { ?>	
					<h1><?php printf( __( 'Year: %s', 'ecobox' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'ecobox' ) ) . '</span>' ); ?></h1>
						
				<?php } elseif ( is_tag() ) { ?>
					<h1><?php printf( __( 'Tag Archives: %s', 'ecobox' ), '<span>"' . single_cat_title( '', false ) . '"</span>' ); ?></h1>
				
				<?php } else { ?>
					<h1><?php the_title(); ?></h1>
				<?php } ?>
			
			<?php } ?>

			
			<?php // Breadcrumb
			if($ecobox_data['breadcrumbs'] == 1) {
				ecobox_breadcrumbs();
			}?>
			
		</div>
	</div>
</div>

<?php } else { ?>

<div class="page-header page-header__404">
	<h1>
		<span class="line line__left"></span>
		404
		<span class="line line__right"></span>
	</h1>
	<div class="desc"><?php _e( 'ooops! error!', 'ecobox' ); ?></div>
</div>

<?php } ?>