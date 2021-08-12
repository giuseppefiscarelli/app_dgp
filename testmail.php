<?php
  $pathReport= "/inv2020/report/";
  require "Mail.php";
  require_once "Mail/mime.php";
  $host    = "smtp.gmail.com";
  $port    = "587";
  $user    = "fiscarelli.giu@gmail.com";
  $pass    = "01735583";
  $smtp    = @Mail::factory("smtp", array("host"=>$host, "port"=>$port, "auth"=> true, "username"=>$user, "password"=>$pass));
  $from    = "\"Test mail\" <fiscarelli.giu@gmail.com>";


 //par
  $to = 'giuseppe.fiscarelli@setec.it';
  $file =  $pathReport."193__1627461928.pdf";
  //tab
  $subject = "Invio test";
  $body    = "\n\n<html><body><h1>Email contents here from HMR</h1></body></html>";
  $mime = new Mail_mime();
    if ($mime->addAttachment($file,'application/pdf')){
        echo "attached successfully! </br>";
    } else {
        echo "Nope, failed to attache!! </br>";
    }

  $headers = array(
                    "From"=> $from,
                    "To"=>$to,
                    "Subject"=>$subject,
                    //"MIME-Version"=>"1.0",
                   // "Content-Type"=>"text/html; charset=ISO-8859-1"
                );
  
  $mail    = @$smtp->send($to, $headers, $body);

  var_dump($mail);