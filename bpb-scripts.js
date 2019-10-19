jQuery(document).ready(function(){

	// console.log(fa_ajax.ajax_url);
	jQuery('#bpb-trigger').click(function(){
		
		jQuery.ajax({
        	url: bpb_ajax.ajax_url,
        	type: 'POST',
        	data: {
				action: 'bpb'
	        },
	        success : function(op) {
	        	console.log(op);
	        	jQuery('.response').html(op.data);
	        },
	        error : function(error) {
				console.log(error);
			}
		});		
	
	});
	
});