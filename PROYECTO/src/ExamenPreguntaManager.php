<?php
require_once __DIR__ . '/Database.php';

class ExamenPreguntaManager {

    public static function obtenerExamenes() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM examenes ORDER BY titulo");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPreguntas() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM preguntas ORDER BY id_pregunta DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function preguntasAsignadas($id_examen) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "SELECT id_pregunta FROM examen_preguntas WHERE id_examen = ?"
        );
        $stmt->execute([$id_examen]);
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_pregunta');
    }

    public static function asignar($id_examen, $id_pregunta) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT IGNORE INTO examen_preguntas (id_examen, id_pregunta)
             VALUES (?, ?)"
        );
        $stmt->execute([$id_examen, $id_pregunta]);
    }

    public static function quitar($id_examen, $id_pregunta) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "DELETE FROM examen_preguntas
             WHERE id_examen = ? AND id_pregunta = ?"
        );
        $stmt->execute([$id_examen, $id_pregunta]);
    }
}
