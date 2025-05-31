<?php
require_once '../config/database.php';
require_once '../models/Usuario.php';

class AuthController {
    private $usuarioModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->usuarioModel = new Usuario($db);
    }

    public function login($email, $password) {
        $usuario = $this->usuarioModel->verificar($email, $password);
        if ($usuario) {
            // Aquí puedes iniciar sesión, por ejemplo:
            session_start();
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'email' => $usuario['email'],
                'nombre' => $usuario['nombre'] // Asegúrate de que venga de la BD
            ];

            return true;
        }
        return false;
    }

    // Método para registrar usuario
    public function registrar($email, $password, $nombre) {
        return $this->usuarioModel->crearUsuario($email, $password, $nombre);
    }
}
