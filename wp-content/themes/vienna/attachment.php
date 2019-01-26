<!doctype html>
<html class="no-js" lang="en">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- For third-generation iPad with high-resolution Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo zl_option('favicon_144'); ?>">
		<!-- For iPhone with high-resolution Retina display: -->
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo zl_option('favicon_114'); ?>">
		<!-- For first- and second-generation iPad: -->
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo zl_option('favicon_72'); ?>">
		<!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
		<link rel="apple-touch-icon-precomposed" href="<?php echo zl_option('favicon_57'); ?>">
		<?php /*  <link rel="icon" href="<?php echo zl_option('favicon'); ?>" type="image/x-icon" />  */?>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php wp_head();?>
	</head>
	<body <?php body_class(); ?>>
		<!-- oooooooooooooooooooooooooooooooooo
			Post Entries
			oooooooooooooooooooooooooooooooooooo-->
		<?php 
		global $post;
		$thumb = get_post_thumbnail_id();
		$thispageid = get_the_ID();
		$img_url = wp_get_attachment_url(); 
		$image = zl_theme_thumb($img_url, 775, null, 'c', true);
		$parents = get_post_ancestors( $post->ID );
		$pageid = ($parents) ? $parents[count($parents)-1]: $post->ID;
		$content_post = get_post($pageid);

		$attachment_ids = array();
		$pattern = get_shortcode_regex();
		$ids = array();

		if (preg_match_all( '/'. $pattern .'/s', $content_post->post_content, $matches ) ) {   
			//finds the     "gallery" shortcode and puts the image ids in an associative array at $matches[3]
			$count=count($matches[3]);      //in case there is more than one gallery in the post.
			for ($i = 0; $i < $count; $i++){
			    $atts = shortcode_parse_atts( $matches[3][$i] );
			    if ( isset( $atts['ids'] ) ){
			    	$attachment_ids = explode( ',', $atts['ids'] );
			    	$ids = array_merge($ids, $attachment_ids);
			    }
			}
		}

		$photos = $ids;
		
		/*
		echo '<pre>';
		print_r($photos);
		echo '</pre>';
		*/
		?>
		
		<div class="zl_single_photo">
			<!-- oooooooooooooooooooooooooooooooooooo
			PHOTO
			ooooooooooooooooooooooooooooooooooooo -->
			<div class="zl_photospot">
				<h3><?php the_title(); ?></h3>
				<img src="<?php echo $img_url; ?>" alt="<?php echo $img_url; ?>" class="mainimage" data-id="<?php echo $thispageid; ?>"/>
				<?php //next_image_link(); ?>

				<?php if($photos): 
				$position = array_search($thispageid, $photos);
				?>
				<div class="alb_prevlink">
					<?php 
						/*if (isset($photos[$position - 1])) {
						    $before = $photos[$position - 1];
						    echo '<a href="'.get_attachment_link($before).'"><span class="dashicons dashicons-arrow-left-alt2"></span></a>';
						}*/
					 ?>
					<a><span class="dashicons dashicons-arrow-left-alt2"></span></a>
				</div>
				<div class="alb_nextlink">
					<?php 
						/*if (isset($photos[$position + 1])) {
						    $after = $photos[$position + 1];
						    echo '<a href="'.get_attachment_link($after).'"><span class="dashicons dashicons-arrow-right-alt2"></span></a>';
						}*/
					 ?>
					 <a><span class="dashicons dashicons-arrow-right-alt2"></span></a>
				</div>
				<div class="alb_navig text-center">
					<div class="dashicons dashicons-screenoptions"></div>
				</div>

				<div class="alb_thumbnails">
					<div class="dashicons dashicons-no-alt close_su"></div>
					<div class="owl-carousel albthumb">
					<?php 
					if($photos){
						$i=0;
						foreach ($photos as $id) {
							$attimgurl   = wp_get_attachment_url($id,'full');
							$imgsrc   = zl_theme_thumb($attimgurl, 80, 80, 'c', true);
							//Output
							$aresame = null;
							if (get_the_ID() == $id ) {
								$aresame = 'iscurrent';
							}
							echo '<a href="'.get_attachment_link($id).'" title="'.get_the_title($id).'" data-id="'.$id.'" class="'. $aresame .'"><img src="'. $imgsrc .'" alt="'.get_the_title($id).'" /></a>';
						$i++;
						} // end foreach
					} //endif
				 	?>
				 	</div> <!-- End .albthumb -->
				</div> <!-- End .alb_thumbnails -->
				<?php endif; ?>
			</div> <!-- End .zl_photospot -->

			<!-- oooooooooooooooooooooooooooooooooooo
			COMMENTS
			ooooooooooooooooooooooooooooooooooooo -->
			<div class="zl_commentspot">
			<div class="innner">
				<div class="att_date"><span class="dashicons dashicons-calendar"></span> <time><?php echo date('n F, Y', strtotime($post->post_date)); ?></time></div>
				<div class="clear"></div>
				<?php
					global $post;
					echo wpautop(strip_tags(apply_filters ('the_excerpt', $post->post_content)) );;
					?>
				<div class="clear"></div>
				<hr>
				<?php echo getPostLikeLink( $post->ID );?>
				<div class="clear"></div>
				<hr>
				<div class="zl_commentsbox">
					<?php comments_template( '/comments-photo.php' ); ?>
				</div>
			</div>
			</div>
		</div>
		
		<?php /*
			<!-- oooooooooooooooooooooooooooooooooooo
			Comments Section
			oooooooooooooooooooooooooooooooooooo -->
			<div class="clear"></div>
			<section id="zl_comments">
				<div class="row">
					<?php 
				if ( comments_open() || get_comments_number() ) {
					//get_template_part('inc/parts/comments');
					comments_template();
				}
				?>
		</div>
		</section>
		<div class="clear"></div>
		*/ ?>
		<?php wp_footer();?>
	</body>
</html>