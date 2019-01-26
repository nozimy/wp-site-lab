

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				 
    <?php

		$mp3 = rwmb_meta('ninetheme_confidence_m_b_audio_mp3', 'type=text');
		$oga = rwmb_meta('ninetheme_confidence_m_b_audio_ogg', 'type=text');
		$sc_url = rwmb_meta('ninetheme_confidence_m_b_audio_sc', 'type=text');
		$sc_color = rwmb_meta('ninetheme_confidence_m_b_audio_sc_color', 'type=color');
		$ninetheme_confidence_m_b_wp_audio = '[audio mp3="'.$mp3.'"  ogg="'.$oga.'"]';

		$soundcloud_audio = '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.urlencode($sc_url).'&amp;show_comments=true&amp;auto_play=false&amp;color='.$sc_color.'"></iframe>';

		?>

		<?php if($sc_url!='') : ?>
		<div class="post-thumb blog-bg-off"><?php echo ($soundcloud_audio); ?></div>
		<?php else : ?>
		<div class="post-thumb blog-bg-off">
			<?php if(has_post_thumbnail()) : the_post_thumbnail(); endif; ?>
			<?php echo do_shortcode($ninetheme_confidence_m_b_wp_audio); ?>
		</div>
		<?php endif; ?>
		
		<div class="event-container">
			<div class="inner">
			
				<div class="inner items col-sm-3">
					<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_date', true )){ 
					echo '<span class="lead-off-off uppercase strong">' . esc_html__('ministry date', 'confidence') . '</span> '; 
					echo '<span class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_date', true ).'</span> '; 
					} ?>
				</div>
				<div class="inner items col-sm-4">
					<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_manager', true )){ 
					echo '<span class="lead-off uppercase strong">' . esc_html__('ministry manager', 'confidence') . '</span> '; 
					echo '<span class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_manager', true ).'</span> '; 
					} ?>
				</div>
				<div class="inner items col-sm-4">
					<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_location', true )){ 
					echo '<span class="lead-off uppercase strong">' . esc_html__('ministry Location', 'confidence') . '</span> '; 
					echo '<span class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_ministry_location', true ).'</span> '; 
					} ?>
				</div>

			</div>
		</div>

 	<div class="content-container">
		<header class="entry-header">
			<?php
				if ( is_single() ) :
					the_title( '<h2 class="entry-title">', '</h2>' );
				else :
					the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
				endif;
			?>
		</header><!-- .entry-header -->
		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'confidence' ) );
			if ( $tags_list ) :
		?>
		
		<?php endif; // End if $tags_list ?>
		<div class="post-meta-first">
			<span><i class="fa fa-calendar"></i> <?php the_time('F j, Y'); ?></span>
			<span><i class="fa fa-user"></i> <?php the_author(); ?></span>
			<span><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></span>
			<span><?php the_tags( '<i class="fa fa-tag"></i>', ',', ' '); ?></span>
		</div>
		<div class="post-meta-second">
			
			
		</div>
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
</article><!-- #post-## -->
