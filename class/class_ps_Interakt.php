<?php

class PS_Interakt{
	
    /**
     * Holds the values to be used in the fields callbacks
     */

    public $options;

    /**
     * Start up
     */

    public function __construct()
    {
      $this->options = get_option( 'interakt_plugin_options_name' );
      add_action( 'admin_menu', array( $this, 'interakt_plugin_admin_add_page' ) );
      add_action( 'admin_init', array( $this, 'interakt_plugin_admin_init' ) );
      add_action('admin_enqueue_scripts', array(&$this, 'register_admin_script'));
      add_action( 'admin_init', array($this,'interakt_initialize_contactform_options') );  /**/
    }

    /**
     * Add options page
     */
    //$icon_url = plugin_dir_url( __FILE__ ) . 'images/interakt_logo.png';
    public function interakt_plugin_admin_add_page()
    {
      // This page will be under "Settings"sss
      add_menu_page(
        '',
        'Interakt',
        'manage_options',
        'interakt_plugin',
        array( $this, 'interakt_plugin_options_page' ),
        plugin_dir_url( __FILE__ ) . '../images/interakt_logo.png',
        58
      );
      add_submenu_page( 
        'interakt_plugin',
        'Setup',
        'Setup',
        'manage_options',
        'interakt_plugin',
         array( $this, 'interakt_plugin_options_general_page' )
      );
      add_submenu_page( 
        'interakt_plugin',
        'Contact Form',
        'Contact Form',
        'manage_options',
        'interakt_plugin_cf',
         array( $this, 'interakt_plugin_options_contact_page' )
      );
          
    }

    /**
     * Options page callback
     */ 
    public function interakt_plugin_options_page(){
      //do_action( 'add_meta_boxes', '' );
    }
  
    public function interakt_plugin_options_general_page(){
     
      
      ?>
      <div class="wrap">  
        <h2>Interakt App Settings</h2>
         <div class="interakt_wrap">     
          <?php settings_errors(); ?>    
         <div id="icon-themes" class="icon32"></div>
         <!-- <form id="setup_page_form" method="post" action="options.php"> -->
          
           <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>">
                  <div id="post-body-content"> 
                    <?php do_meta_boxes('','normal',null); ?>   
                    <div id="postbox-container-1" class="postbox-container">
                      <?php do_meta_boxes('','side',null); ?>       
                    </div>
                 </div>
            </div> <!-- #post-body -->
          </div> <!-- #poststuff -->

        <!-- </form> -->
       </div><!-- /.interakt_wrap -->
      </div><!-- /.wrap -->
    <?php 
   }


   public function interakt_plugin_options_contact_page(){
        // wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );  
        // wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );  
      
      ?><div class="wrap">       
        <h2>Contact Form Settings</h2>
        <?php settings_errors(); ?>
        <div class="interakt_wrap"> 
        <div id="icon-themes" class="icon32"></div>
         <!-- <form id="contact_page_form" method="post" action="options.php">    -->

          <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>">
                  <div id="post-body-content"> 
                    <?php do_meta_boxes('','normal',null); ?> 
                    <div id="postbox-container-1" class="postbox-container">
                      <?php do_meta_boxes('','side',null); ?>       
                    </div>
                 </div>
            </div> <!-- #post-body -->
           </div> <!-- #poststuff -->

       <!-- </form>  -->
       </div><!-- /.interakt_wrap -->     
    </div><!-- /.wrap -->
        <?php
   }

    

    /**
     * Register and add settings
     */
    
    public function interakt_plugin_admin_init()
    {
      register_setting(
        'interakt_plugin_options_group', // Option group
        'interakt_plugin_options_name', // Option name
        array( $this, 'interakt_plugin_options_validate' ) // Sanitize
      );

      add_settings_section(
        'interakt_app_do_not_reload_section_id', // ID
        '', // interakt_app_key
        array( $this, 'interakt_app_do_not_reload_message' ), // Callback
        '__FILE__' // Page
      );
      add_settings_section(
        'interakt_main_section_id', // ID
        'Configure Interakt App ID and API key', // interakt_app_key
        array( $this, 'interakt_main_section_cb' ), // Callback
        '__FILE__' // Page
      );
       
      //  add_settings_field(
      //   'interakt_app_do_not_reload',
      //   '',
      //   array( $this, 'interakt_app_do_not_reload_message' ),
      //   '__FILE__',
      //   'interakt_main_section_id'
      // );

      add_settings_field(
        'interakt_app_key',
        'Interakt App ID',
        array( $this, 'interakt_app_key_setting' ),
        '__FILE__',
        'interakt_main_section_id',
         array( 'label_for' => 'interakt_app_key' )
      );
      add_settings_field(
        'interakt_api_key',
        'Interakt API Key',
        array( $this, 'interakt_api_key_setting' ),
        '__FILE__',
        'interakt_main_section_id',
         array( 'label_for' => 'interakt_api_key' )
      );
      add_settings_field(
        'interakt_sink_data',
        'Initiate Manual Sync',
        array( $this, 'interakt_sync_data_button' ),
        '__FILE__',
        'interakt_main_section_id',
        array( 'label_for' => 'interakt_sink_data' )
      );
      add_settings_field(
        'interakt_no_of_users_synced',
        '',
        array( $this, 'interakt_no_of_users_synced_message' ),
        '__FILE__',
        'interakt_main_section_id'
      );
	  
	  /* Manage Apps Section In setup page*/

     if( false == get_option( 'interakt_manageapps_options' ) ) {   
        add_option( 'interakt_manageapps_options' );
     } // end if
     register_setting(
        'interakt_manageapps_options', // Option group
        'interakt_manageapps_options' // Option name
        //array( $this, 'interakt_contactform_options_validate' ) // Sanitize
     );

     add_settings_section(
        'interakt_notice_section_id', // ID
        '', // interakt_app_key
        array( $this, 'interakt_notice_section_cb' ), // Callback
        'interakt_manageapps_options' // Page
      );
        
	   add_settings_section(
        'interakt_chatfeed_section_id', // ID
        'Chat & Feedback Widgets Settings', // interakt_app_key
        array( $this, 'interakt_chatfeed_section_cb' ), // Callback
        'interakt_manageapps_options' // Page
      );
     
      add_settings_field(
        'chat_onoffswitch',
        'Live Chat',
        array( $this, 'interakt_chat_setting_cb' ),
        'interakt_manageapps_options',
        'interakt_chatfeed_section_id'
      );
  
      add_settings_field(
        'feedback_onoffswitch',
        'Helpdesk',
        array( $this, 'interakt_feedback_setting_cb' ),
        'interakt_manageapps_options',
        'interakt_chatfeed_section_id'
      ); 
      add_settings_section(
        'interakt_otherapps_section_id', // ID
        'Other Apps', // interakt_app_key
        array( $this, 'interakt_otherapps_section_cb' ), // Callback
        'interakt_manageapps_options' // Page
      );
      add_settings_field(
        'notification_link',
        'Notification',
        array( $this, 'interakt_notification_link_cb' ),
        'interakt_manageapps_options',
        'interakt_otherapps_section_id'
      );
  
      add_settings_field(
        'faq_link',
        'FAQ',
        array( $this, 'interakt_faq_link_cb' ),
        'interakt_manageapps_options',
        'interakt_otherapps_section_id'
      );   
   } 

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
  
    public function interakt_plugin_options_validate( $input )
    {
      return $input;
    }

    public function interakt_main_section_cb(){
    }

    /**
     * Get the settings option array and print one of its values
     */
    public function interakt_app_key_setting()
    {
   
      printf('<div id="app_id_mark" style=" display: none;"><i>You can find your Interakt App ID in your Interakt account settings.</i></div>');
      printf( 
        '<input type="text" id="interakt_app_key" name="interakt_plugin_options_name[interakt_app_key]"  class="CheckChange" value="%s" />',
        isset( $this->options['interakt_app_key'] ) ? esc_attr( $this->options['interakt_app_key']) : ''
      );
      printf('<img id="icon_correct" src="%s" height="17px" width="17px" style="display:none;"/>',plugin_dir_url( __FILE__ ) . '../images/tick.png');
      printf('<img id="icon_incorrect" src="%s" height="20px" width="20px" style="display:none;"/>',plugin_dir_url( __FILE__ ) . '../images/redcrossmark.png');
    }
    /**
    * Field for interakt app key
    */
    public function interakt_api_key_setting()
    {
      printf('<p id="api_key_mark" style=" display: none;"><i>You can find your Interakt API Key in your Interakt account settings.</i></p>');
      printf(
        '<input type="text" id="interakt_api_key" name="interakt_plugin_options_name[interakt_api_key]" class="CheckChange" value="%s" />',
        isset( $this->options['interakt_api_key'] ) ? esc_attr( $this->options['interakt_api_key']) : ''
      );
      printf('<img id="icon_correct" src="%s"  height="17px" width="17px" style="display:none;"/>',plugin_dir_url( __FILE__ ) . '../images/tick.png');
      printf('<img id="icon_incorrect" src="%s" height="20px" width="20px" style="display:none;"/>',plugin_dir_url( __FILE__ ) . '../images/redcrossmark.png');

    }
    public function interakt_sync_data_button(){
        
         printf('<input type="button" id="sink_btn" class="button" value="Sync Users" />');
        if ( class_exists( 'WooCommerce' ) ){
          printf('&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="sink_orders_btn" class="button" value="Sync Orders" />');
         }
          printf('<input type="hidden" id="sync_order_class_path" value="%s"/>', plugins_url("/class_syncing_order_data.php", __FILE__ ));
    }
    public function interakt_no_of_users_synced_message() {
       
         printf('<span id="msg1" style="font-size=20px;"></span>');
    }
    public function interakt_app_do_not_reload_message(){
    
         printf('<p id="reload_msg" style="font-size=20px;"></p>'); 
    }
	
	 public function interakt_chatfeed_section_cb(){    
   }
   public function interakt_notice_section_cb(){

    printf('<div class="notice notice-error custom" id="notice_msg" style="font-size=20px;">Please insert valid App ID and API key.</div>'); 
   }
 
   public function interakt_chat_setting_cb(){

    
     $interakt_app_key=isset($this->options['interakt_app_key'])?$this->options['interakt_app_key']:"";
     $chat_src = "https://interakt.co/apps/livechat";
     $options = get_option( 'interakt_manageapps_options' );
   
     $checked = ( isset($options['chat_onoffswitch']) && $options['chat_onoffswitch'] == 1) ? 1 : 0;
 
  	 printf(
  	  '<div class="chat_onoffswitch">
        <input type="checkbox" id="chat_onoffswitch" name="interakt_manageapps_options[chat_onoffswitch]" class="chat_onoffswitch-checkbox"  value="1"' . checked( 1, $checked, false ) . ' />
        <label class="chat_onoffswitch-label" for="chat_onoffswitch">
            <span class="chat_onoffswitch-inner"></span>
            <span class="chat_onoffswitch-switch"></span>
        </label>
       </div><div id="chat_subtitle"><i>To know more about our Live Chat application, please <a href="%s" target="_blank"><u>click here.</u></a></i></div>',$chat_src);
     printf('<input type="hidden" id="control_class_path" value="%s"/>', plugins_url("/class_chat_feedback_control.php", __FILE__ ));

    }
    
    public function interakt_feedback_setting_cb(){
      

     $interakt_app_key=isset($this->options['interakt_app_key'])?$this->options['interakt_app_key']:"";
     $feed_src = "https://interakt.co/apps/helpdesk";
  	 $options = get_option( 'interakt_manageapps_options' );

     $checked = ( isset($options['feedback_onoffswitch']) && $options['feedback_onoffswitch'] == 1) ? 1 : 0;
  	 
     printf(
  	  '<div class="feedback_onoffswitch">
      <input type="checkbox" id="feedback_onoffswitch" name="interakt_manageapps_options[feedback_onoffswitch]" class="feedback_onoffswitch-checkbox" value="1"' . checked( 1, $checked, false ) . '>
      <label class="feedback_onoffswitch-label" for="feedback_onoffswitch">
          <span class="feedback_onoffswitch-inner"></span>
          <span class="feedback_onoffswitch-switch"></span>
      </label>
      </div><div id="feed_subtitle"><i>To know more about our Helpdesk application, please <a href="%s" target="_blank"><u>click here.</u></a></i></div>',$feed_src);
        printf('<input type="hidden" id="control_class_path" value="%s"/>', plugins_url("/class_chat_feedback_control.php", __FILE__ ));
    }
    public function interakt_otherapps_section_cb(){    
    } 
    public function interakt_notification_link_cb()
    {    
      $interakt_app_key=isset($this->options['interakt_app_key'])?$this->options['interakt_app_key']:"";
      //$notf_src1 = "https://app.interakt.co/projects/".$interakt_app_key."/notifications";
      $notf_src = "https://interakt.co/apps/notifications";
      printf('<div class="button"><a href="%s" target="_blank">Manage Notifications</a></div>',$notf_src);
     //  $notf_src2 = "https://interakt.co/apps/notifications";
      printf('<div id="notf_subtitle" style=" display: block;"><i>To manage your Notifications, please <a href="%s" target="_blank"><u>click here.</u></a></i></div>',$notf_src);
    } 
    public function interakt_faq_link_cb(){   
      $interakt_app_key=isset($this->options['interakt_app_key'])?$this->options['interakt_app_key']:"";
      $faq_src = "https://faq.interakt.co/#/"; 
      printf('<div class="button"><a href="%s" target="_blank">Manage FAQs</a></div>',$faq_src);
      printf('<div id="faq_subtitle" style=" display: block;"><i>To manage your FAQs, please <a href="%s" target="_blank"><u>click here.</u></a></i></div><br><br>',$faq_src);
    } 
        
    public function register_admin_script() {
      $interakt_app_key=isset($this->options['interakt_app_key'])?$this->options['interakt_app_key']:"";
      $interakt_api_key=isset($this->options['interakt_api_key'])?$this->options['interakt_api_key']:"";
      wp_register_script('interakt-admin-script', plugins_url('../js/syncing_user_data.js', __FILE__), array('jquery'));  
      wp_enqueue_script('interakt-admin-script');
      wp_localize_script('interakt-admin-script', 'syncUserScript', array('pluginsUrl' => plugins_url(),'interakt_app_key'=>$interakt_app_key,'interakt_api_key'=>$interakt_api_key));
      
    }
  


public function interakt_initialize_contactform_options() {
 
    // If the contact form options don't exist, create them.
    if( false == get_option( 'interakt_contactform_options' ) ) {   
        add_option( 'interakt_contactform_options' );
    } // end if
    
     register_setting(
        'interakt_contactform_options', // Option group
        'interakt_contactform_options' // Option name
        //array( $this, 'interakt_contactform_options_validate' ) // Sanitize
      );

     add_settings_section(
        'interakt_cf_section_id', // ID
        '', // Title
        '', // Callback
        'interakt_contactform_options' // Page on which it is to be displayed
      );
      
       add_settings_field(
        'interakt_cf_editor_box',
        '',
        array( $this, 'interakt_text_span_callback' ),
        'interakt_contactform_options',
        'interakt_cf_section_id'
      );    
       add_settings_field(
        'interakt_cf_shortcode',
        '',
        array( $this, 'interakt_cf_shortcode_callback' ),
        'interakt_contactform_options',
        'interakt_cf_section_id'
      );  

    /* Contact-Form Email format setting */
    
   if( false == get_option( 'interakt_mail_options' ) ) {   
        add_option( 'interakt_mail_options' );
    } // end if
     register_setting(
        'interakt_mail_options', // Option group
        'interakt_mail_options' // Option name
        //array( $this, 'interakt_contactform_options_validate' ) // Sanitize
      );

      add_settings_section(
        'interakt_cf_mail_head_section_id', // ID
        '', // Title
        array( $this, 'interakt_cf_mail_head_callback' ), // Callback
        'interakt_mail_options' // Page on which it is to be displayed
      );   
   
      add_settings_section(
        'interakt_cf_format_section_id', // ID
        '', // Title
        '', // Callback
        'interakt_mail_options' // Page on which it is to be displayed
      ); 
      
     
      add_settings_field(
        'interakt_cf_recepient_email',
        'To',
        array( $this, 'interakt_cf_recepient_email_callback' ),
        'interakt_mail_options',
        'interakt_cf_format_section_id'
      ); 
      add_settings_field(
        'interakt_cf_subject',
        'Subject',
        array( $this, 'interakt_cf_subject_callback' ),
        'interakt_mail_options',
        'interakt_cf_format_section_id'
      );     
      add_settings_field(
        'interakt_cf_mail_body',
        'Message Body',
        array( $this, 'interakt_cf_mail_body_callback' ),
        'interakt_mail_options',
        'interakt_cf_format_section_id'
      );     

      /* Messages Tab settings*/

      if( false == get_option( 'interakt_contactform_msgs_options' ) ) {   
        add_option( 'interakt_contactform_msgs_options' );
      } // end if

       register_setting(
        'interakt_contactform_msgs_options', // Option group
        'interakt_contactform_msgs_options' // Option name
        //array( $this, 'interakt_contactform_options_validate' ) // Sanitize
      );
     add_settings_section(
        'interakt_cf_msg_head_section_id', // ID
        '', // Title
        array( $this, 'interakt_cf_msg_head_callback' ), // Callback
        'interakt_contactform_msgs_options' // Page on which it is to be displayed
      );  
     add_settings_section(
        'interakt_cf_msgs_section_id', // ID
        '', // Title
        array( $this, 'interakt_cf_success_msg_callback' ), // Callback
        'interakt_contactform_msgs_options' // Page on which it is to be displayed
     );         
                                                          
  } // end interakt_initialize_contactform_options
                              
 
   /**
   sanitize contact form settings fields
   */
    public function interakt_contactform_options_validate( $input )
    {
      return $input; 
    }
     public function interakt_mail_options_validate( $input )
    {
      return $input;
    }
    public function interakt_cf_msg_head_callback(){
      printf('<h3>Message</h3>Edit message to be displayed after form submission.');
    }

    public function interakt_cf_success_msg_callback(){

      printf('<br><br><span style="color:#666; font-size:13px;"><i> %s</i></span>',"Sender's message was sent successfully");
      $options = get_option( 'interakt_contactform_msgs_options' );
      if(!isset($options['interakt_cf_success_msg'])){
        $options['interakt_cf_success_msg'] = "Thank you.We will get back to you soon.";
        update_option('interakt_manageapps_options', $options);
      }
      printf(
        '<input type="text" id="interakt_cf_success_msg" name="interakt_contactform_msgs_options[interakt_cf_success_msg]" value="'.$options['interakt_cf_success_msg'].'" />'
      );
      
    }
   
   public function interakt_text_span_callback(){
     
      printf('<div id="editor-button">');
       printf('<h3 style="font-weight: 600;">Form</h3>');
	    printf('<input type="button" class="button cfi_mutual_settings" id="interakt_title_button" title="Title Genrator: ICF" value="title"/>');
      printf('<input type="button" class="button cfi_mutual_settings" id="interakt_subtitle_button" title="Subtitle Generator: ICF" value="subtitle"/>');
   	  printf('<input type="button" class="button cfi_mutual_settings" id="interakt_text_button" title="Form-tag Generator: text" value="text"/>');
      printf('<input type="button" class="button cfi_mutual_settings" id="interakt_email_button" title="Form-tag Generator: email" value="email"/>');
      printf('<input type="button" class="button cfi_mutual_settings" id="interakt_tel_button" title="Form-tag Generator: tel" value="tel"/>');
      printf('<input type="button" class="button cfi_mutual_settings" id="interakt_Number_button" title="Form-tag Generator: number" value="number"/>');
      printf('<input type="button" class="button cfi_mutual_settings" id="interakt_date_button" title="Form-tag Generator: date" value="date"/>');
      printf('<input type="button" class="button cfi_mutual_settings" id="interakt_textarea_button" title="Form-tag Generator: text area" value="text area"/>');
      printf('<input type="button" class="button cfi_mutual_settings" id="interakt_dropdown_button" title="Form-tag Generator: drop-down menu" value="dropdown"/>');
      printf('<input type="button" class="button cfi_mutual_settings" id="interakt_radio_button" title="Form-tag Generator: radio buttons" value="radio button"/>');
      

     $options = get_option( 'interakt_contactform_options' );

     printf('<br><textarea rows="20" cols="150" id="interakt_cf_editor_box" name="interakt_contactform_options[interakt_cf_editor_box]">%s</textarea><br><br>* Use "Enter" to position fields in the form.<br>*  An Email field in the form is mandatory to send leads to Interakt App.</div>', isset( $options['interakt_cf_editor_box'] ) ? esc_attr( $options['interakt_cf_editor_box']) : ''

      );
       printf('</div>');
     printf('<input type="hidden" id="class_path" value="%s"/>', plugins_url("/class_create_dynamic_fields.php", __FILE__ ));

   } 

    public function interakt_cf_shortcode_callback()
    { 
       $options = get_option( 'interakt_contactform_options' );
      printf('<b><span/>Shortcode</span><br><br>');
      if($options){
        printf('<b><input type="text" id="interakt_cf_shortcode" name="interakt_contactform_options[interakt_cf_shortcode]" value="[interakt_contact_form]"/></b><br>');
      }
      else{
        printf('<b><input type="text" id="interakt_cf_shortcode" name="interakt_contactform_options[interakt_cf_shortcode]" value=""/></b><br>');
      }
      
      printf('<span style="color:#666; font-size:12px;"><i>Copy this short code and paste on the page you want the contact form to appear.</i></span>');
    }
    public function interakt_cf_mail_head_callback(){
      printf('<h3>Mail</h3>Please fill in the details below to receive e-mails from the Contact Form.');
      
    }
    public function interakt_cf_recepient_email_callback(){

      $options = get_option( 'interakt_mail_options' );
      if(!isset($options['interakt_cf_recepient_email'])){
        $options['interakt_cf_recepient_email'] = "hello@example.com";
      }
      printf(
        '<input type="text" id="interakt_cf_recepient_email" name="interakt_mail_options[interakt_cf_recepient_email]" value="%s" />',
        isset( $options['interakt_cf_recepient_email'] ) ? esc_attr( $options['interakt_cf_recepient_email']) : ''
      );
    }
    
     public function interakt_cf_subject_callback(){
      $options = get_option( 'interakt_mail_options' );
      if(!isset($options['interakt_cf_subject'])){
        $options['interakt_cf_subject'] = "Feedback mail from WordPress site";
      }
      printf(
        '<input type="text" id="interakt_cf_subject" name="interakt_mail_options[interakt_cf_subject]" size="53" value="%s"/>', isset( $options['interakt_cf_subject'] ) ? esc_attr( $options['interakt_cf_subject']) : ''
      );
    }
    public function interakt_cf_mail_body_callback(){
      $options = get_option( 'interakt_mail_options' );
      if(!isset($options['interakt_cf_mail_body'])){
        $options['interakt_cf_mail_body'] = "Hi,\n\nYou have a new mail from your WordPress site.";
      }
 
      printf(
        '<textarea rows="13" cols="55" id="interakt_cf_mail_body" name="interakt_mail_options[interakt_cf_mail_body]" >%s</textarea>', isset( $options['interakt_cf_mail_body'] ) ? esc_attr( $options['interakt_cf_mail_body']) : ''
      ); 
      printf('<br><span style="color:#666; font-size:12px;">Message body will be attached at the beginning of email.</span>');
    }
 
 }/***end of PS_INTERAKT class***/
?>