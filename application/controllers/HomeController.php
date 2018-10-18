<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeController
 *
 * @author Saqib Ahmad
 */
class HomeController extends Pixel_Controller {
    public $labelArray = [];
    public function index() {
        
        $this->load->model('questionsModel', 'model');
        $this->labelArray = $this->model->getLabels();
        $data['decision_list'] = $this->model->selectTypes('decisions');
        $data['profession_list'] = $this->model->selectTypes('profession');
        $this->load->view('shared/_header');
        $this->load->view('home', $data);
        $this->load->view('shared/_footer');
    }

    public function registerPage() {
        $this->load->model('bilalModel', 'model');
        $activityList = $this->model->getActivities(null);
        $data['activityList'] = $activityList;
        $usersList = $this->model->getUsers();
        $data['usersList'] = $usersList;

        $this->load->view('shared/_header');
        $this->load->view('01_register',$data);
        $this->load->view('shared/_footer');
    }

    public function createActivity() {
        //$postobject = $this->input->post(NULL,TRUE);
        //print_r($postobject);
        $object = new stdClass();
        $object->activity = $this->input->post('activity', TRUE);
        $object->module = $this->input->post('module', TRUE);
        $object->deleted = $this->input->post('deleted', TRUE);
        $object->applicant_id = $this->input->post('applicant_id', TRUE);
        $object->ip = $this->input->post('ip', TRUE);
        $object->session_id = $this->input->post('session_id', TRUE);
        $object->company_id = $this->input->post('company_id', TRUE);
        $object->created_on = $this->currentDate;
        //echo $firstname;
        $this->load->model('bilalModel', 'model');
        $newId = $this->model->insertActivity($object);
        if ($newId > 0) {

            echo "Done. Your new ID is = ".$newId;
        } else {

            echo "Sorry Boss";
        }
        
    }

    public function aboutUsPage() {
        $this->load->view('shared/_header');
        $this->load->view('about');
        $this->load->view('shared/_footer');
    }

    public function contactUsPage() {
        $this->load->view('shared/_header');
        $this->load->view('contact');
        $this->load->view('shared/_footer');
    }

    public function advisorsPage() {
        $this->load->view('shared/_header');
        $this->load->view('advisors');
        $this->load->view('shared/_footer');
    }


    public function faqsPage() {
        $this->load->view('shared/_header');
        $this->load->view('faqs');
        $this->load->view('shared/_footer');
    }
    public function faqsLawyerPage() {
        $this->load->view('shared/_header');
        $this->load->view('faq_lawyer');
        $this->load->view('shared/_footer');
    }
    

    public function buyGiftPage() {
        
        $this->load->model('questionsModel', 'model');
        
        $data['buy_for'] = $this->model->selectTypes('buy_for');
        $data['life_decision'] = $this->model->selectTypes('life_decision');
        
        $this->load->view('shared/_header');
        $this->load->view('buy_gift', $data);
        $this->load->view('shared/_footer');
    }


    public function questionnairePreviewPage() {
        $this->load->view('shared/_header');
        $this->load->view('preview');
        $this->load->view('shared/_footer');
    }
    public function solutionSample() {
        
    }
    public function lawyersPage() {
        $this->load->view('shared/_header');
        $this->load->view('lawyers');
        $this->load->view('shared/_footer');
    }

    public function professionsPage() {
        $this->load->view('shared/_header');
        $this->load->view('professions');
        $this->load->view('shared/_footer');
    }
    public function giftsPage() {
        $this->load->view('shared/_header');
        $this->load->view('wedding_gifts');
        $this->load->view('shared/_footer');
    }
    
    public function nine11Page() {
        $this->load->view('shared/_header');
        $this->load->view('911');
        $this->load->view('shared/_footer');
    }
    public function teacherPage() {
        $this->load->view('shared/_header');
        $this->load->view('teacher');
        $this->load->view('shared/_footer');
    }
    public function medicalPage() {
        $this->load->view('shared/_header');
        $this->load->view('medical');
        $this->load->view('shared/_footer');
    }
    public function executivePage() {
        $this->load->view('shared/_header');
        $this->load->view('executive');
        $this->load->view('shared/_footer');
    }
    public function financePage() {
        $this->load->view('shared/_header');
        $this->load->view('finance');
        $this->load->view('shared/_footer');
    }
    public function consultantPage() {
        $this->load->view('shared/_header');
        $this->load->view('consultant');
        $this->load->view('shared/_footer');
    }
}
