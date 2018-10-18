<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EndUserAccountController
 *
 * @author Saqib Ahmad
 */
class EndUserAccountController extends Pixel_Controller {

    public function applicationListPage() {

        $this->redirectUnAuthorized();


        $this->load->model('myAccountModel', 'model');
        $object = new stdClass();
        /*$object->user = $this->input->get('user', TRUE);
        $count = $this->model->countUsers($object);

        $this->load->library('pagination');
        $pageLimit = Constants::$LIMIT;
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        $this->model->setStart($page);
        $this->model->setLimit($pageLimit);
        $config = Smart::paginationConfig("list-users/", $count, $pageLimit);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();*/
        $data['list'] = $this->model->getApplicationList($this->currentCustomer->id);

        $this->load->view('shared/_header');
        $this->load->view('myaccount/application_list', $data);
        $this->load->view('shared/_footer');
    }
    public function restartApplication($id) {
        $this->load->model('myAccountModel', 'model');
        $object = $this->model->getApplicationById($this->currentCustomer->id, $id);
        if($object !== NULL){
            $this->session->set_userdata(array('appId' => $object->id));
            $this->session->set_userdata(array('numKids' => (int)$object->num_kids));
            redirect(base_url($object->current_seo_uri));
        }else{
            show_404();
        }
    }
    
    public function restartTempApplication($id) {
        $this->load->model('myAccountModel', 'model');
        $object = $this->model->getApplicationById($this->session->session_id, $id);
        if($object !== NULL){

            $this->session->set_userdata(array('appId' => $object->id));
            $this->session->set_userdata(array('numKids' => (int)$object->num_kids));
            redirect(base_url($object->current_seo_uri));
        }else{
            show_404();
        }
    }

}
