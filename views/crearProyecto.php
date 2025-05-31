<?php
require_once '../config/database.php';
require_once '../models/Proyecto.php';

$db = new Database();
$conn = $db->getConnection();
$proyecto = new Proyecto($conn);

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $descripcion = trim($_POST['descripcion']);
    $cliente_id = intval($_POST['cliente_id']);

    if ($nombre && $descripcion && $cliente_id) {
        if ($proyecto->agregar($nombre, $descripcion, $cliente_id)) {
            $mensaje = "Proyecto registrado correctamente.";
        } else {
            $mensaje = "Error al registrar el proyecto.";
        }
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Proyecto</title>
    <link rel="stylesheet" href="../public/crearpro.css">
</head>
<body>
    <div class="contenedor-formulario">
        <h2 class="titulo-formulario">Registrar Nuevo Proyecto</h2>

        <?php if ($mensaje): ?>
            <div class="mensaje <?= strpos($mensaje, 'correctamente') !== false ? 'exito' : 'error' ?>">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="crearProyecto.php" class="formulario-proyecto">
            <label for="nombre" class="label-input">Nombre del Proyecto:</label>
            <input type="text" name="nombre" id="nombre" required class="input-text">

            <label for="descripcion" class="label-input">Descripción:</label>
            <textarea name="descripcion" id="descripcion" required class="textarea"></textarea>

            <label for="cliente_id" class="label-input">ID del Cliente:</label>
            <input type="number" name="cliente_id" id="cliente_id" required class="input-text">

            <button type="submit" class="btn-registrar">Registrar</button>
        </form>

        <a href="proyectos.php" class="link-volver">Volver a la lista de proyectos</a>
    </div>
</body>
</html>
