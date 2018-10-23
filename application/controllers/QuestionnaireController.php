<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionnaireController
 *
 * @author Saqib Ahmad
 */
class QuestionnaireController extends Pixel_Controller {
    public $labelArray = [];
    public function __construct() {
        parent::__construct();
        $this->load->model('questionsModel', 'model');
        
        $this->labelArray = $this->model->getLabels();
    }


    public function createSessionApplication() {
        // $isLogedIn = $this->isAuthorized();
        // if ($isLogedIn === TRUE) {//if Loggedin Start Appl
            $this->createApplication();
       //  } else {
       //      $haveTempApp = (int) $this->model->numSessionApps($this->session->session_id);
       //      if ($haveTempApp <= 0) {
       //          $object = new stdClass();
       //          $object->user_id = 0;
       //          $object->decision_id = $this->input->post('decision_id', TRUE);
       //          //$object->profession_id = $this->input->post('profession_id', TRUE);
       //          $object->start_date = $this->currentDate;
       //          $object->session_id = $this->session->session_id;
       //          $object->current_seo_uri = 'confide';
       //          $appDate = array('tempApp' => TRUE, "tempId" => $this->session->session_id);
       //          $this->session->set_userdata($appDate);
       //          $applicationId = $this->model->createApplication($object);
       //          $this->session->set_userdata(array('appId' => $applicationId));
       //          $this->session->set_userdata(array('numKids' => 0));
                
       //          $application = $this->model->getApplicationById($this->session->appId);
       //          $key = "life-decision";
       //          $objFlow = Smart::getNextPreviousStep($application, $key);
       //      } else {
       //          $application = $this->model->getApplicationBySession($this->session->session_id);
       //          $this->session->set_userdata(array('appId' => $application->id));
       //          $key = $application->current_seo_uri;
       //          $objFlow = Smart::getNextPreviousStep($application, $key);
       //          $objFlow->next = $key;
       //      }
       //      redirect(base_url($objFlow->next));
       // } 
    }

    public function createApplication() {

        //$this->redirectUnAuthorized(TRUE, 'sign-in');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_decission'),
            'is_natural_no_zero' => $this->lang->line('req_decission'));
        $errorP = array('required' => $this->lang->line('req_profession'),
            'is_natural_no_zero' => $this->lang->line('req_profession'));

        $this->form_validation->set_rules('decision_id', '', 'trim|required|is_natural_no_zero', $error);
        //$this->form_validation->set_rules('profession_id', '', 'trim|required|is_natural_no_zero', $errorP);
        if ($this->form_validation->run() == FALSE) {

            $this->startQuestionPage();
        } else {
            $object = new stdClass();
            $object->user_id = (int) $this->currentCustomer->id;
            $object->decision_id = $this->input->post('decision_id', TRUE);
            // /$id =$this->input->post('decision_id', TRUE);

            $decision_row = $this->model->get_decision($object->decision_id);
            $decision =  $decision_row->name;
            $this->session->set_userdata('life_decision',$decision);
            
         

            //$object->profession_id = $this->input->post('profession_id', TRUE);
            $object->start_date = $this->currentDate;
            $object->current_seo_uri = 'life-decision';


            if ((int) $this->session->appId > 0) {//if already created or coming from session
                $application = $this->model->getApplicationById($this->session->appId);
                $key = "life-decision";
                $objFlow = Smart::getNextPreviousStep($application, $key);
                $this->updateApplication($object, $objFlow->next);
            } else {
                $applicationId = $this->model->createApplication($object);
                $this->session->set_userdata(array('appId' => $applicationId));
                $application = $this->model->getApplicationById($this->session->appId);
                $key = "life-decision";
                $objFlow = Smart::getNextPreviousStep($application, $key);
            }

            redirect(base_url($objFlow->next));
        }
    }

    public function startQuestionPage() {

        //$this->redirectUnAuthorized(TRUE, 'sign-in');
        $haveTempApp = (int) $this->model->numSessionApps($this->session->session_id);
        //if ($haveTempApp <= 0) {
            Smart::setTitle('Life Decission');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');
            $app = new stdClass();
            $app->decision_id = 0;
            //$app->profession_id = 0;
            if ((int) $this->session->appId > 0) {
                $app = $this->model->getApplicationById($this->session->appId);
            }

            $data['app'] = $app;
            $data['decision_list'] = $this->model->selectTypes('decisions');
            $data['profession_list'] = $this->model->selectTypes('profession');


            $data['next_page'] = "";
            $data['prev_page'] = "";
            $data['percentage'] = 0;
            $data['show_assessment'] = FALSE;


            $this->load->view('shared/_header');
            $this->load->view('questions/start_questions', $data);
            $this->load->view('shared/_footer');
        /*} else {
            $application = $this->model->getApplicationBySession($this->session->session_id);
            $this->session->set_userdata(array('appId' => $application->id));
            $key = $application->current_seo_uri;
            
            redirect(base_url($key));
        }*/
    }

    public function relationShipPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('What\'s your relationship status?');
            Smart::setDescription("What's your relationship status?");
            Smart::setKeywords('Famiequity');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('relationship_status');
            $data['app'] = $application;

            $key = 'relationship-status';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            //        echo "<pre>";
            // print_r($data); exit();

            $this->load->view('shared/_header');
            $this->load->view('questions/relation_ship_status', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function saveRelationShip() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_relationship_status'),
            'is_natural_no_zero' => $this->lang->line('req_relationship_status'));

        $this->form_validation->set_rules('relationship_status', '', 'trim|required|is_natural_no_zero', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->relationShipPage();
        } else {

            $object = new stdClass();
            $object->relationship_status = $this->input->post('relationship_status', TRUE);

          

            // $key = "relationship-status";
            // $objFlow = Smart::getNextPreviousStep($application, $key);

            // // echo $object->relationship_status;
            // // print_r($objFlow); exit();
            // $object->current_seo_uri = $objFlow->next;
            // $this->updateApplication($object, $objFlow->next);
            
            $key = "relationship-status";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            // echo "<pre>";
            // echo $this->session->appId;
            // echo  $application->relationship_status;
            // echo $object->relationship_status;
            // print_r( $application); exit();
            $this->updateApplication($object, $objFlow->next);
        }
    }

    public function getIncomePage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Income Information');
            Smart::setDescription('Income Info');
            Smart::setKeywords('Start');


            $application = $this->model->getApplicationById($this->session->appId);
            $risk = Smart::calculateRisk($application, $this->model);
            //$key =  $this->uri->segment(1);
            //Smart::getNextPreviousStep($application, $key);
            $data['list'] = $this->model->selectTypes('relationship_status');
            $data['app'] = $application;
            $data['risk'] = $risk;


            $key = 'income-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;//$objFlow->next;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            // echo "<pre>";
            // print_r( $application);
            // print_r( $objFlow); exit();
            $this->load->view('shared/_header');
            $this->load->view('questions/income', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function getIncome() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_annual_income'));
        $errorS = array('required' => $this->lang->line('req_annual_income_p'));

        $this->form_validation->set_rules('highest_income', '', 'trim|required', $error);
        $this->form_validation->set_rules('s_highest_income', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->getIncome();
        } else {

            $object = new stdClass();
            $object->highest_income = $this->input->post('highest_income', TRUE);
            $object->s_highest_income = $this->input->post('s_highest_income', TRUE);

            $application = $this->model->getApplicationById($this->session->appId);
            $key = 'income-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            //$next = Smart::getFirstPart($application);
            $object->current_seo_uri = $objFlow->next;
            // echo  $object->job_title;
            // echo $objFlow->next;
            // print_r($objFlow); exit();
            $this->updateApplication($object, $objFlow->next);
        }
    }

    public function cohabitationInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Short Questions');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $risk = Smart::calculateRisk($application, $this->model);
            $data['list'] = $this->model->selectTypes('relationship_status');
            $data['app'] = $application;
            
            $data['risk'] = $risk;
            $key = 'cohabitaion-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            

            $this->load->view('shared/_header');
            $this->load->view('questions/cohabitation', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function cohabitationInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_decission'));
        $errorS = array('required' => $this->lang->line('req_decission'));

        $this->form_validation->set_rules('month', '', 'trim|required', $error);
        $this->form_validation->set_rules('year', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->cohabitationInfoPage();
        } else {

            $object = new stdClass();
            $object->moved_date = $this->input->post('year', TRUE) . "-" . $this->input->post('month', TRUE) . "-01";

            $key = 'cohabitaion-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }

    public function basicKidsInfoPage() {

        //$this->redirectUnAuthorized(TRUE, 'sign-up');
        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('How many kids do you have?');
            Smart::setDescription('How many kids do you have?');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('time_spent');
            $data['app'] = $application;

            $key = "kids-basic-info";
            $objFlow = Smart::getNextPreviousStep($application, $key, 0);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = FALSE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/kids', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function basicKidsInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_kids_number'));
        $errorS = array('required' => $this->lang->line('req_kids_nightsout'));
        $errorTime = array('required' => $this->lang->line('req_kids_timekids'));

        $this->form_validation->set_rules('num_kids', '', 'trim|required', $error);
        $this->form_validation->set_rules('num_late_nights', '', 'trim|required', $errorS);
        //$this->form_validation->set_rules('kids_time_spend', '', 'trim|required', $errorTime);

        if ($this->form_validation->run() == FALSE) {
            $this->basicKidsInfoPage();
        } else {

            $object = new stdClass();
            $object->num_kids = $this->input->post('num_kids', TRUE);
            $object->num_late_nights = $this->input->post('num_late_nights', TRUE);
            //$object->kids_time_spend = $this->input->post('kids_time_spend', TRUE);

            $application = $this->model->getApplicationById($this->session->appId);
            
            $key = "kids-basic-info";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $object->current_seo_uri);
        }
    }

    public function marriageInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Short Questions');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('relationship_status');
            $data['app'] = $application;

            $key = "marriage-info";
            $objFlow = Smart::getNextPreviousStep($application, $key, 0);
            $data['next_page'] = FALSE;
            $data['show_assessment'] = FALSE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = FALSE;

            $this->load->view('shared/_header');
            $this->load->view('questions/marriage', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function marriageInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_decission'));
        $errorS = array('required' => $this->lang->line('req_decission'));

        $this->form_validation->set_rules('month', '', 'trim|required', $error);
        $this->form_validation->set_rules('year', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->marriageInfoPage();
        } else {

            $object = new stdClass();
            $object->married_date = $this->input->post('year', TRUE) . "-" . $this->input->post('month', TRUE) . "-01";

            $application = $this->model->getApplicationById($this->session->appId);
            $key = "marriage-info";
            $objFlow = Smart::getNextPreviousStep($application, $key);

            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }

    public function applicationViewPage($id) {
        $application = $this->model->getApplicationById((int) $id);
        if ($application !== NULL) {
            $data['application'] = $application;

            $this->load->view('shared/_header');
            $this->load->view('questions/application_view', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('my-applications'));
        }
    }

    private function updateApplication($object, $redirect) {
        $appId = (int) $this->session->appId;
        $this->model->updateApplication($object, $appId);
        redirect(base_url($redirect));
    }

}
