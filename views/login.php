<?php
require_once '../controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $auth = new AuthController();

    if ($auth->login($email, $password)) {
        // Login exitoso, redirige al menú o dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Credenciales inválidas.";
    }
} else {
    // Mostrar formulario de login si quieres aquí (o usar el HTML separado)
    include_once 'login.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Iniciar Sesión</h2>

        <form method="post" action="login.php" class="login-form">
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" class="login-button">Iniciar Sesión</button>
        </form>

        <form action="register.php" method="get" class="login-register-form">
            <button type="submit" class="register-button">Crear una cuenta</button>
        </form>
    </div>
</form>
</body>
</html>
