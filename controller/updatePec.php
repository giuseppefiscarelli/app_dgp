<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/pec.php';
$params = $_GET;
switch ($action){
    case 'newAllegatoPec':
      $file=$_FILES['upload1'];
      $data=$_POST;
      

      if ($file['size'] > 0) {
        $docu_nome_file_origine =  $file['name'];
        $path_parts = pathinfo($docu_nome_file_origine);
        $docu_id_file_archivio = $data['id']."_".$data['id_ram']."_".strtotime("now").".".$path_parts['extension'];
        $data['nome_file']=$docu_id_file_archivio;
        
         move_uploaded_file($file['tmp_name'],$pathReport.$docu_id_file_archivio);
         if(file_exists($pathReport.$docu_id_file_archivio)){
           
                $res = convMail($data); 
   
         }
      }else{
        $res = convMail($data); 
      }
      echo json_encode($res);
    
       

    break;
}