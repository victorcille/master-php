<?php

require_once '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;  // Librería para generar PDFs

$html2pdf = new Html2Pdf();

/*
// 1ª Forma: inyectando directamente el código html en una variable y pasándosela por parámetro a la función writeHTML()
$html = "<h1>Hola Mundo desde una librería de PHP para hacer PDFs</h1>";
$html .= "<p>Master en PHP</p>";

$html2pdf->writeHTML($html);
$html2pdf->output('pdf_generado.pdf');
*/

// 2ª Forma: Cargar una plantilla o vista que será la que se imprima en el PDF
ob_start();
require_once 'plantilla_html.php';
$html = ob_get_clean();

$html2pdf->writeHTML($html);
$html2pdf->output('pdf_generado.pdf');