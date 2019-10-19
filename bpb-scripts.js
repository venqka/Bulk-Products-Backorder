jQuery(document).ready(function(){

	// console.log(fa_ajax.ajax_url);
	jQuery('#bpb-trigger').click(function(){
		
		jQuery.ajax({
        	url: bpb_ajax.ajax_url,
        	type: 'POST',
        	data: {
				action: 'bpb'
	        },
	        beforeSend : function() {
	        	jQuery( '.toplevel_page_bulk-products-backorder').css('opacity', '0.5');
	        },
	        success : function(op) {
	        	console.log(op);
	        	jQuery('.response').html(op.data);
	        	jQuery( '.toplevel_page_bulk-products-backorder').css('opacity', '1');
	        	alert( 'Backorders set');
	        },
	        error : function(error) {
				console.log(error);
			}
		});		
	
	});
	
});