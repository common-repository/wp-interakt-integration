jQuery(document).ready(function(){
 
	// /* Validate data from subscription widget*/
	
	jQuery("#interakt-subscribe-phone").keypress(function (e) {
	     //if the letter is not digit then display error and don't type anything
	     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	        //display error message
	        jQuery("#errmsg").html("Digits Only").show().fadeOut("slow");
	               return false;
	    }
    });

	var validateEmail = function(elementValue) {
          var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
          return emailPattern.test(elementValue);
    }

	jQuery('#subscribe-btn').on('click',function(event){
		var name = jQuery('#interakt-subscribe-name').val();
		var email = jQuery('#interakt-subscribe-email').val();
		var phone = jQuery('#interakt-subscribe-phone').val();

		
		var emailvalid = validateEmail(email);
		
		 
	    if(jQuery('#interakt-subscribe-name').val() == ''){
			jQuery('#interakt-subscribe-email').removeClass('alert');
			jQuery('#interakt-subscribe-phone').removeClass('alert');
			jQuery('#interakt-subscribe-name').removeClass('alert');
			jQuery('#interakt-subscribe-name').addClass('alert');
			return false; 
		 }
		 	
		 else if(jQuery('#interakt-subscribe-email').val() == ''){
			jQuery('#interakt-subscribe-email').removeClass('alert');
			jQuery('#interakt-subscribe-phone').removeClass('alert');
			jQuery('#interakt-subscribe-name').removeClass('alert');
			jQuery('#interakt-subscribe-email').addClass('alert');
			return false; 
		 }
		 	 
		 else if (!emailvalid) {
            jQuery('#interakt-subscribe-email').removeClass('alert');
			jQuery('#interakt-subscribe-phone').removeClass('alert');
			jQuery('#interakt-subscribe-name').removeClass('alert');
			jQuery('#interakt-subscribe-email').addClass('alert');       
            return false;
         }

		 else if(jQuery('#interakt-subscribe-phone').val() == '' || jQuery('#interakt-subscribe-phone').val().length !== 10){
			jQuery('#interakt-subscribe-email').removeClass('alert');
			jQuery('#interakt-subscribe-phone').removeClass('alert');
			jQuery('#interakt-subscribe-name').removeClass('alert');
			jQuery('#interakt-subscribe-phone').addClass('alert');
			return false; 
		 }
		 		
		 else{
				
			event.preventDefault();
			var name = jQuery('#interakt-subscribe-name').val();
			var email = jQuery('#interakt-subscribe-email').val();
			var phone = jQuery('#interakt-subscribe-phone').val();

			var href = jQuery('#subscribe-btn').data('href');
			
			jQuery.post(href,{name:name,email:email,phone:phone},function(data,status){
				if(status=='success'){
					jQuery('#interakt-subscribe ').remove();
					jQuery('#sub-message').removeAttr('style');
				}
			});
			
		}
	});

  /* interakt menu options */
	jQuery('.interaktfeedbackclass').on("click", function(e){ 
         interaktfb();
    });
	jQuery('.interaktchatclass').on("click", function(e){ 
         interaktchat();
    });

});

