jQuery(document).ready(function($){
	

/*----------------------------------------------------------------------------------*/
/*	Display post format meta boxes as needed
/*----------------------------------------------------------------------------------*/
	
	
	$('#post-formats-select input').change(checkFormat);
	
	function checkFormat(){
		var format = $('#post-formats-select input:checked').attr('value');
		
		//only run on the posts page
		if(typeof format != 'undefined'){
			
			$('#post-body div[id^=church_m_b-blogmeta-]').hide();
			$('#post-body #church_m_b-blogmeta-'+format+'').stop(true,true).fadeIn(500);
					
		}
	
	}
	
	$(window).load(function(){
		checkFormat();
	})

/*----------------------------------------------------------------------------------*/
/*	Display Delete Button On Editor
/*----------------------------------------------------------------------------------*/
	
$(document).ready(function () {
 
    $('.rwmb-image-bar a.rwmb-delete-file').append('x');

});


		
    
});
