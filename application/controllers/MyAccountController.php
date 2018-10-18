<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyAccountController
 *
 * @author Saqib Ahmad
 */
class MyAccountController extends Pixel_Controller{
    
    public function usersListPage() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {

            $this->load->model('myAccountModel', 'model');
            $object = new stdClass();
            $object->user = $this->input->get('user', TRUE);
            $count = $this->model->countUsers($object);

            $this->load->library('pagination');
            $pageLimit = Constants::$LIMIT;
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $this->model->setStart($page);
            $this->model->setLimit($pageLimit);
            $config = Smart::paginationConfig("list-users/", $count, $pageLimit);
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
            $data['list'] = $this->model->getUsersList($object);

            $this->load->view('shared/_header');
            $this->load->view('myaccount/users_list', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('sign-in'));
        }
    }
    public function clientListPage() {
        $isFA = $this->isAuthorizedFA();
        if ($isFA === TRUE) {

            $this->load->model('myAccountModel', 'model');
            $object = new stdClass();
            $object->user = $this->input->get('user', TRUE);
            $object->parent_id = $this->currentCustomer->id;
            $count = $this->model->countUsers($object);

            $this->load->library('pagination');
            $pageLimit = Constants::$LIMIT;
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $this->model->setStart($page);
            $this->model->setLimit($pageLimit);
            $config = Smart::paginationConfig("list-users/", $count, $pageLimit);
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
            $data['list'] = $this->model->getUsersList($object);

            $this->load->view('shared/_header');
            $this->load->view('myaccount/client_list', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('sign-in'));
        }
    }
    
    public function editUserPage($id) {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {

            $this->load->model('myAccountModel', 'model');
            $object = $this->model->getUserById((int) $id);
            if ($object !== NULL) {
                $data['roles'] = $this->model->getRoleList();
                $data['obj'] = $object;
                $data['provinces'] = $this->model->selectTypes('state');
                $this->load->view('shared/_header');
                $this->load->view('myaccount/edit_user', $data);
                $this->load->view('shared/_footer');
            } else {
                show_404();
            }
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function updateUser() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $errFName = array('required' => $this->lang->line('req_fname'),
            'min_length' => $this->lang->line('req_fname'),
            'max_length' => $this->lang->line('req_fname'),
            'regex_match' => $this->lang->line('alpha'));

        $errLName = array('required' => $this->lang->line('req_lname'),
            'min_length' => $this->lang->line('req_lname'),
            'max_length' => $this->lang->line('req_lname'),
            'regex_match' => $this->lang->line('alpha'));

        $errEmail = array('required' => $this->lang->line('valid_email'), 'valid_email' => $this->lang->line('valid_email'));

        //$this->form_validation->set_rules('email_address', '', 'required|callback_username_check', $errEmail);
        $this->form_validation->set_rules('first_name', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_ALPHA . ']*$/u]|min_length[1]|max_length[32]', $errFName);
        if ($this->form_validation->run() == FALSE) {
            $this->editAgentPage();
        } else {
            $object = (object) $this->input->post(null, TRUE);

            $this->load->model('myAccountModel', 'model');
            $this->model->updateUser($object);
            redirect(base_url('list-users'));
        }
    }
    
    public function addInstitutePage() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {
        Smart::setTitle('Register');
        Smart::setDescription('Register');
        
        $obj = new stdClass();
        $obj->id = 0;
        $obj->name = Smart::setValue('name');
        $obj->contact_person = Smart::setValue('contact_person');
        $obj->email = Smart::setValue('email');
        $obj->phone = Smart::setValue('phone');
        $obj->fax = Smart::setValue('fax');
        $obj->address = Smart::setValue('address');
        $obj->status = Smart::setValue('status');
        
        
        $data['action'] = 'create-institute';
        $data['obj'] = $obj;
        $data['isEdit'] = FALSE;
        
        $this->load->view('shared/_header');
        $this->load->view('myaccount/add_institute', $data);
        $this->load->view('shared/_footer');
        }else{
            redirect(base_url('sign-in'));
        }
    }
    public function createInstitute() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $errFName = array('required' => $this->lang->line('req_fname'),
            'min_length' => $this->lang->line('req_fname'),
            'max_length' => $this->lang->line('req_fname'),
            'regex_match' => $this->lang->line('alpha'));
        $this->form_validation->set_rules('name', '', 'required|min_length[1]|max_length[150]', $errFName);
        if ($this->form_validation->run() == FALSE) {
            $this->addInstitutePage();
        } else {
            $object = (object) $this->input->post(null, TRUE);
            unset($object->aid);
            $this->load->model('myAccountModel', 'model');
            $this->model->addInstitution($object);
            redirect(base_url('list-institutes'));
        }
        }else{
            redirect(base_url('sign-in'));
        }
    }
    public function instituteListPage() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {

            $this->load->model('myAccountModel', 'model');
            $object = new stdClass();
            $object->name = $this->input->get('name', TRUE);
            $count = $this->model->countInstitutes($object);

            $this->load->library('pagination');
            $pageLimit = Constants::$LIMIT;
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $this->model->setStart($page);
            $this->model->setLimit($pageLimit);
            $config = Smart::paginationConfig("list-institutes/", $count, $pageLimit);
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
            $data['list'] = $this->model->getInstitutesList($object);

            $this->load->view('shared/_header');
            $this->load->view('myaccount/institute_list', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('sign-in'));
        }
    }
    
    public function editInstitutePage($id) {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {

            $this->load->model('myAccountModel', 'model');
            $object = $this->model->getInstituteById((int) $id);
            if ($object !== NULL) {
                
                $data['obj'] = $object;
                $data['action'] = 'update-institute';
                $data['isEdit'] = True;
                
                $this->load->view('shared/_header');
                $this->load->view('myaccount/add_institute', $data);
                $this->load->view('shared/_footer');
            } else {
                show_404();
            }
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function updateInstitute() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $object = (object) $this->input->post(null, TRUE);
        $errFName = array('required' => $this->lang->line('req_fname'),
            'min_length' => $this->lang->line('req_fname'),
            'max_length' => $this->lang->line('req_fname'),
            'regex_match' => $this->lang->line('alpha'));
        $this->form_validation->set_rules('name', '', 'required|min_length[1]|max_length[150]', $errFName);
        if ($this->form_validation->run() == FALSE) {
            $this->editInstitutePage($object->aid);
        } else {
            

            $this->load->model('myAccountModel', 'model');
            $this->model->updateInstitution($object);
            redirect(base_url('list-institutes'));
        }
        }else{
           redirect(base_url('sign-in')); 
        }
    }
    
    
    /*Edit Questions*/
    public function questionListPage() {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {

            $this->load->model('myAccountModel', 'model');
            $object = new stdClass();
            $object->question = $this->input->get('q', TRUE);
            $count = $this->model->countQuestions($object);

            $this->load->library('pagination');
            $pageLimit = 150;
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

            $this->model->setStart($page);
            $this->model->setLimit($pageLimit);
            $config = Smart::paginationConfig("questions-list/", $count, $pageLimit);
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
            $data['list'] = $this->model->getQuestionList($object);

            $this->load->view('shared/_header');
            $this->load->view('myaccount/question_list', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('sign-in'));
        }
    }
    public function editQuestionPage($id) {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {

            $this->load->model('myAccountModel', 'model');
            $object = $this->model->getQuestionById((int) $id);
            if ($object !== NULL) {
                $data['obj'] = $object;
                $this->load->view('shared/_header');
                $this->load->view('myaccount/edit_question', $data);
                $this->load->view('shared/_footer');
            } else {
                show_404();
            }
        } else {
            redirect(base_url('sign-in'));
        }
    }

    public function updateQuestionPage() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $object = (object) $this->input->post(null, TRUE);
        $id = $object->id;
        $errFName = array('required' => "Please provide a valid question between 2-400 character",
            'min_length' => "Please provide a valid question between 2-400 character",
            'max_length' => "Please provide a valid question between 2-400 character",
            'regex_match' => "Please provide a valid question between 2-400 character");
        $this->form_validation->set_rules('question', '', 'required|regex_match[/^[' . Constants::$REGEX_SAFE_NO_TAG . ']*$/u]|min_length[1]|max_length[400]', $errFName);
        if ($this->form_validation->run() == FALSE) {
            $this->editQuestionPage($id);
        } else {
            $this->load->model('myAccountModel', 'model');
            $this->model->updateQuestion($object);
            Smart::setSoftMesssage("Question has been updated.");
            redirect(base_url('questions-list'));
        }
    }
    public function chnageTypeOrdering($type) {
        $isAdmin = $this->isAuthorizedAdmin();
        if ($isAdmin === TRUE) {

            $this->load->model('myAccountModel', 'model');
            
            $data['uri'] = uri_string();
            $data['list'] = $this->model->selectTypes($type);

            $this->load->view('shared/_header');
            $this->load->view('myaccount/change_order', $data);
            $this->load->view('shared/_footer');
        } else {
            redirect(base_url('sign-in'));
        }
    }
    public function updateTypeOrdering() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $object = (object) $this->input->post(null, TRUE);
        $list = $object->ord;
        $this->load->model('myAccountModel', 'model');
        if(count($list)> 0){
            foreach ($list as $p) {
                $id = $p;
                $value =(int)$this->input->post('order_'.$id, TRUE);
                $this->model->updateSelectTypeOrder($id, $value);
                
            }
        }
        redirect(base_url($object->uri));
    }
    
}
