jQuery(document).ready(function(){


   /* display Text on the hover of question mark */
	jQuery('.postbox table.form-table tr:nth-child(1) th:first-child label').hover(function () {
	   jQuery("#app_id_mark").show();
	   },function () {
	    jQuery("#app_id_mark").hide();
	});
	jQuery('.postbox table.form-table tr:nth-child(2) th:first-child label').hover(function () {
	      jQuery("#api_key_mark").show();
	     },function () {
	    jQuery("#api_key_mark").hide();
	});

		jQuery('#interakt_setup_save_btn').on("click", function(e){
		 
			var app_id = jQuery('#interakt_app_key').val();
			var api_key = jQuery('#interakt_api_key').val();
			if(app_id == '' || app_id.length !=32 ){
			   jQuery('#notice_msg').show();
	           return false;
			}
			else if(api_key == '' || api_key.length !=32){
				jQuery('#notice_msg').show();
              return false;
			}
			
		});
});
jQuery(document).ready(function(){ 
         
        jQuery('#setup_whole_form').submit( function(){
          jQuery('#publishing-action .spinner').css('display','inline');
        });
        jQuery('#contact_whole_form').submit( function(){
          jQuery('#publishing-action .spinner').css('display','inline');
        });

 });
 