
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( ! function_exists( 'rwmb_meta' ) ) {
				function rwmb_meta( $key, $args = '', $post_id = null ) { return false; }
			} 
		?>
			 
		<?php
			$mp3 = rwmb_meta('ninetheme_confidence_m_b_audio_mp3', 'type=text');
			$oga = rwmb_meta('ninetheme_confidence_m_b_audio_ogg', 'type=text');
			$sc_color = rwmb_meta('ninetheme_confidence_m_b_audio_sc_color', 'type=color');
			$ninetheme_confidence_m_b_wp_audio = '[audio mp3="'.$mp3.'"  ogg="'.$oga.'"]';
			$show_audio_meta = rwmb_meta('ninetheme_confidence_m_b_show_audio_meta', 'type=select');
			$show_audio_social_icons = rwmb_meta('ninetheme_confidence_m_b_show_audio_social_icons', 'type=select');
			$soundcloud_audio = rwmb_meta('ninetheme_confidence_m_b_audio_sc', 'type=text');
		?>

		<?php if($soundcloud_audio!='') : ?>
		<div class="post-thumb blog-bg"><?php echo ($soundcloud_audio); ?></div>
		<?php else : ?>
		<div class="post-thumb blog-bg">
			<?php if(has_post_thumbnail()) : the_post_thumbnail(); endif; ?>
			<?php echo do_shortcode($ninetheme_confidence_m_b_wp_audio); ?>
		</div>
		<?php endif; ?>


 	<div class="content-container">
		<header class="entry-header">
			<?php
				if ( is_single() ) :
					the_title( '<h2 class="entry-title post-heading">', '</h2>' );
				else :
					the_title( sprintf( '<h2 class="entry-title post-heading"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
			?>
		</header><!-- .entry-header -->
		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list();
			if ( $tags_list ) :
		?>
		
		<?php endif; // End if $tags_list ?>
		<?php if($show_audio_meta == 'value1') : ?>
			<div class="post-meta-first">
				<span><i class="fa fa-calendar"></i><?php the_time('F j, Y'); ?></span>
				<span><i class="fa fa-user"></i> <?php the_author(); ?></span>
				<span><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></span>
				<span><?php the_tags( '<i class="fa fa-tag"></i>', ',', ' '); ?></span>
			</div>
			<div class="post-meta-second"></div>
		<?php endif; ?>
	</div>
	

	<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_content( sprintf(
					esc_html__( 'Continue reading %s', 'confidence' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );
			?>
	</div><!-- .entry-content -->
	<?php if ( ! is_single() ) : ?>
		<a href="<?php echo get_permalink(); ?>" role="button" class="btn more"><?php esc_html_e( 'Read More', 'confidence' ); ?><i class="fa fa-long-arrow-right "></i></a>
	<?php endif; // is_single() ?>
	
	<?php if($show_audio_social_icons == 'value1') : ?>
		<!-- I got these buttons from simplesharebuttons.com -->
		<div id="share-buttons">
			<a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
			<a href="http://twitter.com/share?url=<?php echo get_permalink(); ?>&text=Simple Share Buttons&hashtags=simplesharebuttons" target="_blank"><i class="fa fa-twitter"></i></a>
			<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			<a href="http://www.digg.com/submit?url=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-digg"></i></a>
			<a href="http://reddit.com/submit?url=<?php echo get_permalink(); ?>&title=Simple Share Buttons" target="_blank"><i class="fa fa-reddit"></i></a>
			<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
			<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());"><i class="fa fa-pinterest"></i></a>
			<a href="http://www.stumbleupon.com/submit?url=<?php echo get_permalink(); ?>&title=Simple Share Buttons" target="_blank"><i class="fa fa-stumbleupon"></i></a>
			<a href="mailto:?Subject=Simple Share Buttons&Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo get_template_directory_uri(); ?>"><i class="fa fa-envelope-o"></i></a>
		</div>
	<?php endif; ?>
	
	</article><!-- #post-## -->
