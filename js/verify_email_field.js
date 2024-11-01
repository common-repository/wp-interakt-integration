 jQuery(document).ready(function(){
  
 	jQuery('#interakt_form_save_btn').on("click", function(e){ 
 	  var counter = 0;
 	  var tag_lines = [];
 	  var tag_words = [];
      var builder_box_data = jQuery('#interakt_cf_editor_box').val();
      var tag_filter = /\[(.*?)\]/g;
      for(m = tag_filter.exec(builder_box_data); m; m = tag_filter.exec(builder_box_data)){
         tag_line = m[1];
         tag_words = tag_line.split(" ");
         var prefix = 'type="email"'; 
          jQuery.each( tag_words, function( id_index, id_value ) {
            if (id_value.startsWith(prefix)) {
             counter++;
            }
          });  
      }
  
       if(counter<=0){
 
           jQuery('.wp-admin')                         
	        .append('<div class="modal"><div class="modal_title">Notice</div>'+
	            '<div class="modalbody">'+
              'Please make sure you add an E-mail ID field in the form to save it.'+
	            '<div class="modal_close" style="top:9%;"> X </div>'+
	            '</div></div><div class="modalback_mask"></div>'
	            );

	         jQuery(".modal_close").click(function(){
		         jQuery(".modal").hide();
		         jQuery(".modalback_mask").hide();
             });		
           return false;
        } 
 	}); 
 });