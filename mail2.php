<?php
include 'Mail.php';
include 'Mail/mime.php' ;
$pathReport= "/inv2020/report/";
$from    = "\"Test mail\" <fiscarelli.giu@gmail.com>";
$text = 'Text version of email';
$html = '<html><body>HTML version of email</body></html>';
$file =  $pathReport."193__1627461928.pdf";
$to = "giuseppe.fiscarelli@setec.it";
 
$crlf = "\n";
$hdrs = array(
    'From' => $from,
    'Subject' => 'Test mime message',
    "To"=>$to
);


$host    = "smtp.gmail.com";
$port    = "587";
$user    = "fiscarelli.giu@gmail.com";
$pass    = "01735583";

$mime = new Mail_mime(array('eol' => $crlf));
$mime->setTXTBody($text);
$mime->setHTMLBody($html);
$mime->addAttachment($file, 'application/pdf');
$body = $mime->get();
$attachmentheaders  = $mime->headers($hdrs);

$smtp    = @Mail::factory("smtp", array("host"=>$host, "port"=>$port, "auth"=> true, "username"=>$user, "password"=>$pass));
$mail = $smtp->send($to, $attachmentheaders , $body);

?>