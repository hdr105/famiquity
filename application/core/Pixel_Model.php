<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 Base Pixel Model
 */

/**
 * Description of Pixel_model
 *
 * @author saqib
 */
class Pixel_Model extends CI_Model {

    protected $database, $limit, $start, $currentDate;

    public function __construct() {
        parent::__construct();
        $this->database = $this->load->database('yacopo', TRUE);
        $now = new DateTime();
        $this->currentDate = $now->format('Y-m-d H:i:s');
    }

    public function getLimit() {
        return $this->limit;
    }

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    public function getStart() {
        return $this->start;
    }

    public function setStart($start) {
        $this->start = $start;
    }

    public function create($table, $object) {

        if ($this->database->insert($table, (array) $object)) {
            return TRUE;
        }
        return FALSE;
    }

    public function update($table, $object) {
        $this->database->update($table, (array) $object);
        return $this->database->affected_rows();
    }

    public function findById($table, $fields = "*") {
        $this->database->select($fields)
                ->from($table);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->row(0);
        }
        return NULL;
    }

    public function select($table, $fields = "*") {
        $this->database->select($fields)
                ->from($table);
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function getRoles() {
        $this->database->where('status', 1)
                ->order_by('name');
        return $this->select('roles', 'id, name');
    }

    public function getCities() {
        $this->database->where('status', 1)
                ->order_by('name');
        return $this->select('cities', 'id, name');
    }

    public function getLookupList($table) {
        $this->database->where('status', 1)
                ->order_by('name');
        return $this->select($table, 'id, name');
    }

    public function addActivityLog($activity, $key, $applicant_id) {
        $obj = new stdClass();
        $obj->activity = $activity;
        $obj->module = $key;
        $obj->created_on = $this->currentDate;
        $obj->deleted = 0;
        $obj->applicant_id = $applicant_id;
        $obj->ip = Smart::getSanitizedIP();
        $obj->session_id = session_id();

        if ($this->database->insert('activities', (array) $obj)) {
            return TRUE;
        }
        return FALSE;
    }

    public function hasActivity($id, $key, $min) {
        $where = "applicant_id='$id' and module='" . $key . "' and TIMESTAMPDIFF(MINUTE,created_on,NOW()) <= " . $min;

        $this->database->select('id')
                ->from('activities')
                ->where($where)
                ->order_by("id", "desc");
        $this->database->limit(1);

        $records = $this->database->get();
        if ($records->num_rows() > 0) {
            return 1;
        }
        return 0;
    }

    public function numActivity($key, $min, $id = 0) {
        $where = "module='" . $key . "' and TIMESTAMPDIFF(MINUTE,created_on,NOW()) <= " . $min;
        $where .= ((int) $id > 0) ? " and applicant_id='$id'" : "";

        $this->database->select('count(id) as num')
                ->from('activities')
                ->where($where);

        $nRecords = $this->database->get();
        $nRow = $nRecords->row(0);
        return $nRow->num;
    }

    /**
     * get User Activity Logs by Ip
     * 
     * Get num rows for a given ip address between a specific time period
     * 
     * @param string    $ip ip address
     * @param string    $key Tag to compair
     * @param int    $min minutes
     * @param int    customer id
     * 
     * @return int
     */
    public function hasIPActivity($ip, $key, $min, $id = 0) {
        $where = "ip ='" . $ip . "' and module='" . $key . "' and TIMESTAMPDIFF(MINUTE,created_on,NOW()) <= " . $min;
        $where .= ((int) $id > 0) ? " and applicant_id='$id'" : "";

        $this->database->select('count(id) as num')
                ->from('activities')
                ->where($where);

        $nRecords = $this->database->get();
        $nRow = $nRecords->row(0);
        return $nRow->num;
    }

    /**
     * get User Activity Logs by session
     * 
     * get num rows for a 
     * given session between a specific time period
     * 
     * @param string    $sid session i
     * @param string    $key Tag to compair
     * @param int    $min minutes
     * @param int    customer id
     * 
     * @return int
     */
    public function hasSessionActivity($sid, $key, $min, $id = 0) {
        $where = "session_id ='" . $sid . "' and module='" . $key . "' and TIMESTAMPDIFF(MINUTE,created_on,NOW()) <= " . $min;
        $where .= ((int) $id > 0) ? " and applicant_id='$id'" : "";

        $this->database->select('count(id) as num')
                ->from('activities')
                ->where($where);

        $nRecords = $this->database->get();
        $nRow = $nRecords->row(0);
        return $nRow->num;
    }

    /**
     * get customer by email
     * 
     * get customer object by given email
     * 
     * @param string    $email Email address
     * 
     * @return object
     */
    public function objectFromEmail($email) {
        $this->database->select('id, role_id, email, first_name, last_name, active, language')
                ->from('users')
                ->where('email', $this->database->escape_str($email));

        $records = $this->database->get();
        if ($records->num_rows() > 0) {
            $obj = $records->row(0);
            return $obj;
        }
        return NULL;
    }

    /**
     * get customer by Id
     * 
     * Get customer object by given customer id
     * 
     * @param int    $id Customer Id
     * 
     * @return object
     */
    public function objectFromId($id) {
        $this->database->select('id, role_id, email, first_name, last_name, active, language, activate_hash')
                ->from('users')
                ->where('id', $this->database->escape_str($id));

        $records = $this->database->get();
        if ($records->num_rows() > 0) {
            $obj = $records->row(0);
            return $obj;
        }
        return NULL;
    }

    /**
     * Check Subscription
     *
     * Called to check subscription status
     *
     * @param string
     * 
     * @return object
     */
    public function checkSubscription($email) {
        $this->database->select('*')
                ->from('subscriptions')
                ->where('email', $email);
        $records = $this->database->get();
        if ($records->num_rows() > 0) {
            return $records->row(0);
        }
        return NULL;
    }

    /**
     * Add Subscription
     * 
     * Insert subscription
     * 
     * @param object    Subscription class object
     * 
     * @return void
     */
    public function subcribeCustomer($obj) {

        $this->database->insert('subscriptions', (array) $obj);
        $this->addActivityLog("Subscription has been added for: " . $obj->email, "SUBSCRIBE", $obj->applicant_id);
    }

    /**
     * Update Subscription
     * 
     * called to update subscriptions
     * 
     * @param object    Subscription class object
     * 
     * @return void
     */
    public function updateSubcribeCustomer($obj) {
        $this->database->where('id', $obj->id);
        unset($obj->id, $obj->email);
        $this->database->update('subscriptions', (array) $obj);
        $activity = ((int) $obj->status > 0) ? $obj->email . " subscribe successfully!" : $obj->email . " unsubscribe successfully!";
        $this->addActivityLog($activity, "SUBSCRIBE", $obj->applicant_id);
    }

    public function addEmailQueue($object) {
        if ($this->database->insert('email_queue', (array) $object)) {
            return TRUE;
        }
        return FALSE;
    }

    public function selectTypes($type, $alpha_order = FALSE) {
        $this->database->select('*')
                ->from('select_types')
                ->where('type', $type)
                ->where('status', 1);
        if($alpha_order === TRUE){
            $this->database->order_by('name');
        }else{
            $this->database->order_by('display_order');
        }
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }
    
    public function selectTypeById($id) {
        $this->database->select('id, name')
                ->from('select_types')
                ->where('id', (int)$id);
        $records = $this->database->get();
        if ($records->num_rows() > 0) {
            return $records->row(0)->name;
        }
        return '';
    }
    
    
    public function selectAppFlow($status, $type=NULL) {
        $this->database->select('uri, ask_payor, ask_receipent, skip_steps, skip_value')
                ->from('questions_flow')
                ->where('status_id', $status)
                ->where('status', Constants::$ENABLE);
        
        if((int)$type > 0){
            //1 for payer and 2 for Receipent
            $col = ((int)$type === 1)?'ask_payor':'ask_receipent';
            $this->database->where($col, Constants::$ENABLE);
        }
        
        $this->database->order_by('display_order');
        $query = $this->database->get();
        if ((int) $query->num_rows() > 0) {
            $rows = $query->result();
            $array = [];
            foreach ($rows as $row) {
                $array[$row->uri] = $row;
            }
            return $array;
        }
        return NULL;
    }

}

?>
