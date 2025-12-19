<?php
require_once __DIR__ . '/Database.php';

class ExamenManager {

    public static function crear($titulo, $descripcion, $tiempo_limite) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO examenes (titulo, descripcion, tiempo_limite)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$titulo, $descripcion, $tiempo_limite]);
    }

    public static function obtenerTodos() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM examenes ORDER BY id_examen DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function cambiarEstado($id_examen, $estado) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "UPDATE examenes SET activo = ? WHERE id_examen = ?"
        );
        $stmt->execute([$estado, $id_examen]);
    }

    public static function eliminar($id_examen) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "DELETE FROM examenes WHERE id_examen = ?"
        );
        $stmt->execute([$id_examen]);
    }
}
