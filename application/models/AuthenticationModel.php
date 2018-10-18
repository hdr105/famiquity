<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthenticationModel
 *
 * @author Saqib Ahmad
 */
class AuthenticationModel extends Pixel_Model {
    
    private $username, $password, $data, $applicant_id;
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }
    /**
     * setter for Username
     *
     * Allows caller to set USername.
     *
     * @param	string	$username
     */
    function setUsername($username) {
        $this->username = $username;
    }
    /**
     * setter for password
     *
     * Allows caller to set password.
     *
     * @param	string	$password
     */
    function setPassword($password) {
        $this->password = $password;
    }
    /**
     * Get Authorize Customer
     *
     * Allows caller to get Customer authorization status
     *
     * @param	none
     * 
     * @return object
     */
    public function isAutorized()
    {
        $this->database->select('id, password_hash, role_id, email, first_name, last_name, active, language')
                ->from('users')
                ->where('email',  $this->username)
                ->where('active', Constants::$ENABLE)
                ->where('is_completed', Constants::$ENABLE);
        $records = $this->database->get();
        if($records->num_rows() > 0){
            $row = $records->row(0);
            if($this->verifyPassword($row->password_hash)){
                unset($row->password_hash);
                
                $this->updateLastLogin();
                return $row;
            }
            
        }
        return NULL;
    }
    
    private function verifyPassword($password){
        if(password_verify($this->password, $password)){
            return TRUE;
        }
        return FALSE;
    }
    
    public function updateLastLogin(){
        $this->database->where('email', $this->username);
        $this->database->update('users', array("last_ip"=> Smart::getSanitizedIP(), "last_login"=> $this->currentDate));
    }
    
    
    public function resetPassword($pwd) {
        $options = ['cost' => 11,];
        $pwdHash = password_hash($pwd, PASSWORD_BCRYPT, $options);
        
        $this->database->where('email', $this->username);
        $this->database->update('users', array("password_hash"=>  $pwdHash));
    }
    public function hasPwdRestRequest($id) {
        return $this->hasActivity($id, 'FORGET_PWD', PWD_REST_MIN);
    }
    public function getObjectFromEmail(){
        
        $this->database->select('id, role_id, email, first_name, last_name, active, language')
                ->from('users')
                ->where('email', $this->database->escape_str($this->username));
        
        $records = $this->database->get();
        if($records->num_rows() > 0){
            $obj = $records->row(0);
            return $obj;
        }
        return NULL;
    }
    
    public function getData() {
        return $this->data;
    }
    public function updatePassword($id, $pass) {
        
        $options = ['cost' => 11,];
        $hash = password_hash($pass, PASSWORD_BCRYPT, $options);
        
        $this->database->where('id', $id);
        $this->database->update('users', array("password_hash"=>$hash));
    }
    
    public function updateCustomer($object, $customer_id) {
        $this->database->where('id', $customer_id);
        if($this->database->update('users', (array)$object)){
            return TRUE;      
        }
        return FALSE;
    }
    
    public function updateSubscription($subscribe, $applicant, $metaInfo) {
        
       
        $this->database->select("count(id) as cnt");
        $this->database->from("subscriptions");
        $this->database->where('applicant_id', $applicant->id);
        
        $query = $this->database->get();
        if((int)$query->row(0)->cnt > 0){
            $this->database->where('applicant_id', $applicant->id);
            $this->database->update('subscriptions', array("status"=>(int)$subscribe, "updated_date"=>date('Y-m-d H:i:s'), "meta_info"=>$metaInfo));
            
        }else{
            $object = new stdClass();
            $object->email = $applicant->email;
            $object->applicant_id = $applicant->id;
            $object->status = (int)$subscribe;
            $object->token = str_replace("-", "", strtolower(GUID()));
            $object->created_date = date('Y-m-d H:i:s');
            $object->updated_date = date('Y-m-d H:i:s');
            $object->meta_info = $metaInfo;
            $this->database->insert('subscriptions', (array)$object);
            
        }
        
    }
}
