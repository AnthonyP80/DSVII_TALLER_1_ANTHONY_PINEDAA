<?php
require_once __DIR__ . '/Database.php';

class ExamenUsuarioManager {

    public static function obtenerExamenesActivos() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM examenes WHERE activo = 1");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPreguntasExamen($id_examen) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "SELECT p.*
             FROM preguntas p
             INNER JOIN examen_preguntas ep ON p.id_pregunta = ep.id_pregunta
             WHERE ep.id_examen = ?"
        );
        $stmt->execute([$id_examen]);
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

    public static function guardarResultado($id_usuario, $id_examen, $calificacion) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO resultados (id_usuario, id_examen, calificacion)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$id_usuario, $id_examen, $calificacion]);
        return $db->lastInsertId();
    }

    public static function guardarRespuesta($id_resultado, $id_pregunta, $id_opcion) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "INSERT INTO respuestas (id_resultado, id_pregunta, id_opcion)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$id_resultado, $id_pregunta, $id_opcion]);
    }

    public static function obtenerOpcionCorrecta($id_pregunta) {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            "SELECT id_opcion FROM opciones
             WHERE id_pregunta = ? AND es_correcta = 1"
        );
        $stmt->execute([$id_pregunta]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['id_opcion'];
    }
    public static function yaRealizado($id_usuario, $id_examen) {
    $db = Database::getConnection();
    $stmt = $db->prepare(
        "SELECT id_resultado FROM resultados
         WHERE id_usuario = ? AND id_examen = ?"
    );
    $stmt->execute([$id_usuario, $id_examen]);
    return $stmt->fetch() ? true : false;
}

}
