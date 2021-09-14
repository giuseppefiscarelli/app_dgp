<?php

/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */
require_once  '../../vendor/autoload.php';
require_once  '../../model/istanze.php';
require_once  '../../functions.php';
$rep = getReportId($_GET['id']);
$user = getistanza($rep['id_RAM']);
$dettagli = getDettReport($_GET['id']);
$tipo = $_GET['tipo'];
$data_RAM = getistanzaView($rep['id_RAM']);
$tipo_istanza= getTipoIstanza($user['tipo_istanza']);

/*
//$contrId = intval($data['id_contratto']);
$contrId = intval($_GET['id']);
//var_dump($contrId);die;
$contr = getContratto($contrId);

$cliId = $contr['id_cliente'];
$motoId = $contr['id_veicolo'];
$cli= getClientecf($cliId);
$m=getMotosel($motoId);
$acc=getAccessori($contrId);
//$quest = getValutazione($trId);
//var_dump($tr);die;
*/
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 2),true);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->pdf->SetProtection(array('print','copy'));
    $html2pdf->setDefaultFont('Times', 'Serif');
    //$html2pdf->setDefaultFont('roboto');
    ob_start();
    include dirname(__FILE__).'/res/inammissibilita.php';
    
     
    
    $content = ob_get_clean();
    $path = $pathReport;
    $html2pdf->writeHTML($content);

    //$html2pdf->addFont($family, $style, $file);
    $filename = $rep['id']."_".$rep['id_RAM']."_".time();
    //$html2pdf->createIndex('Sommaire', 30, 12, false, true, 2, null, '10mm');
    
    if($tipo =="P"){
        $html2pdf->output($filename.".pdf",'I');
    }
    if($tipo =="D"){
        $html2pdf->output($path.$filename.".pdf",'FD');
    }
    if($tipo =="S"){
        $html2pdf->output($path.$filename.".pdf",'F');
        echo $filename.".pdf";
    }
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}