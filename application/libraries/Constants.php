<?php
/**
 * Description of Constants
 *
 * @author saqib
 */
class Constants {

    public static $ENABLE = 1;
    public static $DISABLE = 0;
    
    public static $ADMIN = 2;
    public static $FINANCIALADVISOR = 3;
    public static $LAWYER = 4;
    public static $ENDUSER = 5;
    
    public static $LIMIT = 12;
    
    public static $REGEX_SAFE_NO_TAG = 'A-Za-z0-9ÀÂÆÇÈÉÊËÎÏÔŒÙÛÜŸàâæçèéêëîïôœùûüÿ“”~«»–—œ:,\^\{\}\[\]\.\-_=;!\+@\$\*\?#%&\/\\\(\)\'\s';
    public static $REGEX_SAFE_ALPHANUMERIC = 'A-Za-z0-9ÀÂÆÇÈÉÊËÎÏÔŒÙÛÜŸàâæçèéêëîïôœùûüÿ:\.\-_\'\s';
    public static $REGEX_SAFE_ALPHA = 'A-Za-zÀÂÆÇÈÉÊËÎÏÔŒÙÛÜŸàâæçèéêëîïôœùûüÿ:\.\-_\'\s';
    public static $REGEX_SAFE_ADDRESS2 = 'A-Za-z0-9ÀÂÆÇÈÉÊËÎÏÔŒÙÛÜŸàâæçèéêëîïôœùûüÿ:\#\/\\\(\)\.\-_\'\s';
    public static $REGEX_SAFE_PWD = '(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{6,16}';
    public static $REGEX_SAFE_SLUG = 'A-Za-z0-9ÀÂÆÇÈÉÊËÎÏÔŒÙÛÜŸàâæçèéêëîïôœùûüÿ\-_';

    
    public static $PINK = 58;
    public static $BLUE = 59;
    public static $GREEN = 60;
    public static $ORANGE = 61;
    public static $RED = 62;
    public static $PURPULE = 63;
    
    public static function getnumberToText($num) {
        $array = array(
            "1"=>"First",
            "2"=>"Second",
            "3"=>"Third",
            "4"=>"Forth",
            "5"=>"Fifth",
            "6"=>"Sixth",
            "7"=>"Seventh",
            "8"=>"Eighth",
            "9"=>"Ninth",
            "10"=>"Tenth",
            );
            return $array[$num];
        
    }
    
    
    
    
    public static function getStrategyList() {
        return array(
            "Cash Purchase (i.e. not mortgagable)",
            "BTL",
            "BTL (Tenant in situ)", 
            "Social / Government Scheme", 
            "Flip", 
            "Development", 
            "Multi-Let / HMO", 
            "vCapital Growth", 
            "Commercial","Portfolio");
        
    }

    public static function getLandingPage($role) {
        $out = "";
        switch ((int)$role) {
            case self::$ADMIN:
                $out = "list-agents";                
                break;
            case self::$AGENT:
                $out = "my-account";                
                break;
            case self::$INVESTOR:
                $out = "all-properties";                
                break;
            default:
                break;
        }
        return $out;
        
    }
    public static function getStatusList() {
        
        return array("0"=>(object)array("id"=>0,"name"=>"In-active"),
            "1"=>(object)array("id"=>1,"name"=>"Active"),
            );
    }
    
    public static function getStatusLabel($id){
        try{
            $array = Constants::getStatusList();
            $object = $array[(int)$id];
        return ($object === NULL)?'':$object->name;
        }  catch (Exception $e){
            return '';
        }
    }
    
    public static function getAppStatusList() {
        
        return array("0"=>(object)array("id"=>0,"name"=>"Incomplete"),
            "1"=>(object)array("id"=>1,"name"=>"Completed"),
            );
    }
    
    public static function getAppStatusLabel($id){
        try{
            $array = Constants::getAppStatusList();
            $object = $array[(int)$id];
        return ($object === NULL)?'':$object->name;
        }  catch (Exception $e){
            return '';
        }
    }
    
    public static function getRegisterStatusList() {
        
        return array("0"=>(object)array("id"=>0,"name"=>"Pending"),
            "1"=>(object)array("id"=>1,"name"=>"Registered"),
            );
    }
    
    public static function getRegisterStatusLabel($id){
        try{
            $array = Constants::getRegisterStatusList();
            $object = $array[(int)$id];
        return ($object === NULL)?'':$object->name;
        }  catch (Exception $e){
            return '';
        }
    }
    
}

?>
