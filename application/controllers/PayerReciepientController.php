<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PayerReciepientController
 *
 * @author Saqib Ahmad
 */
class PayerReciepientController extends Pixel_Controller {

    const RENT = 28;
    const YES = 1;
    const NO = 2;
    public $labelArray = [];
    public function __construct() {
        parent::__construct();
        $this->load->model('questionsModel', 'model');
        $this->labelArray = $this->model->getLabels();
    }

    public function pensionInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Questions');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "pension-info";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = FALSE;

            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/pension', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function pensionInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_decission'));
        $errorS = array('required' => $this->lang->line('req_decission'));

        $this->form_validation->set_rules('rrsp_value', '', 'trim|required', $error);
        $this->form_validation->set_rules('s_rrsp_value', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->pensionInfoPage();
        } else {

            $object = new stdClass();
            $object->rrsp_value = $this->input->post('rrsp_value', TRUE);
            $object->s_rrsp_value = $this->input->post('s_rrsp_value', TRUE);
            
            $application = $this->model->getApplicationById($this->session->appId);
            $key =  "pension-info";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }

    public function inheritanceInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Inheritance Information');
            Smart::setDescription('Inheritance Information');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('inheritance_maintained');
            $data['app'] = $application;
            
            $key =  "inheritance-info";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = FALSE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/inheritance', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function inheritanceInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));
        

        $this->form_validation->set_rules('received_cash_property_value', '', 'trim|required', $error);
        $this->form_validation->set_rules('inheritance_maintained', '', 'trim|required', $error);
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->inheritanceInfoPage();
        } else {

            $object = new stdClass();
            $object->received_cash_property_value = $this->input->post('received_cash_property_value', TRUE);
            $object->inheritance_maintained = $this->input->post('inheritance_maintained', TRUE);
            
            $key =  "inheritance-info";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function inheritanceMaintainedPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Inheritance Information');
            Smart::setDescription('Inheritance Information');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            
            $key =  "inheritance-maintained";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = FALSE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/inheritance_maintained', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function inheritanceMaintained() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));
        $errorS = array('required' => $this->lang->line('req_gift_value'));
        
        $this->form_validation->set_rules('has_inheritance_gift', '', 'trim|required', $errorS);
        $this->form_validation->set_rules('inheritance_protection', '', 'trim|required', $error);
        
        
        if ($this->form_validation->run() == FALSE) {
            $this->inheritanceMaintainedPage();
        } else {

            $object = new stdClass();
            
            $object->has_inheritance_gift = $this->input->post('has_inheritance_gift', TRUE);
            $object->inheritance_protection = $this->input->post('inheritance_protection', TRUE);
            
            $key =  "inheritance-maintained";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function weddingGidtInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Estimated cash gift from your family at your wedding?');
            Smart::setDescription('Estimated cash gift from your family at your wedding?');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            $key =  "wedding-gift-info";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/wedding_gifit_value', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function weddingGidtInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_wedding_gift'));
        
        $this->form_validation->set_rules('wedding_gifit_value', '', 'trim|required', $error);
        
        if ($this->form_validation->run() == FALSE) {
            $this->weddingGidtInfoPage();
        } else {

            $object = new stdClass();
            $object->wedding_gifit_value = $this->input->post('wedding_gifit_value', TRUE);
            
            
            $key =  "wedding-gift-info";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }

    public function homeOwnerInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Do you rent or own your home?');
            Smart::setDescription('Do you rent or own your home?');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('own_rent');
            $data['app'] = $application;
            $key = 'home-owner-info';
            $objFlow = Smart::getNextPreviousStep($application, $key, self::RENT);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = FALSE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/home_owner', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function homeOwnerInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_home_owner'));
        $this->form_validation->set_rules('has_own_home', '', 'trim|required', $error);

        if ($this->form_validation->run() == FALSE) {
            $this->homeOwnerInfoPage();
        } else {

            $object = new stdClass();
            $object->has_own_home = $this->input->post('has_own_home', TRUE);
            //Skiped algo
            $key = 'home-owner-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key, $object->has_own_home);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $object->current_seo_uri);
        }
    }

    public function homeValueInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Who\'s on title in your home today?');
            Smart::setDescription('Who\'s on title in your home today?');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('me_you');
            $data['app'] = $application;
            $key = 'home-value-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/home_value', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function homeValueInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_home_title_today'));
        

        $this->form_validation->set_rules('home_value', '', 'trim|required', $error);
        //$this->form_validation->set_rules('home_value', '', 'trim|required', $error);

        if ($this->form_validation->run() == FALSE) {
            $this->homeTitleInfoPage();
        } else {

            $object = new stdClass();
            $object->home_title = $this->input->post('home_title', TRUE);
            $object->home_value = $this->input->post('home_value', TRUE);
            $object->outstanding_mortgage = $this->input->post('outstanding_mortgage', TRUE);
            
            $key = 'home-value-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }

    public function cohabitationHomeValueInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Please let us know about cohabitation');
            Smart::setDescription('Please let us know about cohabitation');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('me_you');
            $data['app'] = $application;
            $key = 'past-cohabitaion-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            $this->load->view('shared/_header');
            $this->load->view('questions/coh_home_title', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function cohabitationHomeValueInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_home_title_coh'));
        $errorValue = array('required' => $this->lang->line('req_value_coh'));
        $errorMortgage = array('required' => $this->lang->line('req_mortgage_value_coh'));
        
        $this->form_validation->set_rules('coh_home_title', '', 'trim|required', $error);
        $this->form_validation->set_rules('coh_home_value', '', 'trim|required', $errorValue);
        $this->form_validation->set_rules('coh_mortgage_value', '', 'trim|required', $errorMortgage);

        if ($this->form_validation->run() == FALSE) {
            $this->cohabitationHomeValueInfoPage();
        } else {

            $object = new stdClass();
            $object->coh_home_title = $this->input->post('coh_home_title', TRUE);
            $object->coh_home_value = $this->input->post('coh_home_value', TRUE);
            $object->coh_mortgage_value = $this->input->post('coh_mortgage_value', TRUE);
            
            $key = 'past-cohabitaion-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function homeTitleMarraigeInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('At the date of marriage, who was on title for your home?');
            Smart::setDescription('At the date of marriage, who was on title for your home?');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('me_you');
            $data['list_moved'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'home-title-marriage-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = FALSE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/merriage_home_title', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function homeTitleMarraigeInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_marriage_title'));
        $errorMoved = array('required' => $this->lang->line('req_marriage_moved'));
        
        $this->form_validation->set_rules('merriage_home_title', '', 'trim|required', $error);
        $this->form_validation->set_rules('have_moved', '', 'trim|required', $errorMoved);

        if ($this->form_validation->run() == FALSE) {
            $this->homeTitleMarraigeInfoPage();
        } else {

            $object = new stdClass();
            $object->merriage_home_title = $this->input->post('merriage_home_title', TRUE);
            $object->have_moved = $this->input->post('have_moved', TRUE);
            
            $key = 'home-title-marriage-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function homeTitleInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Who is going to be on title of your home?');
            Smart::setDescription('Who is going to be on title of your home?');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('me_you');
            $data['app'] = $application;
            $key = 'home-title-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/home_title', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function homeTitleInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_home_title'));
        $this->form_validation->set_rules('home_title', '', 'trim|required', $error);
        

        if ($this->form_validation->run() == FALSE) {
            $this->homeTitleInfoPage();
        } else {

            $object = new stdClass();
            $object->home_title = $this->input->post('home_title', TRUE);
            
            
            $key = 'home-title-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function financialInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Financial Responsibility');
            Smart::setDescription('Financial Responsibility');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            
            $isPayer = Smart::isPayer($application);
            $this->session->set_userdata(array('numKids' => ((int)$isPayer > 1) ? 0 : (int)$application->num_kids));
            
            $data['list'] = $this->model->selectTypes('me_you');
            $data['list2'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'financial-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;

            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            
            if((int)$application->relationship_status > 59){
                $data['prev_page'] = ((int)$application->has_own_home === self::RENT)?'home-owner-info':$objFlow->prev;
            }
            
            
            
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/financial', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function financialInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_bill_payments'));
        $errorS = array('required' => $this->lang->line('req_partner_lineinmeans'));

        $this->form_validation->set_rules('bill_payments_manager', '', 'trim|required', $error);
        $this->form_validation->set_rules('s_expense_status', '', 'trim|required', $error);

        if ($this->form_validation->run() == FALSE) {
            $this->financialInfoPage();
        } else {

            $object = new stdClass();
            $object->bill_payments_manager = $this->input->post('bill_payments_manager', TRUE);
            $object->s_expense_status = $this->input->post('s_expense_status', TRUE);
            $key = 'financial-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key, (int)$application->num_kids);
            $object->current_seo_uri = $objFlow->next;
            if (!$this->isAuthorized()) {
                $this->session->set_userdata("hdr_middle_report",true);
                $this->updateApplication($object, 'risk-report');
            }else{
                $this->updateApplication($object, $objFlow->next);
            }
            
        }
    }

    public function otherKidsInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('How many kids do you have with your partner/spouse?');
            Smart::setDescription('how many kids do you have with your partner/spouse');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('me_you');
            $data['app'] = $application;
            $key = 'kids-other-partner-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/other_kids', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function otherKidsInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_kids_others'));
        
        $this->form_validation->set_rules('num_kids_other', '', 'trim|required', $error);

        if ($this->form_validation->run() == FALSE) {
            $this->otherKidsInfoPage();
        } else {

            $object = new stdClass();
            $object->num_kids_other = $this->input->post('num_kids_other', TRUE);
            
            $key = 'kids-other-partner-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }

    public function kidsInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Child(ren) Information');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['kids'] = $this->model->getAppKids($this->session->appId);
            $data['app'] = $application;
            $key = 'kids-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/kids_info', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function kidsInfo() {

        $application = $this->model->getApplicationById($this->session->appId);

        $this->load->library('form_validation');

        $error = array('required' => $this->lang->line('req_fname'));
        for ($i = 0; $i < $application->num_kids; $i++) {
            $this->form_validation->set_rules('first_name_' . $i, '', 'trim|required', $error);
        }
        if ($this->form_validation->run() == FALSE) {
            $this->kidsInfoPage();
        } else {
            
            $this->model->deleteKids($this->session->appId);
            for ($i = 0; $i < $application->num_kids; $i++) {
                $kid = new stdClass();
                $kid->first_name = $this->input->post('first_name_'.$i, TRUE);
                $kid->dob = $this->input->post('year_'.$i, TRUE)."-".$this->input->post('month_'.$i, TRUE)."-".$this->input->post('day_'.$i, TRUE);
                $kid->application_id = $this->session->appId;
                $kid->user_id = $this->currentCustomer->id;
                $kid->date_added = $this->currentDate;
                $this->model->createKids($kid);
            }

            $object = new stdClass();
            $key = 'kids-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }

    public function kidsActivitiesInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Kids Extracurricular Activities');
            Smart::setDescription('Kids Extracurricular Activities');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('extracurricular');
            $data['app'] = $application;
            $key = 'kids-activities-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/kids_activities', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function kidsActivitiesInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_kids_activites'));
        $errorS = array('required' => $this->lang->line('req_kids_activites_cost'));

        $this->form_validation->set_rules('kids_activities[]', '', 'trim|required', $error);
        $this->form_validation->set_rules('activities_cost', '', 'trim|required', $errorS);

        if ($this->form_validation->run() == FALSE) {
            $this->kidsActivitiesInfoPage();
        } else {

            $object = new stdClass();
            $kids_activities = implode(",", $this->input->post('kids_activities[]', TRUE));
            $object->activities_cost = $this->input->post('activities_cost', TRUE);
            $object->kids_activities = $kids_activities;

            $key = 'kids-activities-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function kidsCommunicateInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Do you communicate with your kids teacher(s)?');
            Smart::setDescription('Do you communicate with your kids teacher(s)?');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'kids-communicate-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/kids_communicate', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function kidsCommunicateInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_kids_communicate'));
        

        $this->form_validation->set_rules('communicate_with_teacher', '', 'trim|required', $error);

        if ($this->form_validation->run() == FALSE) {
            $this->kidsCommunicateInfoPage();
        } else {

            $object = new stdClass();
            $object->communicate_with_teacher = $this->input->post('communicate_with_teacher', TRUE);
            $key = 'kids-communicate-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function kidsDinnerInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('How many days per week do you make your kids dinner?');
            Smart::setDescription('How many days per week do you make your kids dinner?');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'kids-dinner-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/kids_dinner', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function kidsDinnerInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_kids_dinner'));
        

        $this->form_validation->set_rules('days_kids_meal', '', 'trim|required', $error);

        if ($this->form_validation->run() == FALSE) {
            $this->kidsDinnerInfoPage();
        } else {

            $object = new stdClass();
            $object->days_kids_meal = $this->input->post('days_kids_meal', TRUE);
            $key = 'kids-dinner-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function kidsHomeWorkInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('How many days per week do you helps kids with homework?');
            Smart::setDescription('How many days per week do you helps kids with homework?');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'kids-homework-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/kids_homework', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function kidsHomeWorkInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_kids_homework'));
        

        $this->form_validation->set_rules('days_kids_help', '', 'trim|required', $error);

        if ($this->form_validation->run() == FALSE) {
            $this->kidsHomeWorkInfoPage();
        } else {

            $object = new stdClass();
            $object->days_kids_help = $this->input->post('days_kids_help', TRUE);
            $key = 'kids-homework-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function kidsDoctorInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('In the past 12 months, have you taken the kids to a doctor?');
            Smart::setDescription('In the past 12 months, have you taken the kids to a doctor?');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'kids-doctor-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/kids_doctor', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function kidsDoctorInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_kids_doctor'));
        

        $this->form_validation->set_rules('days_kids_doctor', '', 'trim|required', $error);

        if ($this->form_validation->run() == FALSE) {
            $this->otherKidsInfoPage();
        } else {

            $object = new stdClass();
            $object->days_kids_doctor = $this->input->post('days_kids_doctor', TRUE);
            $key = 'kids-doctor-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function kidsHelpComplaintInfoPage() {

        $this->redirectUnAuthorized();
        
        if ((int) $this->session->appId > 0) {
            $application = $this->model->getApplicationById($this->session->appId);
            if((int)$application->num_kids <= 0){
                redirect(base_url('kids-basic-info'));
            }
            
            Smart::setTitle('Has your partner/spouse complained that you don\'t do enough to help with the children?');
            Smart::setDescription('Has your partner/spouse complained that you don\'t do enough to help with the children?');
            Smart::setKeywords('');

            
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'spouse-complaint-help';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/kids_help_complaint', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function kidsHelpComplaintInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_kids_help'));
        
        $this->form_validation->set_rules('s_complained_help', '', 'trim|required', $error);

        if ($this->form_validation->run() == FALSE) {
            $this->kidsHelpComplaintInfoPage();
        } else {

            $object = new stdClass();
            $object->days_kids_doctor = $this->input->post('s_complained_help', TRUE);
            $key = 'spouse-complaint-help';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function spouseInfoPage() {

        $this->redirectUnAuthorized();
        if ($this->session->userdata("hdr_middle_report")) {
            
            $this->session->unset_userdata("hdr_middle_report");
        }
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Spouse Information');
            Smart::setDescription('Spouse Information');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            //$data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'spouse-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            
            $data['prev_page'] = $objFlow->prev;
            if((int)$application->relationship_status === 61 || (int)$application->relationship_status === 63){
                $data['prev_page'] = ((int)$application->num_kids <= 0)?'financial-info':$objFlow->prev;
            }
            
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/spouse_info', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function spouseInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_spouseinfo_name'));
        $errorS = array('required' => $this->lang->line('req_spouseinfo_email'));

        $this->form_validation->set_rules('s_first_name', '', 'trim|required', $error);
        $this->form_validation->set_rules('s_email', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->spouseInfoPage();
        } else {

            $object = new stdClass();
            $object->s_first_name = $this->input->post('s_first_name', TRUE);
            $object->s_email = $this->input->post('s_email', TRUE);
            $key = 'spouse-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function spouseJobInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Partner Job Title');
            Smart::setDescription('Partner Job Title');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('jobtitle', TRUE);
            $data['app'] = $application;
            $key = 'spouse-job-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/spouse_job', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function spouseJobInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_spouse_job'));
        

        $this->form_validation->set_rules('s_job_title', '', 'trim|required', $error);
        //$this->form_validation->set_rules('s_email', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->spouseJobInfoPage();
        } else {

            $object = new stdClass();
            $object->s_job_title = $this->input->post('s_job_title', TRUE);
            //$object->s_email = $this->input->post('s_email', TRUE);
            $key = 'spouse-job-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function jobInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Your Job Title');
            Smart::setDescription('Your Job Title');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('jobtitle', TRUE);
            $data['app'] = $application;
            $key = 'job-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/your_job', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function jobInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_job'));
        

        $this->form_validation->set_rules('job_title', '', 'trim|required', $error);
        
        if ($this->form_validation->run() == FALSE) {
            $this->jobInfoPage();
        } else {

            $object = new stdClass();
            $object->job_title = $this->input->post('job_title', TRUE);
            
            $key = 'job-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function busniessTaxInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('personal expenses you receive from your business');
            Smart::setDescription('personal expenses you receive from your business');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            //if not doing business skip this
            if((int)$application->additional_business_info === self::NO){
                $key = 'business-tax-info';
                $objFlow = Smart::getNextPreviousStep($application, $key);
                redirect(base_url($objFlow->next));
                exit;
            }
            
            
            
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'business-tax-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/business_tax_info', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function busniessTaxInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_addincome_expense'));
        $errorS = array('required' => $this->lang->line('req_addincome_percentage'));

        $this->form_validation->set_rules('bus_personal_expense', '', 'trim|required', $error);
        $this->form_validation->set_rules('share_percentage', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->busniessTaxInfoPage();
        } else {

            $object = new stdClass();
            $object->bus_personal_expense = $this->input->post('bus_personal_expense', TRUE);
            $object->share_percentage = $this->input->post('share_percentage', TRUE);
            $key = 'business-tax-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function additionalBusniessInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('personal expenses you receive from your business');
            Smart::setDescription('personal expenses you receive from your business');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'additional-business-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = 'trust-info';
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/additional_business_info', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function additionalBusniessInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_addincome_expense'));
        

        $this->form_validation->set_rules('additional_business_info', '', 'trim|required', $error);
        
        if ($this->form_validation->run() == FALSE) {
            $this->additionalBusniessInfoPage();
        } else {

            $object = new stdClass();
            $object->additional_business_info = $this->input->post('additional_business_info', TRUE);
            $key = 'additional-business-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    
    
    
    
    public function trustInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Trust Information');
            Smart::setDescription('Trust Information');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'trust-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = ((int)$application->additional_business_info === self::NO)?'additional-business-info':$objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/trust_info', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function trustInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_trust_info'));
        

        $this->form_validation->set_rules('trust_setup', '', 'trim|required', $error);
        $this->form_validation->set_rules('trust_income_draw_amount', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->trustInfoPage();
        } else {

            $object = new stdClass();
            $object->trust_setup = $this->input->post('trust_setup', TRUE);
            $object->trust_income_draw_amount = $this->input->post('trust_income_draw_amount', TRUE);
            //$object->share_percentage = $this->input->post('share_percentage', TRUE);
            $key = 'trust-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function shiftWorkInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Shift Work');
            Smart::setDescription('Shift Work');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'shift-work';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/shift_work', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function shiftWorkInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_shiftwork'));
        
        $this->form_validation->set_rules('do_shift_work', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->shiftWorkInfoPage();
        } else {

            $object = new stdClass();
            $object->do_shift_work = $this->input->post('do_shift_work', TRUE);
            //$object->share_percentage = $this->input->post('share_percentage', TRUE);
            $key = 'shift-work';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function nightsWithOutSpousePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Nights without Spouse');
            Smart::setDescription('Nights without spouse');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'nights-without-spouse';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/night_without_s', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function nightsWithOutSpouse() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_nightout'));
        

        $this->form_validation->set_rules('night_without_s', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->nightsWithOutSpousePage();
        } else {

            $object = new stdClass();
            $object->night_without_s = $this->input->post('night_without_s', TRUE);
            //$object->share_percentage = $this->input->post('share_percentage', TRUE);
            $key = 'nights-without-spouse';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function haveDatePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('how many nights per month have you gone out without your partner/spouse');
            Smart::setDescription('how many nights per month have you gone out without your partner/spouse');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'have-date';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/have_date', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function haveDate() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_datenight'));
        
        $this->form_validation->set_rules('have_date', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->haveDatePage();
        } else {

            $object = new stdClass();
            $object->have_date = $this->input->post('have_date', TRUE);
            //$object->share_percentage = $this->input->post('share_percentage', TRUE);
            $key = 'have-date';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function nightsNotHomePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Nights not at home');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'nights-not-home';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/nights_not_home', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function nightsNotHome() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_notcomehome'));
        
        $this->form_validation->set_rules('nights_not_home', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->nightsNotHomePage();
        } else {

            $object = new stdClass();
            $object->nights_not_home = $this->input->post('nights_not_home', TRUE);
            
            $key = 'nights-not-home';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function spouseNightsNotHomePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Spouse night not at home');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'spouse-nights-not-home';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/s_nights_not_home', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function spouseNightsNotHome() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_spouse_nothome'));

        $this->form_validation->set_rules('s_nights_not_home', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->spouseNightsNotHomePage();
        } else {

            $object = new stdClass();
            $object->s_nights_not_home = $this->input->post('s_nights_not_home', TRUE);
            
            $key = 'spouse-nights-not-home';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function nightsWithOutYouPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('How many nights per month has your partner/spouse gone out without you');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'nights-without-you';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/s_nights_without_you', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function nightsWithOutYou() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_spouse_nightout'));
        

        $this->form_validation->set_rules('s_nights_without_you', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->nightsWithOutYouPage();
        } else {

            $object = new stdClass();
            $object->s_nights_not_home = $this->input->post('s_nights_not_home', TRUE);
            
            $key = 'nights-without-you';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function drinksPerWeekPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Drink Information');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'drinks-per-week';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/alcoholic_drinks_per_week', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function drinksPerWeek() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_alcohol'));

        $this->form_validation->set_rules('alcoholic_drinks_per_week', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->drinksPerWeekPage();
        } else {

            $object = new stdClass();
            $object->alcoholic_drinks_per_week = $this->input->post('alcoholic_drinks_per_week', TRUE);
            
            $key = 'drinks-per-week';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    /*   **/
    public function drugsInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Drugs Information');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'drugs-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/have_drugs', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function drugsInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_drugs'));
        
        $this->form_validation->set_rules('have_drugs', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->drugsInfoPage();
        } else {

            $object = new stdClass();
            $object->have_drugs = $this->input->post('have_drugs', TRUE);
            
            $key = 'drugs-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function addictionInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Addiction Information');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'addiction-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/has_addiction_problem', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function addictionInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_addictions'));
        
        $this->form_validation->set_rules('has_addiction_problem', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->addictionInfoPage();
        } else {

            $object = new stdClass();
            $object->has_addiction_problem = $this->input->post('has_addiction_problem', TRUE);
            
            $key = 'addiction-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function hitSpouseInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Spouse abuse');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['list2'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'hit-spouse-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/have_hit_s', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function hitSpouseInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_spousal_abuse'));
        
        $this->form_validation->set_rules('have_hit_s', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->hitSpouseInfoPage();
        } else {

            $object = new stdClass();
            $object->have_hit_s = $this->input->post('have_hit_s', TRUE);
            $key = 'hit-spouse-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            
            $object->status = ((int)$object->have_hit_s === self::YES)?1:0;
            $objFlow->next = ((int)$object->have_hit_s === self::YES)?'suspension':$objFlow->next;

            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function hitKidsInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Child(ren)');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'hit-kids-info';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/has_hit_kids', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function hitKidsInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_child_abuse'));
        
        $this->form_validation->set_rules('has_hit_kids', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->hitKidsInfoPage();
        } else {

            $object = new stdClass();
            $object->has_hit_kids = $this->input->post('has_hit_kids', TRUE);
            
            $key = 'hit-kids-info';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            
            $object->status = ((int)$object->has_hit_kids === self::YES)?1:0;
            $objFlow->next = ((int)$object->has_hit_kids === self::YES)?'suspension':$objFlow->next;
            
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function datingProfileInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Dating profile');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'dating-profile';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/has_dating_profile', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function datingProfileInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_internet_dating'));
        
        $this->form_validation->set_rules('has_dating_profile', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->datingProfileInfoPage();
        } else {

            $object = new stdClass();
            $object->has_dating_profile = $this->input->post('has_dating_profile', TRUE);
            
            $key = 'dating-profile';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function slepOnCouchPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Slept on couch');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'slept-on-couch';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/times_slept_couch', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function slepOnCouch() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_couch_sleeping'));
        
        $this->form_validation->set_rules('times_slept_couch', '', 'trim|required', $error);
        //$this->form_validation->set_rules('share_percentage', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->slepOnCouchPage();
        } else {

            $object = new stdClass();
            $object->times_slept_couch = $this->input->post('times_slept_couch', TRUE);
            
            $key = 'slept-on-couch';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function hasRelationShipPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Relationship');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'has-relationship';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/has_relationship_outside', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function hasRelationShip() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_emotional_relationship'));
        $errorS = array('required' => $this->lang->line('req_spouse_know'));

        $this->form_validation->set_rules('has_relationship_outside', '', 'trim|required', $error);
        $this->form_validation->set_rules('s_know_relationship', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->hasRelationShipPage();
        } else {

            $object = new stdClass();
            $object->s_know_relationship = $this->input->post('s_know_relationship', TRUE);
            $object->has_relationship_outside = $this->input->post('has_relationship_outside', TRUE);
            
            $key = 'has-relationship';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function houseLiensPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('House Liens');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'house-liens';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/liens_on_house', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function houseLiens() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_liens'));
        
        $this->form_validation->set_rules('liens_on_house', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->houseLiensPage();
        } else {

            $object = new stdClass();
            $object->liens_on_house = $this->input->post('liens_on_house', TRUE);
            
            $key = 'house-liens';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function loanInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Family Loan');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            $key = 'loan-money';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/have_loan_money', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function loanInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_family_load'));

        $this->form_validation->set_rules('have_loan_money', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->loanInfoPage();
        } else {

            $object = new stdClass();
            $object->have_loan_money = $this->input->post('have_loan_money', TRUE);
            
            $key = 'loan-money';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function socialClassPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Social Information');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('economic_class');
            $data['app'] = $application;
            $key = 'your-social-class';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/social_class', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function socialClass() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_economicclass'));

        $this->form_validation->set_rules('social_class', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->socialClassPage();
        } else {

            $object = new stdClass();
            $object->social_class = $this->input->post('social_class', TRUE);
            
            $key = 'your-social-class';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function spouseSocialClassPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Spouse social information');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('economic_class');
            $data['app'] = $application;
            $key = 'spouse-social-class';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            $this->load->view('shared/_header');
            $this->load->view('questions/s_social_class', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function spouseSocialClass() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_economicclass_spouse'));

        $this->form_validation->set_rules('s_social_class', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->spouseSocialClassPage();
        } else {

            $object = new stdClass();
            $object->s_social_class = $this->input->post('s_social_class', TRUE);
            
            $key = 'spouse-social-class';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function confideInfoPage() {

        //$this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Questions');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('confide');
            $data['app'] = $application;
            $key = 'confide';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
             $data['show_assessment'] = false;

            $this->load->view('shared/_header');
            $this->load->view('questions/people_confide', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function confideInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_confide'));
        
        $this->form_validation->set_rules('confide', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->confideInfoPage();
        } else {

            $object = new stdClass();
            $confide = $this->input->post('confide', TRUE);
            $object->confide = $confide;
            
            $key = 'confide';
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function influencerInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Questions');
            Smart::setDescription('Start');
            Smart::setKeywords('Start');
            $confide = Smart::arrayOfObjectToArray($this->model->selectTypes('confide'));
            $application = $this->model->getApplicationById($this->session->appId);
            
            $data['list'] = $confide;
            $data['app'] = $application;
            $data['list1'] = $this->model->selectTypes('ask_for_advice');
            $data['influencers'] = $this->model->getAppInfluencers($this->session->appId);
            $key = 'influencer';
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/influencer_info', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function influencerInfo() {

        
        $this->load->library('form_validation');
        $confide = Smart::arrayOfObjectToArray($this->model->selectTypes('confide'));
        $application = $this->model->getApplicationById($this->session->appId);
        $selectedConfide = explode(",", $application->confide);
        foreach ($selectedConfide as $c) {
            $infObj = $confide[$c];
            $error = array('required' => "Please provide first name of your ".$infObj->name);
            $errorEmail = array('required' => "Please provide email address of your ".$infObj->name);
            $this->form_validation->set_rules('first_name_' . $infObj->id, '', 'trim|required', $error);
            $this->form_validation->set_rules('email_' . $infObj->id, '', 'trim|required', $errorEmail);
        }
        //
        //$errorS = array('required' => $this->lang->line('req_decission'));

        
        //$this->form_validation->set_rules('share_percentage', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->influencerInfoPage();
        } else {
            $this->model->deleteInfluencers($this->session->appId);
            
            
            foreach ($selectedConfide as $c) {
                $infObj = $confide[$c];
                
                $obj = new stdClass();
                $obj->first_name = $this->input->post('first_name_'.$infObj->id, TRUE);
                $obj->email = $this->input->post('email_'.$infObj->id, TRUE);
                $obj->can_contact = $this->input->post('can_contact_'.$infObj->id, TRUE);
                
                $obj->when_ask_advice = 0;//$this->input->post('when_ask_advice_'.$infObj->id, TRUE);
                $obj->application_id = $this->session->appId;
                $obj->user_id = $this->currentCustomer->id;
                $obj->added_date = $this->currentDate;
                $obj->relationship = $infObj->id;
                $obj->status = 1;
                
                $this->model->createInfluencers($obj);
            }
            
            $object = new stdClass();
            $object->current_seo_uri = 'life-decision';
            $object->completion_date = $this->currentDate;
            $object->status = 1;
            $this->updateApplication($object, 'results');
            
        }
    }
    
    
    
    public function finishApplicationPage() {
        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Thanks For Fillin the information');
            Smart::setDescription('');
            Smart::setKeywords('');
            
            
            $this->load->view('shared/_header');
            $this->load->view('questions/finish');
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }
    
    
    private function updateApplication($object, $redirect) {
        $appId = (int) $this->session->appId;
        $this->model->updateApplication($object, $appId);
        redirect(base_url($redirect));
    }

    
    
    public function affectionateSalutationPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Affectionate Salutation');
            Smart::setDescription('Affectionate Salutation');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "affectionate-salutation";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/affectionate_salutation', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function affectionateSalutation() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));
        $errorS = array('required' => $this->lang->line('req_gift_value'));

        $this->form_validation->set_rules('affectionate_salutation', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->affectionateSalutationPage();
        } else {

            $object = new stdClass();
            $object->affectionate_salutation = $this->input->post('affectionate_salutation', TRUE);
            
            $key =  "affectionate-salutation";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function inheritedIncomePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Inheritance Information');
            Smart::setDescription('Inheritance Information');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['list2'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            
            $key =  "inherited-income";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/inherited_income', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function inheritedIncome() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));
        $errorS = array('required' => $this->lang->line('req_gift_value'));

        $this->form_validation->set_rules('income_from_inherited_property', '', 'trim|required', $error);
        $this->form_validation->set_rules('income_from_property_excluded_gifter', '', 'trim|required', $errorS);
        if ($this->form_validation->run() == FALSE) {
            $this->inheritedIncomePage();
        } else {

            $object = new stdClass();
            $object->income_from_inherited_property = $this->input->post('income_from_inherited_property', TRUE);
            $object->income_from_property_excluded_gifter = $this->input->post('income_from_property_excluded_gifter', TRUE);
            
            $key =  "inherited-income";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
     public function financialControlPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Financial Control');
            Smart::setDescription('Financial Control');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            
            $key =  "financial-control";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/financial_control', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function financialControl() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('has_money_control', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->financialControlPage();
        } else {

            $object = new stdClass();
            $object->has_money_control = $this->input->post('has_money_control', TRUE);
            
            $key =  "financial-control";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function withheldSexPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Sexual Emotional Abuse');
            Smart::setDescription('Sexual Emotional Abuse');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            
            $key =  "withheld-sex";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/withheld_sex', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function withheldSex() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('have_withheld_sex', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->withheldSexPage();
        } else {

            $object = new stdClass();
            $object->have_withheld_sex = $this->input->post('have_withheld_sex', TRUE);
            
            $key =  "withheld-sex";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function petAbusePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Pet Abuse');
            Smart::setDescription('Pet Abuse');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            
            $key =  "pet-abuse";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/pet_abuse', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function petAbuse() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('killed_pet', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->petAbusePage();
        } else {

            $object = new stdClass();
            $object->killed_pet = $this->input->post('killed_pet', TRUE);
            
            $key =  "pet-abuse";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            
            $object->status = ((int)$object->killed_pet === self::YES)?1:0;
            $objFlow->next = ((int)$object->killed_pet === self::YES)?'suspension':$objFlow->next;
            
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function ethnicBackgroundPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Ethnic Background');
            Smart::setDescription('Ethnic Background');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['list'] = $this->model->selectTypes('bool');
            $data['list2'] = $this->model->selectTypes('bool');
            $data['app'] = $application;
            
            $key =  "ethnic-background";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/ethnic_background', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function ethnicBackground() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('same_ethnic_background', '', 'trim|required', $error);
        $this->form_validation->set_rules('issues_based_ethnicity', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->ethnicBackgroundPage();
        } else {

            $object = new stdClass();
            $object->same_ethnic_background = $this->input->post('same_ethnic_background', TRUE);
            $object->issues_based_ethnicity = $this->input->post('issues_based_ethnicity', TRUE);
            
            $key =  "ethnic-background";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function automobilePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Automobile');
            Smart::setDescription('Automobile');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "automobile";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/automobile', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function automobile() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('automobile', '', 'trim|required', $error);
        $this->form_validation->set_rules('automobile_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->automobilePage();
        } else {

            $object = new stdClass();
            $object->automobile = $this->input->post('automobile', TRUE);
            $object->automobile_spouse = $this->input->post('automobile_spouse', TRUE);
            
            $key =  "automobile";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function otherAutosPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Other Autos');
            Smart::setDescription('Other Autos');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "other-autos";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/other_autos', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function otherAutos() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('other_autos', '', 'trim|required', $error);
        $this->form_validation->set_rules('other_autos_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->otherAutosPage();
        } else {

            $object = new stdClass();
            $object->other_autos = $this->input->post('other_autos', TRUE);
            $object->other_autos_spouse = $this->input->post('other_autos_spouse', TRUE);
            
            $key =  "other-autos";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function collectablesPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Collectables');
            Smart::setDescription('Collectables');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "collectables";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/collectables', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function collectables() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('collectables', '', 'trim|required', $error);
        $this->form_validation->set_rules('collectables_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->collectablesPage();
        } else {

            $object = new stdClass();
            $object->collectables = $this->input->post('collectables', TRUE);
            $object->collectables_spouse = $this->input->post('collectables_spouse', TRUE);
            
            $key =  "collectables";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function gadgetsPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Gadgets');
            Smart::setDescription('Gadgets');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "gadgets";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/gadgets', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function gadgets() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('gadgets', '', 'trim|required', $error);
        $this->form_validation->set_rules('gadgets_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->gadgetsPage();
        } else {

            $object = new stdClass();
            $object->gadgets = $this->input->post('gadgets', TRUE);
            $object->gadgets_spouse = $this->input->post('gadgets_spouse', TRUE);
            
            $key =  "gadgets";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function bankAccountsPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Bank Accounts');
            Smart::setDescription('Bank Accounts');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "bank-accounts";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/bank_accounts', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function bankAccounts() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('bank_accounts', '', 'trim|required', $error);
        $this->form_validation->set_rules('bank_accounts_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->bankAccountsPage();
        } else {

            $object = new stdClass();
            $object->bank_accounts = $this->input->post('bank_accounts', TRUE);
            $object->bank_accounts_spouse = $this->input->post('bank_accounts_spouse', TRUE);
            
            $key =  "bank-accounts";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function cryptoCurrenciesPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Crypto Currencies');
            Smart::setDescription('Crypto Currencies');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "crypto-currencies";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/crypto_currencies', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function cryptoCurrencies() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('crypto_currencies', '', 'trim|required', $error);
        $this->form_validation->set_rules('crypto_currencies', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->cryptoCurrenciesPage();
        } else {

            $object = new stdClass();
            $object->crypto_currencies = $this->input->post('crypto_currencies', TRUE);
            $object->crypto_currencies_spouse = $this->input->post('crypto_currencies_spouse', TRUE);
            
            $key =  "crypto-currencies";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function moneyowedtoYouPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Money owed to you');
            Smart::setDescription('Money owed to you');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "money-owed-to-you";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/money_owed_you', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function moneyowedtoYou() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('money_owed_to_you', '', 'trim|required', $error);
        $this->form_validation->set_rules('money_owed_to_you_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->moneyowedtoYouPage();
        } else {

            $object = new stdClass();
            $object->money_owed_to_you = $this->input->post('money_owed_to_you', TRUE);
            $object->money_owed_to_you_spouse = $this->input->post('money_owed_to_you_spouse', TRUE);
            
            $key =  "money-owed-to-you";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function investmentsStocksPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Investments Stocks');
            Smart::setDescription('Investments Stocks');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "investments-stocks";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/investments_stocks', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function investmentsStocks() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('investments_stocks', '', 'trim|required', $error);
        $this->form_validation->set_rules('investments_stocks_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->investmentsStocksPage();
        } else {

            $object = new stdClass();
            $object->investments_stocks = $this->input->post('investments_stocks', TRUE);
            $object->investments_stocks_spouse = $this->input->post('investments_stocks_spouse', TRUE);
            
            $key =  "investments-stocks";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function businessvalueAssetsPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Business Value Assets');
            Smart::setDescription('Business Value Assets');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "business-value-assets";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/business_value_assets', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function businessvalueAssets() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('business_value_assets', '', 'trim|required', $error);
        $this->form_validation->set_rules('business_value_assets_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->businessvalueAssetsPage();
        } else {

            $object = new stdClass();
            $object->business_value_assets = $this->input->post('business_value_assets', TRUE);
            $object->business_value_assets_spouse = $this->input->post('business_value_assets_spouse', TRUE);
            
            $key =  "business-value-assets";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function disabilityInsurancePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Disability Insurance');
            Smart::setDescription('Disability Insurance');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "disability-insurance";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/disability_insurance', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function disabilityInsurance() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('disability_insurance', '', 'trim|required', $error);
        $this->form_validation->set_rules('disability_insurance_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->disabilityInsurancePage();
        } else {

            $object = new stdClass();
            $object->disability_insurance = $this->input->post('disability_insurance', TRUE);
            $object->disability_insurance_spouse = $this->input->post('disability_insurance_spouse', TRUE);
            
            $key =  "disability-insurance";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function personalLoansPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Personal Loans');
            Smart::setDescription('Personal Loans');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "personal-loans";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/personal_loans', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function personalLoans() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('personal_loans', '', 'trim|required', $error);
        $this->form_validation->set_rules('personal_loans_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->personalLoansPage();
        } else {

            $object = new stdClass();
            $object->personal_loans = $this->input->post('personal_loans', TRUE);
            $object->personal_loans_spouse = $this->input->post('personal_loans_spouse', TRUE);
            
            $key =  "personal-loans";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function personalcreditLinePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Personal Credit Line');
            Smart::setDescription('Personal Credit Line');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "personal-credit-line";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/personal_credit_line', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function personalcreditLine() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('personal_credit_lines', '', 'trim|required', $error);
        $this->form_validation->set_rules('personal_credit_lines_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->personalcreditLinePage();
        } else {

            $object = new stdClass();
            $object->personal_credit_lines = $this->input->post('personal_credit_lines', TRUE);
            $object->personal_credit_lines_spouse = $this->input->post('personal_credit_lines_spouse', TRUE);
            
            $key =  "personal-credit-line";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function creditCardsPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Credit Cards');
            Smart::setDescription('Credit Cards');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "credit-cards";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/credit_cards', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function creditCards() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('credit_cards', '', 'trim|required', $error);
        $this->form_validation->set_rules('credit_cards_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->creditCardsPage();
        } else {

            $object = new stdClass();
            $object->credit_cards = $this->input->post('credit_cards', TRUE);
            $object->credit_cards_spouse = $this->input->post('credit_cards_spouse', TRUE);
            
            $key =  "credit-cards";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function otherDebtPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Other Debt');
            Smart::setDescription('Other Debt');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "other-debt";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/other_debt', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function otherDebt() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('other_debt', '', 'trim|required', $error);
        $this->form_validation->set_rules('other_debt_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->otherDebtPage();
        } else {

            $object = new stdClass();
            $object->other_debt = $this->input->post('other_debt', TRUE);
            $object->other_debt_spouse = $this->input->post('other_debt_spouse', TRUE);
            
            $key =  "other-debt";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function businesscreditLinePage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Business Credit Line');
            Smart::setDescription('Business Credit Line');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "business-credit-line";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/business_credit_line', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function businesscreditLine() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('business_credit_line', '', 'trim|required', $error);
        $this->form_validation->set_rules('business_credit_line_spouse', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->businesscreditLinePage();
        } else {

            $object = new stdClass();
            $object->business_credit_line = $this->input->post('business_credit_line', TRUE);
            $object->business_credit_line_spouse = $this->input->post('business_credit_line_spouse', TRUE);
            
            $key =  "business-credit-line";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function assetsInfoPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Business Credit Line');
            Smart::setDescription('Business Credit Line');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "assets-info";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/assets_info', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function assetsInfo() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('num_properties', '', 'trim|required', $error);
        
        if ($this->form_validation->run() == FALSE) {
            $this->assetsInfoPage();
        } else {

            $object = new stdClass();
            $object->num_properties = (int)$this->input->post('num_properties', TRUE);            
            $key =  "assets-info";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function assetsDetailsPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Business Credit Line');
            Smart::setDescription('Business Credit Line');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            $data['titles'] = $this->model->selectTypes('property_title');
            $data['types'] = $this->model->selectTypes('property_type');
            $data['inhretance'] = $this->model->selectTypes('property_inhretance');
            $data['list'] = $this->model->selectTypes('bool');
            $data['properties'] = $this->model->getAppProperties($this->session->appId);
            
            $key =  "asset-details-info";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            if((int)$application->num_properties <= 0){
                redirect(base_url($objFlow->next));
            }
            $this->load->view('shared/_header');
            $this->load->view('questions/assets_details', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function assetsDetails() {

        $this->load->library('form_validation');
        $application = $this->model->getApplicationById($this->session->appId);
        $error = array('required' => "Property Title is required");
        for ($i = 0; $i < $application->num_properties; $i++) {
            $this->form_validation->set_rules('property_title_' . $i, '', 'trim|required', $error);
        }
        if ($this->form_validation->run() == FALSE) {
            $this->assetsDetailsPage();
        } else {

            $this->model->deleteProperties($this->session->appId);
            for ($i = 0; $i < $application->num_properties; $i++) {
                $property = new stdClass();
                $property->property_title = $this->input->post('property_title_'.$i, TRUE);
                $property->property_type = $this->input->post('property_type_'.$i, TRUE);
                $property->application_id = $this->session->appId;
                $property->property_value = $this->input->post('property_value_'.$i, TRUE);
                $property->property_liens = $this->input->post('property_liens_'.$i, TRUE);
                $property->is_inherited = $this->input->post('is_inherited_'.$i, TRUE);
                $property->inheritance_converted = $this->input->post('inheritance_converted_'.$i, TRUE);
                $this->model->createProperties($property);
            }
            
            $object = new stdClass();
            $key =  "asset-details-info";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function numGiftsPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Business Credit Line');
            Smart::setDescription('Business Credit Line');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            $key =  "num-gifts";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/gifts_info', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function numGifts() {

        $this->load->library('form_validation');
        $error = array('required' => $this->lang->line('req_inheritance'));

        $this->form_validation->set_rules('num_gifts', '', 'trim|required', $error);
        if ($this->form_validation->run() == FALSE) {
            $this->numGiftsPage();
        } else {

            $object = new stdClass();
            $object->num_gifts = (int)$this->input->post('num_gifts', TRUE);
            $key =  "num-gifts";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    public function gistDetailsPage() {

        $this->redirectUnAuthorized();
        if ((int) $this->session->appId > 0) {

            Smart::setTitle('Business Credit Line');
            Smart::setDescription('Business Credit Line');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($this->session->appId);
            $data['app'] = $application;
            
            
            
            $data['inhretance'] = $this->model->selectTypes('property_inhretance');
            $data['list'] = $this->model->selectTypes('bool');
            $data['gifts'] = $this->model->getAppGifs($this->session->appId);
            
            
            
            $key =  "gift-detail-info";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = $objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            if((int)$application->num_gifts <= 0){
                redirect(base_url($objFlow->next));
            }
            
            
            $this->load->view('shared/_header');
            $this->load->view('questions/gift_details', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function gistDetails() {

        $this->load->library('form_validation');
        $application = $this->model->getApplicationById($this->session->appId);
        $error = array('required' => "Gift value is required");
        for ($i = 0; $i < $application->num_gifts; $i++) {
            $this->form_validation->set_rules('value_' . $i, '', 'trim|required', $error);
        }
        if ($this->form_validation->run() == FALSE) {
            $this->gistDetailsPage();
        } else {

            $this->model->deleteGifts($this->session->appId);
            for ($i = 0; $i < $application->num_gifts; $i++) {
                $gift = new stdClass();
                $gift->value = $this->input->post('value_'.$i, TRUE);
                $gift->is_converted = $this->input->post('is_converted_'.$i, TRUE);
                $gift->application_id = $this->session->appId;
                $gift->has_proof = $this->input->post('has_proof_'.$i, TRUE);
                $this->model->createGifts($gift);
            }
            
            
            $object = new stdClass();
            
            $key =  "gift-detail-info";
            $application = $this->model->getApplicationById($this->session->appId);
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $object->current_seo_uri = $objFlow->next;
            $this->updateApplication($object, $objFlow->next);
        }
    }
    
    public function riskReportPage($id=0) {
        //$this->redirectUnAuthorized();
        $appId = ((int)$id > 0)?$id:(int)$this->session->appId;
        if ($appId > 0) {

            Smart::setTitle('Risk Report');
            Smart::setDescription('Risk Report');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($appId);
            $data['app'] = $application;
            $risk = Smart::calculateRisk($application, $this->model);
            $data['risk'] = $risk;
            $key =  "num-gifts";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;

            if ($this->session->userdata("hdr_middle_report")) {
                
                $data['next_page'] = $application->current_seo_uri;
            }

     
            $this->load->view('shared/_header');
            $this->load->view('questions/risk_report', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }
    
    public function saveAndExitPage() {
        if($this->isAuthorized() === TRUE){
            redirect(base_url('life-decision'));
            exit;
        }

        if (!isset($id)) {
            
            $id = 0;
        }

        $appId = ((int)$id > 0)?$id:(int)$this->session->appId;


        if ($appId > 0) {

            Smart::setTitle('Save and Exit');
            Smart::setDescription('Save and Exit');
            Smart::setKeywords('');

            $application = $this->model->getApplicationById($appId);
            $data['app'] = $application;
            $risk = Smart::calculateRisk($application, $this->model);
            $data['risk'] = $risk;
            $key =  "num-gifts";
            $objFlow = Smart::getNextPreviousStep($application, $key);
            $data['next_page'] = "";//$objFlow->next;
            $data['show_assessment'] = TRUE;
            $data['prev_page'] = $objFlow->prev;
            $data['percentage'] = $objFlow->percentage;
            
            $this->load->view('shared/_header');
            $this->load->view('questions/save_exit', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('life-decision'));
        }
    }

    public function contactUsPage()
    {
         if($this->isAuthorized() === TRUE){
            redirect(base_url('life-decision'));
            exit;
        }
        $this->load->view('shared/_header');
        $this->load->view('questions/contact_us', $data);
        $this->load->view('shared/_footer');
    }

    public function suspensionPage() {
        $this->redirectUnAuthorized();
        $this->session->appId  = NULL;
        Smart::setTitle('Alerting Suspension of use of this application');
        Smart::setDescription('');
        Smart::setKeywords('');


        $this->load->view('shared/_header');
        $this->load->view('questions/suspension');
        $this->load->view('shared/_footer');
        
    }
    
}
