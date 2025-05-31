<?php
require_once '../config/database.php';
require_once '../models/Cliente.php';

$db = (new Database())->getConnection();
$cliente = new Cliente($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'crear':
                $cliente->insertar($_POST['nombre'], $_POST['email'], $_POST['telefono']);
                break;
            case 'editar':
                $cliente->actualizar($_POST['id'], $_POST['nombre'], $_POST['email'], $_POST['telefono']);
                break;
            case 'eliminar':
                $cliente->eliminar($_POST['id']);
                break;
        }
    }
    header('Location: ../views/clientes.php');
}
?>
