<?php

/*
 * Static Helper Class
 */

class Smart {

    private static $meta_title, $meta_des, $meta_key, $meta_extra, $subnav, $title, $currentIndex, $maxIndex;
    public static $FORGET_PWD_TYPE = 100;
    public static $CHANGE_PWD_TYPE = 101;
    public static $FORGET_EMAIL_DELAY = 15;
    const TIME_SPENT_YOU = 111;
    const TIME_SPENT_PARTNER = 112;
    const TIME_SPENT_EQUAL = 113;
    
    private static $FLOWS = array("58"=>NULL, "59"=>NULL, "60"=>NULL, "61"=>NULL, "62"=>NULL, "63"=>NULL,);
    

    public static function setTitle($str) {
        self::$meta_title = $str;
    }

    public static function setExtra($str) {
        self::$meta_extra = $str;
    }

    public static function setDescription($str) {
        self::$meta_des = $str;
    }

    public static function setKeywords($str) {
        self::$meta_key = $str;
    }

    public static function getTitle() {
        return (empty(self::$meta_title)) ? COMPANY_NAME : self::$meta_title;
    }

    public static function getExtra() {
        return self::$meta_extra;
    }

    public static function getDescription() {
        return (empty(self::$meta_des)) ? COMPANY_NAME : self::$meta_des;
    }

    public static function getKeywords() {
        return (empty(self::$meta_key)) ? COMPANY_NAME : self::$meta_key;
    }

    public static function echoString($str) {
        echo Smart::string($str);
    }

    public static function string($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');






    }

public static function formatDate($date = NULL, $type = "LONG") {
    $date = ($date === NULL) ? time() : strtotime($date);
    switch ($type) {
        case 'SHORT':
            return date('j M, Y', $date);
        default:
            return date('l, F jS, Y', $date);
    }
}

public static function paginationConfig($url, $count, $limit, $segment = 2) {

    $config = array();
    $config["base_url"] = base_url($url);
    $config["total_rows"] = $count;
    //$config['use_page_numbers'] = TRUE;
    $config['num_links'] = 10;
    $config["per_page"] = $limit;
    $config['reuse_query_string'] = TRUE;
    $config['enable_query_strings'] = TRUE;
    $config["uri_segment"] = $segment;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href=#>';
    $config['cur_tag_close'] = '</a></li>';

    return $config;
}

public static function getSanitizedIP($ip = "") {
    $ip = (empty($ip)) ? $_SERVER['REMOTE_ADDR'] : $ip;
    $ip = Smart::sanitizeInput($ip);
    if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
        return $ip;
    }
    return "0.0.0.0";
}

/**
 * Sanitzed Input
 * 
 * This function will return sanitized string,
 * This function will allow most uzed characters including french characters, but dissallow
 * most dangerous chars and sequences
 * 
 * @param string
 * @return string  
 */
public static function sanitizeInput($str) {
    $tags = array("shell_exec", "eval(", "system(", "passthru(", "exec(", "../", "..\\");
    $replacement = array("", "", "", "", "", "[removed]", "[removed]");
    $str = str_replace($tags, $replacement, $str);
    return preg_replace('/[^' . Constants::$REGEX_SAFE_NO_TAG . ']+/i', '[removed]', $str);
}

public static function query($str) {
    $str = str_replace(array("{", "}", "[", "]"), "", $str);
    $pattern = '/[%\'\?:|_]/i';
    $replacement = '\\\$0';
    $output = preg_replace($pattern, $replacement, $str);

    return $output;
}

/**
 * Escape Json
 * 
 * This function will print an escaped json string that is generally XSS safe. 
 * 
 * @param $object Object
 * @return void
 */
public static function echoJson($object) {
    if (is_object($object) || is_array($object)) {
        echo self::json($object);
    } else {
        throw new Exception('input is not either an object or array. ');
    }
}

/**
 * Escape Json
 * 
 * This function will return an HTML escaped json that is generally XSS safe. 
 * 
 * @param $object Object
 * @return String
 */
public static function json($object) {
    if (is_object($object) || is_array($object)) {
        return json_encode($object, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
    }
    throw new Exception('input is not either an object or array. ');
}

public static function generatePassword() {

    $pool[0] = '!@#$*()!@*';
    $pool[1] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = str_replace(array('+', '/', '='), array('a', 'A', ''), base64_encode(mcrypt_create_iv(8, MCRYPT_DEV_URANDOM)));
    $second = intval(date('s'));
    $cap = substr($pool[1], (($second % 26)), 1);
    $special = substr($pool[0], (($second % 10)), 1);

    return str_shuffle($password . $special . $cap);
}

public static function formatCurrency($amount) {
    setlocale(LC_MONETARY, 'en_US');
    return '$' . number_format($amount, 2);
}

/**
 * Sanitzed Input
 * 
 * this function will return sanitized string
 * 
 * @param string


 * @return string
 */
public static function localeDateTime($date = NULL) {
    if ($date === NULL) {
        $localeDate = utf8_encode(strftime('%d %B'));
        $time = date('H:i');
    } else {
        $localeDate = utf8_encode(strftime('%d %B', strtotime($date)));
        $time = date('H:i', strtotime($date));
    }

    return $localeDate . ", " . $time;
}

public static function groupByArray($array, $group_key) {
    $arr = array();
    foreach ($array as $key => $item) {
        $arr[$item->$group_key][$key] = $item;
    }
    asort($arr, SORT_NUMERIC);
    return $arr;
}

public function piviotArray($array) {
    $arr = array();
    foreach ($array as $item) {
        $arr[$item->name]['name'] = $item->name;
        $arr[$item->name][$item->year] = $item->amount;
        $arr[$item->name]['total'] += $item->amount;
    }
    //ksort($arr, SORT_NUMERIC);
    return $arr;
}

public static function loadImages($src) {

    return base_url("assets/images/" . $src);
}

public static function loadJs($src) {

    return base_url("assets/js/" . $src);
}

public static function loadCss($src) {

    return base_url("assets/css/" . $src);
}

public static function loadAsset($src) {

    return base_url("assets/" . $src);
}

public static function makeNavigation($route, $caption) {
    $CI = &get_instance();
    $isActive = ($route == $CI->uri->segment(1)) ? ' class="active"' : '';
    return '<li' . $isActive . '><a href="' . base_url($route) . '">' . $caption . '</a></li>';
}
public static function makeNavigationDivider() {
    return '<li><div class="divider"></div></li>';
}
public static function formErrors() {
    $errors = validation_errors();
    $html = "";
    $ci = &get_instance();
    if (strlen($errors) > 2) {
        $html .= $ci->load->view('shared/_errors', array("errors" => $errors), true);
    }
    return $html;
}

public static function softErrors() {
    $html = "";
    $ci = &get_instance();
    $soft = $ci->session->flashdata('soft_message');

    if (strlen($soft) > 0) {
        $class = $ci->session->flashdata('soft_css');
        $html .= $ci->load->view('shared/_soft_error', array("message" => $soft, "class" => $class), true);
    }

    return $html;
}

public static function validatePassword($candidate) {
    $r1 = '/[A-Z]/';  //Uppercase
    $r2 = '/[a-z]/';  //lowercase
    $r3 = '/[!@#$^*()\-_=+]/';  // whatever you mean by 'special char'
    $r4 = '/[0-9]/';  //numbers
    if (strlen($candidate) < 6) {
        return FALSE;
    }
    if (strlen($candidate) > 16) {
        return FALSE;
    }
    if (preg_match_all($r1, $candidate, $o) < 1) {
        return FALSE;
    }

    if (preg_match_all($r2, $candidate, $o) < 1) {
        return FALSE;
    }

    if (preg_match_all($r4, $candidate, $o) < 1) {
        return FALSE;
    }


    return TRUE;
}

public static function GUID() {
    return bin2hex(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
}

public static function setSoftMesssage($message) {
    $ci = &get_instance();
    $ci->session->set_flashdata('soft_message', $message);
    $ci->session->set_flashdata('soft_css', 'success');
}

public static function setSoftError($message) {
    $ci = &get_instance();
    $ci->session->set_flashdata('soft_message', $message);
    $ci->session->set_flashdata('soft_css', 'danger');
}

public static function getCurrentUser() {
    $ci = &get_instance();
    return $ci->session->userdata('CustomerObject');
}

public static function isAuthorized() {
    $ci = &get_instance();
    if ($ci->session->AppLogin <> TRUE) {
        return FALSE;
    }
    return TRUE;
}

public static function makeEmailButton($param) {
    $CI = &get_instance();
    $html = $CI->load->view("emails/_buttons", array("param" => $param), true);
    return $html;
}

public static function makeIVHash($email) {

    $iterations = 1000;
    $salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
    $hash = hash_pbkdf2("sha256", $email, $salt, $iterations, 20);
    return $hash;
}

public static function urlSafeString($str) {
    return preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^\wàâæçéèêëïîôœÿüûù]+/', '-', $str)));
}

public static function selectList($array, $field, $caption, $selectedValue = NULL) {
    $html = "";
    if (count($array) > 0) {
        foreach ($array as $value) {
            $value = (array) $value;
            $selected = ($value[$field] == $selectedValue) ? 'selected="true"' : '';
            $html .= '<option value="' . $value[$field] . '" ' . $selected . '>' . $value[$caption] . '</option>';
        }
    }
    return $html;
}

public static function selectListNumber($selectedValue = NULL, $start=1, $end=7, $empty="0", $showPlus=FALSE) {
    $html = "";
    
        for($i=$start; $i<=$end; $i++) {
            
            $value = ((int) $i <=0)? $empty : $i;
            $selected = ($value == $selectedValue) ? 'selected="true"' : '';
            $html .= '<option value="' . $i . '" ' . $selected . '>' . $value . '</option>';
        }
        if($showPlus === TRUE){
            $value = ($i-1)."+";
            $selected = (($i) == $selectedValue) ? 'selected="true"' : '';
            $html .= '<option value="' . $i . '" ' . $selected . '>' . $value . '</option>';
        }
    
    return $html;
}
public static function selectListMonth($selectedValue = NULL) {
    $html = "";
    
        for($i=1; $i<=12; $i++) {
            $value = str_pad($i, 2, "0", STR_PAD_LEFT);
            $selected = ($value == $selectedValue) ? 'selected="true"' : '';
            $html .= '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
        }
    
    return $html;
}



public static function selectListYear($selectedValue = NULL, $endYear = 1960) {
    $html = "";
        $currentYear = (int)date('Y');
        for($i=$currentYear; $i>=$endYear; $i--) {
            $value = $i;
            $selected = ($value == $selectedValue) ? 'selected="true"' : '';
            $html .= '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
        }
    
    return $html;
}

public static function radioCheckList($type, $name, $array, $field, $caption, $selectedValue = NULL) {
    $html = "";
    if (count($array) > 0) {
        foreach ($array as $value) {
            $value = (array) $value;
            $selected = ($value[$field] == $selectedValue) ? 'checked="checked"' : '';
            if ($type == 'radio') {
                $html .= '<input type="radio" value="' . $value[$field] . '" ' . $selected . ' name="' . $name . '" id="radio_' . $value[$field] . '"> <label for="radio_' . $value[$field] . '">' . $value[$caption] . '</label><br>';
            } else {
                $html .= '<input type="checkbox" value="' . $value[$field] . '" ' . $selected . ' name="' . $name . '" id="chk_' . $value[$field] . '"> <label for="chk_' . $value[$field] . '">' . $value[$caption] . '</label><br>';
            }
        }
    }
    return $html;
}

public static function checkListSmart($name, $array, $field, $caption, $selectedValue = NULL) {//check list with javascript function
    $html = "";
    if (count($array) > 0) {
        $i=0;
        foreach ($array as $value) {
            $value = (array) $value;
            $isExisit = array_search($value[$field], $selectedValue);
            $selected = ($isExisit !== FALSE) ? 'checked="checked"' : '';
            $chkId = str_replace(" ", "_", $value[$field]);
            $html .= '<input type="checkbox" value="' . $value[$field] . '" ' . $selected . ' name="' . $name . '" id="chk_' . $chkId . '"> <label for="chk_' . $chkId . '">' . $value[$caption] . '</label><br>';
            $i++;
        }
    }
    return $html;
}

public static function setValue($fieldName, $default = '') {
    return (strlen(set_value($fieldName)) <= 0) ? $default : set_value($fieldName);
}

public static function makeBreadCrum($breadCrum) {
    $html = "";
    if (count($breadCrum) > 0) {
        $html = '<ol class="breadcrumb m-b-0">'
                . '<li><a href="' . base_url() . '">Home</a></li>';
        foreach ($breadCrum as $part) {

            if (empty($part['url'])) {
                $html .= '<li>' . $part['name'] . '</li>';
            } else {
                $html .= '<li><a href="' . $part['url'] . '" title="">' . $part['name'] . '</a></li>';
            }
        }
        $html .= '</ol>';
    }
    return $html;
}

public static function getSelectCaption($id) {
    $CI = &get_instance();
    $CI->load->model('AuthenticationModel', 'sel_model');
    return $CI->sel_model->selectTypeById($id);
}

    public static function getRoleNavigation($role_id = 0) {
        $CI = &get_instance();
        $html = "";
        switch ($role_id) {
            case Constants::$ADMIN://Admin
                $html = $CI->load->view('shared/_admin_nav', null, TRUE);
                break;
            case Constants::$ENDUSER://Agent
                $html = $CI->load->view('shared/_end_user_nav', null, TRUE);
                break;
            case Constants::$FINANCIALADVISOR://Investor
                $html = $CI->load->view('shared/_fa_nav', null, TRUE);
                break;
            case Constants::$LAWYER://Investor
                $html = $CI->load->view('shared/_lawyer_nav', null, TRUE);
                break;
            default :
                $html = $CI->load->view('shared/_basic_nav', null, TRUE);
                break;
        }
        return $html;
    }
    public static function get_next_key_array($array,$key){
        $keys = array_keys($array);
        $position = array_search($key, $keys);
        if (isset($keys[$position + 1])) {
            $nextKey = $keys[$position + 1];
        }
        return $nextKey;
    }
    public static function arrayOfObjectToArray($array) {
        $out = [];
        foreach ($array as $a) {
            $out[$a->id] = $a;
        }
        return $out;
    }
    
    public static function statusAppFlow($app) {
        //$type 1 for payer and 2 for Receipent
        //if(Smart::$FLOWS[$app->relationship_status] === NULL){//Statically Load flow from DB
            $type = self::isPayer($app);
            $CI = &get_instance();
            $CI->load->model('QuestionsModel', 'flow_model');
            self::$FLOWS[$app->relationship_status] = $CI->flow_model->selectAppFlow((int)$app->relationship_status, $type);
        //}
        
    }
    public static function getNextPart($keys, $key) {
        $out =  NULL;
        $i = 1;
        self::$maxIndex = count($keys);
        foreach ($keys as $k) {
            if ($k === $key) {
                $out = next($keys);
                self::$currentIndex = $i;
                        
                break;
            }
            next($keys);
            $i++;
        }
        return ($out === FALSE)?NULL:$out;
    }
    public static function getPreviousPart($keys, $key) {
        $out =  NULL;
        foreach ($keys as $k) {
            
            if ($k === $key) {
                $out = prev($keys);
                break;
               
            }
            next($keys);
        }
        return $out;
    }
    
    public static function isPayer($app) {
        //highest_income s_highest_income kids_time_spend
        
        $myIncome = (float)$app->highest_income;
        $spouseIncome = (float)$app->s_highest_income;
        $numLatesNights = (int)$app->num_late_nights;
        if($numLatesNights > 3){
            return 1;
        }
        return ($myIncome >= $spouseIncome) ? 1: 2;
    }
    public static function getNextPreviousStep($app, $key, $skip_value=NULL) {
    
        $app->relationship_status = ((int)$app->relationship_status < 63)?63:$app->relationship_status;//Fix for initial questions
        $out['prev'] = NULL;
        $out['next'] = NULL;
        $out['skip_to'] = NULL;
        Smart::statusAppFlow($app);
        if(self::$FLOWS[$app->relationship_status] !== NULL){
            
            $keys = array_keys(self::$FLOWS[$app->relationship_status]);
            reset($keys);
            $next = self::getNextPart($keys, $key);
            reset($keys);
            $previous = self::getPreviousPart($keys, $key);
            
            $out['prev'] = ($previous !== NULL)? $previous : 'income-info';
            $nextURI = ($next !== NULL)? $next : NULL;
            //echo (int)self::$FLOWS[$app->relationship_status][$next]->skip_value;
            //print_r(self::$FLOWS[$app->relationship_status][$next]);
            //exit;
            if($nextURI !== NULL){
                $nextURI = ((int)$skip_value === (int)self::$FLOWS[$app->relationship_status][$next]->skip_value)?
                        self::$FLOWS[$app->relationship_status][$next]->skip_steps : $nextURI;
            }
            $out['next'] = $nextURI;
            $out['percentage'] = (int)(((int)self::$currentIndex / (int)self::$maxIndex)*100);
            
        }
        return (object)$out;
        
    }
    public static function getFirstPart($app) {
    
        self::statusAppFlow($app);
        if(self::$FLOWS[$app->relationship_status] !== NULL){
            $keys = array_keys(self::$FLOWS[$app->relationship_status]);
            return reset($keys);
        }
        return NULL;
    }
    
    public static function calculateRisk($application, $model) {
        
        $risk = 40000;
        $factor = 0.5;
        $childfactor = 0.12;
        $averageyears = 8;
        $daysyear = 365;
        $spousalfactor = 0.46;
        $currentYear = (int)date('Y');
        $marrieddate = (float)$application->married_date;
        $marrieddateexplode = explode("-", $marrieddate);
        $marriedyear = $marrieddateexplode[0];
        $noyearsmarried =  $marriedyear - $currentYear;
        $localeDate = utf8_encode(strftime('%d %B'));
        if ((float)$application->married_date){
             $spousalyearsfactor = 0.5;
           } 
        else{
             $spousalyearsfactor = 0;
           }
        
        $risk = (float)$risk + (((float)$application->highest_income - (float)$application->s_highest_income) * $factor);
        $risk = (float)$risk + (((float)$application->rrsp_value - (float)$application->s_rrsp_value) * $factor);
        if((int)$application->inheritance_maintained === 114){
            $risk = (float)$risk + (((float)$application->received_cash_property_value) * $factor);
        }
        $risk = (float)$risk + max((((float)$application->trust_income_draw_amount - (float)$application->bus_personal_expense) * $factor),0);
        $risk = (float)$risk + max((((float)$application->home_value - (float)$application->outstanding_mortgage) * $factor),0);
        $risk = (float)$risk + max((((float)$application->automobile - (float)$application->automobile_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->other_autos - (float)$application->other_autos_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->collectables - (float)$application->collectables_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->gadgets - (float)$application->gadgets_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->bank_accounts - (float)$application->bank_accounts_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->crypto_currencies - (float)$application->crypto_currencies_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->money_owed_to_you - (float)$application->money_owed_to_you_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->investments_stocks - (float)$application->investments_stocks_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->business_value_assets - (float)$application->business_value_assets_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->disability_insurance - (float)$application->disability_insurance_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->personal_loans - (float)$application->personal_loans_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->personal_credit_lines - (float)$application->personal_credit_lines_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->credit_cards - (float)$application->credit_cards_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->other_debt - (float)$application->other_debt_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->business_credit_line - (float)$application->business_credit_line_spouse) * $factor),0);
        $risk = (float)$risk + max((((float)$application->highest_income * (float)$application->num_kids) * $childfactor * $averageyears),0);
        $risk = (float)$risk + (((((float)$application->highest_income + (float)$application->s_highest_income) * $spoualfactor) - (float)$application->s_highest_income )* $noyearsmarried * $spousalyearsfactor);
  
        $assets = $model->getAppProperties($application->id);
        $gifts = $model->getAppGifs($application->id);
        if(count($assets) > 0)
        {
            foreach ($assets as $asset) {
                $risk = (float)$risk + (((float)$asset->property_value - (float)$asset->property_liens) * $factor);
            }
        }
        if(count($gifts) > 0)
        {
            foreach ($gifts as $gift) {
                $risk = (float)$risk + (((float)$gift->value) * $factor);
            }
        }
        return $risk;
    
    }
    public static function getApplication($id) {
        $CI = &get_instance();
        $CI->load->model('QuestionsModel', 'app_model');
        return $CI->app_model->getApplicationById($id);
    }
    
    
}

?>
