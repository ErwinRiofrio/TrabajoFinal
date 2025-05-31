<?php
class Cliente {
    private $conn;
    private $table = "clientes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar($nombre, $email, $telefono) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (nombre, email, telefono) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $email, $telefono]);
    }

    public function actualizar($id, $nombre, $email, $telefono) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET nombre = ?, email = ?, telefono = ? WHERE id = ?");
        return $stmt->execute([$nombre, $email, $telefono, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
