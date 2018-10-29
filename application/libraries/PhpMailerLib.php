<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhpMailerLib 
{
	function __construct($config = array())
	{
		
	}

	public function load()
	{
		require_once(APPPATH."third_party/phpmailer/PHPMailer.php");
		$objMail = new \PHPMailer\PHPMailer\PHPMailer;
        $objMail->isSMTP();                                      // Set mailer to use SMTP
        $objMail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $objMail->SMTPAuth = true;                               // Enable SMTP authentication
        $objMail->Username = 'haadi.javaid@gmail.com';                 // SMTP username
        $objMail->Password = '';
        $objMail->SMTPSecure = 'tls';                            
        $objMail->Port = '587';
        return $objMail;
        }
    }

