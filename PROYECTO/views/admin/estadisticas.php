<?php
session_start();
require_once '../../src/Auth.php';
require_once '../../src/EstadisticaManager.php';

if (!Auth::isAdmin()) {
    header("Location: ../../index.php");
    exit;
}

$stats = EstadisticaManager::estadisticasPorExamen();
?>

<link rel="stylesheet" href="../../public/assets/css/estilos.css">

<div class="contenedor">
    
<h1>📊 Estadísticas de Rendimiento</h1>
<a href="dashboard.php">⬅ Volver</a>

<hr>

<table border="2" cellpadding="5">
    <tr>
        <th>Examen</th>
        <th>Intentos</th>
        <th>Promedio</th>
        <th>Nota Máxima</th>
        <th>Nota Mínima</th>
    </tr>

    <?php foreach ($stats as $s): ?>
    <tr>
        <td><?= htmlspecialchars($s['titulo']) ?></td>
        <td><?= $s['total_intentos'] ?></td>
        <td><?= round($s['promedio'],2) ?>%</td>
        <td><?= $s['maxima'] ?>%</td>
        <td><?= $s['minima'] ?>%</td>
    </tr>
    <?php endforeach; ?>
</table>
