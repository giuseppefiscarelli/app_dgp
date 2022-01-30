<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/proprietari.php';
$params = $_GET;

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

switch ($action){
    case 'updateProprietario':

		$data = $_REQUEST;
		$id = $_REQUEST['id'];
		$res = updateProprietario($data, $id);
		unset($params['action']);
		echo json_encode($res);
	break;

    case 'getProprietari':

        $params = $_REQUEST;
        //var_dump($params);
        $res = getProprietariCSV($params);
        echo json_encode($res);

        break;
}