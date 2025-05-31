<?php
require '../vendor/autoload.php'; // dompdf
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = "<h1>Reporte de Proyectos</h1><p>Listado...</p>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("reporte_proyectos.pdf");
?>
