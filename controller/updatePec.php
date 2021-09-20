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

    case 'testSendMail':
     
      $id=$_POST['id'];
      $id_RAM = $_POST['id_RAM'];
      $istanza = getIstanza($id_RAM);
      $report = getReportId($id);
      $tipo_report =  getInfoReport($report['tipo_report']);
      $tipo_istanza = getTipoIstanza($istanza['tipo_istanza']);
      $body = $tipo_report['body'];
      $replace = '%ragSoc%';
      $replace2 ='%*';
      $time = time();
      $rag = $istanza['ragione_sociale'];
      $bodymod = str_replace($replace,$rag,$body);
      $bodymod = str_replace('%*', '<br>', $bodymod);
      $data = array(
        'To'=> $istanza['pec_impr'],
        'file' =>  $pathReport.$report['nome_file'],
        'Subject' =>$tipo_report['object'].' - rif#'.$time,
        'body' => $bodymod,
        'envProd' => $envProd
      );
      var_dump($envProd);die;
      $res = sendMail($data);
     // var_dump($res);
     if($res){
       $data = array(
         'id' => $id,
         'data_invio' => date("Y-m-d H:i:s"),
         'user_invio' => $_SESSION['userData']['email'],
         'rif_invio' => $time,
         'stato' => 'C'
       );
       $res2 = upReportSendMail($data);
     }else{
       $res2 = false;
     }
     
      echo json_encode($res2);
    break;
    case 'delReport': 
      $data = $_REQUEST;
      $res= delReport($data['id']);
      echo json_encode($res);
    break;
}