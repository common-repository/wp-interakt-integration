jQuery(document).ready(function()
{    
	/**
	Validate APP ID and API key fields
	*/
	jQuery('#msg1').hide();
	jQuery('#notice_msg').hide();
    jQuery(".CheckChange").on("change", function(){
	        if (jQuery(this).val().length == 32){

	            jQuery(this).next("img").next("img").hide();
	            jQuery(this).next("img").show();
                jQuery('#notice_msg').hide();
	            jQuery('#sink_btn').prop('disabled', false);
	            jQuery('#sink_orders_btn').prop('disabled', false);
	        }
	        else{
	            jQuery(this).next("img").hide();
	            jQuery(this).next("img").next("img").show();
	            jQuery('#notice_msg').show();
	            jQuery('#sink_btn').prop('disabled', true);
	            jQuery('#sink_orders_btn').prop('disabled', true);
	        }
	 });


  /* Sync Users*/

	var href = syncUserScript.pluginsUrl + '/wp-interakt-integration/class/class_syncing_user_data.php';
	var totalUsers;
	var offset;
	var interakt_app_id;
	var interakt_app_key;

    interakt_app_id=syncUserScript.interakt_app_key;
    interakt_app_key=syncUserScript.interakt_api_key;
 
    if(interakt_app_id=="" || interakt_app_key==""){
		    jQuery('#sink_btn').prop('disabled', true);
		    jQuery('#sink_orders_btn').prop('disabled', true);
		    jQuery('#notice_msg').show();
			jQuery('#reload_msg').show().html("<p>Please insert App ID and API Key.</p>");
	}
	else if(interakt_app_id.length < 32 || interakt_app_key.length < 32){
            jQuery('#sink_btn').prop('disabled', true);
            jQuery('#sink_orders_btn').prop('disabled', false);
		    jQuery('#notice_msg').show();
			jQuery('#reload_msg').show().html("<p>Please insert valid App ID and API Key.</p>");
	}
	else{
		 jQuery('#reload_msg').hide();
	}

	var sendData=function()
	{ 
 
		jQuery('#reload_msg').text("Please do not reload page, it will take some time.");
		if(parseInt(offset)<parseInt(totalUsers))
		{    // var userintotal ;
			jQuery.post(href,{totalUsers:totalUsers,interaktAppId:interakt_app_id,interaktAppKey:interakt_app_key},function(data,status){
				if(data)
				{   // alert("hi");
		            //userintotal = data;
					jQuery('#msg1').show().html('<p>Users synced from   '+offset+' to  '+data+'.</p>');
					 if(data=='error')
					{	
						jQuery('#msg1').show().html('<p>Invalid App ID or API key, please check your App ID or API key, further you have any problem please <a href="mailto:support@interakt.co?Subject=Need help for Interakt Integration with WordPress site" target="_top">Drop us an Email</a>')
					}
					else
					{
						offset=data;
						sendData();
					}

				}
			});
		}
		else
		{   
			jQuery('#reload_msg').text("");		
			jQuery( '#msg1' ).replaceWith(jQuery('#msg1').show().html("<p style='font-size:14px;'>Total no. of users = "+totalUsers+"<br>All data has been synced.</p>"));
			jQuery('#msg1').after(' '+data+'');
			return false;
		}
	}


    
		 
	jQuery('#sink_btn').unbind().on('click',function()

	{ 
		interakt_app_id=syncUserScript.interakt_app_key;
		interakt_app_key=syncUserScript.interakt_api_key;
	    //alert(interakt_app_id);

		if(interakt_app_id=="" || interakt_app_key=="")
		{
			jQuery('#msg1').show().html("<p style='font-size:14px;'>Please insert valid App ID and API Key.</p>");
		}
		else
		{    
			var isUserCount="yes";
			jQuery.post(href,{isUserCount:isUserCount},function(data,status){
				if(data)
				{
                    var replaced = data.replace(/\<.*\>/g,'');
                    data = replaced;
  
					jQuery('#msg1').show().html("<p style='font-size:14px;'>Syncing User Data..</p>");
					totalUsers=data;
					offset=0;
					sendData();		 
				}
			});
		}
	});

 /**
  Admin Bar Sync Button
 */
	jQuery('#wp-admin-bar-sync_btn').unbind().on('click', function()

	{	
		interakt_app_id=syncUserScript.interakt_app_key;
		interakt_app_key=syncUserScript.interakt_api_key;
 
		if(interakt_app_id=="" || interakt_app_key=="")
		{
			jQuery('#msg').html("<p>Please insert App ID and API Key.</p>");
		}
		else
		{
			var isUserCount="yes";
			jQuery.post(href,{isUserCount:isUserCount},function(data,status){
				var value=2;
				if(data)
				{
					
                    var replaced = data.replace(/\<.*\>/g,'');
                    data = replaced;
                    
					jQuery('#msg').html("<p>Total no. of users = "+data+"</br>Syncing User Data.. </p>");
					totalUsers=data;
					offset=0;
					sendData();
					
					jQuery('.wp-admin')                                
                    .append('<div class="modal"><div class="message"> Message</div><div class="modalbody"><p>All users are synced with Interakt.</p>Total no. of users = '+data+'<div class="modal_close close"><a class="closebtn1">Close</a> </div> <div class="modal_close"> X </div></div></div><div class="modalback_mask"></div>')
               
					jQuery(".modal_close").click(function(){
		               jQuery(".modal").hide();
		                jQuery(".modalback_mask").hide();
                     });	

				}
			});
		}
		//location.href = 'options-general.php?page=__FILE__';	 
	});	
	
});

