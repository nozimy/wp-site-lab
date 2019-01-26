<?php /* Template Name: Contacts */ ?>

<?php get_header(); ?>

<?php global $ecobox_data; ?>

<div class="row">
	<div class="col-md-8">
		<?php if($ecobox_data['opt-contact-gmap'] == 1): ?>
		<script type="text/javascript">
			jQuery(function($){
				//getter
				var zoom= $('#map_canvas').gmap('option', 'zoom');
				
				$('#map_canvas').gmap().bind('init', function(ev, map) {
					$('#map_canvas').gmap('addMarker', {'position': '<?php echo $ecobox_data["opt-contact-coordinates"]; ?>', 'bounds': true});
					$('#map_canvas').gmap('option', 'zoom', <?php echo $ecobox_data["opt-contact-zoom"]; ?>);
				});
			});
		</script><!-- Google Map Init-->
		<!-- Google Map -->
		<div class="googlemap-wrapper">
			<div id="map_canvas" class="map-canvas"></div>
		</div>
		<!-- Google Map / End -->
		<?php endif; ?>
	</div>
	<div class="col-md-4">
		<div class="title">
			<h2><?php echo $ecobox_data['opt-contact-title']; ?></h2>
		</div>

		<?php if($ecobox_data['opt-contact-desc']):?>
		<p><?php echo $ecobox_data['opt-contact-desc']; ?></p>
		<?php endif; ?>

		<!-- Contact Info -->
		<ul class="contact-info-list">
			<?php if(isset($ecobox_data['opt-contact-phone'])): ?>
			<li>
				<span class="icon"><i class="fa fa-phone"></i></span>
				<?php 
					foreach( $ecobox_data['opt-contact-phone'] as $key => $value){
						echo "$value <br />";
					}
				?>
			</li>
			<?php endif; ?>
			<?php if(isset($ecobox_data['opt-contact-email'])): ?>
			<li>
				<span class="icon"><i class="fa fa-envelope"></i></span>
				<?php 
					foreach( $ecobox_data['opt-contact-email'] as $key => $value){
						echo "<a href='mailto:$value'>$value</a> <br />";
					}
				?>
			</li>
			<?php endif; ?>
			<?php if(isset($ecobox_data['opt-contact-address'])): ?>
			<li>
				<span class="icon"><i class="fa fa-map-marker"></i></span>
				<?php echo $ecobox_data['opt-contact-address']; ?>
			</li>
			<?php endif; ?>
		</ul>
		<!-- Contact Info / End -->

		<!-- Social Links / End -->
		<ul class="social-list social-list__footer list-unstyled">
			<?php if(isset($ecobox_data['opt-contact-social-fb']) && $ecobox_data['opt-contact-social-fb'] != ""): ?>
			<li><a href="<?php echo $ecobox_data['opt-contact-social-fb']; ?>"><i class="fa fa-facebook"></i></a></li>
			<?php endif; ?>
			<?php if(isset($ecobox_data['opt-contact-social-twitter']) && $ecobox_data['opt-contact-social-twitter'] != ""): ?>
			<li><a href="<?php echo $ecobox_data['opt-contact-social-twitter']; ?>"><i class="fa fa-twitter"></i></a></li>
			<?php endif; ?>
			<?php if(isset($ecobox_data['opt-contact-social-linkedin']) && $ecobox_data['opt-contact-social-linkedin'] != ""): ?>
			<li><a href="<?php echo $ecobox_data['opt-contact-social-linkedin']; ?>"><i class="fa fa-linkedin"></i></a></li>
			<?php endif; ?>
			<?php if(isset($ecobox_data['opt-contact-social-google-plus']) && $ecobox_data['opt-contact-social-google-plus'] != ""): ?>
			<li><a href="<?php echo $ecobox_data['opt-contact-social-google-plus']; ?>"><i class="fa fa-google-plus"></i></a></li>
			<?php endif; ?>
			<?php if(isset($ecobox_data['opt-contact-social-pinterest']) && $ecobox_data['opt-contact-social-pinterest'] != ""): ?>
			<li><a href="<?php echo $ecobox_data['opt-contact-social-pinterest']; ?>"><i class="fa fa-pinterest"></i></a></li>
			<?php endif; ?>
			<?php if(isset($ecobox_data['opt-contact-social-youtube']) && $ecobox_data['opt-contact-social-youtube'] != ""): ?>
			<li><a href="<?php echo $ecobox_data['opt-contact-social-youtube']; ?>"><i class="fa fa-youtube"></i></a></li>
			<?php endif; ?>
			<?php if(isset($ecobox_data['opt-contact-social-instagram']) && $ecobox_data['opt-contact-social-instagram'] != ""): ?>
			<li><a href="<?php echo $ecobox_data['opt-contact-social-instagram']; ?>"><i class="fa fa-instagram"></i></a></li>
			<?php endif; ?>
		</ul>
		<!-- Social Links / End -->
	</div>
</div>

<div class="spacer"></div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
	<div id="page-content">
		<?php the_content(); ?>							
	</div>
</div><!-- .post-->
<?php endwhile; ?>

<?php get_footer(); ?>