<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * BASE PIXEL Controller Class
 */

/**
 * Description of Pixel_Controller
 *
 * @author saqib
 */
class Pixel_Controller extends CI_Controller {

    public $language;
    protected $currentCustomer, $slug, $currentDate;

    public function __construct() {
        parent::__construct();
        $this->language = strtolower($this->uri->segment(1, 'en'));
        $this->language = ($this->language !== 'fr') ? "en" : "fr";

        $this->lang->load('common', $this->language);
        $this->lang->load('form_validation', $this->language);
        $local = ($this->language === 'fr') ? "fr_CA" : "en_US";
        $this->currentCustomer = $this->session->userdata('CustomerObject');
        setlocale(LC_ALL, $local);
        $now = new DateTime();
        $this->currentDate = $now->format('Y-m-d H:i:s');
        $this->load->helper("custom");
    }

    public function getLanguage() {
        $lang = array("en" => "en", "fr" => "fr");
        $language = (array_search($this->language, $lang) === FALSE) ? "en" : $this->language;
        $this->language = $language;
        return $this->language;
    }

    public function setLocale($lang) {
        $this->language = $lang;
        $this->language = ($this->language !== 'fr') ? "en" : "fr";
        $local = ($this->language === 'fr') ? "fr_CA" : "en_US";
        setlocale(LC_ALL, $local);
    }

    protected function isAuthorized() {
        if ($this->session->AppLogin <> TRUE) {
            return FALSE;
        }
        return TRUE;
    }

    protected function isAuthorizedAdmin() {
        if ($this->session->AppLogin === TRUE) {
            $role = $this->session->CustomerObject->role_id;
            return ((int) $role === Constants::$ADMIN) ? TRUE : FALSE;
        }
        return FALSE;
    }

    protected function isAuthorizedFA() {
        if ($this->session->AppLogin === TRUE) {
            $role = $this->session->CustomerObject->role_id;
            return ((int) $role === Constants::$FINANCIALADVISOR) ? TRUE : FALSE;
        }
        return FALSE;
    }

    public function isAuthorizedLawyer() {
        if ($this->session->AppLogin === TRUE) {
            $role = $this->session->CustomerObject->role_id;
            return ((int) $role === Constants::$LAWYER) ? TRUE : FALSE;
        }
        return FALSE;
    }

    public function isAuthorizedUSER() {
        if ($this->session->AppLogin === TRUE) {
            $role = $this->session->CustomerObject->role_id;
            return ((int) $role === Constants::$ENDUSER) ? TRUE : FALSE;
        }
        return FALSE;
    }

    protected function redirectUnAuthorized($checkIsLogged = TRUE, $uri = "/sign-in") {
        if ($checkIsLogged === TRUE) {
            if (!$this->isAuthorized()) {
                $this->session->pageReffrer = Smart::sanitizeInput($_SERVER['HTTP_REFERER']);
                redirect(base_url($uri));
            }
        } else {
            if ($this->isAuthorized()) {
                redirect(base_url($uri));
            }
        }
    }

    public function isMobile() {

        return $this->agent->is_mobile();
    }

    public function requestMobile() {

        return $this->agent->mobile();
    }

    public function requestPlatform() {
        $platform = $this->agent->platform();
        $osName = "";
        if (stripos($platform, "Windows") !== FALSE) {
            $osName = "Windows";
        } elseif (stripos($platform, "mac") !== FALSE) {
            $osName = "Macintosh";
        } elseif (stripos($platform, "Android") !== FALSE) {
            $osName = "Android";
        } elseif (stripos($platform, "iOS") !== FALSE) {
            $osName = "iOS";
        } elseif (stripos($platform, "Linux") !== FALSE) {
            $osName = "Linux";
        } elseif (stripos($platform, "BlackBerry") !== FALSE) {
            $osName = "BlackBerry";
        } elseif (stripos($platform, "Macintosh") !== FALSE) {
            $osName = "Macintosh";
        } elseif (stripos($platform, "Debian") !== FALSE) {
            $osName = "Linux";
        } else {
            $osName = "Others";
        }
        return $osName;
    }

    public function requestVersion() {
        if ($this->agent->is_browser()) {
            return $this->agent->version();
        }
        return "Unknown/or no version";
    }

    public function requestBrowser() {
        if ($this->agent->is_browser()) {
            return $this->agent->browser();
        }
        return "Unknown/or no browser";
    }

    public function requestBrowserWithVersion() {
        if ($this->agent->is_browser()) {
            return $this->agent->browser() . "___" . $this->agent->version();
        }
        return "Unknown/or no browser";
    }

    public function metaInfo() {
        $object = array(
            "ip" => Smart::getSanitizedIP(),
            "browser" => $this->requestBrowser(),
            "browserVersion" => $this->requestVersion(),
            "isMobile" => ($this->isMobile()) ? 1 : 0,
            "mobile" => $this->requestMobile(),
            "osName" => $this->requestPlatform(),
            "lang" => $this->language);
        return $object;
    }
    
    public function verifyCaptcha() {
        $this->load->library('recaptcha');
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) and $response['success'] === true) {
                return TRUE;
            }
        } 
            return FALSE;
        
    }
    protected function updateTempApp($customer) {
        
        $hasTempApp = $this->session->tempApp;
        if($hasTempApp === TRUE){
            $sessionId = $this->session->session_id;
            $this->load->model('questionsModel', 'qmodel');
            $application = $this->qmodel->updateTempApplication($customer->id, $sessionId);
            $this->session->unset_userdata("tempApp");
            $this->session->unset_userdata("tempId");
            return $application;
        }
        
        return NULL;
    }
}

?>
