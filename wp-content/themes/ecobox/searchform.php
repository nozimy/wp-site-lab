<!-- Searchform -->
<form method="get" class="search-form clearfix" action="<?php echo home_url(); ?>" >
	<div class="form-group">
		<label for="name" class="sr-only"><?php _e( 'Search...', 'ecobox' ); ?></label>
		<input id="s" type="text" name="s" onfocus="if(this.value==''){this.value=''};" 
		onblur="if(this.value==''){this.value=''};" class="form-control input-lg" value="" placeholder="<?php _e( 'Search...', 'ecobox' ); ?>">
	</div>
</form>
<!-- /Searchform -->