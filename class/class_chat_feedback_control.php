<?php
require_once('../../../../wp-load.php');

class interakt_chat_feedback_control{
  
  private $chat_status;
  private $feedback_status;
  private $options;
  
  public function __construct(){
      $this->chat_status =  isset($_POST['chat_status'])?$_POST['chat_status']:""; 
      $this->feedback_status =  isset($_POST['feedback_status'])?$_POST['feedback_status']:""; 
      $this->options = get_option( 'interakt_plugin_options_name' );
  }

 public function interakt_chat_control() {

   /* send chat status*/
      $url = "https://app.interakt.co/api/v1/chat";

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_POSTFIELDS, array('app_id'=>$this->options['interakt_app_key'],'status'=>$this->chat_status));
      curl_setopt($curl, CURLOPT_URL, $url);
      $curl_response = curl_exec($curl);
      curl_close($curl);
      $curl_response=json_decode($curl_response,true);
      echo $curl_response;
     // var_dump($curl_response);
 }

 public function interakt_feedback_control() {
     /* send feedback status*/
      $url = "https://app.interakt.co/api/v1/feedback";

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_POSTFIELDS, array('app_id'=>$this->options['interakt_app_key'] ,'status'=>$this->feedback_status));
      curl_setopt($curl, CURLOPT_URL, $url);
      $curl_response = curl_exec($curl);
      curl_close($curl);
      $curl_response=json_decode($curl_response,true);
      echo $curl_response;
     //var_dump($curl_response);
 }
}
  $chatfeed_control_obj = new interakt_chat_feedback_control();
  $chatfeed_control_obj->interakt_chat_control();
  $chatfeed_control_obj->interakt_feedback_control(); 
?>