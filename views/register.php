<?php
session_start();
require_once '../config/database.php'; // Aquí la conexión PDO

$database = new Database();
$conn = $database->getConnection(); // CORRECCIÓN AQUÍ

// Inicializar mensajes
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 6) {
        // Hashear contraseña
        $passwordSegura = password_hash($password, PASSWORD_BCRYPT);

        try {
            $sql = "INSERT INTO usuarios (nombre, email, password_hash) VALUES (:nombre, :email, :password_hash)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password_hash', $passwordSegura);
            $stmt->execute();

            $mensaje = "Usuario registrado correctamente. Ya puedes iniciar sesión.";
        } catch (PDOException $e) {
            $mensaje = "Error al registrar usuario: " . $e->getMessage();
        }
    } else {
        $mensaje = "Por favor ingresa un email válido y una contraseña de al menos 6 caracteres.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <div class="registro-container">
        <h2 class="registro-titulo">Registro de Usuario</h2>

        <?php if (isset($mensaje) && $mensaje): ?>
            <p class="registro-mensaje"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <form method="POST" action="register.php" class="registro-form">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="registro-input" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="registro-input" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" class="registro-input" minlength="6" required>

            <button type="submit" class="registro-boton">Registrar</button>
        </form>

        <a href="login.php" class="registro-enlace">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</body>
</html>
