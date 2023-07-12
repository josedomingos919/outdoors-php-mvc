<?php

namespace App\Services;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmialService
{
    public static function sendEmail($fromEmail, $fromName, $toEmail, $toName, $subject, $body)
    {
        $mail = new PHPMailer();

        try {
            //Server settings
            $mail->CharSet = "UTF-8";
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; //'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = '20200689@isptec.co.ao';
            $mail->Password   = 'Domingos.1';
            $mail->Port       = 587;
            //$mail->SMTPSecure = 'tls';

            //Recipients
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($toEmail, $toName);

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
