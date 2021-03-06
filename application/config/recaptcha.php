<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Recaptcha configuration settings
 * 
 * recaptcha_sitekey: Recaptcha site key to use in the widget
 * recaptcha_secretkey: Recaptcha secret key which is used for communicating between your server to Google's
 * lang: Language code, if blank "en" will be used
 * 
 * recaptcha_sitekey and recaptcha_secretkey can be obtained from https://www.google.com/recaptcha/admin/
 * Language code can be obtained from https://developers.google.com/recaptcha/docs/language
 * 
 * @author Damar Riyadi <damar@tahutek.net>
 */

$config['recaptcha_site_key'] = "6LfZUR4UAAAAADbk5J6dbKXNErE8st96kGsNRWmq";
$config['recaptcha_secret_key'] = "6LfZUR4UAAAAAE0CxjV4PUA-7gC3fdUDpdxvePfn";
$config['recaptcha_lang'] = "en";