<?php
require_once  '../../vendor/autoload.php';
//require_once  '../../model/istanze.php';
require_once  '../../functions.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 2),true);
$html2pdf->writeHTML('<h1>HelloWorld</h1>This is my first test');
$html2pdf->output();
