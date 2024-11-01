jQuery(document).on('widget-updated widget-added ready', function(){
	
	
  jQuery('.title').change(function() {
    if(jQuery(this).is(':checked')){
       jQuery('.titletype').prop('readonly', false);
       jQuery('.titletype').prop('disabled', false);
    }

    else {
       jQuery('.titletype').prop('readonly', true);
	   jQuery('.titletype').prop('disabled', true);
    }
  });

   jQuery('.subscription').change(function() {
	 if(jQuery(this).is(':checked')){
        jQuery('.subscribe').prop('readonly', false);
        jQuery('.subscribe').prop('disabled', false);
		
     }  	
	
	 else{
		 jQuery('.subscribe').prop('readonly', true);
		 jQuery('.subscribe').prop('disabled', true);
  		 jQuery('.subscribe').val('Subscibe to our newsletter');		
	 }
	});
	 jQuery('.style').change(function() {
		 if(jQuery(this).is(':checked')){
        jQuery('.cssstyle').prop('readonly', false);
        jQuery('.cssstyle').prop('disabled', false);
		
    }  	
	
	else{
		jQuery('.cssstyle').prop('readonly', true);
		jQuery('.cssstyle').prop('disabled', true);
 	
	}
	 });
	   jQuery('.contact').change(function() {
		 if(jQuery(this).is(':checked')){
        jQuery('.contacttype').prop('readonly', false);
        jQuery('.contacttype').prop('disabled', false);
	
    }  	
	
	else{
		jQuery('.contacttype').prop('readonly', true);
		jQuery('.contacttype').prop('disabled', true);
        jQuery('.contacttype').val('Enter Your Name');		
	 	
	}
	 });
	 
	 
	jQuery('.phone').change(function() {
	 if(jQuery(this).is(':checked')){
        jQuery('.phonetype').prop('readonly', false);
        jQuery('.phonetype').prop('disabled', false);
 
        }  	
	
	else{
		jQuery('.phonetype').prop('readonly', true);
		jQuery('.phonetype').prop('disabled', true);
        jQuery('.phonetype').val('Enter Your Contact No.');		
		
	}
   });
	jQuery('.message').change(function() {
	 if(jQuery(this).is(':checked')){
        jQuery('.messagetype').prop('readonly', false);
        jQuery('.messagetype').prop('disabled', false);
 
     }  	
	
	else{
		jQuery('.messagetype').prop('readonly', true);
		jQuery('.messagetype').prop('disabled', true);
        jQuery('.messagetype').val('Enter Your Contact No.');		
	}
   });
	jQuery('.btncolor').change(function() {
	 if(jQuery(this).is(':checked')){
        jQuery('.colortype').prop('readonly', false);
        jQuery('.colortype').prop('disabled', false);
 
     }  	

	else{
		jQuery('.colortype').prop('readonly', true);
		jQuery('.colortype').prop('disabled', true);
        jQuery('.colortype').val('#000000');		
		
	}
  });
	 
   jQuery('.textcolor').change(function() {
	if(jQuery(this).is(':checked')){
        jQuery('.textcolortype').prop('readonly', false);
        jQuery('.textcolortype').prop('disabled', false);
    }  	

   else{
		jQuery('.textcolortype').prop('readonly', true);
		jQuery('.textcolortype').prop('disabled', true);
        jQuery('.textcolortype').val('#ffffff');			
   }
  });
	 
  	  jQuery('.btntext').change(function() {
		 if(jQuery(this).is(':checked')){
        jQuery('.btntexttype').prop('readonly', false);
        jQuery('.btntexttype').prop('disabled', false);
 
     }  	
	
	else{
		jQuery('.btntexttype').prop('readonly', true);
		jQuery('.btntexttype').prop('disabled', true);
        jQuery('.btntexttype').val('Submit');		
		
	}
   });
	 
	 jQuery("#headeroption h4,a.toggle").click(function(){
	 
	   jQuery(".formheade_body").slideToggle();
	   jQuery(".toggle").toggleClass("special");
      
     });

    jQuery("#formoption h4,a.togglebody").click(function(){
	   jQuery(".formbody_body").slideToggle();
	   jQuery(".togglebody").toggleClass("special");
		
    });

    jQuery("#buttonoptions h4,a.togglefooter").click(function(){
	   jQuery(".buttonbody_body").slideToggle();
	   jQuery(".togglefooter").toggleClass("special");
			
    });
 
});