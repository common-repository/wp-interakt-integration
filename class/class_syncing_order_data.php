<?php
require_once('../../../../wp-load.php');
class Sync_Orders{

  private $options;

  public function __construct(){

      $this->options = get_option( 'interakt_plugin_options_name' );
  }
  public function sync_orders_to_interakt(){

    //$options = get_option( 'interakt_plugin_options_name' );
       /* Sync Orders*/
     $customer_orders = get_posts( array(
    'numberposts' => -1,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => wc_get_order_types(),
    'post_status' => array_keys( wc_get_order_statuses() ),
     ) );
  
     $woo_order_ids = array();
     foreach($customer_orders as $keys => $order_objs){
      foreach($order_objs as $key => $order_value){
       // echo $key."  ".$order_value."  ";
       if($key=="ID") 
        $woo_order_ids[] = $order_value;
       }
     }
     //echo "<br><br>IDs : <br>";
    $counter =0;
    foreach($woo_order_ids as $key => $woo_order_id){

      // echo $woo_order_id."  ";
       $order = new WC_Order( $woo_order_id ); 
       $tot_amount = $order->get_total(); 
       $order_date = date('Y-m-d',strtotime($order->order_date));
       $email = $order->billing_email;

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
        $order_id = "#".$woo_order_id;
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
        //   echo $key."  :  ".$value."  ";
        // }
        //  echo "<br><br>";

        /* Send order data to Interkat*/
        $url='https://app.interakt.co/api/v1/members';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
        curl_setopt($curl, CURLOPT_USERPWD, $this->options['interakt_app_key'] .':'.$this->options['interakt_api_key']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array( 'email' => $email, 'orders' => $order_data)));
        $curl_response = curl_exec($curl);
        curl_close($curl);
        $curl_response=json_decode($curl_response,true);
        //return $curl_response;
        // the handle response    
        if (strpos($curl_response,'ERROR') !== false) {
               $counter++;
               $curl_error = $curl_response;

        }
    }/* foreach loop End*/
    if ($counter==0) {
          echo count($woo_order_ids);
    } 
    else {
          echo $curl_error;
   }
  }/* sync_orders_to_interakt End*/
}/* End of class*/
 $woo_order_obj = new Sync_Orders(); 
 $woo_order_obj->sync_orders_to_interakt(); 

 ?>