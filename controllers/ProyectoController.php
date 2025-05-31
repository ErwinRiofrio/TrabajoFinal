<?php
require_once '../config/database.php';
require_once '../models/Proyecto.php';

$db = new Database();
$conn = $db->getConnection();
$proyecto = new Proyecto($conn);

$accion = $_GET['accion'] ?? '';

switch ($accion) {
    case 'agregar':
        $proyecto->agregar($_POST['nombre'], $_POST['descripcion'], $_POST['cliente_id']);
        header('Location: ../views/proyectos.php');
        break;
    case 'actualizar':
        $proyecto->actualizar($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['cliente_id']);
        header('Location: ../views/proyectos.php');
        break;
    case 'eliminar':
        $proyecto->eliminar($_GET['id']);
        header('Location: ../views/proyectos.php');
        break;
    default:
        $lista = $proyecto->obtenerTodos();
        include '../views/proyectos.php';
}
?>
