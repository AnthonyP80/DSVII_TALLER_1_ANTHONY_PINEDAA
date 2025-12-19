<?php
require_once __DIR__ . '/Database.php';

class EstadisticaManager {

    public static function estadisticasPorExamen() {
        $db = Database::getConnection();
        $stmt = $db->query(
            "SELECT 
                e.titulo,
                COUNT(r.id_resultado) AS total_intentos,
                IFNULL(AVG(r.calificacion),0) AS promedio,
                IFNULL(MAX(r.calificacion),0) AS maxima,
                IFNULL(MIN(r.calificacion),0) AS minima
             FROM examenes e
             LEFT JOIN resultados r ON e.id_examen = r.id_examen
             GROUP BY e.id_examen"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
