<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/armatori.php';
$params = $_GET;

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

switch ($action){

    case 'updateArmatore':
		$data = $_REQUEST;
		$id = $_REQUEST['id'];
		$res = updateArmatore($data, $id);
		unset($params['action']);
		echo json_encode($res);
	break;

    case 'getArmatori':
        $params = $_REQUEST;
        //var_dump($params);
        $res = getArmatoriCSV($params);
        echo json_encode($res);
    break;
    
}