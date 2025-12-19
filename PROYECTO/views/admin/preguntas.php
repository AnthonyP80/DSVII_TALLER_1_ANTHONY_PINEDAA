<?php
session_start();
require_once '../../src/Auth.php';
require_once '../../src/PreguntaManager.php';

if (!Auth::isAdmin()) {
    header("Location: ../../index.php");
    exit;
}

/* CREAR PREGUNTA + OPCIONES */
if (isset($_POST['crear_pregunta'])) {
    $idPregunta = PreguntaManager::crearPregunta(
        trim($_POST['enunciado']),
        $_POST['tipo']
    );

    foreach ($_POST['opciones'] as $i => $texto) {
        $esCorrecta = ($_POST['correcta'] == $i) ? 1 : 0;
        PreguntaManager::agregarOpcion($idPregunta, $texto, $esCorrecta);
    }

    header("Location: preguntas.php");
    exit;
}

/* ELIMINAR */
if (isset($_GET['eliminar'])) {
    PreguntaManager::eliminarPregunta($_GET['eliminar']);
    header("Location: preguntas.php");
    exit;
}

$preguntas = PreguntaManager::obtenerPreguntas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Banco de Preguntas</title>
    <link rel="stylesheet" href="../../public/assets/css/estilos.css">
</head>
<body>

<div class="contenedor">
    <div class="card">

        <div class="header">
            <h1>Banco de Preguntas</h1>
        </div>

        <a href="dashboard.php">⬅ Volver</a>

        <hr>

        <h3>Nueva Pregunta</h3>

        <form method="POST">

            <label>Enunciado</label>
            <textarea name="enunciado" required></textarea>

            <label>Tipo</label>
            <select name="tipo" required>
                <option value="opcion_multiple">Opción múltiple</option>
                <option value="verdadero_falso">Verdadero / Falso</option>
            </select>

            <label>Opciones</label>

            <input type="radio" name="correcta" value="0" required>
            <input type="text" name="opciones[]" placeholder="Opción 1" required>

            <input type="radio" name="correcta" value="1">
            <input type="text" name="opciones[]" placeholder="Opción 2" required>

            <input type="radio" name="correcta" value="2">
            <input type="text" name="opciones[]" placeholder="Opción 3">

            <input type="radio" name="correcta" value="3">
            <input type="text" name="opciones[]" placeholder="Opción 4">

            <br><br>
            <button type="submit" name="crear_pregunta">Guardar Pregunta</button>
        </form>

        <hr>

        <h3>Preguntas Registradas</h3>

        <?php foreach ($preguntas as $p): ?>
            <div style="margin-bottom:15px; border:1px solid #ccc; padding:10px;">
                <strong><?= htmlspecialchars($p['enunciado']) ?></strong><br>
                <em><?= $p['tipo'] ?></em>

                <ul>
                    <?php
                    $opciones = PreguntaManager::obtenerOpciones($p['id_pregunta']);
                    foreach ($opciones as $o):
                    ?>
                        <li>
                            <?= htmlspecialchars($o['texto_opcion']) ?>
                            <?= $o['es_correcta'] ? '✅' : '' ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <a href="?eliminar=<?= $p['id_pregunta'] ?>"
                   onclick="return confirm('¿Eliminar esta pregunta?')">
                   ❌ Eliminar
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</div>

</body>
</html>
