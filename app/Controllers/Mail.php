<?php

namespace Jelena\Controllers;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

trait Mail
{

    public array $result=[];
 public function sendMail($result, $getcat, $message){




     $mail=new PHPMailer();
     try{


         $mail->SMTPDebug = SMTP::DEBUG_SERVER;
         $mail->isSMTP();
         $mail->Host = 'smtp.gmail.com';
         $mail->SMTPAuth   = true;
         $mail->Username   = 'jelena.naumovski95@gmail.com';
         $mail->Password   = 'xxxxx';
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
         $mail->Port       = 465;
//var_dump($result);
         foreach ($result as $value)
         {
             $mail->setFrom('jelena.naumovski@gmail.com');
             $mail->addAddress($value->mail);
             $mail->isHTML(true);
             $mail->Subject = 'New news';
             $mail->Body    = 'There is new news in '.$getcat.' category';
             $mail->send();
  // var_dump($value);

         }
     }

     catch (Exception $e)
     {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";


     }
 }
}