<?php
// reference the Dompdf namespace
require_once "dompdf/autoload.inc.php";
require ('funciones.php');


//require_once ('dompdf/dompdf_config.inc.php');

use Dompdf\Dompdf;


// instantiate and use the dompdf class
$mipdf = new Dompdf();
//$html = ob_get_clean(); -> Obtiene el contenido del búfer actual y elimina el búfer de salida actual. 

$html=file_get_contents_curl("http://localhost/github/CURSO2019/TELEMATIC/PHP-SQL/provaFinal/privada.php");
                         

$mipdf->load_Html(utf8_decode($html));

// (Optional) Setup the paper size and orientation
$mipdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$mipdf->render();

// Output the generated PDF to Browser

$mipdf->stream('noticias.pdf');

function file_get_contents_curl($url) {
	$crl = curl_init();
	$timeout = 5;
	curl_setopt($crl, CURLOPT_URL, $url);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	$ret = curl_exec($crl);
	curl_close($crl);
	return $ret;
}
