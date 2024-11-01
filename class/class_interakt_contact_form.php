<?php
require_once('../../../../wp-load.php');

class interakt_contact_form{
  
  private $email;
  private $source;
  private $options;
  private $options_mail;

  private $cf_data = array();

  public function __construct(){
  
      $this->email =  isset($_POST['lead_mailid'])?$_POST['lead_mailid']:""; 
      $this->source = "Interakt Contact Form";
      $this->options = get_option( 'interakt_plugin_options_name' );
      $this->options_mail = get_option( 'interakt_mail_options' );

      $this->cf_data = isset($_POST['form_data'])?$_POST['form_data']:""; 
  }

 public function interakt_deliver_mail() {

      /* send leads*/
      $url = "https://app.interakt.co/api/v1/leads";

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array('email'=>$this->email,'source'=>$this->source)));
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
      curl_setopt($curl, CURLOPT_USERPWD, $this->options['interakt_app_key'] .':'.$this->options['interakt_api_key'] );
      $curl_response = curl_exec($curl);
      curl_close($curl);
      $curl_response=json_decode($curl_response,true);
      echo $curl_response;
 
    /* send mail*/  
       $message = $this->options_mail['interakt_cf_mail_body']."\n\n"; 
        
       foreach ($this->cf_data as $key => $value) {
         $message .=  $value."\n\n";
       }

        //$to = get_option( 'admin_email' );
        $blog_title = get_bloginfo();
        $to = $this->options_mail['interakt_cf_recepient_email'];
    
        $subject = $this->options_mail['interakt_cf_subject'];
        $headers = 'From:'.'<wordpress@'.$blog_title.'.com>'. "\r\n";
        $attachments = '';

        $mail_check = mail( $to, $subject, $message, $headers) ;        
         //If email has been process for sending, display a success message
        if ($mail_check) {
            echo "success";
        } 
        else {
            echo "false";
        }   
  
   }/* end interaKt_deliver_mail*/

}/* end class_interakt_contact_form */

$cfmail_obj = new interakt_contact_form();
$cfmail_obj->interakt_deliver_mail(); 
?>