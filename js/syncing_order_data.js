jQuery(document).ready(function(){  

	var href  = jQuery("#sync_order_class_path").val();
	
	jQuery('#sink_orders_btn').on('click',function(){ 
		

		    jQuery('#reload_msg').show().text("Please do not reload page, it will take some time.");
		    jQuery('#msg1').show().html("<p style='font-size:14px;'>Syncing orders..</p>");
			jQuery.post(href,function(data,status){
				if(status=="success")
				{
					jQuery('#msg1').show().html("<p style='font-size:14px;'>Total no. of orders = "+data+"</br>All data has been synced.</p>");	
					jQuery('#reload_msg').text("");	 
				}
				else
				{
					//alert(data);
					jQuery('#reload_msg').text("");
					jQuery('#msg1').show().text('Sending orders failed.');	 
					return false;
				}
			});
		
	});
	
});

