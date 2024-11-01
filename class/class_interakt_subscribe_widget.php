<?php
class InteraktSubscribe_Widget extends WP_Widget {
	  
    public function __construct() {
        add_action('wp_enqueue_scripts', array(&$this, 'register_frontend_scripts'));

        parent::__construct(
            'interaktsubscribe_widget',
            __( 'Interakt Subscription Widget', 'interaktsubscription' ),
            array(
                'classname'   => 'interaktsubscribe_widget',
                'description' => __( 'Add a custom form to capture more leads via Interakt.', 'interaktsubscription' )
                )
        );

        load_plugin_textdomain( 'interaktsubscription', false, basename( dirname( __FILE__ ) ) . '/languages' );
    }

    public function register_frontend_scripts() {
        wp_enqueue_style('wp-interakt-subscribe', plugins_url('../css/interakt-frontend-style.css', __FILE__));
        wp_enqueue_script('wp-interakt-subscribe-frontend', plugins_url('../js/wp-interakt-subscribe-frontend.js', __FILE__), array('jquery'));  
        wp_enqueue_script('cf-validation-script', plugin_dir_url(__FILE__) . '../js/cf_validation.js');
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {

        extract( $args );
      	$title_check = $instance[ 'title_check' ] ? 'true' : 'false';
    		$text_check = $instance[ 'text_check' ] ? 'true' : 'false';
    		$style_check = $instance[ 'style_check' ] ? 'true' : 'false';
    		$btn_text_check = $instance[ 'btn_text_check' ] ? 'true' : 'false';
    		$name_check = $instance[ 'name_check' ] ? 'true' : 'false';
    		$phone_check = $instance[ 'phone_check' ] ? 'true' : 'false';
    		$msg_check = $instance[ 'msg_check' ] ? 'true' : 'false';
    		$btn_check = $instance[ 'btn_check' ] ? 'true' : 'false';
		

        $defaults = $this->get_defaults();

        $instance = wp_parse_args( (array) $instance, $defaults );

        echo $before_widget;

        if(!empty($instance['title'])){
          echo $before_title.apply_filters( 'widget_title', $instance['title'] ).$after_title;
        }		
        ?>

        <div class="interakt-subscribe" id="interakt-subscribe">
          <?php if(!empty($instance['text']))
            echo '<p class="interakt-subscribe-text">'.$instance['text'].'</p>';
          ?>  

  		    <form> 
            <div class="interakt-subscribe-form <?php //if($instance['cssstyle']=='inline')echo 'inline';?>">
   
             <?php 
             if(!$instance['name_check']=='false'){}
      		   else{
  				     echo '<input placeholder="Your Name" style=" border-radius: 4px" class="interakt-subscribe-field" type="text" name="name" id="interakt-subscribe-name" value="" required>';
  			      }
             ?>
            
             <input placeholder="Your E-mail" style=" border-radius: 4px" class="interakt-subscribe-field" type="email" name="email" id="interakt-subscribe-email" value=""  required>

             <?php 
             if(!$instance['phone_check']=='false'){}
  			     else{
  				
  		             echo ' <input placeholder="Your Phone No." style=" border-radius: 4px" class="interakt-subscribe-field" type="tel" name="phone" id="interakt-subscribe-phone" value="" pattern="^\d{10}$" >';

  			      } 
              ?>
              <a style="background-color:<?php echo $instance['btncolor'];?>;color:<?php echo $instance['textcolor'];?>" class="interakt-subscribe-button" id="subscribe-btn" href="#" data-href="<?php echo plugins_url('/class_send_email_to_interakt.php', __FILE__);?>"><?php echo $instance['btntext'];?></a>

            </div>
      		</form>
    	 </div>
       <div style="display:none;" id="sub-message"><?php echo $instance['msg'];?></div>
          
        <?php

        echo $after_widget;
    }


    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {

       $instance = $old_instance;
		
		   if(!isset($instance['title']) || empty($instance['title'])){
        echo '<script type="text/javascript">alert("It works.");</script>';
       }


       $instance['title'] = strip_tags( $new_instance['title'] );
       $instance['text'] = strip_tags($new_instance['text']);
	     $instance['phoneno'] = strip_tags($new_instance['phoneno']);
       $instance['cssstyle'] = strip_tags($new_instance['cssstyle']);
       $instance['msg'] = strip_tags($new_instance['msg']);
       $instance['btntext'] = strip_tags($new_instance['btntext']);
       $instance['title_check'] = strip_tags($new_instance['title_check']);
       $instance['text_check'] = strip_tags($new_instance['text_check']);
       $instance['style_check'] = strip_tags($new_instance['style_check']);
       $instance['name_check'] = strip_tags($new_instance['name_check']);
       $instance['btn_text_check'] = strip_tags($new_instance['btn_text_check']);
       $instance['phone_check'] = strip_tags($new_instance['phone_check']);	
       $instance['msg_check'] = strip_tags($new_instance['msg_check']);		
       $instance['btn_check'] = strip_tags($new_instance['btn_check']);
       $instance['chkbox'] = strip_tags($new_instance['chkbox']);
       $instance['btncolor'] = strip_tags($new_instance['btncolor']);
		   $instance['textcolor'] = strip_tags($new_instance['textcolor']);
       return $instance;

    }

    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */

    public function form( $instance ) {
	

        $defaults = $this->get_defaults();
        $instance = wp_parse_args( (array) $instance, $defaults );
		
	      if(!isset($instance['title']) || empty($instance['title'])){
         $title                = "Subscribe" ;
        }    
        else{
	
          $title                = esc_attr($instance['title'] );
        }

          $text                 = esc_attr($instance['text']);
  		
  	      $phoneno              = esc_attr($instance['phoneno']);
  	
  	      $ContactName          = esc_attr($instance['ContactName']);

          $cssstyle             = esc_attr($instance['cssstyle']);

          $msg                  = esc_attr($instance['msg']);

          $btntext              = esc_attr($instance['btntext']);
  		
  		    $title_check          = esc_attr($instance['title_check']);
  		
  		    $text_check          = esc_attr($instance['text_check']);
  		
  		    $style_check          = esc_attr($instance['style_check']);
  		
  		    $name_check          = esc_attr($instance['name_check']);
  		
  		    $phone_check          = esc_attr($instance['phone_check']);
  		
  		    $btn_text_check        = esc_attr($instance['btn_text_check']);
  		
  		    $msg_check          = esc_attr($instance['msg_check']);
  		
  		    $btn_check          = esc_attr($instance['btn_check']);
  	 
          $chkbox               = esc_attr($instance['chkbox']);

          $btncolor             = esc_attr($instance['btncolor']);
  		
  		    $textcolor            = esc_attr($instance['textcolor']);
  		
  		    $testing              = esc_attr($instance['testing']);
		
        ?>
		


  <div class="formheader">
	  <a class="toggle"></a>
	  <a id="headeroption" style="display:inline-block;width:85%;"><h4 style="cursor:pointer">Header Options</h4></a>
	</div>

  <div class="formheade_body">

     <p id="#hide"> 
       <input type="checkbox"  <?php checked( $instance[ 'title_check' ], 'on' ) ?> class="widefat title" id="title <?php echo $this->get_field_id('title_check'); ?>"  name="<?php echo $this->get_field_name('title_check'); ?>"> 			 

       <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>

       <input class="titletype widefat" <?php if(checked( $instance[ 'title_check' ], 'on' )==true) {$abc="hi" ;} else{$abc="disabled";} ?>  <?php echo $abc ?> id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>

      <p> 
       <input type="checkbox"  <?php checked( $instance[ 'text_check' ], 'on' ); ?> class="widefat subscription" id="<?php echo $this->get_field_id('text_check'); ?>"  name="<?php echo $this->get_field_name('text_check'); ?>">

       <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Subscription Text'); ?></label>

       <input type="text" class="subscribe widefat" <?php if(checked( $instance[ 'text_check' ], 'on' )==true) {$subs="hi";} else{$subs="disabled";} ?>  <?php echo $subs ?> id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" value="<?php echo $text; ?>" />
      </p>

  </div>
	
        
	<div class="formbody">
  <a class="togglebody"></a>
	<a id="formoption" style="display:inline-block;width:85%;"><h4 style="cursor:pointer">Form Options</h4></a>
	</div>

  <div class="formbody_body">
		  
      <p>
			 <input type="checkbox"  <?php checked( $instance[ 'name_check' ], 'on' ); ?> class="widefat contact" id="<?php echo $this->get_field_id('name_check'); ?>"  name="<?php echo $this->get_field_name('name_check'); ?>">
       <label for="<?php echo $this->get_field_id('ContactName'); ?>"><?php _e('Contact Name'); ?></label>     
      </p>

		<p>  
			<input type="checkbox"  <?php checked( $instance[ 'phone_check' ], 'on' ); ?> class="widefat phone" id="<?php echo $this->get_field_id('phone_check'); ?>"  name="<?php echo $this->get_field_name('phone_check'); ?>"> 

      <label for="<?php echo $this->get_field_id('phoneno'); ?>"><?php _e('Contact Number'); ?></label>
    </p>

    <p>
		  <input type="checkbox"  <?php checked( $instance[ 'msg_check' ], 'on' ); ?> class="widefat message" id="<?php echo $this->get_field_id('msg_check'); ?>"  name="<?php echo $this->get_field_name('msg_check'); ?>"> 
           
      <label for="<?php echo $this->get_field_id('msg'); ?>"><?php _e('Thank You Message'); ?><br /></label><br />
     
      <input type="text"  <?php if(checked( $instance[ 'msg_check' ], 'on' )==true) {$msg_order="" ;} else{$msg_order="disabled";} ?>  <?php echo $msg_order ?> class="messagetype widefat" id="<?php echo $this->get_field_id('msg'); ?>" name="<?php echo $this->get_field_name('msg'); ?>" value="<?php echo $msg; ?>" />
    </p>

	</div>

	<div class="buttonbody">
  <a class="togglefooter"></a>
	<a id="buttonoptions" style="display:inline-block;width:85%;"><h4 style="cursor:pointer">Button Options</h4></a>
	</div>

	<div class="buttonbody_body">
    <p>
  		  <input type="checkbox"  <?php checked( $instance[ 'btn_check' ], 'on' ); ?> class="widefat btncolor" id="<?php echo $this->get_field_id('btn_check'); ?>"  name="<?php echo $this->get_field_name('btn_check'); ?>"> 
        
        <label for="<?php echo $this->get_field_id('btncolor'); ?>"><?php _e('Choose Sign Up Button Color'); ?></label>
        
        <input type="color" <?php if(checked( $instance[ 'btn_check' ], 'on' )==true) {$btncolor_order="" ;} else{$btncolor_order="disabled";} ?>  <?php echo $btncolor_order ?> class="colortype widefat" id="<?php echo $this->get_field_id('btncolor'); ?>" name="<?php echo $this->get_field_name('btncolor'); ?>" value="<?php echo $btncolor; ?>" />
    </p>

		<p>
  		  <input type="checkbox"  <?php checked( $instance[ 'btn_text_check' ], 'on' ); ?> class="widefat textcolor" id="<?php echo $this->get_field_id('btn_text_check'); ?>"  name="<?php echo $this->get_field_name('btn_text_check'); ?>"> 

        <label for="<?php echo $this->get_field_id('text-color'); ?>"><?php _e('Choose Sign Up text Color'); ?></label>
         
        <input type="color"  <?php if(checked( $instance[ 'btn_text_check' ], 'on' )==true) {$btntxt_order="" ;} else{$btntxt_order="disabled";} ?>  <?php echo $btntxt_order ?> class="textcolortype widefat" id="<?php echo $this->get_field_id('textcolor'); ?>" name="<?php echo $this->get_field_name('textcolor'); ?>" value="<?php echo $textcolor; ?>" />
    </p>
     
    <p>	
        <label for="<?php echo $this->get_field_id('btntext'); ?>"><?php _e('Sign Up Button Text'); ?></label>
        
        <input type="text" class="btntexttype widefat" id="<?php echo $this->get_field_id('btntext'); ?>" name="<?php echo $this->get_field_name('btntext'); ?>" value="<?php echo $btntext; ?>" />
    </p>

	 </div>
     

  <?php
   }

   public function get_defaults(){

      return array(
        'title'=>'Subscribe',
        'title_check' => '',
        'text'=>'Subscibe to our newsletter',
        'interakt_app_id'=>'',
        'interakt_api_key'=>'',
        //'cssstyle' => 'inline',
		    'ContactName' => 'Name',
        'msg' =>'Thank You For Subscription',
        'btncolor'=>'#000000',
    		'textcolor'=>'#ffffff',
    		'title_check'=>'on',
    		'text_check'=>'on',
    		'style_check'=>'on',
    		'name_check'=>'on',
    		'phone_check'=>'on',
    		'msg_check'=>'on',
    		'btn_check'=>'on',
    		'btn_text_check'=>'on',
        'btntext'=>'Submit',
    		'testing'=>'test',
    		'phoneno'=>'Contact No.',	
      );
  }

}/* End of class */

/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'InteraktSubscribe_Widget' );
});
?>