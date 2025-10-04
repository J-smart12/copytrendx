<?php
//Load Composer's autoloader
// update to singleton later
require 'phpmailer/vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SMTPMESSAGING {
    private $db;
    private $MAILER_SETTINGS = [
        "host"=>"smtp.hostinger.com",
        "password"=>"=HrQ)_TJh7Ua8bJ",
        "username"=>"info@girlholdmyhandwithstormywellingtondigitalmasterclass.com",
        "name"=>"Girlholdmyhand Digital Masterclass"
    ];

    function setEmailBody($body) {
        // $mailerInstance->body = $body;
    }
    
    private function smtpmailer($to ,$subj, $msg, $user_name=''){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        // Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP(true);                                            //Send using SMTP
        $mail->Host       = $this->MAILER_SETTINGS['host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $this->MAILER_SETTINGS['username'];                     //SMTP username
        $mail->Password   = $this->MAILER_SETTINGS['password'];                         //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        
        $mail->setFrom($this->MAILER_SETTINGS['username'],$this->MAILER_SETTINGS['name']);
        $mail->addReplyTo($this->MAILER_SETTINGS['username']);
        
        $mail->addAddress($to, $user_name);                             //Add a recipient
        // $mail->addAddress($from);                                   //Name is optional
        
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //  Attachments
        //  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //  $mail->addEmbeddedImage(dirname(__FILE__).'/logo.png','logo');
        //  $mail->addEmbeddedImage('./logo.png','logo');
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subj;
        $mail->Body    = $msg;
        $mail->AltBody = $msg;
    
        if( $mail->send() ){
          return [
                    "status"=>true,
                    "message"=>"Success"
                ];;
        }else{
            echo $mail->ErrorInfo;
            return [
                    "status"=>false,
                    "message"=>$mail->ErrorInfo
                ];
        }
    }
    
    function send($to ,$subj, $msg, $user_name='') {
        $message = $this->smtpmailer($to ,$subj, $msg, $user_name='');
        
        return $message;
    }
}



 
 
 