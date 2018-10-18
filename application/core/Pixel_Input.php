<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GAM_Input
 *
 * @author Saqib Ahmad
 */
class Pixel_Input extends CI_Input{
  
    
    public function post($index = NULL, $xss_clean = NULL) {
        $output = parent::post($index, $xss_clean);
        return (is_array($output))?$output:  trim(Smart::sanitizeInput($output));
        
    }
}
