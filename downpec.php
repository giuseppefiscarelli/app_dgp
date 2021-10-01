<?php

session_start();
require_once 'functions.php';
if(!isUserLoggedin()){

      header('Location:index.php');
      exit;
    }
$id = getParam('id','');
require 'model/istanze.php';

$res =getReportId($id);

 
     

      if(isUserUser()){

       
                  header('Location:home.php');
            
      }else{
            $file = $pathReport.$res['nome_file']; 
      $filename = $res['nome_file']; 
      $filename = mb_ereg_replace("([^\w\s\d\-_~;\[\]\(\).])", '', $filename);

  
      header("Content-type: application/pdf");
           
            header('Content-Disposition: attachment; filename='.basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file));
            header('Accept-Ranges: bytes');
      @readfile($file);
      }