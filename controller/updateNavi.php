<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/navi.php';
$params = $_GET;

if(!isUserLoggedin()){

  header('Location:index.php');
  exit;
}

switch ($action){

	case 'scaricaEml':


		$id = getParam('id','');
		$id_pec = getParam('id_ele','');
		$id_mbx = getParam('id_mbx','');
		$pathEml = getPathEml($id_mbx);
/*
	    var_dump($id);
	    var_dump($id_pec);
	    die;
*/
	    //		var_dump($id);
//		var_dump($id_pec);die;

//		$pathEml = 'd:\\APPO_TEST\\';                ----- la variabile è stata spostata sul file di configirazione

//    if (!file_exists($pathEml.$id.".eml")){
//    	return ""

//	$res =getAllegatoID($id);

	    $file = trim($pathEml).trim($id).".eml";
	    $filename = trim($id).".eml";
		if (!file_exists($file)){
//			echo "directory ".dirname($pathEml)."<br>";
			echo "file ".$file. " non trovato <br>";
			var_dump($file);
//			var_dump($filename);
			die;
		}

//		var_dump($file); die;
/*
	    var_dump($pathEml);
	    var_dump($id);
	    var_dump($file);
	    var_dump($filename);
	    die;
*/
//      header("Content-type: application/pdf");

            header('Content-Disposition: attachment; filename='.basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file));
            header('Accept-Ranges: bytes');
	    @readfile($file);

	    $azione = (writeAzione(1, $id, $id_pec));
	    if (!$azione){
	    	echo "<br> errore scrittura azione";
	    	var_dump($azione);
	    	die;
	    }

		break;

	case 'getDatiNave':

		$id = $_REQUEST['id'];

		$res = getDatiNave($id);
	
		echo json_encode($res);
		//echo $res;
		break;

	case 'updateNave':
		$data = $_REQUEST;
		$id = $_REQUEST['id'];
		$res = updateNave($data, $id);
		unset($params['action']);
		echo json_encode($res);
	break;

	case 'getServizi':
		$id = $_REQUEST['id'];
		$res = getServizi($id);
	//	echo json_encode($res);
		echo $res;
	break;

	case 'getArmatore':
		$id = $_REQUEST['id'];
		$res = getArmatore($id);
		echo json_encode($res);
	break;

	case 'getProprietario':
		$id = $_REQUEST['id'];
		$res = getProprietario($id);
		echo json_encode($res);
	break;


}