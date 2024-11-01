jQuery(document).ready(function(){

  var countBox = Math.floor((Math.random() * 1000) + 1);
 
  var boxName = "";
  var dy_label, dy_name, dy_id, dy_class, dy_required,drop;
  
  jQuery(".cfi_mutual_settings").click(function(event){

    var class_path = jQuery('#class_path').val();
    var button_id =jQuery(this).attr('id');

    switch (button_id) {
		
		case "interakt_title_button":

		  jQuery('.wp-admin')                         
				 .append('<div class="modal"><div class="modal_title">Title</div>'+
					   '<div class="modalbody">'+
						  '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
								'<tr><td class="form_option">Title </td><td class="form_value"><input name="dy_title" id="dy_title"  type="text" value="" /></td><tr>'+
								'<tr><td class="form_option">Position </td><td class="form_value"><input name="dy_position" id="dy_position"  type="text" value="" /><br><sub style="color:#999;font-size: 12px;">left / right / center</sub></td><tr>'+ 
								'<tr><td class="form_option">Class</td><td class="form_value"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+		
								'<tr><td class="form_create_btn test" colspan="2" ><div class="create_btn"><a id="dy_create_field" href="#" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
							'<div class="modal_close"> X </div>'+
						   '</table></div></div> <div class="modalback_mask"></div>');
					
			jQuery(".modal_close").click(function(){
				  jQuery(".modal").hide();
				  jQuery(".modalback_mask").hide();
			});		 
					 
			jQuery(".form_create_btn").click(function(){ 
				
				jQuery(".modal").hide();
				jQuery(".modalback_mask").hide();

				dy_position = new Array();
				jQuery("input[name=dy_position]").each(function () {
				  	    dy_position.pop();
					    dy_position.push(jQuery(this).val());
				});
				
				dy_id = new Array();
				jQuery("input[name=dy_id]").each(function () {
				  	    dy_id.pop();
					    dy_id.push(jQuery(this).val());
				});

				dy_class = new Array();
				jQuery("input[name=dy_class]").each(function () {
					    dy_class.pop();
					    dy_class.push(jQuery(this).val());
				});
			    
			    dy_title = new Array();
				jQuery("input[name=dy_title]").each(function () {
				 	    dy_title.pop();
					    dy_title.push(jQuery(this).val());
				});
				
			     jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[h1 class="icf_title" class="'+dy_class+'" style="text-align:'+dy_position+'"]'+dy_title+'[/h1]');             	 
			}); 	 
				   
            break;
			
	case "interakt_subtitle_button":

	     boxName="subtitle-"+countBox; 
		 countBox += 1;

		  jQuery('.wp-admin')                         
				 .append('<div class="modal"><div class="modal_title">Subtitle</div>'+
					   '<div class="modalbody">'+
						  '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
								'<tr><td class="form_option">Subtitle </td><td class="form_value"><input name="dy_title" id="dy_title"  type="text" value="" /></td><tr>'+
								'<tr><td class="form_option">Position </td><td class="form_value"><input name="dy_position" id="dy_position"  type="text" value="" /><br><sub style="color:#999;font-size: 12px;">left / right / center</sub></td><tr>'+
								'<tr><td class="form_option">Class</td><td class="form_value"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
								'<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" href="#" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+		 
							'<div class="modal_close"> X </div>'+
						   '</table></div></div> <div class="modalback_mask"></div>');
					
			jQuery(".modal_close").click(function(){
				  jQuery(".modal").hide();
				  jQuery(".modalback_mask").hide();
			});		 
					 
			jQuery(".form_create_btn").click(function(){ 
				
				jQuery(".modal").hide();
				jQuery(".modalback_mask").hide();

				dy_id = new Array();
				jQuery("input[name=dy_id]").each(function () {
				  	    dy_id.pop();
					    dy_id.push(jQuery(this).val());
				});

				dy_class = new Array();
				jQuery("input[name=dy_class]").each(function () {
					    dy_class.pop();
					    dy_class.push(jQuery(this).val());
				});
			    
			    dy_title = new Array();
				jQuery("input[name=dy_title]").each(function () {
				 	    dy_title.pop();
					    dy_title.push(jQuery(this).val());
				});
				
				dy_position = new Array();
				jQuery("input[name=dy_position]").each(function () {
				  	    dy_position.pop();
					    dy_position.push(jQuery(this).val());
				});
				
			     jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[h3 class="icf_subtitle" class="'+dy_class+'" style="text-align:'+dy_position+'"]'+dy_title+'[/h3]');             	 
			}); 	 
				   
            break;		
     
     case "interakt_text_button":

	     boxName="textbox-"+countBox; 
		 countBox += 1;

		  jQuery('.wp-admin')                         
				 .append('<div class="modal"><div class="modal_title">Text Box</div>'+
					   '<div class="modalbody">'+
						  '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
								'<tr><td class="form_option">Required </td><td class="form_required"><input type="checkbox" name="dy_required" id="dy_required"/></td>'+
								'<tr><td class="form_option">Label </td><td class="form_value"> <input name="dy_label" id="dy_label"  type="text" value="" /></td>'+
								'<tr><td class="form_option">Name </td><td class="form_value"><input name="dy_name" id="dy_name"  type="text" value="" /></td><tr>'+
								'<tr><td class="form_option">ID* </td><td class="form_value"> <input name="dy_id" id="dy_id"  type="text" value="'+boxName+'" /></td>'+
								'<tr><td class="form_option">Class</td><td class="form_value"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
								'<tr><td class="form_option">Placeholder </td><td class="form_value"><input name="dy_placeholder" id="dy_placeholder"  type="text" value="" /></td><tr>'+
								'<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" href="#" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
							'<div class="information_title"> Note : Id field is mandatory to send data into mail.<br></div>'+
							'<div class="modal_close"> X </div>'+
						   '</table></div></div> <div class="modalback_mask"></div>');
					
			jQuery(".modal_close").click(function(){
				  jQuery(".modal").hide();
				  jQuery(".modalback_mask").hide();
			});		 
					 
			jQuery(".form_create_btn").click(function(){ 
				
				jQuery(".modal").hide();
				jQuery(".modalback_mask").hide();

				dy_label = new Array();
			    jQuery("input[name=dy_label]").each(function () {
					 dy_label.pop();
					 dy_label.push(jQuery(this).val());
				});

				dy_name = new Array();
				jQuery("input[name=dy_name]").each(function () {
					 dy_name.pop();
					 dy_name.push(jQuery(this).val());
				});

				dy_id = new Array();
				jQuery("input[name=dy_id]").each(function () {
					 dy_id.pop();
					 dy_id.push(jQuery(this).val());
				});

				dy_class = new Array();
				jQuery("input[name=dy_class]").each(function () {
					 dy_class.pop();
					 dy_class.push(jQuery(this).val());
				});
			    
			    dy_placeholder = new Array();
				jQuery("input[name=dy_placeholder]").each(function () {
					 dy_placeholder.pop();
					 dy_placeholder.push(jQuery(this).val());
				});

				dy_required = new Array();
				jQuery("input[name=dy_required]").each(function () {
					 dy_required.pop();
					 dy_required.push(jQuery(this).is(':checked'));
				});
	   

			
		        if(dy_required == 'true'){
 
			     jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'(required)'+'[/label]'+'[input  type="text" name="'+dy_name+'" id="'+dy_id+'" class="'+dy_class+'"  placeholder="'+dy_placeholder+'" required]');             	 
		        }
	            else  {
		         jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]s'+'[input  type="text" name="'+dy_name+'" id="'+dy_id+'" class="'+dy_class+'" placeholder="'+dy_placeholder+'" ]');             	 
		        }
			}); 	 
				   
            break;
				
    case "interakt_email_button":

         boxName="email-"+countBox; 
	     countBox += 1;
 
	     jQuery('.wp-admin')                         
	        .append('<div class="modal"><div class="modal_title">Email</div>'+
	            '<div class="modalbody">'+
	                '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
	                '<tr><td class="form_option">Required </td><td class="form_required"><input name="dy_required" id="dy_required"  type="checkbox" value="" /></td>'+
	                 '<tr><td class="form_option">Label </td><td class="form_value"> <input name="dy_label" id="dy_label"  type="text" value="" /></td>'+
	                 '<tr><td class="form_option">Name </td><td class="form_value"><input name="dy_name" id="dy_name"  type="text" value="" /></td><tr>'+ 
	                 '<tr><td class="form_option">ID* </td><td class="form_value"> <input name="dy_id" id="dy_id"  type="text" value="'+boxName+'" /></td>'+
	                 '<tr><td class="form_option">Class</td><td class="form_value"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
	                 '<tr><td class="form_option">Placeholder </td><td class="form_value"><input name="dy_placeholder" id="dy_placeholder"  type="text" value="" /></td><tr>'+
	                 '<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
	                 '<div class="information_title"> Note : Id field is mandatory to send data into mail.</div>'+
	                 '<div class="modal_close"> X </div>'+
	                '</table></div></div> <div class="modalback_mask"></div>');
	         
		jQuery(".modal_close").click(function(){
			 jQuery(".modal").hide();
			 jQuery(".modalback_mask").hide();
		});		 
				 
		jQuery(".form_create_btn").click(function(){
	   
			jQuery(".modal").hide();
			jQuery(".modalback_mask").hide();
							
			dy_label = new Array();
			jQuery("input[name=dy_label]").each(function () {
				dy_label.pop();
				dy_label.push(jQuery(this).val());
			});

			dy_name = new Array();
			jQuery("input[name=dy_name]").each(function () {
				dy_name.pop();
				dy_name.push(jQuery(this).val());
			});

			dy_id = new Array();
			jQuery("input[name=dy_id]").each(function () {
				dy_id.pop();
				dy_id.push(jQuery(this).val());
			});

			dy_class = new Array();
			jQuery("input[name=dy_class]").each(function () {
				dy_class.pop();
				dy_class.push(jQuery(this).val());
			});

			dy_placeholder = new Array();
			jQuery("input[name=dy_placeholder]").each(function () {
				dy_placeholder.pop();
				dy_placeholder.push(jQuery(this).val());
			});

			dy_required = new Array();
			jQuery("input[name=dy_required]").each(function () {
				dy_required.pop();
				dy_required.push(jQuery(this).is(':checked'));
			});

			if(dy_required == 'true'){
			 jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'(required)'+'[/label]'+'[input  name="'+dy_name+'" type="email" id="'+dy_id+'" class="'+dy_class+'"  placeholder="'+dy_placeholder+'" required]');             	 
            }
			else  {
			 jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[input name="'+dy_name+'" type="email" id="'+dy_id+'" class="'+dy_class+'" placeholder="'+dy_placeholder+'" ]');             	 
			}				  

      }); 
 
      break;


 case "interakt_tel_button":

	  boxName="tel-"+countBox; 
	  countBox += 1;
 
	   jQuery('.wp-admin')                         
	           .append('<div class="modal"><div class="modal_title">Telephone</div>'+
	            '<div class="modalbody">'+
	                '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
	                '<tr><td class="form_option">Required </td><td class="form_required"> <input name="dy_required" id="dy_required"  type="checkbox" value="" /></td>'+
	                 '<tr><td class="form_option">Label </td><td class="form_value"> <input name="dy_label" id="dy_label"  type="text" value="" /></td>'+
	                 '<tr><td class="form_option">Name </td><td class="form_value"><input name="dy_name" id="dy_name"  type="text" value="" /></td><tr>'+
	                 '<tr><td class="form_option">ID* </td><td class="form_value"> <input name="dy_id" id="dy_id"  type="text" value="'+boxName+'" /></td>'+
	                 '<tr><td class="form_option">Class</td><td class="form_value"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
	                 '<tr><td class="form_option">Placeholder </td><td class="form_value"><input name="dy_placeholder" id="dy_placeholder"  type="text" value="" /></td><tr>'+
	                 '<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
	                 '<div class="information_title"> Note : Id field is mandatory to send data into mail.</div>'+
	                 '<div class="modal_close"> X </div>'+
	                '</table></div></div> <div class="modalback_mask"></div>');
        
	  jQuery(".modal_close").click(function(){
		 jQuery(".modal").hide();
		 jQuery(".modalback_mask").hide();
	  });		 
			 
	  jQuery(".form_create_btn").click(function(){
	   
		  jQuery(".modal").hide();
		  jQuery(".modalback_mask").hide();
			
	      dy_label = new Array();
		  jQuery("input[name=dy_label]").each(function () {
				dy_label.pop();
				dy_label.push(jQuery(this).val());
		  });

		  dy_name = new Array();
		  jQuery("input[name=dy_name]").each(function () {
				dy_name.pop();
				dy_name.push(jQuery(this).val());
		  });

		  dy_id = new Array();
		  jQuery("input[name=dy_id]").each(function () {
				dy_id.pop();
				dy_id.push(jQuery(this).val());
		  });

	      dy_class = new Array();
	      jQuery("input[name=dy_class]").each(function () {
			dy_class.pop();
			dy_class.push(jQuery(this).val());
	      });

		  dy_placeholder = new Array();
		  jQuery("input[name=dy_placeholder]").each(function () {
			dy_placeholder.pop();
			dy_placeholder.push(jQuery(this).val());
		  });

		  dy_required=new Array();
		  jQuery("input[name=dy_required]").each(function () {
			dy_required.pop();
			dy_required.push(jQuery(this).is(':checked'));
		  }); 
                 
	      if(dy_required == 'true'){
		   jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[input  name="'+dy_name+'" type="tel" id="'+dy_id+'" class="'+dy_class+'"  placeholder="'+dy_placeholder+'" required]');             	 
	      }
		  else  {
		   jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[input  name="'+dy_name+'" type="tel"  id="'+dy_id+'" class="'+dy_class+'" placeholder="'+dy_placeholder+'" ]');             	 
		  }	
     });

     break;
  
case "interakt_Number_button":

       boxName="number-"+countBox; 
       countBox += 1; 

	   jQuery('.wp-admin')
	     .append('<div class="modal"><div class="modal_title">Number</div>'+
	        '<div class="modalbody">'+
	        '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
	        '<tr><td class="form_options">Required </td><td class="form_required"> <input name="dy_required" id="dy_label"  type="checkbox" value="" /></td>'+
	        '<tr><td class="form_options">Label </td><td class="form_values"> <input name="dy_label" id="dy_label"  type="text" value="" /></td>'+
	        '<tr><td class="form_options">Name </td><td class="form_values"><input name="dy_name" id="dy_name"  type="text" value="" /></td><tr>'+
			'<tr><td class="form_range">Range </td>'+
			'<td class="form_options1">Min</td><td class="form_values1"><input name="dy_minrange" id="dy_minrange"  type="number" value="" style="width:100%;max-width:50px" /></td>'+
			'<td class="form_options2">Max </td><td class="form_values2"><input name="dy_maxrange" id="dy_maxrange"  type="number" value="" style="width:100%;max-width:50px" /></td></tr>'+
	        '<tr><td class="form_options">ID* </td><td class="form_values"> <input name="dy_id" id="dy_id"  type="text" value="'+boxName+'" /></td>'+
	        '<tr><td class="form_options">Class</td><td class="form_values"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
	        '<tr><td class="form_options">Placeholder </td><td class="form_values"><input name="dy_placeholder" id="dy_placeholder"  type="text" value="" /></td><tr>'+
	        '<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
	        '<div class="information_title"> Note : Id field is mandatory to send data into mail.</div>'+
	        '<div class="modal_close"> X </div>'+    
	        '</table></div></div> <div class="modalback_mask"></div>');
         
       jQuery(".modal_close").click(function(){
			 jQuery(".modal").hide();
			 jQuery(".modalback_mask").hide();
	   });		 	 
         
       jQuery(".form_create_btn").click(function(){
   
			jQuery(".modal").hide();
			jQuery(".modalback_mask").hide();

			dy_label = new Array();
			jQuery("input[name=dy_label]").each(function () {
					dy_label.pop();
					dy_label.push(jQuery(this).val());
			});

			dy_name = new Array();
			jQuery("input[name=dy_name]").each(function () {
					dy_name.pop();
					dy_name.push(jQuery(this).val());
			});

			dy_id = new Array();
			jQuery("input[name=dy_id]").each(function () {
					dy_id.pop();
					dy_id.push(jQuery(this).val());
			});

			dy_class = new Array();
			jQuery("input[name=dy_class]").each(function () {
					dy_class.pop();
					dy_class.push(jQuery(this).val());
			});

			dy_maxrange = new Array();
            jQuery("input[name=dy_maxrange]").each(function () {
                dy_maxrange.pop();
                dy_maxrange.push(jQuery(this).val());
             });

	        dy_minrange = new Array();
	        jQuery("input[name=dy_minrange]").each(function () {
	                dy_minrange.pop();
	                dy_minrange.push(jQuery(this).val());
	        });

		    dy_placeholder = new Array();
		    jQuery("input[name=dy_placeholder]").each(function () {
				dy_placeholder.pop();
				dy_placeholder.push(jQuery(this).val());
			});

		    dy_required = new Array();
		    jQuery("input[name=dy_required]").each(function () {
					dy_required.pop();
					dy_required.push(jQuery(this).is(':checked'));
		    });


	   	    if(dy_required == 'true'){
		          jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[input  name="'+dy_name+'" type="number" max="'+dy_maxrange+'" min="'+dy_minrange+'" id="'+dy_id+'" class="'+dy_class+'"  placeholder="'+dy_placeholder+'" required]');             	 
			}
			else  {
				  jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[input name="'+dy_name+'" type="number" max="'+dy_maxrange+'" min="'+dy_minrange+'" id="'+dy_id+'" class="'+dy_class+'"  placeholder="'+dy_placeholder+'"]');      
	        }	
      }); 
		 	 
      break;
	 
	 
case "interakt_date_button":
 
      boxName="date-"+countBox;       
      countBox += 1;
	   /* Get browser */
    jQuery.browser.firefox = /firefox/.test(navigator.userAgent.toLowerCase());

    /* Detect Chrome */
    if(jQuery.browser.firefox){
        /* Do something for Chrome at this point */
       // alert("You are using firebox!");
		
		 jQuery('.wp-admin')                         
        .append('<div class="modal"><div class="modal_title">Date</div>'+
            '<div class="modalbody">'+
                '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
                '<tr><td class="form_options">Required </td><td class="form_required"> <input name="dy_required" id="dy_required"  type="checkbox" value="" /></td>'+
                 '<tr><td class="form_options">Label </td><td class="form_values"> <input name="dy_label" id="dy_label"  type="text" value="" /></td>'+
                 '<tr><td class="form_options">Name </td><td class="form_values"><input name="dy_name" id="dy_name"  type="text" value="" /></td><tr>'+
				 '<tr><td class="form_range">Range </td>'+
			         '<td class="form_optionsdate"  style="left:110px !important">Max</td><td class="form_valuesdate" style="left:10% !important"><input name="dy_maxrange" id="dy_maxrange testing"  type="" value="" style="width:50%" placeholder="yy-mm-dd"/></td>'+
			         '<td class="form_optionsdate2"  style="left:0 !important">Min </td><td class="form_valuesdate2" style="right: 0 !important"><input name="dy_minrange" id="dy_minrange"  type="" value="" style="width:89%" placeholder="yy-mm-dd"/></td></tr>'+
                '<tr><td class="form_options">ID* </td><td class="form_values"> <input name="dy_id" id="dy_id"  type="text" value="'+boxName+'" /></td>'+
                 '<tr><td class="form_options">Class</td><td class="form_values"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
                '<tr><td class="form_options">Placeholder </td><td class="form_values"><input name="dy_placeholder" id="dy_placeholder"  type="text" value="" /></td><tr>'+
                '<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
                '<div class="information_title"> Note : Id field is mandatory to send data into mail.</div>'+
                '<div class="modal_close"> X </div>'+     
                '</table></div></div> <div class="modalback_mask"></div>');
         
		 jQuery(".modal_close").click(function(){
	         jQuery(".modal").hide();
	         jQuery(".modalback_mask").hide();
         });		 
                 
         jQuery(".form_create_btn").click(function(){
		   
             jQuery(".modal").hide();
             jQuery(".modalback_mask").hide();
     
			  dy_label = new Array()
			 jQuery("input[name=dy_label]").each(function () {
					dy_label.pop();
					dy_label.push(jQuery(this).val());
			 });

			 dy_name = new Array()
			 jQuery("input[name=dy_name]").each(function () {
					dy_name.pop();
					dy_name.push(jQuery(this).val());
			 });

			 dy_id = new Array()
			 jQuery("input[name=dy_id]").each(function () {
					dy_id.pop();
					dy_id.push(jQuery(this).val());
			 });

			 dy_class = new Array()
			 jQuery("input[name=dy_class]").each(function () {
					dy_class.pop();
					dy_class.push(jQuery(this).val());
			 });
			 
			 dy_maxrange = new Array();
             jQuery("input[name=dy_maxrange]").each(function () {
                    dy_maxrange.pop();
                    dy_maxrange.push(jQuery(this).val());
             });

	        dy_minrange = new Array();
	        jQuery("input[name=dy_minrange]").each(function () {
	                dy_minrange.pop();
	                dy_minrange.push(jQuery(this).val());
	        });

			 dy_placeholder = new Array()
			 jQuery("input[name=dy_placeholder]").each(function () {
					dy_placeholder.pop();
					dy_placeholder.push(jQuery(this).val());
			 });

			 dy_required = new Array()
			 jQuery("input[name=dy_required]").each(function () {
					dy_required.pop();
					dy_required.push(jQuery(this).is(':checked'));
			 });

          if(dy_required == 'true'){
               jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[input name="'+dy_name+'" type="date" max="'+dy_maxrange+'" min="'+dy_minrange+'" id="'+dy_id+'" class="'+dy_class+'" placeholder="'+dy_placeholder+'"  required]');             	     
             }
             else  {
               jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[input name="'+dy_name+'" type="date" max="'+dy_maxrange+'" min="'+dy_minrange+'" id="'+dy_id+'" class="'+dy_class+'" placeholder="'+dy_placeholder+'" ]');             	 

             }
			   
		 });
        
     }
	 else{

	  jQuery('.wp-admin')                         
        .append('<div class="modal"><div class="modal_title">Date</div>'+
            '<div class="modalbody">'+
                '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
                '<tr><td class="form_options">Required </td><td class="form_required"> <input name="dy_required" id="dy_required"  type="checkbox" value="" /></td>'+
                 '<tr><td class="form_options">Label </td><td class="form_values"> <input name="dy_label" id="dy_label"  type="text" value="" /></td>'+
                 '<tr><td class="form_options">Name </td><td class="form_values"><input name="dy_name" id="dy_name"  type="text" value="" /></td><tr>'+
				 '<tr><td class="form_range">Range </td>'+
			         '<td class="form_optionsdate2">Min </td><td class="form_valuesdate2"><input name="dy_minrange" id="dy_minrange"  type="date" value="" style="width:85%" /></td></tr>'+
			          '<td class="form_optionsdate">Max</td><td class="form_valuesdate"><input name="dy_maxrange" id="dy_maxrange"  type="date" value="" style="width:85%" /></td>'+
                '<tr><td class="form_options">ID* </td><td class="form_values"> <input name="dy_id" id="dy_id"  type="text" value="'+boxName+'" /></td>'+
                 '<tr><td class="form_options">Class</td><td class="form_values"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
                '<tr><td class="form_options">Placeholder </td><td class="form_values"><input name="dy_placeholder" id="dy_placeholder"  type="text" value="" /></td><tr>'+
                '<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
                '<div class="information_title"> Note : Id field is mandatory to send data into mail.</div>'+
                '<div class="modal_close"> X </div>'+ 
                '</table></div></div> <div class="modalback_mask"></div>');
         
		 jQuery(".modal_close").click(function(){
	         jQuery(".modal").hide();
	         jQuery(".modalback_mask").hide();
         });		 
                 
         jQuery(".form_create_btn").click(function(){
		   
             jQuery(".modal").hide();
             jQuery(".modalback_mask").hide();
     
			  dy_label = new Array()
			 jQuery("input[name=dy_label]").each(function () {
					dy_label.pop();
					dy_label.push(jQuery(this).val());
			 });

			 dy_name = new Array()
			 jQuery("input[name=dy_name]").each(function () {
					dy_name.pop();
					dy_name.push(jQuery(this).val());
			 });

			 dy_id = new Array()
			 jQuery("input[name=dy_id]").each(function () {
					dy_id.pop();
					dy_id.push(jQuery(this).val());
			 });

			 dy_class = new Array()
			 jQuery("input[name=dy_class]").each(function () {
					dy_class.pop();
					dy_class.push(jQuery(this).val());
			 });
			 
			 dy_maxrange = new Array();
             jQuery("input[name=dy_maxrange]").each(function () {
                    dy_maxrange.pop();
                    dy_maxrange.push(jQuery(this).val());
             });

	        dy_minrange = new Array();
	        jQuery("input[name=dy_minrange]").each(function () {
	                dy_minrange.pop();
	                dy_minrange.push(jQuery(this).val());
	        });

			 dy_placeholder = new Array()
			 jQuery("input[name=dy_placeholder]").each(function () {
					dy_placeholder.pop();
					dy_placeholder.push(jQuery(this).val());
			 });

			 dy_required = new Array()
			 jQuery("input[name=dy_required]").each(function () {
					dy_required.pop();
					dy_required.push(jQuery(this).is(':checked'));
			 });

          if(dy_required == 'true'){
               jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[input name="'+dy_name+'" type="date"  id="'+dy_id+'" min="'+dy_minrange+'" max="'+dy_maxrange+'" class="'+dy_class+'" placeholder="'+dy_placeholder+'"  required]');             	     
             }
             else  {
               jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[input name="'+dy_name+'" type="date" id="'+dy_id+'" min="'+dy_minrange+'" max="'+dy_maxrange+'" class="'+dy_class+'" placeholder="'+dy_placeholder+'" ]');             	 

             }
			   

	   }); 
	 }
	   break;
		 
  case "interakt_textarea_button":
        
        boxName="textarea-"+countBox; 
        countBox += 1; 

	    jQuery('.wp-admin')                         
           .append('<div class="modal"><div class="modal_title">Text Area</div>'+
            '<div class="modalbody">'+
                '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
                '<tr><td class="form_option">Required </td><td class="form_required"> <input name="dy_required" id="dy_required"  type="checkbox" value="" /></td>'+
                 '<tr><td class="form_option">Label </td><td class="form_value"> <input name="dy_label" id="dy_label"  type="text" value="" /></td>'+
                 '<tr><td class="form_option">Name </td><td class="form_value"><input name="dy_name" id="dy_name"  type="text" value="" /></td><tr>'+
                 '<tr><td class="form_option">ID* </td><td class="form_value"> <input name="dy_id" id="dy_id"  type="text" value="'+boxName+'" /></td>'+
                 '<tr><td class="form_option">Class</td><td class="form_value"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
                '<tr><td class="form_option">Placeholder </td><td class="form_value"><input name="dy_placeholder" id="dy_placeholder"  type="text" value="" /></td><tr>'+
                '<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
                '<div class="information_title"> Note : Id field is mandatory to send data into mail.</div>'+
                '<div class="modal_close"> X </div>'+    
                '</table></div></div> <div class="modalback_mask"></div>');
         
		 jQuery(".modal_close").click(function(){
	          jQuery(".modal").hide();
	          jQuery(".modalback_mask").hide();
         });		 
                 
         jQuery(".form_create_btn").click(function(){
		   
             jQuery(".modal").hide();
             jQuery(".modalback_mask").hide();
     
			 dy_placeholder = new Array()
			 jQuery("input[name=dy_placeholder]").each(function () {
					dy_placeholder.pop();
					dy_placeholder.push(jQuery(this).val());
			 });
			 dy_label = new Array()
			 jQuery("input[name=dy_label]").each(function () {
					dy_label.pop();
					dy_label.push(jQuery(this).val());
			 });
			 dy_name = new Array()
			 jQuery("input[name=dy_name]").each(function () {
					dy_name.pop();
					dy_name.push(jQuery(this).val());
			 });
			 dy_id = new Array()
			 jQuery("input[name=dy_id]").each(function () {
					dy_id.pop();
					dy_id.push(jQuery(this).val());
			 });
			 dy_class = new Array()
			 jQuery("input[name=dy_class]").each(function () {
					dy_class.pop();
					dy_class.push(jQuery(this).val());
			 });

			 dy_required=new Array()
		     jQuery("input[name=dy_required]").each(function () {
					dy_required.pop();
					dy_required.push(jQuery(this).is(':checked'));
		     });

          
		     if(dy_required == 'true'){		 
              jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[textarea name="'+dy_name+'" id="'+dy_id+'" class="'+dy_class+'"  placeholder="'+dy_placeholder+'" required][/textarea]');             	   
             }  
             else  {
             jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[textarea name="'+dy_name+'" id="'+dy_id+'" class="'+dy_class+'"  placeholder="'+dy_placeholder+'"][/textarea]');             	 
             }
       }); 

	   break;
		 
 case "interakt_dropdown_button":
 
       boxName="Dropdown-"+countBox; 
       countBox += 1; 

	   jQuery('.wp-admin')                         
	        .append('<div class="modal"><div class="modal_title">Dropdown</div>'+
	            '<div class="modalbody"><form name="tag-generator" action="#" method="post">'+
	                '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
	                '<tr><td class="form_option">Required </td><td class="form_required"> <input name="dy_required" id="dy_required"  type="checkbox" value="" /></td>'+
	                '<tr><td class="form_option">Label </td><td class="form_value"> <input name="dy_label" id="dy_label"  type="text" value="" /></td>'+
	                 '<tr><td class="form_option">Name </td><td class="form_value"><input name="dy_name" id="dy_name"  type="text" value="" required="required"/></td><tr>'+
					 '<tr><td class="dd_option">Options </td><td class="form_value"><textarea name="dy_dropdown" id="dy_dropdown"></textarea><br><sub style="color:#999999;">Use "Enter" to add different options.</sub> </td></tr>'+
	                 '<tr><td class="form_option">ID* </td><td class="form_value"> <input name="dy_id" id="dy_id"  type="text" value="'+boxName+'" /></td>'+
	                 '<tr><td class="form_option">Class</td><td class="form_value"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
	                /*'<tr><td class="form_option">Placeholder </td><td class="form_value"><input name="dy_placeholder" id="dy_placeholder"  type="text" value="" /></td><tr>'+*/
	                '<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
	                '<div class="information_title"> Note : Id field is mandatory to send data into mail.</div>'+
	                '<div class="modal_close"> X </div>'+     
	                '</table></form></div></div> <div class="modalback_mask"></div>');
         
		 jQuery(".modal_close").click(function(){
	         jQuery(".modal").hide();
	         jQuery(".modalback_mask").hide();
          });		 
                 
         jQuery(".form_create_btn").click(function(){
			 
		    jQuery(".modal").hide();
            jQuery(".modalback_mask").hide();
		  
			dy_label = new Array()
			jQuery("input[name=dy_label]").each(function () {
				dy_label.pop();
				dy_label.push(jQuery(this).val());
				
			 });

		    dy_name = new Array()
		    jQuery("input[name=dy_name]").each(function () {
				dy_name.pop();
				dy_name.push(jQuery(this).val());
			});

		    dy_id = new Array()
		    jQuery("input[name=dy_id]").each(function () {
				dy_id.pop();
				dy_id.push(jQuery(this).val());
			});


			dy_class = new Array()
			jQuery("input[name=dy_class]").each(function () {
				dy_class.pop();
				dy_class.push(jQuery(this).val());
			});

		    dy_placeholder = new Array()
			jQuery("input[name=dy_placeholder]").each(function () {
				dy_placeholder.pop();
				dy_placeholder.push(jQuery(this).val());
	        });

		    dy_required=new Array()
		    jQuery("input[name=dy_required]").each(function () {
				dy_required.pop();
				dy_required.push(jQuery(this).is(':checked'));
		    });
					   
			var dy_dropdown = [];
			jQuery("textarea[name=dy_dropdown]").each(function () {
			    dy_dropdown.pop();
			    var arrlen = jQuery(this).val() ;
			    var arrrepl = arrlen.replace(/(\r\n|\n|\r)/gm,' , ');
			    arrsplit =arrrepl.split(',');
			    dy_dropdown.push(arrrepl);
				
		    });

 
			jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]'+'[select name="'+dy_name+'" id="'+dy_id+'" class="'+dy_class+'" ]'+'\n');
            for (i=0; i<arrsplit.length; i++) { 	
			    if(dy_required == 'true'){
	                 jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[option  name="'+dy_name+'"  value ="'+arrsplit[i]+'"]'+arrsplit[i]+'[/option]'+'\n');         
	              }
	            else{
	                    jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[option  name="'+dy_name+'"  value= "'+arrsplit[i]+'"]'+arrsplit[i]+'[/option]'+'\n');
	            }
			}
			jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[/select]');
		
       }); 
	   
	   break;
		  
  case "interakt_radio_button":

	    boxName="radio-"+countBox; 
        countBox += 1; 
 
		jQuery('.wp-admin')                         
	        .append('<div class="modal"><div class="modal_title">Radio Button</div>'+
	            '<div class="modalbody">'+
	                '<p><table class="modal_table_container" name="dynamic_box" cellpadding="5px">'+
 	                 '<tr><td class="form_option">Label </td><td class="form_value"> <input name="dy_label" id="dy_label"  type="text" value="" /></td>'+
	                 '<tr><td class="form_option">Name </td><td class="form_value"><input name="dy_name" id="dy_name"  type="text" value="" /></td><tr>'+
	                 '<tr><td class="radio dd_option">Options </td><td class="form_value"><textarea name="radio_type" id="radio_type"></textarea><br><sub>Use "Enter" to add different options.</sub></td></tr>'+
					 '<tr><td class="form_option">ID*</td><td class="form_value"> <input name="dy_id" id="dy_id"  type="text" value="'+boxName+'" /></td>'+
	                 '<tr><td class="form_option">Class</td><td class="form_value"><input name="dy_class" id="dy_class"  type="text" value="" /></td></tr>'+
	                '<tr><td class="form_create_btn test" colspan="2"><div class="create_btn"><a id="dy_create_field" data-href="'+class_path+'" class="closebtn">Create</a></div></td></tr>'+
	                '<div class="information_title"> Note : Id field is mandatory to send data into mail.</div>'+
	                '<div class="modal_close"> X </div>'+  
	                '</table></div></div> <div class="modalback_mask"></div>');
         
	   jQuery(".modal_close").click(function(){
	         jQuery(".modal").hide();
	         jQuery(".modalback_mask").hide();
        });		 
                 
       jQuery(".form_create_btn").click(function(){
	   
	        jQuery(".modal").hide();
	        jQuery(".modalback_mask").hide();
	 
			dy_placeholder = new Array();
			jQuery("input[name=dy_placeholder]").each(function () {
				dy_placeholder.pop();
				dy_placeholder.push(jQuery(this).val());
			});

			dy_label = new Array();
			jQuery("input[name=dy_label]").each(function () {
				dy_label.pop();
				dy_label.push(jQuery(this).val());
			 });

			dy_name = new Array();
			jQuery("input[name=dy_name]").each(function () {
				dy_name.pop();
				dy_name.push(jQuery(this).val());
			});

			dy_id = new Array();
			jQuery("input[name=dy_id]").each(function () {
				dy_id.pop();
				dy_id.push(jQuery(this).val());
			});

			dy_class = new Array();
			jQuery("input[name=dy_class]").each(function () {
				dy_class.pop();
				dy_class.push(jQuery(this).val());
			});
 		
			var radio_type = [];
			jQuery("textarea[name=radio_type]").each(function () {
			    radio_type.pop();
			    var value = jQuery(this).val() ;
			    var someText = value.replace(/(\r\n|\n|\r)/gm,' , ');
			    arr =someText.split(',');
			    radio_type.push(someText);
				
		    });
			 

 			jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[label class="icf_label"]'+dy_label+'[/label]\n');
			jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[div class="radio_button_options"]');
		  
		    for (i=0; i<arr.length; i++){ 
		    	 dy_id = boxName +'-' + countBox;
		    	 countBox+= 1;
				jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[input name="'+dy_name+'"  type="radio" value ="'+arr[i]+'" id="'+dy_id+'" class="'+dy_class+'"]'+ arr[i] + '\n');             	                
		    }

			jQuery('#interakt_cf_editor_box').val(jQuery('#interakt_cf_editor_box').val()+'[/div]');

     }); 
	 
   } /* End if switch case */

 }); /* End of  modal structure */

 // jQuery("#interakt_form_save_btn").click(function(){
 //   var box_val = jQuery('#interakt_cf_editor_box').val();
 // });


}); /*End of document*/