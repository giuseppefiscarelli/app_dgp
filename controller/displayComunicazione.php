<?php


  if(!empty($_SESSION['message'])){
    $message = $_SESSION['message'];
    $alertType = $_SESSION['success'] ? 'success':'danger';
    $iconType = $_SESSION['success'] ? 'check':'exclamation-triangle';
    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  }
  /*
  if(!isUserUser()){
  $id = getParam('id',0);
  if($id){
      $i = getIstanza($id);
  }
  }else
  {
    $utente= $_SESSION['userData']['email'];
    $i = getIstanzaUser($utente);
  }

  $rend = checkRend($i['id_RAM']);
  //var_dump($rend);die;
  if(!$rend){
    createSrtructure($i);
  } 
  if(isUserAdmin()){
    require_once 'view/istanze/istanzaAdmin.php';
  }else{
  require_once 'view/istanze/istanza_page.php';
 }
 */

$id = getParam('id',0);
$c = getMsg($id);
$tipo = getTipo($c['tipo']);
$conv = getConv($id);
if(!isUserUser()){
    setReadConv($id,'user');
    if($c['read_msg']=='0'){
        setReadmsg($id);
        
    }

}else{
    setReadConv($id,'admin');
}
//var_dump($conv);

if($c['risolto'] !== '0'){
    $stato = '<span class="badge badge-success">Richiesta Chiusa</span>';
}else{
    $stato = '<span class="badge badge-warning">In Lavorazione</span>';
}
require_once 'view/comunicazioni/comunicazione.php';

?>