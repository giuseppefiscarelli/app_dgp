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
    ob_start();
    include dirname(__FILE__).'/res/ammissione.php';
    
     
    
    $content = ob_get_clean();
    $path = $pathReport;
    $html2pdf->writeHTML($content);
    $filename = $rep['id']."_".$rep['id_RAM']."_".time();
    //$html2pdf->createIndex('Sommaire', 30, 12, false, true, 2, null, '10mm');
    $html2pdf->output($path.$filename.".pdf",'FI');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}