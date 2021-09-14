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
$search2 = getParam('search2','');
$search3 = getParam('search3','');
$search4 = getParam('search4','');
$params =[
  'orderBy' => $orderBy, 
  'orderDir'=> $orderDir,
  'recordsPerPage' =>$recordsPerPage,
  'search1' => $search1,
  'search2' => $search2,
  'search3' => $search3,
  'search4' => $search4,
  'page' => $page
];

$orderByParams = $orderByNavigatorParams = $params;
unset($orderByParams['orderBy']);
unset($orderByParams['orderDir']);
unset($orderByNavigatorParams['page']);
$orderByQueryString = http_build_query($orderByParams,'&amp;');
$navOrderByQueryString = http_build_query($orderByNavigatorParams,'&amp;');
/*
 if(!isUserUser()){
    $totalMsg= countComunicazioni($params);
    $numPages= ceil($totalMsg/$recordsPerPage);
    //$email=$_SESSION['userData']['email'];
    $comunicazioni = getComunicazioni($params);
    $params['search3']='0';
    $unreadMsg= countComunicazioni($params);
   
    $params['search3']=1;
    $readMsg= countComunicazioni($params);
    $params['search4']=1;
    $closedMsg= countComunicazioni($params);
    //var_dump($readMsg);
    $checkConv = checkConv();
    //var_dump($checkConv);
     require_once 'view/comunicazioni/comunicazioni_admin.php';
 }else{
    $params['search1']=$_SESSION['userData']['email'];
    $totalMsg= countComunicazioni($params);
    $numPages= ceil($totalMsg/$recordsPerPage);
    //$email=$_SESSION['userData']['email'];
    $comunicazioni = getComunicazioni($params);
    $params['search3']='0';
    $unreadMsg= countComunicazioni($params);
   
    $params['search3']=1;
    $params['search4']='0';
    $readMsg= countComunicazioni($params);
    $params['search4']=1;
    $closedMsg= countComunicazioni($params);
    $tipi= getTipi();
    //var_dump($closedMsg);
     require_once 'view/comunicazioni/comunicazioni_user.php';
    


 }
 */

$orderDirClass = $orderDir;
$orderDir = $orderDir === 'ASC' ? 'DESC' : 'ASC';
$unreadMsg=0; //test

$params['search1']='B';
$unSend= countReport($params);
$pecUnsend = getReport($params);
$params['search1']='C';
$send= countReport($params);
$pecSend = getReport($params);
$params['search1']='A';
$conv= countReport($params);
$pecConv = getReport($params);
$tipiReport=getTipireport();
$userIns= getUserIns();
$edizioni = getTipiIstanza();
//var_dump($userIns);
//var_dump($envProd);
require_once 'view/pec/pecAdmin.php';
?>