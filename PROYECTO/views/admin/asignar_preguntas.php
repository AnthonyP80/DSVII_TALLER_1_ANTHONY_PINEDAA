<?php
session_start();
require_once '../../src/Auth.php';
require_once '../../src/ExamenPreguntaManager.php';

if (!Auth::isAdmin()) {
    header("Location: ../../index.php");
    exit;
}

$examenes = ExamenPreguntaManager::obtenerExamenes();
$preguntas = ExamenPreguntaManager::obtenerPreguntas();

$idExamen = $_GET['examen'] ?? null;

/* ASIGNAR */
if (isset($_GET['asignar'])) {
    ExamenPreguntaManager::asignar($_GET['examen'], $_GET['asignar']);
    header("Location: asignar_preguntas.php?examen=" . $_GET['examen']);
    exit;
}

/* QUITAR */
if (isset($_GET['quitar'])) {
    ExamenPreguntaManager::quitar($_GET['examen'], $_GET['quitar']);
    header("Location: asignar_preguntas.php?examen=" . $_GET['examen']);
    exit;
}

$asignadas = $idExamen
    ? ExamenPreguntaManager::preguntasAsignadas($idExamen)
    : [];
?>

<link rel="stylesheet" href="../../public/assets/css/estilos.css">

<div class="contenedor">
    <div class="card">
      
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Preguntas</title>
</head>
<body>

<h1>Asignar Preguntas a Examen</h1>
<a href="dashboard.php">⬅ Volver</a>

<hr>

<form method="GET">
    <label>Seleccionar Examen:</label>
    <select name="examen" required onchange="this.form.submit()">
        <option value="">-- Seleccione --</option>
        <?php foreach ($examenes as $e): ?>
            <option value="<?= $e['id_examen'] ?>"
                <?= ($idExamen == $e['id_examen']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($e['titulo']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if ($idExamen): ?>
<hr>

<h3>Banco de Preguntas</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Enunciado</th>
        <th>Acción</th>
    </tr>

    <?php foreach ($preguntas as $p): ?>
    <tr>
        <td><?= $p['id_pregunta'] ?></td>
        <td><?= htmlspecialchars($p['enunciado']) ?></td>
        <td>
            <?php if (in_array($p['id_pregunta'], $asignadas)): ?>
                <a href="?examen=<?= $idExamen ?>&quitar=<?= $p['id_pregunta'] ?>">➖ Quitar</a>
            <?php else: ?>
                <a href="?examen=<?= $idExamen ?>&asignar=<?= $p['id_pregunta'] ?>">➕ Asignar</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

</body>
</html>
    </div>
</div>
