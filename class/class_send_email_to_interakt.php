
<?php
require_once('../../../../wp-load.php');

class SendEmail{

 
private $name;
private $email;
private $phone;
private $source;
private $options;

	public function __construct(){
                $this->name  = isset($_POST['name'])?$_POST['name']:"";
                $this->email = isset($_POST['email'])?$_POST['email']:"";			
		        $this->phone = isset($_POST['phone'])?$_POST['phone']:"";
		        $this->source = "Interakt Widget";
		
 		$this->options = get_option( 'interakt_plugin_options_name' );

	}

	public function email_to_interakt(){

		$url = "https://app.interakt.co/api/v1/leads";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array('email'=>$this->email,'name'=>$this->name,'phone'=>$this->phone,'source'=>$this->source)));
		curl_setopt($curl,CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
		curl_setopt($curl, CURLOPT_USERPWD, $this->options['interakt_app_key'] .':'.$this->options['interakt_api_key'] );
		$curl_response = curl_exec($curl);
		curl_close($curl);
		$curl_response=json_decode($curl_response,true);
		echo $curl_response;
	}
}
$sendemail_obj = new SendEmail();
$sendemail_obj->email_to_interakt();	
?>