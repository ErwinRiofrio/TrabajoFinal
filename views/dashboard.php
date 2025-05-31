<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <div class="dashboard-header">
        <h2>Bienvenido, <?= $_SESSION['usuario']['nombre'] ?? 'Invitado' ?></h2>
    </div>

    <nav class="dashboard-nav">
        <a href="clientes.php">Clientes</a>
        <a href="proyectos.php">Proyectos</a>
        <a href="../libs/pdfGenerator.php?reporte=proyectos">Exportar PDF</a>
        <form class="logout-form" method="post" action="logout.php">
            <button type="submit" class="logout-button">Cerrar Sesión</button>
        </form>
    </nav>
</body>
</html>
