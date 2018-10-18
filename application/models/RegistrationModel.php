<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistrationModel
 *
 * @author Saqib Ahmad
 */
class RegistrationModel extends Pixel_Model {

    /**
     * Register Customer
     *
     * Called to register a customer
     *
     * @param object
     * 
     * @return object
     */
    public function registerCustomer($obj) {
        if (is_object($obj)) {
            $options = ['cost' => 11,];
            $pwd = password_hash($obj->password_hash, PASSWORD_BCRYPT, $options);
            $obj->password_hash = $pwd;
            $obj->created_on = $this->currentDate;
            if ($this->database->insert('users', (array) $obj)) {

                $returnObj = $this->objectFromId($this->database->insert_id());
                return $returnObj;
            }
        }
        return NULL;
    }

    /**
     * Customer Object
     *
     * Called to get customer object from hash
     *
     * @param string
     * 
     * @return object
     */
    public function objectFromHash($hash) {
        $this->database->select('*')
                ->from('users')
                ->where('activate_hash', $hash);
        $records = $this->database->get();
        if ($records->num_rows() > 0) {
            return $records->row(0);
        }
        return NULL;
    }

    /**
     * Register Exists
     *
     * Called to check is customer exists in the database
     *
     * @param string
     * @param int type
     * 
     * @return object
     */
    public function isCustomerExisits($email) {
        $this->database->select('count(email) as rcd')
                ->from('users')
                ->where('email', $email);
        $records = $this->database->get();
        $row = $records->first_row();
        $rtn = $row->rcd;
        return $rtn;
    }

    /**
     * Subscribe Customer
     *
     * Called to subscribe customer
     *
     * @param object
     * 
     * @return void
     */
    public function subcribeCustomer($obj) {
        $this->database->insert('subscriptions', (array) $obj);
        //$customer = $obj->applicant_id;
        //$this->updateCustomerSubscription($customer, $obj->status);
    }

    /**
     * Unpdate Customer Subscription
     *
     * Called to unpdate customer subscription
     *
     * @param object
     * 
     * @return void
     */
    public function updateSubcribeCustomer($obj) {
        $this->database->where('id', $obj->id);
        //$customer = $obj->applicant_id;
        unset($obj->id, $obj->email);
        $this->database->update('subscriptions', (array) $obj);
        //$this->updateCustomerSubscription($customer, $obj->status);
    }

    public function activateUser($email) {
        $this->database->where('email', $email);
        $this->database->update('users', array("active" => Constants::$ENABLE));
    }

    public function updateLastLogin($email) {
        $this->database->where('email', $email);
        $this->database->update('users', array("last_ip" => Smart::getSanitizedIP(), "last_login" => $this->currentDate));
    }
    
    public function completeRegistration($obj) {
        $this->database->where('email', $obj->email);
        $this->database->update('users', $obj);
    }

}
