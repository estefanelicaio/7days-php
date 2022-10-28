<?php

use PHPMailer\PHPMailer\PHPMailer;

function send_mail(string $recipient, string $subject, string $content): void
{
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Port = SMTP_PORT;
    $mail->Username = SMTP_USER;
    $mail->Password = SMTP_PASSWORD;
    $mail->CharSet = 'UTF-8';
    
    $mail->From = EMAIL_ADDRESS;
    $mail->FromName = APP_NAME;
    $mail->AddAddress($recipient);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $content;
    $mail->AltBody = $content;

    $mail->send();
}
