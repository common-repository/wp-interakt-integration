jQuery(document).ready(function(){

	 var validateEmail = function(elementValue) {
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailPattern.test(elementValue);
    }
    var validatePhoneno = function(elementValue) {
    	var phonenoPattern =/([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/;
    	return phonenoPattern.test(elementValue);
    }

    jQuery('#cf-submitted').on("click", function(e){ 
       
       event.preventDefault();
       var cf_href = jQuery('#cf-submitted').data('href');
       var fields_val = [];
       var lead_mailid = '';
       var counter;
      // var email_field_present = false;
     
     
       function validate_form(){
    	
		   jQuery.each( dynamic_fields_from_php, function( id_index, id_value ) {
 
             var current_id =  "#" + id_value ;
             var current_val = jQuery(current_id).val();
             var current_name = jQuery(current_id).prop("name");
              counter = false;
            

			 /*****
              write validation code here..*/
			   if(jQuery(current_id).prop("required") && current_val == ''){	  		
 
						jQuery(current_id).addClass('alert');
						jQuery(current_id).focus();
						jQuery('#interakt_contactform').not(current_id).removeClass('alert');    
						counter = false;     
		                return counter;            
	            }

			   if(jQuery(current_id).prop("type")=="email"){
			 
	                 var email_is_valid = validateEmail(jQuery(current_id).val());
		             if (!email_is_valid) {
						jQuery(current_id).addClass('alert');
						jQuery(current_id).focus(); 
						jQuery('#interakt_contactform').not(current_id).removeClass('alert');       
		                counter = false;     
		                return counter;  
	                 }
	                 else{
	                    lead_mailid = jQuery(current_id).val();
	                    counter = true;  
	                 }
	            }
               if(jQuery(current_id).prop("type")=="tel"){	  	
                
	                 var phoneno_is_valid = validatePhoneno(jQuery(current_id).val());
		             if (!phoneno_is_valid) {
						jQuery(current_id).addClass('alert');  
                        jQuery().focus();   
					    jQuery('#interakt_contactform').not(current_id).removeClass('alert');   
		                counter = false;     
		                return counter;  
	                 }
	            }
	           else if(jQuery(current_id).is(':radio')){	
                   
		             if(jQuery(current_id).is(":checked")){
		    	  
		    	        current_val = jQuery(current_id).val();
		    	        name_val_pair = current_name + "  -  " +current_val;
			            fields_val.push(name_val_pair);
			            counter = true;  
	 
		    	      } 
	            }           
	           else{ 
		         	name_val_pair = current_name + "  -  " +current_val;
		            fields_val.push(name_val_pair);  
		            counter = true;
	           }
	    
         });
        return counter;
      }/* End of function_validate */  
     
 
      form_is_valid = validate_form();
	  if(form_is_valid == true){
	  
        jQuery.post(cf_href,{'lead_mailid':lead_mailid,'form_data[]':fields_val},function(data,status){
			if(status=='success'){
			   jQuery('#interakt_contactform').remove();
	           jQuery('#cf-return-message').removeAttr('style');	         
		    }
		});
		
      }
           
    }); /* End of submit button click */
	
});

/* End of document */