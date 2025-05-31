<?php
class Proyecto {
    private $conn;
    private $table = "proyectos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregar($nombre, $descripcion, $cliente_id) {
        $sql = "INSERT INTO {$this->table} (nombre, descripcion, cliente_id) VALUES (:nombre, :descripcion, :cliente_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':cliente_id' => $cliente_id
        ]);
    }

    public function actualizar($id, $nombre, $descripcion, $cliente_id) {
        $sql = "UPDATE {$this->table} SET nombre = :nombre, descripcion = :descripcion, cliente_id = :cliente_id WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':cliente_id' => $cliente_id
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>
