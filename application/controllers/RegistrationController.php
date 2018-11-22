<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistrationController
 *
 * @author Saqib Ahmad
 */
class RegistrationController extends Pixel_Controller {


    public function send_mail()
    {
        $form_data = array("email"=>'ijunaidraza@gmail.com');
        $this->load->library("PhpMailerLib");
        $mail = $this->phpmailerlib->shootEmail($form_data);

        if (!$mail) {

            $msg = $mail->ErrorInfo;
        }
        else
        {
            $msg = "Email Send";
            echo $msg;
        }
    }

    public function test_email(){
          $this->load->library("PhpMailerLib");

         $mail = $this->phpmailerlib->contact_us_mail('svsc');

           //  $mail->SMTPDebug = 2; 
    
           //  $mail->setFrom('haadi.javaid@gmail.com', 'Haider');
           //  $mail->addAddress('haadi.javaid@gmail.com', '');     // Add a recipient
           //  $mail->isHTML(true);                                  // Set email format to HTML
           //  $mail->Subject = 'TEST';
           //  $mail->Body    = '<b>TEST</b>';

           //  $abc = $mail->send();

           //  if ($abc) {

           //      echo ('Seems like your SMTP settings is set correctly. Check your email now.');

           //  }else{
           //     echo ('<h1>Your SMTP settings are not set correctly here is the debug log.</h1><br />' . $mail->ErrorInfo);


           // }

       
    }

    
    public function registrationCompletePage() {
        // if ($this->isAuthorized()) {
        //     redirect(base_url('sign-in'));
        // }

        Smart::setTitle('Register');
        Smart::setDescription('Register');
        $this->load->view('shared/_header');
        $this->load->view('register/thanks');
        $this->load->view('shared/_footer');
    }

    public function signUpPage() {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }
        $this->load->model('registrationModel', 'model');
        Smart::setTitle('Register');
        Smart::setDescription('Register');

        $this->load->library('recaptcha');
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
            'error' => $this->session->flashdata('error'),
        );
        $data['provinces'] = $this->model->selectTypes('state');

        $this->load->view('shared/_header');
        //$this->load->view('register/temp', $data);//
        $this->load->view('register/signup', $data);
        $this->load->view('shared/_footer');
    }
    
    public function signUpTermsPage() {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }
        $captchaVerified = $this->verifyCaptcha();
        if ($captchaVerified === FALSE) {
            Smart::setSoftError("Please prove you are a human");
            redirect('sign-up');
            exit;
        }
        if ($this->validateForms() === FALSE) {
            if (strip_tags(form_error('email_address')) === "CUSTOMEREXISITS") {
                Smart::setSoftError($this->lang->line('email_exisit'));
                redirect(base_url("forgot-password"));
            } else {
                $this->signUpPage();
            }
        } else {
            Smart::setTitle('Accept Terms and Conditions');
            Smart::setDescription('Register');
            $customerObject = new stdClass();
            $customerObject->first_name = $this->input->post("first_name", TRUE);
            $customerObject->email = $customerObject->username = strtolower($this->input->post("email_address", TRUE));
            $customerObject->password_hash = $this->input->post("password", TRUE);
            $customerObject->active = 0;
            $customerObject->is_completed = 1;
            $customerObject->role_id = Constants::$ENDUSER;
            $customerObject->province = $this->input->post("province", TRUE);

            $customerObject->country = "CA";
            $hash = str_replace("-", "", strtolower(Smart::GUID()));
            $customerObject->activate_hash = $hash;
            $serialObj = base64_encode(serialize($customerObject));
            $data['obj'] = $serialObj;
            $this->load->view('shared/_header');
            //$this->load->view('register/temp', $data);//
            $this->load->view('register/signup_terms', $data);
            $this->load->view('shared/_footer');
            
            //$this->stepOneRoutine($customerObject);
        }
        
    }

    public function termsPage() {
      
   
            Smart::setTitle('Accept Terms and Conditions');
            Smart::setDescription('Register');
            $this->load->view('shared/_header');
            //$this->load->view('register/temp', $data);//
            $this->load->view('register/terms');
            $this->load->view('shared/_footer');
            
           
        
    }

    public function signUp() {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }
        /*$captchaVerified = $this->verifyCaptcha();
        if ($captchaVerified === FALSE) {
            Smart::setSoftError("Please prove you are a human");
            redirect('sign-up');
            exit;
        }
        if ($this->validateForms() === FALSE) {
            if (strip_tags(form_error('email_address')) === "CUSTOMEREXISITS") {
                Smart::setSoftError($this->lang->line('email_exisit'));
                redirect(base_url("forgot-password"));
            } else {
                $this->signUpPage();
            }
        } else {*/
            $customerObject = unserialize(base64_decode($this->input->post('obj', TRUE)));
            $this->stepOneRoutine($customerObject);
        //}
    }

    public function signUpLawyer() {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }
        $captchaVerified = $this->verifyCaptcha();
        if ($captchaVerified === FALSE) {
            Smart::setSoftError("Please prove you are a human");
            redirect('sign-up');
            exit;
        }
        if ($this->validateLawyerFaForms() === FALSE) {
            if (strip_tags(form_error('email_address')) === "CUSTOMEREXISITS") {
                Smart::setSoftError($this->lang->line('email_exisit'));
                redirect(base_url("forgot-password"));
            } else {
                $this->signUpLawyerPage();
            }
        } else {
            $customerObject = new stdClass();
            $customerObject->first_name = $this->input->post("first_name", TRUE);
            $customerObject->email = $customerObject->username = strtolower($this->input->post("email_address", TRUE));
            $customerObject->password_hash = $this->input->post("password", TRUE);
            $customerObject->active = 0;
            $customerObject->is_completed = 1;
            $customerObject->role_id = Constants::$LAWYER;
            $customerObject->province = $this->input->post("province", TRUE);
            $customerObject->city = $this->input->post("city", TRUE);
            $customerObject->postal_code = $this->input->post("postal_code", TRUE);
            $customerObject->institue_practice = $this->input->post("institue_practice", TRUE);

            $customerObject->country = "CA";
            $hash = str_replace("-", "", strtolower(Smart::GUID()));
            $customerObject->activate_hash = $hash;
            $this->stepOneRoutine($customerObject);
        }
    }

    public function signUpFA() {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }
        $captchaVerified = $this->verifyCaptcha();
        if ($captchaVerified === FALSE) {
            Smart::setSoftError("Please prove you are a human");
            redirect('sign-up');
            exit;
        }
        if ($this->validateLawyerFaForms() === FALSE) {
            if (strip_tags(form_error('email_address')) === "CUSTOMEREXISITS") {
                Smart::setSoftError($this->lang->line('email_exisit'));
                redirect(base_url("forgot-password"));
            } else {
                $this->signUpLawyerPage();
            }
        } else {
            $customerObject = new stdClass();
            $customerObject->first_name = $this->input->post("first_name", TRUE);
            $customerObject->email = $customerObject->username = strtolower($this->input->post("email_address", TRUE));
            $customerObject->password_hash = $this->input->post("password", TRUE);
            $customerObject->active = 0;
            $customerObject->is_completed = 1;
            $customerObject->role_id = Constants::$FINANCIALADVISOR;
            $customerObject->province = $this->input->post("province", TRUE);
            $customerObject->city = $this->input->post("city", TRUE);
            $customerObject->postal_code = $this->input->post("postal_code", TRUE);
            $customerObject->institue_practice = $this->input->post("institue_practice", TRUE);

            $customerObject->country = "CA";
            $hash = str_replace("-", "", strtolower(Smart::GUID()));
            $customerObject->activate_hash = $hash;
            $this->stepOneRoutine($customerObject);
        }
    }

    private function validateLawyerFaForms() {
        $this->load->library('form_validation');
        $errFName = array('required' => $this->lang->line('req_fname'),
            'min_length' => $this->lang->line('req_fname'),
            'max_length' => $this->lang->line('req_fname'),
            'regex_match' => $this->lang->line('alpha'));
        $errEmail = array('required' => $this->lang->line('valid_email'), 'valid_email' => $this->lang->line('valid_email'));
        $errCity = array('required' => $this->lang->line('req_city'), 'min_length' => $this->lang->line('req_city'), 'max_length' => $this->lang->line('req_city'));
        $errPostalCode = array('required' => $this->lang->line('req_postal_code'), 'min_length' => $this->lang->line('req_postal_code'), 'max_length' => $this->lang->line('req_postal_code'));
        $errType = array('required' => $this->lang->line('req_practice_type'), 'min_length' => $this->lang->line('req_practice_type'), 'max_length' => $this->lang->line('req_practice_type'));
        $errPassword = array('required' => $this->lang->line('pwd_validation'),
            'min_length' => $this->lang->line('pwd_validation'),
            'max_length' => $this->lang->line('pwd_validation'),
            'matches' => $this->lang->line('pw_do_not_match'));
        $errCPassword = array('required' => $this->lang->line('pwd_validation'));
        $terms = array('required' => $this->lang->line('req_agree_to_terms'));

        $this->form_validation->set_rules('email_address', '', 'required|callback_username_check', $errEmail);
        $this->form_validation->set_rules('first_name', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_ALPHA . ']*$/u]|min_length[1]|max_length[32]', $errFName);
        $this->form_validation->set_rules('password', '', 'required|min_length[6]|max_length[16]|matches[confirm_password]|callback_password_check', $errPassword);
        $this->form_validation->set_rules('confirm_password', '', 'required', $errCPassword);
        $this->form_validation->set_rules('city', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_NO_TAG . ']*$/u]|min_length[1]|max_length[150]', $errCity);
        $this->form_validation->set_rules('postal_code', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_ALPHANUMERIC . ']*$/u]|min_length[3]|max_length[10]', $errPostalCode);
        $this->form_validation->set_rules('institue_practice', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_NO_TAG . ']*$/u]|min_length[1]|max_length[150]', $errType);
        $this->form_validation->set_rules('terms_conditions', '', 'required', $terms);


        return $this->form_validation->run();
    }

    private function validateForms() {
        $this->load->library('form_validation');
        $errFName = array('required' => $this->lang->line('req_fname'),
            'min_length' => $this->lang->line('req_fname'),
            'max_length' => $this->lang->line('req_fname'),
            'regex_match' => $this->lang->line('alpha'));
        $errEmail = array('required' => $this->lang->line('valid_email'), 'valid_email' => $this->lang->line('valid_email'));
        $errPassword = array('required' => $this->lang->line('pwd_validation'),
            'min_length' => $this->lang->line('pwd_validation'),
            'max_length' => $this->lang->line('pwd_validation'),
            'matches' => $this->lang->line('pw_do_not_match'));
        $errCPassword = array('required' => $this->lang->line('pwd_validation'));
        $terms = array('required' => $this->lang->line('req_agree_to_terms'));

        $this->form_validation->set_rules('email_address', '', 'required|callback_username_check', $errEmail);
        $this->form_validation->set_rules('first_name', '', 'required|min_length[1]|max_length[150]', $errFName);
        $this->form_validation->set_rules('password', '', 'required|min_length[6]|max_length[16]|matches[confirm_password]|callback_password_check', $errPassword);
        $this->form_validation->set_rules('confirm_password', '', 'required', $errCPassword);
        //$this->form_validation->set_rules('terms_conditions', '', 'required', $terms);


        return $this->form_validation->run();
    }

    private function validateCompleteForms() {
        $this->load->library('form_validation');
        $errFName = array('required' => $this->lang->line('req_fname'),
            'min_length' => $this->lang->line('req_fname'),
            'max_length' => $this->lang->line('req_fname'),
            'regex_match' => $this->lang->line('alpha'));
        $errPassword = array('required' => $this->lang->line('pwd_validation'),
            'min_length' => $this->lang->line('pwd_validation'),
            'max_length' => $this->lang->line('pwd_validation'),
            'matches' => $this->lang->line('pw_do_not_match'));
        $errCPassword = array('required' => $this->lang->line('pwd_validation'));
        $terms = array('required' => $this->lang->line('req_agree_to_terms'));

        $this->form_validation->set_rules('first_name', '', 'required|min_length[1]|max_length[150]', $errFName);
        $this->form_validation->set_rules('password', '', 'required|min_length[6]|max_length[16]|matches[confirm_password]|callback_password_check', $errPassword);
        $this->form_validation->set_rules('confirm_password', '', 'required', $errCPassword);
        $this->form_validation->set_rules('terms_conditions', '', 'required', $terms);


        return $this->form_validation->run();
    }

    public function signUpLawyerPage() {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }
        $this->load->model('registrationModel', 'model');
        Smart::setTitle('Register');
        Smart::setDescription('Register');

        $this->load->library('recaptcha');
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
            'error' => $this->session->flashdata('error'),
        );
        $data['provinces'] = $this->model->selectTypes('state');
        $this->load->view('shared/_header');
       // $this->load->view('register/temp', $data);//
        $this->load->view('register/signup_lawyer', $data);
        $this->load->view('shared/_footer');
    }

    public function signUpFAPage() {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }
        $this->load->model('registrationModel', 'model');
        Smart::setTitle('Register');
        Smart::setDescription('Register');

        $this->load->library('recaptcha');
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
            'error' => $this->session->flashdata('error'),
        );
        $data['provinces'] = $this->model->selectTypes('state');
        $this->load->view('shared/_header');
         //$this->load->view('register/temp', $data);
        $this->load->view('register/signup_fa', $data);
        $this->load->view('shared/_footer');
    }

    private function stepOneRoutine($customerObject) {
        $this->load->model('registrationModel', 'registration');
        $this->load->helper('string');
        $this->lang->load("notifications", $this->language);
        $sid = session_id();

        $hasRequest = $this->registration->hasSessionActivity($sid, "REGISTER", REG_REQUEST);
        if ((int) $hasRequest <= REG_REQUEST_NUM) {//5 tries in 5 minutes.
            $customer = $this->registration->registerCustomer($customerObject);

            if (is_object($customer) && $customer !== NULL) {
                $this->registration->addActivityLog("Registration Step 1", 'REGISTER', $customer->id);

                //Email Routine
                $link = base_url("activate-account/" . $customer->activate_hash);
                $active_link = base_url("activate-email/" . $customer->activate_hash);
                $this->load->library('emailsHelper');
                //$this->load->library("PhpMailerLib");
      
                $application = $this->updateTempApp($customer);
                $landingPage = "registration-completed";
                if($application !== NULL){
                    $landingPage = $application->current_seo_uri;
                }
                
                $params = array(
                    'actionName' => "welcomeMessage",
                    "language" => $this->language,
                    "email" => $customer->email,
                    "heading" => $this->lang->line('signup_head'),
                    "link" => $link,
                    "activation" => $active_link,
                    "customer" => $customer);
                $this->emailshelper->shootEmail($params, $this->registration);
             
                $userDate = array('CustomerObject' => $customer,
                  'AppLogin' => TRUE,
                  'IpCheck' => FALSE);
                  $this->session->set_userdata($userDate);
                // echo base_url($landingPage);
                redirect(base_url($landingPage));
                
            } else {//User not exisits
                redirect(base_url("signup-error"));
                exit();
            }
        } else {
            //bot or misuse 
           redirect(base_url("un-available"));
          exit();
        }
    }
    
         
    /**
     * Callback
     *
     * Call back method to validate customer username existence
     *
     * @param   string customer email
     * @return  boolean
     */
    public function username_check($str) {

        if (!filter_var($str, FILTER_VALIDATE_EMAIL)) {
            $this->form_validation->set_message('username_check', $this->lang->line('valid_email'));
            return FALSE;
        }
        $this->load->model('registrationModel', 'registration');
        $count = (int) $this->registration->isCustomerExisits($str);
        if ($count > 0) {
            $this->form_validation->set_message('username_check', "CUSTOMEREXISITS");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Callback
     *
     * Call back method to validate customer password
     *
     * @param   string customer password
     * @return  boolean
     */
    public function password_check($str) {

        if (!Smart::validatePassword($str)) {
            $this->form_validation->set_message('password_check', $this->lang->line('pwd_validation'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
      public function googleoAuthCallBack() {
      $this->load->library('Google/GoogleBootstrap');
      if (!isset($_GET['code'])) {
      redirect(base_url($this->language . "/signup-error"));
      } else {
      $client = $this->googlebootstrap->getClient();
      $client->authenticate($_GET['code']);
      $_SESSION['access_token'] = $client->getAccessToken();
      $service = new Google_Service_Oauth2($client);
      $user = $service->userinfo->get();
      $user->media_type = 'G';
      $this->registerAuthUser($user);
      }
      }

      private function registerAuthUser($user) {
      $this->load->model('registrationModel', 'registration');
      $userExists = $this->registration->objectFromEmail($user->email);
      if ($userExists === NULL) {
      $this->load->helper('string');
      $this->lang->load("notifications", $this->language);
      $customerObject = new stdClass();
      $customerObject->first_name = $user->givenName;
      $customerObject->last_name = $user->familyName;
      $customerObject->email = $user->email;
      $customerObject->default_language = $this->language;
      $customerObject->password = Smart::generatePassword();

      $customerObject->status = 1;
      $customerObject->is_active = (int) $user->verifiedEmail;
      $customerObject->meta_info = json_encode($this->metaInfo());

      $customerObject->auth_token = $user->id;
      $customerObject->media_type = $user->media_type;

      $customer = $this->registration->registerCustomer($customerObject);
      $this->SubscribeCustomer($customer);

      if (is_object($customer) && $customer !== NULL) {
      $this->registration->addActivityLog("Registration Step 1", 'REGISTER', $customer->id);
      if ((int) $user->verifiedEmail !== 1) {
      //Email Routine
      $link = base_url($this->language . "/activate-account/" . $customer->auth_token);
      $active_link = base_url($this->language . "/activate-email/" . $customer->auth_token);
      $this->load->library('emailsHelper');
      $params = array(
      'actionName' => "welcomeMessage",
      "language" => $this->language,
      "email" => $customer->email,
      "heading" => $this->lang->line('signup_head'),
      "link" => $link,
      "activation" => $active_link,
      "customer" => $customer);

      $this->emailshelper->shootEmail($params, $this->registration);
      }
      $userDate = array('CustomerObject' => $customer,
      'AppLogin' => TRUE,
      'IpCheck' => FALSE);
      $this->session->set_userdata($userDate);
      $this->registration->updateLastLogin($user->email, $user->media_type);
      redirect(base_url($this->language . "/my-account"));
      } else {//User not exisits
      redirect(base_url($this->language . "/signup-error"));
      }
      } else {

      $userDate = array('CustomerObject' => $userExists,
      'AppLogin' => TRUE,
      'IpCheck' => FALSE);
      $this->session->set_userdata($userDate);
      $this->registration->updateLastLogin($user->email, $user->media_type);
      redirect(base_url($this->language . "/my-account"));
      }
      }

      private function SubscribeCustomer($object) {
      //subscribe

      $this->subscription = new stdClass();
      $subscribedObj = $this->registration->checkSubscription($object->email);
      $this->subscription->email = $object->email;
      $this->subscription->applicant_id = (!empty($object)) ? $object->id : $subscribedObj->applicant_id;
      $this->subscription->status = 1;

      $this->subscription->meta_info = json_encode($this->metaInfo());

      if ($subscribedObj !== NULL) {
      $this->registration->addActivityLog(substr("Subscription update for " . $object->email, 0, 250), "SUBSCRIPTION", $object->id);
      $this->subscription->updated_date = date('Y-m-d H:i:s');
      $this->subscription->id = $subscribedObj->id;
      $this->registration->updateSubcribeCustomer($this->subscription);
      } else {
      $this->registration->addActivityLog(substr("Subscription addition for " . $object->email, 0, 250), "SUBSCRIPTION", $object->id);
      $this->subscription->token = str_replace("-", "", strtolower(Smart::GUID()));
      $this->subscription->created_date = date('Y-m-d H:i:s');
      $this->subscription->updated_date = date('Y-m-d H:i:s');
      $this->registration->subcribeCustomer($this->subscription);
      }
      }
     *
     */

    public function activateAccount($code) {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }

        $this->load->model('registrationModel', 'registration');
        $object = $this->registration->objectFromHash($code);

        if ($object !== NULL) {
            $data['message'] = ((int) $object->active === 1) ? "Link has been expired." : "Your Account has been activated successfully."
                    . '<br><br><a href="'. base_url('sign-in').'" class="button">Sign In</a>';
            $this->registration->activateUser($object->email);
        } else {
            $data['message'] = "Activation code is not correct please contact site administrator.";
        }
        $this->load->view('shared/_header');
        $this->load->view('register/activation_success', $data);
        $this->load->view('shared/_footer');
    }

    public function completeRegistrationPage($code) {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }

        $this->load->model('registrationModel', 'registration');
        $object = $this->registration->objectFromHash($code);

        if ($object !== NULL) {
            if ((int) $object->is_completed === 1) {
                $this->showRegistrationError();
            } else {//Open Reg Page
                $data['provinces'] = $this->registration->selectTypes('state');
                $data['object'] = $object;
                $this->load->view('shared/_header');
                $this->load->view('register/complete_registration', $data);
                $this->load->view('shared/_footer');
            }
            $this->registration->activateUser($object->email);
        } else {
            $this->showRegistrationError();
        }
    }

    private function showRegistrationError() {
        $data['message'] = "Link has been expired, please contact site administrator.";
        $this->load->view('shared/_header');
        $this->load->view('register/activation_success', $data);
        $this->load->view('shared/_footer');
    }

    public function completeRegistration() {
        if ($this->isAuthorized()) {
            redirect(base_url('sign-in'));
        }
        $input = (object) $this->input->post(NULL, TRUE);
        $this->load->model('registrationModel', 'registration');
        $object = $this->registration->objectFromHash($input->hash);
        if ($object !== NULL) {
            if ((int) $object->is_completed === 1) {
                $this->showRegistrationError();
            } else {
                if ($this->validateCompleteForms() === FALSE) {
                    $this->completeRegistrationPage($input->hash);
                } else {
                    $options = ['cost' => 11,];
                    $pwd = password_hash($this->input->post("password", TRUE), PASSWORD_BCRYPT, $options);

                    $customerObject = new stdClass();
                    $customerObject->email = $object->email;
                    $customerObject->first_name = $this->input->post("first_name", TRUE);
                    $customerObject->password_hash = $pwd;
                    $customerObject->active = 1;
                    $customerObject->is_completed = 1;
                    $customerObject->province = $this->input->post("province", TRUE);

                    $hash = str_replace("-", "", strtolower(Smart::GUID()));
                    $customerObject->activate_hash = $hash;
                    //Insert Db and Login
                    $this->registration->completeRegistration($customerObject);
                    $customer = $this->registration->objectFromId($object->id);
                    $userDate = array('CustomerObject' => $customer,
                        'AppLogin' => TRUE,
                        'IpCheck' => FALSE);
                    $this->session->set_userdata($userDate);

                    redirect(base_url('sign-in'));
                }
            }
        } else {
            $this->showRegistrationError();
        }
    }
    public function successMessagePage() {
        
        $data['message'] = $this->session->flashdata('soft_message');
        $this->load->view('shared/_header');
        $this->load->view('register/success_message', $data);
        $this->load->view('shared/_footer');
    }
    public function addFAsPage() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {

            $data['list'] = "";
            
            $this->load->view('shared/_header');
            $this->load->view('register/import_fa', $data);
            $footerJs = array(
                base_url('assets/js/ckeditor/ckeditor.js'),
                base_url('assets/js/app/import.js'),
            );
            $this->load->view('shared/_footer',array("footerJs" => $footerJs));
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function importFA() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {
            if ($this->input->post() !== FALSE) {
                $config_arr = array(
                    'upload_path' => './assets/temp/',
                    'allowed_types' => 'csv',
                    'max_size' => '4096',
                    'encrypt_name' => true,
                    'file_name' => 'import-batch'
                );
                $object = (object) $this->input->post(null, TRUE);
                $this->load->library('upload', $config_arr);
                if (!$this->upload->do_upload('csvbatch')) {

                    Smart::setSoftError($this->upload->display_errors());
                    redirect(base_url('fa-onbording'));
                } else {

                    $data = (object) $this->upload->data();

                    $csv = array_map('str_getcsv', file('./assets/temp/' . $data->file_name));
                    array_shift($csv); //header strip
                    $this->load->model('registrationModel', 'model');
                    $i =0;
                    foreach ($csv as $row) {

                        $customer = $this->model->objectFromEmail($row[1]);
                        if ($customer === NULL) {
                            $customerObject = new stdClass();
                            $customerObject->first_name = $row[0];
                            $customerObject->city = $row[2];
                            $customerObject->postal_code = $row[3];
                            $customerObject->email = $customerObject->username = strtolower($row[1]);
                            $customerObject->password_hash = $pwd = Smart::generatePassword();
                            $customerObject->active = 0;
                            $customerObject->is_completed = 0;
                            $customerObject->role_id = Constants::$FINANCIALADVISOR;
                            $customerObject->province = 6;
                            $customerObject->institue_practice = $row[5];
                            $customerObject->country = "CA";
                            $hash = str_replace("-", "", strtolower(Smart::GUID()));
                            $customerObject->activate_hash = $hash;
                            $message = strip_tags($_POST['message'], '<a><p><b><em><strong><ol><ul><li>');
                            $this->importRoutine($customerObject, Constants::$FINANCIALADVISOR, $message);
                        }
                        $i++;
                    }

                    Smart::setSoftMesssage($i. " advisor(s) successfully imported. A welcome email has been sent.");
                    redirect(base_url('success-message'));
                }
            }
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function addAdvisorPage() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {
            $this->load->model('myAccountModel', 'model');
            $object = new stdClass();
            $object->name = "";
            $this->model->setLimit(NULL);
            $data['list'] = $this->model->getInstitutesList($object);
            $data['provinces'] = $this->model->selectTypes('state');
            $this->load->view('shared/_header');
            $this->load->view('register/add_advisor', $data);
            $footerJs = array(
                base_url('assets/js/ckeditor/ckeditor.js'),
                base_url('assets/js/app/import.js'),
            );
            $this->load->view('shared/_footer',array("footerJs" => $footerJs));
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function addAdvisor() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {

            $this->load->library('form_validation');
            $errFName = array('required' => $this->lang->line('req_fname'),
                'min_length' => $this->lang->line('req_fname'),
                'max_length' => $this->lang->line('req_fname'),
                'regex_match' => $this->lang->line('alpha'));
            $errEmail = array('required' => $this->lang->line('valid_email'), 'valid_email' => $this->lang->line('valid_email'));
            $errCity = array('required' => $this->lang->line('req_city'), 'min_length' => $this->lang->line('req_city'), 'max_length' => $this->lang->line('req_city'));
            $errPostalCode = array('required' => $this->lang->line('req_postal_code'), 'min_length' => $this->lang->line('req_postal_code'), 'max_length' => $this->lang->line('req_postal_code'));


            $this->form_validation->set_rules('email_address', '', 'required|callback_username_check', $errEmail);
            $this->form_validation->set_rules('first_name', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_ALPHA . ']*$/u]|min_length[1]|max_length[32]', $errFName);
            $this->form_validation->set_rules('city', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_NO_TAG . ']*$/u]|min_length[1]|max_length[150]', $errCity);
            $this->form_validation->set_rules('postal_code', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_ALPHANUMERIC . ']*$/u]|min_length[3]|max_length[10]', $errPostalCode);
            if ($this->form_validation->run() === FALSE) {
                $this->addAdvisorPage();
            } else {
                $customerObject = new stdClass();
                $customerObject->first_name = $this->input->post('first_name', TRUE);
                $customerObject->email = $customerObject->username = $this->input->post('email_address', TRUE);
                $customerObject->password_hash = $pwd = Smart::generatePassword();
                $customerObject->active = 0;
                $customerObject->is_completed = 0;
                $customerObject->role_id = Constants::$FINANCIALADVISOR;
                $customerObject->province = $this->input->post('province', TRUE);
                $customerObject->city = $this->input->post('city', TRUE);
                $customerObject->postal_code = $this->input->post('postal_code', TRUE);
                $customerObject->institue_practice = $this->input->post('institue_practice', TRUE);
                $customerObject->country = "CA";
                $hash = str_replace("-", "", strtolower(Smart::GUID()));
                $customerObject->activate_hash = $hash;
                $message = strip_tags($_POST['message'], '<a><p><b><em><strong><ol><ul><li>');
                $this->importRoutine($customerObject, Constants::$FINANCIALADVISOR, $message);
                Smart::setSoftMesssage("Advisor has been added successfully. A welcome email has been sent.");
                redirect(base_url("success-message"));
            }
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function importEndUserPage() {
        $isFa = $this->isAuthorizedFA();
        if ($isFa === TRUE) {
            $this->load->model('myAccountModel', 'model');
            $object = new stdClass();
            $object->name = "";
            $this->model->setLimit(NULL);
            $data['list'] = $this->model->getInstitutesList($object);
            $this->load->view('shared/_header');
            $this->load->view('register/import_enduser', $data);
            $footerJs = array(
                base_url('assets/js/ckeditor/ckeditor.js'),
                base_url('assets/js/app/import.js'),
            );
            $this->load->view('shared/_footer',array("footerJs" => $footerJs));
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function importEndUser() {
        $isFa = $this->isAuthorizedFA();
        if ($isFa === TRUE) {
            if ($this->input->post() !== FALSE) {
                $config_arr = array(
                    'upload_path' => './assets/temp/',
                    'allowed_types' => 'csv',
                    'max_size' => '4096',
                    'encrypt_name' => true,
                    'file_name' => 'import-batch'
                );
                $object = (object) $this->input->post(null, TRUE);
                $this->load->library('upload', $config_arr);
                if (!$this->upload->do_upload('csvbatch')) {

                    Smart::setSoftError(strip_tags($this->upload->display_errors()));
                    redirect(base_url('import-clients'));
                } else {

                    $data = (object) $this->upload->data();

                    $csv = array_map('str_getcsv', file('./assets/temp/' . $data->file_name));
                    array_shift($csv); //header strip
                    $this->load->model('registrationModel', 'model');
                    $i = 0;
                    foreach ($csv as $row) {

                        $customer = $this->model->objectFromEmail($row[1]);
                        if ($customer === NULL) {
                            $customerObject = new stdClass();
                            $customerObject->first_name = $row[0];
                            $customerObject->city = $row[2];
                            $customerObject->postal_code = $row[3];
                            $customerObject->email = $customerObject->username = strtolower($row[1]);
                            $customerObject->password_hash = $pwd = Smart::generatePassword();
                            $customerObject->active = 0;
                            $customerObject->is_completed = 0;
                            $customerObject->role_id = Constants::$ENDUSER;
                            $customerObject->province = 6;
                            $customerObject->institution_id = 0;
                            $customerObject->parent_id = $this->currentCustomer->id;
                            $customerObject->country = "CA";
                            $hash = str_replace("-", "", strtolower(Smart::GUID()));
                            $customerObject->activate_hash = $hash;
                            $message = strip_tags($_POST['message'], '<a><p><b><em><strong><ol><ul><li>');
                            $this->importRoutine($customerObject, Constants::$ENDUSER, $message);
                        }
                        $i++;
                    }

                    Smart::setSoftMesssage($i. " client(s) successfully imported. A welcome email has been sent.");
                    redirect(base_url('success-message'));
                }
            }
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function addClientPage() {
        $isFa = $this->isAuthorizedFA();
        if ($isFa === TRUE) {
            $this->load->model('myAccountModel', 'model');
            $object = new stdClass();
            $object->name = "";
            $this->model->setLimit(NULL);

            $data['provinces'] = $this->model->selectTypes('state');
            $this->load->view('shared/_header');
            $this->load->view('register/add_client', $data);
            $footerJs = array(
                base_url('assets/js/ckeditor/ckeditor.js'),
                base_url('assets/js/app/import.js'),
            );
            $this->load->view('shared/_footer',array("footerJs" => $footerJs));
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function addClient() {
        $isFa = $this->isAuthorizedFA();
        if ($isFa === TRUE) {
            $this->load->library('form_validation');
            $errFName = array('required' => $this->lang->line('req_fname'),
                'min_length' => $this->lang->line('req_fname'),
                'max_length' => $this->lang->line('req_fname'),
                'regex_match' => $this->lang->line('alpha'));
            $errEmail = array('required' => $this->lang->line('valid_email'), 'valid_email' => $this->lang->line('valid_email'));
            $errCity = array('required' => $this->lang->line('req_city'), 'min_length' => $this->lang->line('req_city'), 'max_length' => $this->lang->line('req_city'));
            $errPostalCode = array('required' => $this->lang->line('req_postal_code'), 'min_length' => $this->lang->line('req_postal_code'), 'max_length' => $this->lang->line('req_postal_code'));


            $this->form_validation->set_rules('email_address', '', 'required|callback_username_check', $errEmail);
            $this->form_validation->set_rules('first_name', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_ALPHA . ']*$/u]|min_length[1]|max_length[32]', $errFName);
            $this->form_validation->set_rules('city', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_NO_TAG . ']*$/u]|min_length[1]|max_length[150]', $errCity);
            $this->form_validation->set_rules('postal_code', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_ALPHANUMERIC . ']*$/u]|min_length[3]|max_length[10]', $errPostalCode);
            if ($this->form_validation->run() === FALSE) {
                $this->addClientPage();
            } else {
                $customerObject = new stdClass();
                $customerObject->first_name = $this->input->post('first_name', TRUE);
                $customerObject->email = $customerObject->username = $this->input->post('email_address', TRUE);
                $customerObject->password_hash = $pwd = Smart::generatePassword();
                $customerObject->active = 0;
                $customerObject->is_completed = 0;
                $customerObject->parent_id = $this->currentCustomer->id;
                $customerObject->role_id = Constants::$ENDUSER;
                $customerObject->province = $this->input->post('province', TRUE);
                $customerObject->city = $this->input->post('city', TRUE);
                $customerObject->postal_code = $this->input->post('postal_code', TRUE);
                $customerObject->institution_id = 0;
                $message = strip_tags($_POST['message'], '<a><p><b><em><strong><ol><ul><li>');
                $customerObject->country = "CA";
                $hash = str_replace("-", "", strtolower(Smart::GUID()));
                $customerObject->activate_hash = $hash;
                $this->importRoutine($customerObject, Constants::$ENDUSER, $message);
                Smart::setSoftMesssage("Client has been added successfully. A welcome email has been sent.");
                redirect(base_url("success-message"));
            }
        } else {
            redirect(base_url('sign-in'));
        }
    }

    private function importRoutine($customerObject, $role, $body) {
        $this->load->model('registrationModel', 'registration');
        $this->load->helper('string');
        $this->lang->load("notifications", $this->language);
        $sid = session_id();


        $customer = $this->registration->registerCustomer($customerObject);

        if (is_object($customer) && $customer !== NULL) {
            $this->registration->addActivityLog("Registration Step 1", 'REGISTER', $customer->id);

            //Email Routine
            $link = base_url("complete-registration/" . $customer->activate_hash);
            $active_link = base_url("complete-registration/" . $customer->activate_hash);
            
            $message =  $body. '<p>{BUTTON}<br style=\'clear:both;\'></p>';
            
            $this->load->library('emailsHelper');
            $params = array(
                'actionName' => ((int) $role === Constants::$FINANCIALADVISOR) ? "welcomeMessageFA" : "welcomeMessageEndUser",
                "language" => $this->language,
                "email" => $customer->email,
                "heading" => ((int) $role === Constants::$FINANCIALADVISOR) ? $this->lang->line('fa_signup_head') : $this->lang->line('enduser_signup_head'),
                "link" => $link,
                "message" => $message,
                "activation" => $active_link,
                "customer" => $customer);
            //$this->emailshelper->setTest();
            $this->emailshelper->shootEmail($params, $this->registration);
            //echo $this->emailshelper->getHtml();
            
            return TRUE;
        }
        return FALSE;
    }

}
