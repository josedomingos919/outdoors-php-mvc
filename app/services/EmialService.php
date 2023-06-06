<?php

namespace App\Services;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmialService
{
    public static function sendEmail($fromEmail, $fromName, $toEmail, $toName, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->CharSet = "UTF-8";
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'f82ba5b860c3a8';
            $mail->Password   = '461a3b54b455b0';
            $mail->Port       = 2525;

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
