<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'ram.investimenti2020@legalmail.it';                 // SMTP username
    $mail->Password = 'R4ns@2020_VII';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('ram.investimenti2020@legalmail.it');
    $mail->addAddress('n.salvatore@gmail.com');     // Add a recipient
    $mail->addAddress('fiscarelli.giu@gmail.com');               // Name is optional
   

    //Attachments
    $mail->addAttachment('/investimentivii/report/193__1627461928.pdf');         // Add attachments
    
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}