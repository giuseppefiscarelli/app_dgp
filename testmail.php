<?php
  $pathReport= "/investimentivii/report/";
  require "Mail.php";
  require_once "Mail/mime.php";
  $host    = "ssl://sendm.cert.legalmail.it";
    $port    = "465";
    $user    = "ram.investimenti2020@legalmail.it";
    $pass    = "RII2020@atr";
  $smtp    = @Mail::factory("smtp", array(
                                          "host"=>$host, 
                                          "port"=>$port, 
                                          "auth"=> true, 
                                          "username"=>$user, 
                                          "password"=>$pass));
  $from    = "ram.investimenti2020@legalmail.it";


 //par
  $to = 'fiscarelli.giu@gmail.com, n.salvatore@gmail.com';
  $file =  $pathReport."193__1627461928.pdf";
  //tab
  $subject = "Invio test";
  $body    = "\n\n<html><body><h1>Email contents here from test</h1></body></html>";
  
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
                    "MIME-Version"=>"1.0",
                    "Content-Type"=>"text/html; charset=ISO-8859-1"
                );
  
  $mail =@$smtp->send($to, $headers, $body);

  var_dump($mail);