
<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/comunicazioni.php';
$params = $_GET;
if(!isUserLoggedin()){
    exit;
   }
switch ($action){

    case 'newMsg':
    $data=$_POST;
    //var_dump($data);die;
    unset($data['action']);
       
     
     $res = newMsg($data);
     header('Location:../istanza.php?');
    break;

    case 'getMsg':
        
       
     $data = $_REQUEST['id'];
     $res = getMsg($data);
     $res['data_ins']= date("d/m/Y H:i:s",strtotime($res['data_ins']));
     $tipo= getTipo($res['tipo']);
     $res['tipo'] = $tipo['des_msg'];
     if($res['risolto']){
         $res['stato'] = '<span class="badge badge-success">Risolto</span>';
         $res['user_info']=$res['user_risolto'];
          $res['data_info']=date("d/m/Y H:i:s", strtotime($res['data_risolto']));
     }else{
         if($res['read_msg']=='0'){
            $res['stato']='<span class="badge badge-primary">Richiesta Inviata</span>';
            $res['user_info']="";
            $res['data_info']="";
            
         }else{
            $res['stato']='<span class="badge badge-warning">In Lavorazione</span>'; 
            $res['user_info']=$res['user_read'];
            $res['data_info']=date("d/m/Y H:i:s", strtotime($res['data_read']));
         }
         
     }
     echo json_encode($res);
    break;

    case 'newConv':
    $data = $_POST;
    //var_dump($data);die;
    $id = $data['id_comunicazioni'];
    if($data['risolto']==1){
        closeTicket($id);
    }
    
    $res = newConv($data);

    header('Location:../comunicazione.php?id='.$id);
    break;

      
   }