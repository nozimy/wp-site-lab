<?php
/**
 * The template for displaying posts in the Video post format.
 *
 * @package WordPress
 * @subpackage ninetheme_confidence_m_b_
 * @since ninetheme_confidence_m_b_ 1.0
 */
?>

<!-- Start .hentry -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="hentry-box">

		<?php $embed = rwmb_meta('ninetheme_confidence_m_b_video_embed', 'type=textarea'); ?>

		<?php if($embed!='') : ?>

		<div class="post-thumb blog-bg-0ff">

			<div class="media-element video-responsive"><?php echo ($embed); ?></div>

		</div>

		<?php else : ?>

		<?php

		$m4v = rwmb_meta('ninetheme_confidence_m_b_video_m4v', 'type=text');
		$ogv = rwmb_meta('ninetheme_confidence_m_b_video_ogv', 'type=text');
		$webm = rwmb_meta('ninetheme_confidence_m_b_video_webm', 'type=text');
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id, true);
		$ninetheme_confidence_m_b_wp_video = '[video poster="'.$image_url[0].'" mp4="'.$m4v.'"  webm="'.$webm.'"]';

		?>

	    <div class="post-thumb"><?php echo do_shortcode($ninetheme_confidence_m_b_wp_video); ?></div>

		<?php endif; ?>

		<div class="event-container">
			<div class="inner">
			
				<div class="inner items col-sm-3">
					<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_program_date', true )){ 
					echo '<span class="lead-off-off uppercase strong">' . esc_html__('program date', 'confidence') . '</span> '; 
					echo '<span class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_program_date', true ).'</span> '; 
					} ?>
				</div>
				<div class="inner items col-sm-4">
					<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_program_manager', true )){ 
					echo '<span class="lead-off uppercase strong">' . esc_html__('program manager', 'confidence') . '</span> '; 
					echo '<span class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_program_manager', true ).'</span> '; 
					} ?>
				</div>
				<div class="inner items col-sm-4">
					<?php if(get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_program_location', true )){ 
					echo '<span class="lead-off uppercase strong">' . esc_html__('program Location', 'confidence') . '</span> '; 
					echo '<span class="lead-off ">'.get_post_meta( get_the_ID(), 'ninetheme_confidence_m_b_program_location', true ).'</span> '; 
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
		<?php $show_video_meta = rwmb_meta('ninetheme_confidence_m_b_show_video_meta', 'type=select');

		if($show_video_meta == 'value1') : ?>
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
		<?php endif; ?>	
			
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
	</div>

</article><!-- #post-## -->
