<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyAccountModel
 *
 * @author Saqib Ahmad
 */
class MyAccountModel extends Pixel_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function countUsers($object){
        
        $this->database->select("COUNT(id) as cnt")
        ->from('users')
        ->where_in('role_id', array(Constants::$ADMIN, Constants::$LAWYER, Constants::$FINANCIALADVISOR, Constants::$ENDUSER));
        
        if (strlen($object->user) > 1) {
            $this->database->group_start();
            $this->database->like('first_name', $this->database->escape_str($object->user));
            $this->database->or_like('last_name', $this->database->escape_str($object->user));
            $this->database->or_like('email', $this->database->escape_str($object->user));
            $this->database->group_end();
        }
        if((int)$object->parent_id > 0){
            $this->database->where('parent_id', $object->parent_id);
        }
        
        $query = $this->database->get();
        return (int)$query->row(0)->cnt;       
    }
    public function getUsersList($object) {
        $this->database->limit($this->limit, $this->start);
        $this->database->select("*, "
                . "(select name from roles where roles.id=users.role_id) AS role")
                ->from('users')
                ->where_in('role_id', array(Constants::$ADMIN, Constants::$LAWYER, Constants::$FINANCIALADVISOR, Constants::$ENDUSER));
        if (strlen($object->user) > 1) {
            $this->database->group_start();
            $this->database->like('first_name', $this->database->escape_str($object->user));
            $this->database->or_like('last_name', $this->database->escape_str($object->user));
            $this->database->or_like('email', $this->database->escape_str($object->user));
            $this->database->group_end();
        }
        if((int)$object->parent_id > 0){
            $this->database->where('parent_id', $object->parent_id);
        }
        //$sort = $object->sort;
        //$this->sortRoutine($sort);

        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }
    public function getRoleList() {
        
        $this->database->select("*")
                ->from('roles')
                ->where_in('id', array(Constants::$ADMIN, Constants::$LAWYER, Constants::$FINANCIALADVISOR, Constants::$ENDUSER));
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }
    public function getUserById($id) {
        $this->database->select("*")
                ->from('users')
                ->where('id', $id);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->row(0);
        }
        return NULL;
    }
    public function updateUser($object) {
        $tempid = $object->aid;
        unset($object->aid);
        $this->database->where('id', $tempid);
        $this->database->update('users', $object);
    }
    
    public function addInstitution($object) {
        $this->database->insert('institutions', $object);
    }
    public function updateInstitution($object) {
        $tempid = $object->aid;
        unset($object->aid);
        $this->database->where('id', $tempid);
        $this->database->update('institutions', $object);
    }
    public function getInstituteById($id) {
        $this->database->select("*")
                ->from('institutions')
                ->where('id', $id);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->row(0);
        }
        return NULL;
    }
    public function countInstitutes($object){
        
        $this->database->select("COUNT(id) as cnt")
        ->from('institutions');
        
        if (strlen($object->name) > 1) {
            $this->database->like('name', $this->database->escape_str($object->name));
        }
        $query = $this->database->get();
        return (int)$query->row(0)->cnt;       
    }
    public function getInstitutesList($object) {
        $this->database->limit($this->limit, $this->start);
        $this->database->select("*")
                ->from('institutions');
        if (strlen($object->name) > 1) {
            $this->database->like('name', $this->database->escape_str($object->name));
        }
        //$sort = $object->sort;
        //$this->sortRoutine($sort);

        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }
    
    public function getApplicationList($userId) {
        
        $this->database->select("a.*, l.name")
                ->from('applications a')
                ->join('select_types l', 'a.decision_id=l.id')
                ->where('a.user_id', $userId);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }
    public function getApplicationById($userId, $id) {
        $this->database->select("*")
                ->from('applications')
                ->where('id', $id)
                ->where('user_id', $userId);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->row(0);
        }
        return NULL;
    }
    
    public function getApplicationBySession($sid, $id) {
        $this->database->select("*")
                ->from('applications')
                ->where('id', $id)
                ->where('session_id', $sid);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->row(0);
        }
        return NULL;
    }
    
    /*Questions*/
    public function countQuestions($object){
        
        $this->database->select("COUNT(id) as cnt")
        ->from('questions')
        ->where('status', 1);
        
        if (strlen($object->question) > 1) {
            $this->database->group_start();
            $this->database->like('question', $this->database->escape_str($object->question));
            $this->database->group_end();
        }
        $query = $this->database->get();
        return (int)$query->row(0)->cnt;       
    }
    public function getQuestionList($object) {
        $this->database->limit($this->limit, $this->start);
        $this->database->select("*")
                ->from('questions')
                ->where('status', 1);
        if (strlen($object->question) > 1) {
            $this->database->group_start();
            $this->database->like('question', $this->database->escape_str($object->question));
            $this->database->group_end();
        }
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }
    public function getQuestionById($id) {
        
        $this->database->select("*")
                ->from('questions')
                ->where('status', 1)
                ->where('id', $id);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->row(0);
        }
        return NULL;
    }
    public function updateQuestion($object) {
        $tempid = $object->id;
        unset($object->id);
        $this->database->where('id', $tempid);
        $this->database->update('questions', $object);
    }
    public function updateSelectTypeOrder($id, $value) {
        $this->database->where('id', $id);
        $this->database->update('select_types', array('display_order'=>$value));
    }
}
