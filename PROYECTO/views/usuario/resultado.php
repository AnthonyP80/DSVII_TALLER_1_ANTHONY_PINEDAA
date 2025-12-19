<?php
session_start();
require_once '../../src/Auth.php';
require_once '../../src/ExamenUsuarioManager.php';

if (!Auth::check()) {
    header("Location: ../../index.php");
    exit;
}

$idUsuario = $_SESSION['usuario']['id'];
$idExamen = $_POST['id_examen'];
$respuestas = $_POST['respuestas'];

$total = count($respuestas);
$correctas = 0;

foreach ($respuestas as $idPregunta => $idOpcion) {
    $correcta = ExamenUsuarioManager::obtenerOpcionCorrecta($idPregunta);
    if ($idOpcion == $correcta) {
        $correctas++;
    }
}

$nota = round(($correctas / $total) * 100, 2);

$idResultado = ExamenUsuarioManager::guardarResultado(
    $idUsuario,
    $idExamen,
    $nota
);

foreach ($respuestas as $idPregunta => $idOpcion) {
    ExamenUsuarioManager::guardarRespuesta(
        $idResultado,
        $idPregunta,
        $idOpcion
    );
}
?>

<link rel="stylesheet" href="../../public/assets/css/estilos.css">

<div class="contenedor">
    <div class="card small">

        <div class="header">
            <h1>Resultado del Examen</h1>
        </div>

        <div class="mensaje-exito">
            <p>Respuestas correctas: <?= $correctas ?> / <?= $total ?></p>
            <h2>Calificación: <?= $nota ?>%</h2>
        </div>

        <a class="btn" href="examenes.php">⬅ Volver a Exámenes</a>

    </div>
</div>

