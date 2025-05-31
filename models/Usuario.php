<?php
class Usuario {
    private $conn;
    private $table = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function verificar($email, $password) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && isset($usuario['password_hash'])) {
            if (password_verify($password, $usuario['password_hash'])) {
                return $usuario;
            }
        }
        return false;
    }

    // Método para crear usuario (solo para insertar usuarios con contraseña hasheada)
    public function crearUsuario($email, $password) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO {$this->table} (email, password_hash) VALUES (:email, :password_hash)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password_hash', $password_hash);
        return $stmt->execute();
    }
}
