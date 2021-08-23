<?php


  if(!empty($_SESSION['message'])){
    $message = $_SESSION['message'];
    $alertType = $_SESSION['success'] ? 'success':'danger';
    $iconType = $_SESSION['success'] ? 'check':'exclamation-triangle';
    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  }
 
  if(!isUserUser()){
    $id = getParam('id',0);
    if($id){
        $i = getIstanza($id);
      
    }
  }else{
    $utente= $_SESSION['userData']['email'];
    $type_ist = getParam('type');

    $res = getIstanzaUser($utente,$type_ist);
    $i= getIstanza($res['id']);
  // var_dump($i);
  }
  $tipo_istanza = getTipoIstanza($i['tipo_istanza']);
  $tipiCom= getTipiComunicazione();
  $rend = checkRend($i['id_RAM']);
  //var_dump($rend);die;
  if(!$rend){
    createSrtructure($i);
    $rend = checkRend($i['id_RAM']);
  }
  $comunicazioni = getComunicazioni($i['id_RAM']); 
  if(isUserAdmin()){
    
    require_once 'view/istanze/istanzaAdmin.php';
  }else{
  $notifiche = getNotificheuser($i['id_RAM']);
 // var_dump(count($notifiche));
 $_SESSION['userData']['check_ram'] = $i['id_RAM'];
  require_once 'view/istanze/istanza_page.php';
 }
?>