<?php
/*

  Plugin Name: Interakt for WordPress
  Plugin URI: http://interakt.co
  Description: Integrate the <a href="http://interakt.co">Interakt</a> all in one customer engagement platform with your WordPress web app.
  Author: Fizzy Software
  Author URI: https://www.facebook.com/fizzysoftware.india/
  Version: 2.8.0
*/

require_once dirname(__FILE__).'/class/class_ps_Interakt.php' ;
require_once dirname(__FILE__).'/class/class_interakt_subscribe_widget.php' ;
require_once dirname(__FILE__).'/class/class_interakt_menu_metabox.php' ;
require_once dirname(__FILE__).'/class/class_create_dynamic_fields.php' ;
require_once dirname(__FILE__).'/class/class_integrate_woocommerce.php' ;
//require_once dirname(__FILE__).'/class/class_chat_feedback_control.php' ;
//defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

 
/* Enable shortcodes in (widget)text  */
add_filter('widget_text','do_shortcode');

  /* Add css and js for tab navigation*/
function interakt_load_js() {
  
    wp_enqueue_style( 'tab_style', plugin_dir_url(__FILE__) . '/css/interakt_tab_style.css');
    wp_enqueue_script('tabs-toggle-script', plugin_dir_url(__FILE__) . '/js/interakt_tab_script.js');
    wp_enqueue_script('dynamic-fields-script', plugin_dir_url(__FILE__) . '/js/cf_dynamic_fields.js');
   wp_enqueue_script('chat-feedback-control-script', plugin_dir_url(__FILE__) . '/js/chat_feedback_control.js');
    wp_enqueue_script('verify-email-field-script', plugin_dir_url(__FILE__) . '/js/verify_email_field.js');
    wp_enqueue_script('interakt-backend-script', plugin_dir_url(__FILE__) . '/js/interakt_backend_scripts.js');
    wp_enqueue_script('interakt-syncorder-script', plugin_dir_url(__FILE__) . '/js/syncing_order_data.js');
}
add_action('admin_enqueue_scripts', 'interakt_load_js' );


/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'InteraktSubscribe_Widget' );
});

//Calling constructor method if user is in admin panel
  
 if( is_admin() ){                 
      $my_settings_page = new PS_Interakt();
      //$my_settings_page->add_sync_user_script();
 } 
add_action('wp_footer', "add_interakt_script" );

  function add_interakt_script(){
    $interakt_object = new PS_Interakt();
    $interakt_app_id = ($interakt_object->options['interakt_app_key']);
    if (!empty($interakt_app_id)) {
      $protocol=isset($_SERVER['HTTPS'])?'https:':'http:';
      echo "<script>
        (function() {
        var interakt = document.createElement('script');
        interakt.type = 'text/javascript'; interakt.async = true;
        interakt.src = '$protocol//cdn.interakt.co/interakt/$interakt_app_id.js';
        var scrpt = document.getElementsByTagName('script')[0];
        scrpt.parentNode.insertBefore(interakt, scrpt);
        })()
      </script>";
      if ( is_user_logged_in() ) {
        global $current_user;
        get_currentuserinfo();
        $user_name = $current_user->user_login;
        $email = $current_user->user_email;
        $created_at = $current_user->user_registered;
        echo "<script>
          window.mySettings = {
          email: '$email',
          name: '$user_name',
          created_at: '$created_at',
          app_id: '$interakt_app_id'
          };
        </script>";
      }
    }
  };
  
  /* Add css and jsfor tab navigation*/
function interakt_load_widget_js() {
 
  wp_enqueue_script('wp-interakt-subscribe-backend-custom', plugins_url('/js/interakt_subscribe_widget_custom.js', __FILE__), array('jquery'));
  wp_enqueue_style('wp-interakt-subscribe-backend-customcss', plugins_url('/css/interakt_backend_style.css', __FILE__),array(), '1.1', 'all' ); 
  //wp_enqueue_script('wp-interakt-subscribe-global-js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',array(), '1.1', 'all' ); 
}
add_action('admin_enqueue_scripts', 'interakt_load_widget_js' );
  

/**
Adding sync user option on admin bar
 */

function interakt_syncuser_toolbar( $wp_admin_bar ){
   $args = array(
        'id'    => 'sync_btn',
        'title' => '<span class="ab-icon"></span><span class="ab-label">Sync Users</span>'
        //'href'  => admin_url() . 'options-general.php?page=__FILE__'
    );
  $wp_admin_bar->add_node( $args );
}

add_action('admin_bar_menu','interakt_syncuser_toolbar',999);


function wpb_interakt_logo() {
  ?>
  <style type="text/css">
  #wpadminbar #wp-admin-bar-sync_btn .ab-icon:before {
    background-image: url(<?php echo plugin_dir_url( __FILE__ ) . 'images/interakt_logo.png'; ?>)   !important;
    background-position: 0 0;
    background-repeat: no-repeat;
    content: "\f132";
    color:rgba(0, 0, 0, 0);
    top: 5px;
  }
  #wpadminbar #wp-admin-bar-sync_btn.hover > .ab-item .ab-icon {
    background-position: 0 0;
  }
  </style>
  <?php
} 

//hook into the administrative header output
add_action('wp_before_admin_bar_render', 'wpb_interakt_logo');

  /* generate short code for contact form*/

 function generate_interakt_cf_shortcode(){
    ob_start();  
    $cf_dy_obj = new create_dynamic_fields();
    $cf_dy_obj->interakt_create_contactform();           
    return ob_get_clean();
  }

 add_shortcode( 'interakt_contact_form','generate_interakt_cf_shortcode' );
/**End of contact form*/

/**
Interakt Meta Boxes
*/
  
function add_interakt_meta_boxes()
{
    /* Setup Page Metaboxes */
    add_meta_box("setup-content-meta-box", " ", "setup_content_meta_box_markup", "toplevel_page_interakt_plugin", "normal", "high", null);
 
    add_meta_box("info-meta-box", "Information", "info_meta_box_markup", "toplevel_page_interakt_plugin", "side", "default", null);

    add_meta_box("customize-info-meta-box", "Additional Customization", "customize_info_meta_box_markup", "toplevel_page_interakt_plugin", "side", "default", null);

    /* Contact Form Page Metaboxes */

    add_meta_box("contact-content-meta-box", " ", "contact_content_meta_box_markup", "interakt_page_interakt_plugin_cf ", "normal", "high", null);
 
    add_meta_box("info-meta-box", "Information", "info_meta_box_markup", "interakt_page_interakt_plugin_cf ", "side", "default", null);

    add_meta_box("customize-info-meta-box", "Additional Customization", "customize_info_meta_box_markup", "interakt_page_interakt_plugin_cf", "side", "default", null);
 }  
add_action("add_meta_boxes", "add_interakt_meta_boxes");

 function info_meta_box_markup(){
    ?>
        <ul>
         <li><a href="https://docs.interakt.co/integrations/wordpress" target="_blank">Docs</a></li>
         <li><a href="https://faq.interakt.co" target="_blank">FAQ</a></li>
         <li><a href="https://wordpress.org/support/plugin/wp-interakt-integration" target="_blank">Support</a></li>
        </ul>
    <?php
  }
 function customize_info_meta_box_markup(){
    ?>
        <ul><h4 class="list_title">Hiding Widgets:</h4>
         <li>To Hide the Live Chat widget, follow the steps as mentioned <a href="https://docs.interakt.co/pages/support-faq#hidechattrigger" target="_blank">here</a>.</li>
         <li>To Hide the Feedback widget, follow the steps as mentioned <a href="https://docs.interakt.co/pages/support-faq#hidefeedbacktrigger" target="_blank">here</a>.</li>
        </ul>

        <ul><h4 class="list_title">Custom Link Pop-Up:</h4>
          <li>To open the Live Chat by clicking a custom link, follow the steps as mentioned <a href="https://docs.interakt.co/pages/support-faq#embedpopup" target="_blank">here</a>.</li>
          <li>To open the Feedback by clicking a custom link, follow the steps as mentioned <a href="https://docs.interakt.co/pages/support-faq#fbembedpopup" target="_blank">here</a>.</li>
        </ul>
    <?php
  }  
 function setup_content_meta_box_markup(){
    
        ?> 
             <div class="interakt-tab">
             <h3 class="nav-tab-wrapper">
               <a class="nav-tab section1 tab-active-test" href="__FILE__">Setup</a>
               <a class="nav-tab section2" href="__FILE__">Manage Apps</a>     
             </h3>
            </div>    
              <div id="sections">
                <section class="tab_toggle setup_key" >  
                     <form class="setup_tab_form" method="post" action="options.php">                    
                     <?php 
                      settings_fields( 'interakt_plugin_options_group' );
                      do_settings_sections( '__FILE__' ); 
                        ?><br><br><?php
                       $setup_attributes = array( 'id' => 'interakt_setup_save_btn' );
                       submit_button( 'Save', 'primary', 'interakt-save-setup-settings', false, $setup_attributes );           
                     ?>
                   </form>
                 </section>

                  <section class="tab_toggle setup_control" > 
                    <form class="manageapps_tab_form" method="post" action="options.php">
                     <?php      
                        settings_fields( 'interakt_manageapps_options' );
                      do_settings_sections( 'interakt_manageapps_options' );
                      ?><br><br><?php
                      $manageapps_attributes = array( 'id' => 'interakt_manageapps_save_btn' );
                      submit_button( 'Save', 'primary', 'interakt-save-managapps-settings', false,$manageapps_attributes ); 
                     ?>
                   </form>
                  </section>
              </div><!-- end sections div -->    
            </div> <!-- end interakt tab -->        
       
      <?php                         
  }
 function contact_content_meta_box_markup(){
       ?>  
        <div class="interakt-tab">
          <h3 class="nav-tab-wrapper">
            <a class="nav-tab section1 tab-active-test" href="__FILE__">Form</a>
            <a class="nav-tab section2" href="__FILE__">Mail</a>         
            <a class="nav-tab section3" href="__FILE__">Messages</a>         
          </h3>
        </div>

          <div id="sections">
             <section class="tab_toggle cf_form" >
                <form id="contact_tab_form" method="post" action="options.php">
                 <?php      
                   settings_fields( 'interakt_contactform_options' );
                  do_settings_sections( 'interakt_contactform_options' );
                   ?><br><br><?php
                  $form_other_attributes = array( 'id' => 'interakt_form_save_btn' );
                  submit_button( 'Save', 'primary', 'interakt-save-form-settings', false, $form_other_attributes ); 
                 ?>
                 </form>
             </section>

             <section class="tab_toggle cf_mail" >
              <form method="post" action="options.php">
             
                 <?php      
                   settings_fields( 'interakt_mail_options' );
                   do_settings_sections('interakt_mail_options');
                   ?><br><br><?php
                   $mail_other_attributes = array( 'id' => 'interakt_mail_save_btn' );
                   submit_button( 'Save', 'primary', 'interakt-save-mail-settings', false, $mail_other_attributes ); 
       
                 ?>
              </form>
             </section>

             <section class="tab_toggle cf_msg" >
               <form method="post" action="options.php">
                 <?php      
                   settings_fields( 'interakt_contactform_msgs_options' );
                   do_settings_sections('interakt_contactform_msgs_options');
                    ?><br><br><br><?php
                   $msgs_other_attributes = array( 'id' => 'interakt_msgs_save_btn' );
                   submit_button( 'Save', 'primary', 'interakt-save-msgs-settings', false, $msgs_other_attributes ); 
                 ?>
                 </form>
             </section>
          </div><!-- end sections div -->  
        </div> <!-- end interakt tab -->  
      
     <?php        
 }
 

$setup_screen_id = "toplevel_page_interakt_plugin";
/* Add callbacks for this screen only. */
add_action('load-'.$setup_screen_id, 'interakt_add_screen_meta_boxes_setup');
function interakt_add_screen_meta_boxes_setup() {
 
    do_action('add_meta_boxes_'.$setup_screen_id, null);
    do_action('add_meta_boxes', $setup_screen_id, null);
    wp_enqueue_script('postbox');
    add_screen_option('layout_columns', array('max' => 2, 'default' => 2) );
}


$contact_screen_id = "interakt_page_interakt_plugin_cf";
/* Add callbacks for this screen only. */
add_action('load-'.$contact_screen_id, 'interakt_add_screen_meta_boxes_contact');
function interakt_add_screen_meta_boxes_contact() {
 
    do_action('add_meta_boxes_'.$contact_screen_id, null);
    do_action('add_meta_boxes', $contact_screen_id, null);
    wp_enqueue_script('postbox');
    add_screen_option('layout_columns', array('max' => 2, 'default' => 2) );
}
  
function check_chatfeedstat_from_interakt(){
 /* Status check API here */
 $options = get_option( 'interakt_plugin_options_name' );

 $url = "http://app.interakt.co/api/v1/chat_helpdesk_status/".$options['interakt_app_key'];
 
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_POST, false);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

      $curl_response = curl_exec($curl);
      curl_close($curl);
      //var_dump($curl_response);
      $curl_response=json_decode($curl_response,true);
      //echo $curl_response;
  
   $chatfeed_status = get_option( 'interakt_manageapps_options' );
   $chatval_from_interakt = $curl_response["chat_status"];
   $feedval_from_interakt = $curl_response["feedback_enabled"];
   $chatfeed_status['chat_onoffswitch'] = $chatval_from_interakt;
   $chatfeed_status['feedback_onoffswitch'] = $feedval_from_interakt;

   update_option('interakt_manageapps_options', $chatfeed_status);
} 
add_action('init', 'check_chatfeedstat_from_interakt');

/**
Woo-commerce Integration
*/

function send_order_data_to_interakt( $order_id ){

  if ( class_exists( 'WooCommerce' ) ) {

    $options = get_option( 'interakt_plugin_options_name' );

    // get order object and order details
    $order = new WC_Order( $order_id ); 
    $tot_amount = $order->get_total(); 
    $order_date = date('Y-m-d',strtotime($order->order_date));

    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $email = esc_html( $current_user->user_email);
        //printf( 'Cart details sent to Interakt for %s ', esc_html( $current_user->user_email ) );
    }
    else {
      //echo "user not logged in.";
        return false;
    }
    $phone = $order->billing_phone;
    $shipping_type = $order->get_shipping_method();
    $shipping_cost = $order->get_total_shipping();

    // set the address fields
    $user_id = $order->user_id;
    $address_fields = array('country',
        'title',
        'first_name',
        'last_name',
        'company',
        'address_1',
        'address_2',
        'address_3',
        'address_4',
        'city',
        'state',
        'postcode');

    $address = array();
    if(is_array($address_fields)){
        foreach($address_fields as $field){
            $address['billing_'.$field] = get_user_meta( $user_id, 'billing_'.$field, true );
            $address['shipping_'.$field] = get_user_meta( $user_id, 'shipping_'.$field, true );
        }
    }
    
    // get coupon information (if applicable)
    $cps = array();
    $cps = $order->get_items( 'coupon' );
    
    $coupon = array();
    foreach($cps as $cp){
            // get coupon titles (and additional details if accepted by the API)
            $coupon[] = $cp['name'];
    }
    
    // get product details
    $items = $order->get_items();
    
    $item_name = array();
    $item_qty = array();
    $item_price = array();
    $item_sku = array();
        
    foreach( $items as $key => $item){
        $item_name[] = $item['name'];
        $item_qty[] = $item['qty'];
        $item_price[] = $item['line_total'];
        
        $item_id = $item['product_id'];
        $product = new WC_Product($item_id);
        $item_sku[] = $product->get_sku();
    }
    
    /* for online payments, send across the transaction ID/key. If the payment is handled offline, you could send across the order key instead */
    $transaction_key = get_post_meta( $order_id, '_transaction_id', true );
    $transaction_key = empty($transaction_key) ? $_GET['key'] : $transaction_key;   

        // setup the data which has to be sent
    $order_id = "#".$order_id;
    $order_data = array(
            'unique_id' => $order_id,
            'order_id' =>$order_id,
            'customer_email' => $email,
            'customer_phone' => $phone,
            'item_id'=> $item_id,
            'item_name' => implode(',', $item_name), 
            'item_price' => implode(',', $item_price), 
            'quantity' => implode(',', $item_qty), 
            'total_amount' => $tot_amount,
            'order_date' => $order_date,
            'transaction_key' => $transaction_key,
            'coupon_code' => implode( ",", $coupon ),
            'bill_firstname' => $address['billing_first_name'],
            'bill_surname' => $address['billing_last_name'],
            'bill_address1' => $address['billing_address_1'],
            'bill_address2' => $address['billing_address_2'],
            'bill_city' => $address['billing_city'],
            'bill_state' => $address['billing_state'],
            'bill_zip' => $address['billing_postcode'],
            'ship_firstname' => $address['shipping_first_name'],
            'ship_surname' => $address['shipping_last_name'],
            'ship_address1' => $address['shipping_address_1'],
            'ship_address2' => $address['shipping_address_2'],
            'ship_city' => $address['shipping_city'],
            'ship_state' => $address['shipping_state'],
            'ship_zip' => $address['shipping_postcode'],
            'shipping_type' => $shipping_type,
            'shipping_cost' => $shipping_cost
        );

        // foreach ($order_data as $key => $value) {
        //   echo $key."=>".$value."<br>";
        // }

        /* Send order data to Interkat*/
        $url='https://app.interakt.co/api/v1/members';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
        curl_setopt($curl, CURLOPT_USERPWD, $options['interakt_app_key'] .':'.$options['interakt_api_key']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array( 'email' => $email, 'orders' => $order_data)));
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $curl_response=json_decode($curl_response,true);
        //return $curl_response;
        // the handle response    
        if (strpos($curl_response,'ERROR') !== false) {
               print_r($curl_response);
        } else {
              //echo "success";
        }

        /* Empty Cart*/
        $cart_data = array(
          'unique_id' => $email,   
          'item_name' => "", 
          'item_price' => "", 
          'item_quantity' => "", 
          'reg_price' =>  "",
          'sale_price' => "",
          'total_amount' => ""
         );

      // foreach ($cart_data as $key => $value) {
      //   echo "<br>".$key."->".$value."<br>";
      // }

        /* Send empty arrays to Interakt*/
          $url='https://app.interakt.co/api/v1/members';
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($curl, CURLOPT_POST, true);
          curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
          curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
          curl_setopt($curl, CURLOPT_USERPWD, $options['interakt_app_key'] .':'.$options['interakt_api_key']);
          curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array( 'email' => $current_user->user_email, 'carts' => $cart_data)));
          $curl_response = curl_exec($curl);
          curl_close($curl);
          $curl_response=json_decode($curl_response,true);
          //return $curl_response;
          // the handle response    
          if (strpos($curl_response,'ERROR') !== false) {
                  print_r($curl_response);
          }
          else{
            //echo "I am called";
          }
    }
    else{
      //echo "no MAN!!! Plugin not activated";
    }      

}
add_action('woocommerce_thankyou','send_order_data_to_interakt');

function call_send_cart_data_to_interakt(){

  if ( class_exists( 'WooCommerce' ) ) { 
    ob_start();  
    $woo_cart_obj = new integrate_woocommerce();
    $woo_cart_obj->send_cart_data_to_interakt();           
    return ob_get_clean();
  }

  else{
    //echo "no MAN!!! Plugin not activated";
  }
}
   
add_action( 'loop_start', 'call_send_cart_data_to_interakt' );
add_action( 'woocommerce_add_to_cart', 'call_send_cart_data_to_interakt' );
  
?>