<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailsHelper {
    private $CI, $_html, $_test, $_style, $_style2, $_hash, $_isDelayed, $_delayedMinutes;
    
    public function __construct() {
        $this->_test = FALSE;
        $this->_isDelayed = FALSE;
        $this->_style = 'style="color: #9f0003; font-size: 15px; text-decoration: none; font-family: \'Open Sans\', Arial, sans-serif; font-weight:600;"';
        $this->_style2 = 'style="color: #9f0003; font-size: 22px; text-decoration: none; font-family: \'Open Sans\', Arial, sans-serif; font-weight:600;"';
        $this->_delayedMinutes = 0;
    }
    function setIsDelayed($_isDelayed) {
        $this->_isDelayed = $_isDelayed;
    }

    public function setDelayedMinutes($delayedMinutes) {
        $this->_delayedMinutes = $delayedMinutes;
    }

    public function setTest() {
        $this->_test = TRUE;
        
    }
    /**
     * Send Email
     *
     * Called to send email for specified event, this method is only for notification email
     * this methid will not be used for mass emails.
     *
     * @param   array  $param
     * @param   Object $model
     * 
     * @return  void
     */

    // public function shootEmail($param, $model=NULL) {
    //     //actionName, debug, (array) params, 
    //     $this->CI = & get_instance();
    //     if(is_array($param)){
    //         extract($param);
        
    //         $func = $actionName."Success";
    //         $this->_html = $this->$func($param);
    //         $subject = $heading;
    //         $email = $email;
    //         $this->_hash = Smart::makeIVHash($email);
    //         if($model !== NULL){
    //             $this->queueEmail($param, $model, TRUE);
    //             //$this->_html = str_replace("{WEB_URL}", makeWebmailUrl($this->_hash), $this->_html);
    //         }
            
    //         $this->CI->load->library('email');
    //         $this->CI->email->initialize();
    //         $this->CI->email->from($this->CI->config->item('notification_sender_address'), $this->CI->config->item('notification_sender'));
    //         $this->CI->email->to($email);
            
    //         $this->CI->email->subject($subject);
    //         $this->CI->email->message($this->_html);        
    //         if(!$this->_test)
    //         {
    //             $this->CI->email->send();

    //             $error = $this->email->print_debugger(array('headers'));
    //         }
            
    //     }
        
        
    // }

    public function shootEmail($param, $model=NULL)
    {
        $this->load->library("PhpMailerLib");
          $mail = $this->phpmailerlib->load();

            $mail->SMTPDebug = 2; 
    
            $mail->setFrom($this->CI->config->item('notification_sender_address'), $this->CI->config->item('notification_sender'));
            $mail->addAddress($email);     // Add a recipient
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $this->_html;

            $abc = $mail->send();

            if ($abc) {

                echo ('Seems like your SMTP settings is set correctly. Check your email now.');

            }else{
               echo ('<h1>Your SMTP settings are not set correctly here is the debug log.</h1><br />' . $mail->ErrorInfo);


           }

       
    }
    /**
     * Add Email in Queue
     *
     * Called to add email in queue for specified event.
     *
     * @param   array  $param
     * 
     * @return  void
     */
    public function queueEmail($param, $model, $logOnly = FALSE) {
        //actionName, debug, (array) params, 
        $this->CI = & get_instance();
        if(is_array($param)){
            extract($param);
        
            $func = $actionName."Success";
            
            $obj = new stdClass();
            $obj->to_email = $email;
            $obj->subject = $heading;
            
            if($logOnly === FALSE)
            {
                $this->_hash = Smart::makeIVHash($email);
                $this->_html = $this->$func($param);
                //$this->_html = str_replace("{WEB_URL}", makeWebmailUrl($this->_hash), $this->_html);
            }
            $obj->hash = $this->_hash;
            $obj->message = gzencode($this->_html, 9);
            $obj->attempts = ($logOnly)?1:0;
            $obj->success = ($logOnly)?1:0;
            $obj->date_published = ($this->_isDelayed === TRUE)?date('Y-m-d H:i:s',strtotime("+".$this->_delayedMinutes." min")):date('Y-m-d H:i:s');
            $obj->type = 0;
            $obj->language = $language;
            
            $model->addEmailQueue($obj);
            
        }
        
        
    }
    /**
     * Send Email Upon Error
     *
     * Called to send email to admins upon erros, used for debuging and error traking.
     *
     * @param   string  $email  email address of admin.
     * @param   string  $subject  subject
     * @param   string  $body  body
     * 
     * @return  void
     */
    public function sendAdminEmail($email,$subject,$body) {
        //actionName, debug, (array) params, 
        $this->CI = & get_instance();
        $this->CI->load->library('email');
        $this->CI->email->initialize();
        $this->CI->email->from($this->CI->config->item('notification_sender_address'), COMPANY_NAME);
        $this->CI->email->to($email);
        if(EMAIL_DEBUG === TRUE){
            $this->CI->email->bcc(EMAIL_DEBUG_ADD);
        }

        $this->CI->email->subject($subject);
        $this->CI->email->message($body);

        $this->CI->email->send();
        
    }
    /**
     * getter function to get comipled html body
     * 
     * @param   none
     * 
     * @return  string
     */
    public function getHtml() {
        return $this->_html;
    }
    
    /**
     * Forget Password
     * 
     * Internal method to format html body
     * 
     * @param   array
     * 
     * @return  string
     */
    private function forgotPasswordSuccess($params) {
        
        //(array) params = array(language,email, subject, pwd, customerobj), 
        if(is_array($params)){
            extract($params);
            $message= $this->CI->lang->line('forget_password_msg');
            
            $patren = array("{STYLE}", "{PWD}","{EMAIL}");
            $replacments = array($this->_style,$pwd,$email);
            $message= str_replace($patren, $replacments , $message);
            
            $data['header'] = array('heading'=>$heading);
            $data['footer'] = array('email'=>$email);
            $data['customer'] = $customer;
            $data['message'] = $message;
            $data['heading'] = $heading;

            return $this->CI->load->view('emails/generic',$data, true);
        }
        
    }
    
    /**
     * Forget Password Confirmation
     * 
     * Internal method to format html body
     * 
     * @param   array
     * 
     * @return  string
     */
    private function forgotPasswordConfirmSuccess($params) {
        
        //(array) params = array(language,email, subject, pwd, customerobj), 
        if(is_array($params)){
            extract($params);
            
            $message= $this->CI->lang->line('reset_pwd_inq_msg');
            
            $patren = array("{STYLE2}", "{EMAIL}");
            $replacments = array($this->_style2,$email);
            $message= str_replace($patren, $replacments , $message);
            
            
            

            $data['header'] = array('heading'=>$heading, 'language'=> $customer->default_language);
            $data['footer'] = array('email'=>$email, 'language'=> $customer->default_language);
            $data['customer'] = $customer;
            $data['language'] = $customer->default_language;
            $data['message'] = $message;
            $data['heading'] = $heading;

            return $this->CI->load->view('emails/generic',$data, true);
        }
        
    }
    
    
    /**
     * Welcome Message
     * 
     * Internal method to format html body
     * 
     * @param   array
     * 
     * @return  string
     */
    private function welcomeMessageSuccess($params) {
        
        //(array) params = array(language,email, subject, link, customerobj), 
        if(is_array($params)){
            extract($params);
            
            
            $message = $this->CI->lang->line('signup_message');
            $patren = array("{STYLE}", "{BUTTON}","{LINK}","{EMAIL}");
            $replacments = array($this->_style, Smart::makeEmailButton(array("link"=>$link,"text"=>$this->CI->lang->line('activate_account'))),$link,$email);
            $message= str_replace($patren, $replacments , $message);

            $data['header'] = array('heading'=>$heading, 'language'=>$language);
            $data['footer'] = array('email'=>$email, 'language'=>$language);
            $data['customer'] = $customer;
            $data['language'] = $language;
            $data['message'] = $message;
            $data['heading'] = $heading;
            

            return $this->CI->load->view('emails/generic',$data, true);
        }
        
    }
    private function welcomeMessageEndUserSuccess($params) {
        
        //(array) params = array(language,email, subject, link, customerobj), 
        if(is_array($params)){
            extract($params);
            
            $patren = array("{STYLE}", "{BUTTON}","{LINK}","{EMAIL}");
            $replacments = array($this->_style, Smart::makeEmailButton(array("link"=>$link,"text"=>"Register Now")),$link,$email);
            $message= str_replace($patren, $replacments , $message);

            $data['header'] = array('heading'=>$heading, 'language'=>$language);
            $data['footer'] = array('email'=>$email, 'language'=>$language);
            $data['customer'] = $customer;
            $data['language'] = $language;
            $data['message'] = $message;
            $data['heading'] = $heading;
            

            return $this->CI->load->view('emails/generic',$data, true);
        }
        
    }
    private function welcomeMessageFASuccess($params) {
        
        //(array) params = array(language,email, subject, link, customerobj), 
        if(is_array($params)){
            extract($params);
            
            
            $patren = array("{STYLE}", "{BUTTON}","{LINK}","{EMAIL}");
            $replacments = array($this->_style, Smart::makeEmailButton(array("link"=>$link,"text"=>"Register Now")),$link,$email);
            $message= str_replace($patren, $replacments , $message);

            $data['header'] = array('heading'=>$heading, 'language'=>$language);
            $data['footer'] = array('email'=>$email, 'language'=>$language);
            $data['customer'] = $customer;
            $data['language'] = $language;
            $data['message'] = $message;
            $data['heading'] = $heading;
            

            return $this->CI->load->view('emails/generic',$data, true);
        }
        
    }
    
    /**
     * Registration Message
     * 
     * Internal method to format html body
     * 
     * @param   array
     * 
     * @return  string
     */
    private function registerMessageSuccess($params) {
        
        //(array) params = array(language,email, subject, link, customerobj), 
        if(is_array($params)){
            extract($params);
            
            $message= $this->CI->lang->line('step_two_msg');
            
            $patren = array("{STYLE}", "{BUTTON}","{LINK}","{EMAIL}");
            $replacments = array($this->_style, Smart::makeEmailButton(array("link"=>  base_url($language),"text"=>$this->CI->lang->line('get_started'))),$link,$email);
            $message= str_replace($patren, $replacments , $message);

            $data['header'] = array('heading'=>$heading, 'language'=>$language);
            $data['footer'] = array('email'=>$email, 'language'=>$language);
            $data['customer'] = $customer;
            $data['language'] = $language;
            $data['message'] = $message;
            $data['heading'] = $heading;
            $data['button'] = '';

            return $this->CI->load->view('emails/generic',$data, true);
        }
        
    }
    /**
     * Order Invoice
     * 
     * Internal method to format html body
     * 
     * @param   array
     * 
     * @return  string
     */
    private function orderInvoiceSuccess($params) {
        
        if(is_array($params)){
            extract($params);
            
            
            $message = $this->CI->lang->line('transaction_message');
            $patren = array("{INVOICE}", "{DATE}","{PACKAGE}","{AMOUNT}","{EXPIRY}");
            $replacments = array($object->invoice, $object->date,$object->package,"CAD $".$object->amount, $object->expiry);
            $message= str_replace($patren, $replacments , $message);

            $data['header'] = array('heading'=>$heading, 'language'=>$language);
            $data['footer'] = array('email'=>$email, 'language'=>$language);
            $data['customer'] = $customer;
            $data['language'] = $language;
            $data['message'] = $message;
            $data['heading'] = $heading;
            

            return $this->CI->load->view('emails/generic',$data, true);
        
    }
    
    }
    
}
