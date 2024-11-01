<?php

//require_once('../../../../wp-load.php');

class create_dynamic_fields{
  
  private $options;

  public function __construct(){
   
              $this->options = get_option('interakt_mail_options' );
              
  }

 
/** 
render contact form on front-end
*/

  public function interakt_create_contactform() {

      $dy_tag_ids = array();
      $cf_options = get_option( 'interakt_contactform_options' );
      $cf_options_mail = get_option( 'interakt_mail_options' );
      $cf_options_msg = get_option( 'interakt_contactform_msgs_options' );
      $builder_box_content = $cf_options['interakt_cf_editor_box'];
        
      $string = str_replace(array('['),'<',$builder_box_content);
      $html_content = str_replace(array(']'),'>',$string);

  	  echo '<div id="interakt_contactform">';
      echo '<form id="interakt_contactform" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
 
      print_r(nl2br($html_content ,false)); 

      preg_match_all("/\[[^\]]*\]/", $builder_box_content, $matches); /* Replace angular brackets */
     
      while($matches[0]){

        $tag_line = array_pop($matches[0]);     
        $tag_words =  explode(" ", $tag_line);
  
          foreach($tag_words as $key => $values){
            if (strpos($values, 'id=') === 0 ) {        
               preg_match('/"([^"]+)"/', $values, $tag_id) ;
               array_push($dy_tag_ids,$tag_id[1]);   
            }
          }
      }

      // foreach($dy_tag_ids as $key => $values){
      //   echo $values."<br>" ;
      // }
 
      echo "<br><br><br>";  
      $cf_script_url = plugins_url('/class_interakt_contact_form.php', __FILE__ );
      $dy_tag_ids_reverse = array_reverse($dy_tag_ids);
      ?>

      <script type="text/javascript">
       var dynamic_fields_from_php = <?php echo json_encode($dy_tag_ids_reverse); ?>;
      </script>
 
      <a id="cf-submitted" href="#" data-href="<?php echo $cf_script_url;?>">Send</a>  

      <?php  
      echo '</form>';
      echo '</div>';
      echo '<div style="display:none;" id="cf-return-message">'.$cf_options_msg['interakt_cf_success_msg'].'</div>';
     
  }/* End of function */
 
} /* end ofclass */
$cf_dy_obj = new create_dynamic_fields();   
?>