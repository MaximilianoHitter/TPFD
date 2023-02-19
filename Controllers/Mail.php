<?php
require_once('../config.php');
/*require_once($ROOT.'Vendor/phpmailer/phpmailer/src/PHPMailer.php');
require_once($ROOT.'Vendor/phpmailer/phpmailer/src/Exception.php');
require_once($ROOT.'Vendor/phpmailer/phpmailer/src/SMTP.php'); */

/* use Exception;
use PHPMailer\PHPMailer\src\PHPMailer as PHPMailer;
use SMTP; */
/* require_once('includes/PHPMailer.php');
require_once('includes/Exception.php'); */


trait Mail
{
    public static function enviarMail($email, $contenido)
    {
        $mail = new PHPMailer();
        //Set mailer to use smtp
        $mail->isSMTP();
        //define smtp host
        $mail->Host = "smtp.gmail.com";
        //enable smtp auth 
        $mail->SMTPAuth = "true";
        //set type encrypt 
        $mail->SMTPSecure = "tls";
        //set port 
        $mail->Port = "587";
        //set gmial user 
        $mail->Username = "maximliano.hitter@est.fi.uncoma.edu.ar";
        //set pass 
        $mail->Password = "******";
        //set email subj 
        $mail->Subject = "Cambio de estado de la compra";
        //set sender 
        $mail->setFrom("maximliano.hitter@est.fi.uncoma.edu.ar");
        //email body 
        $mail->Body = $contenido;
        //add recipient
        if($email != '' && $email != null){
            $mail->addAddress($email);
        } else{
            $mail->addAddress("maximliano.hitter@est.fi.uncoma.edu.ar");
        }
        //send 
        if ($mail->Send()) {
            $respuesta = true;
        } else {
            $respuesta = false;
        }
        //closing smtp
        $mail->smtpClose();
        return $respuesta;
    }
}
//Include requires phpmailes
/* require ('/Exception.php');
require ('includes/PHPMailer.php');
require ('includes/SMTP.php'); */
//Define namesspaces

//Create instance
