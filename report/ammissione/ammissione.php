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
$data_RAM = getistanzaView($rep['id_RAM']);
$tipo_istanza= getTipoIstanza($user['tipo_istanza']);
$contr_rottamazione = 0;
$check_rottamazione = checkMaggRottamazione($rep['id_RAM']);
if($check_rottamazione){
    $contr_rottamazione = 2000;
}
$prot=0;
$data_prot='';
$data_verb='';
$prot_amm=0;
$data_doc='';

    foreach($dettagli as $dett){

        if($dett['tipo']==1){
            $prot_amm = $dett['descrizione'];
        }
        if($dett['tipo']==2){
            $data_prot = $dett['descrizione'];
        }
        if($dett['tipo']==3){
            $data_verb = $dett['descrizione'];
        }
        if($dett['tipo']==4){
            $prot = $dett['descrizione'];
        }
        if($dett['tipo']==5){
            $data_doc = $dett['descrizione'];
        }
    }
    
$data = reportAmmissione($rep['id_RAM']);
//var_dump($data); die;
$qnt2A=0;
$contr2A = 0;
$pmi2A = 0;
$rete2A =0;
$tot2A=0;

$qnt2B=0;
$contr2B = 0;
$pmi2B = 0;
$rete2B =0;
$tot2B=0;

$qnt2C=0;
$contr2C = 0;
$pmi2C = 0;
$rete2C =0;
$tot2C=0;

$qnt2D=0;
$contr2D = 0;
$pmi2D = 0;
$rete2D =0;
$tot2D=0;

$qnt3=0;
$contr3 = 0;
$pmi3 = 0;
$rete3=0;
$tot3=0;

$qnt4=0;
$contr4 = 0;
$pmi4 = 0;
$rete4 =0;
$tot4=0;

$qnt5A=0;
$contr5A = 0;
$pmi5A = 0;
$rete5A =0;
$tot5A=0;

$qnt5B=0;
$contr5B = 0;
$pmi5B = 0;
$rete5B =0;
$tot5B=0;

$qnt5C=0;
$contr5C = 0;
$pmi5C = 0;
$rete5C =0;
$tot5C=0;

$qnt7=0;
$contr7 = 0;
$pmi7 = 0;
$rete7 =0;
$tot7=0;


foreach ($data as $d){
    

    if ($d['art_dm'] =='2A'){
        $qnt2A = $d['qta'];
        $contr2A = $d['contributo'];
        $pmi2A = floatval($d['pmi_contr'])?10:0;
        $rete2A =  floatval($d['rete_contr'])?10:0;
        $tot2A = $d['contributo']+$d['pmi_contr']+$d['rete_contr'];
    }
    if ($d['art_dm'] =='2B'){
        $qnt2B = $d['qta'];
        $contr2B = $d['contributo'];
        $pmi2B =  floatval($d['pmi_contr'])?10:0;
        $rete2B =  floatval($d['rete_contr'])?10:0;
        $tot2B = $d['contributo']+$d['pmi_contr']+$d['rete_contr'];
        
    }
    if ($d['art_dm'] =='2C'){
        $qnt2C = $d['qta'];
        $contr2C = $d['contributo'];
        $pmi2C =  floatval($d['pmi_contr'])?10:0;
        $rete2C =  floatval($d['rete_contr'])?10:0;
        $tot2C = $d['contributo']+$d['pmi_contr']+$d['rete_contr'];
        
    }
    if ($d['art_dm'] =='3'){
        $qnt3 = $d['qta'];
        $contr3 = $d['contributo'];
        $pmi3 =  floatval($d['pmi_contr'])?10:0;
        $rete3 =  floatval($d['rete_contr'])?10:0;
        $tot3 = $d['contributo']+$d['pmi_contr']+$d['rete_contr'];
    }
    if ($d['art_dm'] =='4'){
        $qnt4 = $d['qta'];
        $contr4 = $d['contributo'];
        $pmi4 =  floatval($d['pmi_contr'])?10:0;
        $rete4 =  floatval($d['rete_contr'])?10:0;
        $tot4 = $d['contributo']+$d['pmi_contr']+$d['rete_contr'];
    }
    if ($d['art_dm'] =='5A'){
        $qnt5A = $d['qta'];
        $contr5A = $d['contributo'];
        $pmi5A =  floatval($d['pmi_contr'])?10:0;
        $rete5A =  floatval($d['rete_contr'])?10:0;
        $tot5A = $d['contributo']+$d['pmi_contr']+$d['rete_contr'];
    }
    if ($d['art_dm'] =='5B'){
        $qnt5B = $d['qta'];
        $contr5B = $d['contributo'];
        $pmi25B =  floatval($d['pmi_contr'])?10:0;
        $rete5B =  floatval($d['rete_contr'])?10:0;
        $tot5B = $d['contributo']+$d['pmi_contr']+$d['rete_contr'];
    }
    if ($d['art_dm'] =='7'){
        $qnt7 = $d['qta'];
        $contr7 = $d['contributo'];
        $pmi7 =  floatval($d['pmi_contr'])?10:0;
        $rete7 =  floatval($d['rete_contr'])?10:0;
        $tot7 = $d['contributo']+$d['pmi_contr']+$d['rete_contr'];
    }
}
//var_dump($data); die;

$totFin = $tot2A+$tot2B+$tot2C+$tot3+$tot4+$tot5A+$tot5B+$tot5C+$tot7+$contr_rottamazione;
$tipo = $_GET['tipo'];

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 2),true);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->pdf->SetProtection(array('print','copy'));
    $html2pdf->setDefaultFont('Times', 'Serif');
    ob_start();
    include dirname(__FILE__).'/res/ammissione.php';
    
     
    
    $content = ob_get_clean();
    $path = $pathReport;
    $html2pdf->writeHTML($content);
    $filename = $rep['id']."_".$rep['id_RAM']."_".time();
    //$html2pdf->createIndex('Sommaire', 30, 12, false, true, 2, null, '10mm');
    //$html2pdf->output($path.$filename.".pdf",'FI');
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