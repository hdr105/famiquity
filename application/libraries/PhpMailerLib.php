<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PhpMailerLib 
{

    private $mail; 
     private $CI, $_html, $_test, $_style, $_style2, $_hash, $_isDelayed, $_delayedMinutes; 

    function __construct()
    {
        require_once(APPPATH."third_party/phpmailer/PHPMailer.php");
        $this->mail = new \PHPMailer\PHPMailer\PHPMailer;
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = 'goholoads@gmail.com';
        $this->mail->Password = 'Jamal123';
        $this->mail->SMTPSecure = 'tls';                            
        $this->mail->Port = '587';
    }



        public function contact_us_mail($data)
        {

            $this->mail->setFrom($this->mail->Username, 'GoHolo Ads');
            $this->mail->addAddress('ijunaidraza@gmail.com'); 
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Welcome to the GoHOLO Network';
            //$this->mail->Body    = $data['message']."<br><div> <b>Best Regards,</b> <br> ".$data['name']."</div>";
            $this->mail->Body    = "ddd";

            $email = $this->mail->send();

            $res = array('res'=>$email,'data'=>$this->mail);
        
            return $res;
        }

    public function shootEmail($data)

    {
echo "<pre>";
 echo $this->mail->Username;       
print_r($data['email']);

            //print_r($param); exit();
                $this->mail->SMTPDebug = 2;
             $this->mail->setFrom($this->mail->Username, 'GoHolo Ads');
             $this->mail->addAddress($data['email']);     // Add a recipient
             $this->mail->isHTML(true);                                  // Set email format to HTML
             $this->mail->Subject = '<b>hello</b>';
             $this->mail->Body    = '<b>hello</b>';

             $email = $this->mail->send();

             $this->mail->ErrorInfo;
             die;

              $res = array('res'=>$email,'data'=>$this->mail);
        
            return $res;

       
    }

    }


