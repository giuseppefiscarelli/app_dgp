<?php


  if(!empty($_SESSION['message'])){
    $message = $_SESSION['message'];
    $alertType = $_SESSION['success'] ? 'success':'danger';
    $iconType = $_SESSION['success'] ? 'check':'exclamation-triangle';
    require 'view/template/message.php';
    unset($_SESSION['message'],$_SESSION['success']);
  }

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
$envPec = $envProd?1:0;

$pec = getPecData($envPec);

require_once 'view/pec/pec_config.php';
?>