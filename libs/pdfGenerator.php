<?php
require '../vendor/autoload.php'; // Dompdf
require_once '../config/database.php';
require_once '../models/Proyecto.php';

use Dompdf\Dompdf;

// Obtener los proyectos desde la base de datos
$db = new Database();
$conn = $db->getConnection();
$proyecto = new Proyecto($conn);
$proyectos = $proyecto->obtenerTodos();

// Estilos CSS embebidos
$styles = '
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
';

// Construir el HTML del listado
$html = '
<html>
<head>' . $styles . '</head>
<body>
    <h1>Reporte de Proyectos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cliente</th>
            </tr>
        </thead>
        <tbody>';

foreach ($proyectos as $p) {
    $html .= '
            <tr>
                <td>' . htmlspecialchars($p['id']) . '</td>
                <td>' . htmlspecialchars($p['nombre']) . '</td>
                <td>' . htmlspecialchars($p['descripcion']) . '</td>
                <td>' . htmlspecialchars($p['cliente_id']) . '</td>
            </tr>';
}

$html .= '
        </tbody>
    </table>
</body>
</html>';

// Generar PDF con Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("reporte_proyectos.pdf", ["Attachment" => false]); // Cambia a true si quieres forzar descarga
?>
