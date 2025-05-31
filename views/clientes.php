<?php
require_once '../config/database.php';
require_once '../models/Cliente.php';

$db = (new Database())->getConnection();
$cliente = new Cliente($db);
$lista = $cliente->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <div class="contenedor-clientes">
        <h2 class="titulo-clientes">Clientes</h2>
        <form method="POST" action="../controllers/ClienteController.php" class="formulario-clientes">
            <input type="hidden" name="accion" value="crear">
            <input type="text" name="nombre" placeholder="Nombre" required class="input-text">
            <input type="email" name="email" placeholder="Correo" required class="input-text">
            <input type="text" name="telefono" placeholder="Teléfono" required class="input-text">
            <button type="submit" class="btn-agregar">Agregar</button>
        </form>

        <table class="tabla-clientes">
            <thead>
                <tr>
                    <th>Nombre</th><th>Email</th><th>Teléfono</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($lista as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['telefono']) ?></td>
                    <td>
                        <form method="POST" action="../controllers/ClienteController.php" class="form-eliminar">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?= $c['id'] ?>">
                            <button type="submit" class="btn-eliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="link-volver">
            <button class="btn-volver">Volver</button>
        </a>
    </div>
</body>
</html>
