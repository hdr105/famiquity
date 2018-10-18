<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionsModel
 *
 * @author Saqib Ahmad
 */
class QuestionsModel extends Pixel_Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function getLabels() {
        $this->database->select("*")
                ->from('questions')
                ->where('status', 1);
        $query = $this->database->get();
        $labels = [];
        if ((int) $query->num_rows() > 0) {
            $rows = $query->result();
            foreach ($rows as $row) {
                $labels[$row->col_name] = $row->question;
            }
        }
        return $labels;
    }
    public function getApplicationById($id) {
        $this->database->select("*")
                ->from('applications')
                ->where('id', $id);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->row(0);
        }
        return NULL;
    }
    
    public function getUserOpenApplication($user_id) {
        $this->database->limit(1);
        $this->database->select("*")
                ->from('applications')
                ->where('user_id', $user_id)
                ->where('status','0');
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->row(0);
        }
        return NULL;
    }
    public function getAppKids($app_id) {
        $this->database->select("*")
                ->from('children')
                ->where('application_id', $app_id);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }
    public function getAppInfluencers($app_id) {
        $this->database->select("*")
                ->from('influencers')
                ->where('application_id', $app_id);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            $rows = $query->result();
            $out = [];
            foreach ($rows as $row) {
                $out[$row->relationship] = $row;
            }
            return $out;
        }
        return NULL;
    }
    public function getAppGifs($app_id) {
        $this->database->select("*")
                ->from('application_gifts')
                ->where('application_id', $app_id);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }
    public function getAppProperties($app_id) {
        $this->database->select("*")
                ->from('application_properties')
                ->where('application_id', $app_id);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }
    
    public function deleteProperties($id) {
        $this->database->delete('application_properties', array('application_id' => $id));
    }
    public function createProperties($object) {
        $this->database->insert('application_properties', $object);
        return $this->database->insert_id();
    }
    
    public function deleteGifts($id) {
        $this->database->delete('application_gifts', array('application_id' => $id));
    }
    public function createGifts($object) {
        $this->database->insert('application_gifts', $object);
        return $this->database->insert_id();
    }
    
    
    public function deleteInfluencers($id) {
        $this->database->delete('influencers', array('application_id' => $id));
    }
    public function createInfluencers($object) {
        $this->database->insert('influencers', $object);
        return $this->database->insert_id();
    }
    public function createApplication($object) {
        
        $this->database->insert('applications', $object);
        return $this->database->insert_id();
    }
    
    public function deleteKids($id) {
        $this->database->delete('children', array('application_id' => $id));
    }
    public function createKids($object) {
        $this->database->insert('children', $object);
        return $this->database->insert_id();
    }
    
    public function updateApplication($object, $id) {
        $this->database->where('id', $id);
        $this->database->update('applications', $object);
    }
    
    public function updateTempApplication($user_id, $sid) {
        $this->database->where('session_id', $sid)
                ->where('user_id', 0);
        $this->database->update('applications', array("user_id"=>$user_id));
        return $this->getApplicationBySession($sid);
    }
    public function numSessionApps($sid) {
        $this->database->select('count(id) as num')
                ->from('applications')
                ->where('session_id', $sid);

        $nRecords = $this->database->get();
        $nRow = $nRecords->row(0);
        return $nRow->num;
    }
    public function getApplicationBySession($sid) {
        $this->database->limit(1);
        $this->database->select("*")
                ->from('applications')
                ->where('session_id', $sid);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->row(0);
        }
        return NULL;
    }
}
