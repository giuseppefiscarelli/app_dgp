
<?php
session_start();
require_once '../functions.php';
$action = getParam('action','');
require '../model/pec.php';
$params = $_GET;
switch ($action){

    case 'getReportId':
        $id = $_REQUEST['id'];
        //var_dump($id);
        $res=getReportId($id);
        if ($res){
            $tipo = getInfoReport($res['tipo_report']);
            $istanza = getIstanza($res['id_RAM']);
            $attr = getDettagliReport($id);
            $json = [
                'data' => $res,
                'type' => $tipo,
                'istanza' => $istanza,
                'attr'=> $attr
            ];
            echo json_encode($json);
        }
       

    break;
    

}