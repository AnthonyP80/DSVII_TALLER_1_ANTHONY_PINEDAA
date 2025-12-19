<?php
session_start();
require_once '../../src/Auth.php';
require_once '../../src/Database.php';
require_once '../../src/ExamenUsuarioManager.php';

if (!Auth::check()) {
    header("Location: ../../index.php");
    exit;
}

/* OBTENER EXAMEN */
$idExamen = $_GET['id'] ?? null;
if (!$idExamen) {
    die("❌ Examen no válido");
}

/* BLOQUEAR REPETICIÓN */
if (ExamenUsuarioManager::yaRealizado($_SESSION['usuario']['id'], $idExamen)) {
    die("❌ Ya realizaste este examen.");
}

/* OBTENER DATOS */
$preguntas = ExamenUsuarioManager::obtenerPreguntasExamen($idExamen);

$db = Database::getConnection();
$tiempo = $db->prepare("SELECT tiempo_limite FROM examenes WHERE id_examen = ?");
$tiempo->execute([$idExamen]);
$tiempo = $tiempo->fetch(PDO::FETCH_ASSOC)['tiempo_limite'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Examen</title>
    <link rel="stylesheet" href="../../public/assets/css/estilos.css">
</head>
<body>

<div class="contenedor">
    <div class="card">

        <div class="header">
            <h1>Realizar Examen</h1>
        </div>

        <div class="mensaje-exito" id="tiempo">
            ⏱ Tiempo restante
        </div>

        <form method="POST" action="resultado.php">

            <input type="hidden" name="id_examen" value="<?= $idExamen ?>">

            <?php foreach ($preguntas as $p): ?>
                <div style="margin-bottom:20px;">
                    <p><strong><?= htmlspecialchars($p['enunciado']) ?></strong></p>

                    <?php
                    $opciones = ExamenUsuarioManager::obtenerOpciones($p['id_pregunta']);
                    foreach ($opciones as $o):
                    ?>
                        <label>
                            <input type="radio"
                                   name="respuestas[<?= $p['id_pregunta'] ?>]"
                                   value="<?= $o['id_opcion'] ?>"
                                   required>
                            <?= htmlspecialchars($o['texto_opcion']) ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <button type="submit">Enviar Examen</button>
        </form>

    </div>
</div>

<script>
let tiempo = <?= $tiempo ?> * 60;

setInterval(() => {
    let min = Math.floor(tiempo / 60);
    let seg = tiempo % 60;

    document.getElementById('tiempo').innerText =
        `⏱ Tiempo restante: ${min}:${seg.toString().padStart(2,'0')}`;

    tiempo--;

    if (tiempo < 0) {
        document.forms[0].submit();
    }
}, 1000);
</script>

</body>
</html>
