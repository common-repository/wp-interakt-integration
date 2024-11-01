jQuery(document).ready(function(){
    var control_href = jQuery('#control_class_path').val();
    //alert(control_href);

   jQuery('#interakt_manageapps_save_btn').on("click", function(e){ 

      chat_status = jQuery('#chat_onoffswitch').is(':checked');
      feedback_status = jQuery('#feedback_onoffswitch').is(':checked');

      // alert(chat_status);
      // alert(feedback_status);
  
    /****** Code for API ******/ 
     
      if(chat_status==true){
       chat_status=1;
      }
      else{
        chat_status=0;
      }
      if(feedback_status==true){
       feedback_status=1;
      }
      else{
        feedback_status=0;
      }
          
    jQuery.post(control_href,{'chat_status':chat_status,'feedback_status':feedback_status},function(data,status){
      if(status=='success'){
      }
    });
 }); 
}); 