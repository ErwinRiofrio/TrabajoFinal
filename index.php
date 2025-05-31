<?php
session_start();

// Si el usuario ya está autenticado, redirigir al dashboard
if (isset($_SESSION['usuario'])) {
    header("Location: views/dashboard.php");
    exit();
} else {
    header("Location: views/login.php");
    exit();
}
?>

