<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthenticationController
 *
 * @author Saqib Ahmad
 */
class AuthenticationController extends Pixel_Controller{
    public function signInPage() {
        Smart::setTitle('Register');
        Smart::setDescription('Register');

        $this->load->library('recaptcha');
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
            'error' => $this->session->flashdata('error'),
        );
        $this->load->view('shared/_header');
        $this->load->view('myaccount/signin', $data);
        $this->load->view('shared/_footer');
    }
    public function signOut() {
        
        $this->session->pageReffrer = "";
        $this->security->inValidateHash();
        $this->session->unset_userdata("AppLogin");
        $this->session->unset_userdata("CustomerObject");
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
    
    public function signIn() {
        
        $captchaVerified = $this->verifyCaptcha();
        if($captchaVerified === FALSE){
            Smart::setSoftError("Please prove you are a human");
            redirect('sign-in');
            exit;
        }
        
        $this->config->set_item('language', $this->language);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $errorEmail = array('required' => $this->lang->line('valid_email'),
            'valid_email' => $this->lang->line('valid_email'));
        $errorPassword = array('required' => $this->lang->line('pwd_validation'),
            'min_length' => $this->lang->line('pwd_validation'),
            'max_length' => $this->lang->line('pwd_validation'));

        $this->form_validation->set_rules('txt_user', '', 'trim|required', $errorEmail);
        $this->form_validation->set_rules('txt_password', '', 'trim|required|min_length[6]|max_length[22]', $errorPassword);
        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('error', $this->lang->line('invalid_login'));
            redirect(base_url("sign-in"));
        } else {
            $this->load->model('authenticationModel', 'auth');
            $hasRequest = $this->auth->hasIPActivity(Smart::getSanitizedIP(), "LOGIN_ATTEMPT", LOGIN_ATTEMPTS_MIN);
            
            if ($hasRequest >= LOGIN_ATTEMPTS) {
                redirect(base_url("forgot-password"));
                exit;
            }
            $this->auth->setUsername($this->input->post("txt_user", TRUE));
            $this->auth->setPassword($this->input->post("txt_password", TRUE));
            $customer = $this->auth->isAutorized();
            if (is_object($customer)) {

                $application = $this->updateTempApp($customer);
                
                $landingPage = "";
                if($application !== NULL){
                    $landingPage = $application->current_seo_uri;
                }
                /*$after_login = (is_null($customer->after_login)) ? "" : $customer->after_login;
                $after_login = ($after_login === "") ? $this->getPageReffrerURI($this->session->pageReffrer) : $after_login;
                $after_login = ($after_login === "") ? "my-account" : $after_login;

                $this->session->pageReffrer = "";*/
                $userDate = array('CustomerObject' => $customer,
                    'AppLogin' => TRUE,
                    'IpCheck' => FALSE);
                $this->session->set_userdata($userDate);

                /*if ($after_login === 'change-password') {
                    $this->lang->load('form_validation', (strtolower($customer->default_language) === 'en') ? 'en' : 'fr');
                    $this->session->set_flashdata('success', $this->lang->line('pwd_request_pending'));
                }*/
                $this->session->set_userdata('__ci_last_regenerate', 0);
                //$landingPage = ((int)$customer->role_id === Constants::$ENDUSER)?"my-applications":"";
                redirect(base_url($landingPage));
                
            } else {//User not exisits
                $this->auth->addActivityLog("wrong login attempt!", 'LOGIN_ATTEMPT', 0);
                Smart::setSoftError($this->lang->line('invalid_login'));
                redirect(base_url("sign-in"));
            }
        }
    }
    /**
     * Forget Password
     *
     * Render Forget password page
     *
     * @param   none
     * @return  void 
     */
    public function forgotPasswordPage() {
        if ($this->isAuthorized()) {
            redirect(base_url());
        }
        $this->load->library('recaptcha');
        $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
            'error' => $this->session->flashdata('error'),
        );
        $this->load->view('shared/_header');
        $this->load->view('myaccount/forgot_password', $data);
        $this->load->view('shared/_footer');
    }

    /**
     * Reset Customer Password
     *
     * Rest customer password and shoot an email with the credentials
     *
     * @param   none (parameteers will be drived from post object)
     * @return  void 
     */
    public function resetPassword() {
        if ($this->isAuthorized()) {
            redirect(base_url());
        }
        /*$captchaVerified = $this->verifyCaptcha();
        if($captchaVerified === FALSE){
            Smart::setSoftError("Please prove you are a human");
            redirect('forgot-password');
            exit;
        }*/
        $this->config->set_item('language', $this->language);
        $this->load->library('form_validation');

        $errEmail = array('valid_email' => $this->lang->line('valid_email'));

        $this->form_validation->set_rules('email_address', '', 'valid_email', $errEmail);

        if ($this->form_validation->run() === FALSE) {

            $this->forgotPasswordPage();
        } else {
            $email = $this->input->post("email_address", TRUE);
            $this->updateCredentials($email);
        }
    }

    /**
     * Update Credentials
     *
     * Internal method to validate and reset customer credential 
     *
     * @param   none (parameteers will be drived from post object)
     * @return  void 
     */
    private function updateCredentials($email) {
        $this->lang->load("notifications", $this->language);
        $this->load->model('authenticationModel', 'auth');

        $hasRequested = $this->auth->hasIPActivity(Smart::getSanitizedIP(), "RESET_PWD", RSET_PWD_ATTEMPTS_MIN);
        if ($hasRequested >= RESET_PWD_ATTEMPTS) {
            $this->load->view('shared/for_bots', $header);
        } else {
            //$this->auth->addActivityLog("reset pasword attempt!", 'RESET_PWD', 0);
            $this->auth->setUsername($email);
            $customer = $this->auth->getObjectFromEmail();
            
            if (is_object($customer)) {
                $id = (int) $customer->id;
                if ($id > 0 && (int)$customer->active == Constants::$ENABLE) {
                    $hasRequest = (int) $this->auth->hasPwdRestRequest($id);
                    if ($hasRequest <= 0) {
                        $this->load->helper('string');
                        $pwd = Smart::generatePassword();
                        $this->auth->resetPassword($pwd);
                        $this->auth->addActivityLog("User: password reset request", 'FORGET_PWD', $id);
                        /* Email Routine */
                        $this->load->library('emailsHelper');
                        //$this->emailshelper->setTest(TRUE);
                        $params = array(
                            'actionName' => "forgotPassword",
                            "language" => 'en',
                            "email" => $customer->email,
                            "heading" => $this->lang->line('forget_password_heading'),
                            "pwd" => $pwd,
                            "customer" => $customer);
                        $this->emailshelper->shootEmail($params, $this->auth);
                        //$this->emailshelper->getHtml(TRUE);
                       
                        /* email routine ended */
                    }
                }
            }
            Smart::setSoftMesssage($this->lang->line('reset_pwd_success'));
            redirect(base_url("forgot-password/"));
        }
    }

    private function getPageReffrerURI($reffrer) {
        if (0 === strpos($reffrer, base_url())) {
            $uriArray = explode("/", $reffrer);
            return implode("/", array_slice($uriArray, 4));
        }
        return "";
    }

    public function changePasswordPage() {
        $this->redirectUnAuthorized();

        $this->load->view('shared/_header');
        $this->load->view('myaccount/change_password');
        $this->load->view('shared/_footer');
    }

    public function updatePassword() {
        $this->redirectUnAuthorized();


        $this->load->helper('form');
        $this->load->library('form_validation');

        $oldPassErros = array('required' => $this->lang->line('pwd_validation'),
            'min_length' => $this->lang->line('pwd_validation'),
            'max_length' => $this->lang->line('pwd_validation'));
        $newPassErros = array('required' => $this->lang->line('pwd_validation'),
            'min_length' => $this->lang->line('pwd_validation'),
            'max_length' => $this->lang->line('pwd_validation'),
            'matches' => $this->lang->line('pw_do_not_match'));
        $confrimPassErros = array('required' => $this->lang->line('pw_do_not_match'));

        $this->form_validation->set_rules('old_pwd', '', 'required|min_length[6]|max_length[16]|callback_oldpass_check', $oldPassErros);
        $this->form_validation->set_rules('pwd', '', 'required|min_length[6]|max_length[16]|matches[confirm_password]|callback_password_check', $newPassErros);
        $this->form_validation->set_rules('confirm_password', '', 'required', $confrimPassErros);
        if ($this->form_validation->run() === FALSE) {
            $this->changePasswordPage();
        } else {
            $this->load->model('authenticationModel', 'auth');
            $this->auth->updatePassword($this->currentCustomer->id, $this->input->post("pwd", TRUE));


            Smart::setSoftMesssage($this->lang->line('success_password'));
            redirect(base_url("change-password/"));
        }
    }

    /**
     * Callback
     *
     * Call back method to validate old passwords
     *
     * @param	string password
     * @return  boolean
     */
    public function oldpass_check($str) {
        $this->load->model('authenticationModel', 'auth');
        $this->auth->setUsername($this->currentCustomer->email);
        $this->auth->setPassword($str);
        $customer = $this->auth->isAutorized();
        if ($customer === NULL) {//Check is user provide a valid password
            $this->form_validation->set_message('oldpass_check', $this->lang->line('incorrect_password'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Callback
     *
     * Call back method to validate passwords
     *
     * @param	string 
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
}
