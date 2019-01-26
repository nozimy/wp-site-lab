<!-- widget related post -->
<?php
$show_related = zl_option('show_related');
if( 1 == $show_related){
$orig_post = $post;
global $post;
$tags = wp_get_post_tags($post->ID);

if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
$args = array(
	'tag__in' => $tag_ids,
	'post_status' => 'publish',
	'post__not_in' => array($post->ID),
	'posts_per_page'=> 3, // Number of related posts to display.
	'ignore_sticky_posts'=> 1,
	'orderby'=> 'rand'
);

$my_query = new wp_query( $args );
/* echo "<pre>";
print_r($tag_ids);
echo "</pre><div class='clear'></div>"; */
if( $my_query->have_posts() ) {
?>
<div class="row">
	<div class="zl_profilebar extrabar relatedposts">
		<!-- pagination -->
		<div class="large-12 column">
			<h2 class="fword"><?php echo zl_option('lang_related', __('Related Articles','zatolab'));?></h2>
		</div>
		<div class="clear"></div>
		<?php 
		// The Loop
		while ($my_query->have_posts()) : 
		$my_query->the_post();
		//Thumb Generate
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url( $thumb,'full' ); 
		$image = zl_theme_thumb($img_url, 300, 200, 't', true);
		?>
		<div <?php post_class('medium-4 column')?> itemscope itemtype="http://schema.org/Article" id="post-<?php the_ID(); ?>">
			<div class="zl_related_thumb">
				<?php if (!empty($image)) { ?>
					<img itemprop="image" class="entry-thumb" src="<?php echo $image; ?>" alt="<?php the_title();?>" title="<?php the_title();?>"/>
				<?php } else {
					echo '<img src="http://placehold.it/300x200/000000/000000" alt="no image"/>';
				}?>
				<a href="<?php the_permalink();?>"><?php echo zl_option('lang_readmore',__('Read More','zatolab'));?></a>
			</div>
			<h4 class="entry-title"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h4>
			<span class="zl_rel_date"><span class="dashicons dashicons-calendar"></span> <?php the_date();?></span>
		</div>
		<?php endwhile; //End The Loop?>
		
		<div class="clear"></div>
		
	</div>
	<div class="clear"></div>
</div>
	<div class="clear"></div>
<?php
}
wp_reset_query();
}
} else {
	
}
?>	