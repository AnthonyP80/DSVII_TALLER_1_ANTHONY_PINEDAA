<?php
require_once __DIR__ . '/Database.php';

class PreguntaManager {

    public static function crearPregunta($enunciado, $tipo) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO preguntas (enunciado, tipo) VALUES (?, ?)"
        );
        $stmt->execute([$enunciado, $tipo]);
        return $db->lastInsertId();
    }

    public static function agregarOpcion($id_pregunta, $texto, $es_correcta) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO opciones (id_pregunta, texto_opcion, es_correcta)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$id_pregunta, $texto, $es_correcta]);
    }

    public static function obtenerPreguntas() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM preguntas ORDER BY id_pregunta DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerOpciones($id_pregunta) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "SELECT * FROM opciones WHERE id_pregunta = ?"
        );
        $stmt->execute([$id_pregunta]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function eliminarPregunta($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM preguntas WHERE id_pregunta = ?");
        $stmt->execute([$id]);
    }
}
