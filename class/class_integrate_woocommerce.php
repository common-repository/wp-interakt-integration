<?php

class integrate_woocommerce{

  private $options;

  public function __construct(){

      $this->options = get_option( 'interakt_mail_options' );
  }

  public function send_cart_data_to_interakt() {

       $options = get_option( 'interakt_plugin_options_name' );
       global $woocommerce;

       if ( is_user_logged_in() ) {
          $current_user = wp_get_current_user();
          $email = $current_user->user_email;
          //printf( 'Cart details sent to Interakt for %s ', esc_html( $current_user->user_email ) );

         //  $tot_amount = $woocommerce->cart->get_total();
           $tot_amount = $woocommerce->cart->cart_contents_total;
          $items = $woocommerce->cart->get_cart();
          if( $items!=null ){

              $item_name = array();
              $item_qty = array();
              $item_price = array();
              $item_reg_price = array();
              $item_sale_price = array();
                  
              foreach($items as $item => $values) { 
                 
                  $_product = $values['data']->post;
                  
                  $price = get_post_meta($values['product_id'] , '_price', true);
          
                  $item_name[]  = $_product->post_title;
                  $item_qty[]  = $values['quantity'];
                  $item_price[]  = $price*$values['quantity'];    
                  $item_reg_price[]  = get_post_meta($values['product_id'] , '_regular_price', true);
                  $item_sale_price[] = get_post_meta($values['product_id'] , '_sale_price', true);
                  //product image
                  // $getProductDetail = wc_get_product( $values['product_id'] );
                  // echo $getProductDetail->get_image(); // accepts 2 arguments ( size, attr )     
               }
                
               $cart_data = array(
                'unique_id' => $email,   
                'item_name' => implode(',', $item_name), 
                'item_price' => implode(',', $item_price), 
                'item_quantity' => implode(',', $item_qty), 
                'reg_price' =>  implode(',', $item_reg_price),
                'sale_price' => implode( ',', $item_sale_price),
                'total_amount' => $tot_amount
               );

              // foreach ($cart_data as $key => $value) {
              //   echo "<br>".$key."->".$value."<br>";
              // }
              /* Send cart data to Interakt*/
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
            } 
        }
        else {
                   echo( 'Sending cart data to Interakt failed !!' );
        }
     
  }
 
}/* End of class */

?>
