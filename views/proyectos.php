<?php
require_once '../config/database.php';
require_once '../models/Proyecto.php';

$db = new Database();
$conn = $db->getConnection();
$proyecto = new Proyecto($conn);
$proyectos = $proyecto->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <h2>Lista de Proyectos</h2>

    <a href="crearProyecto.php" class="btn-primary">Registrar Nuevo Proyecto</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Cliente</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($proyectos as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['id']) ?></td>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td><?= htmlspecialchars($p['descripcion']) ?></td>
                <td><?= htmlspecialchars($p['cliente_id']) ?></td>
                <td>
                    <a href="../controllers/proyectoController.php?accion=eliminar&id=<?= $p['id'] ?>" class="btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este proyecto?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="dashboard.php" class="btn-secondary">Volver al Dashboard</a>
</body>
</html>
