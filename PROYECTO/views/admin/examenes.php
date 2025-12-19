<?php
session_start();
require_once '../../src/Auth.php';
require_once '../../src/ExamenManager.php';

if (!Auth::isAdmin()) {
    header("Location: ../../index.php");
    exit;
}

/* CREAR */
if (isset($_POST['crear_examen'])) {
    ExamenManager::crear(
        trim($_POST['titulo']),
        trim($_POST['descripcion']),
        $_POST['tiempo_limite']
    );
    header("Location: examenes.php");
    exit;
}

/* CAMBIAR ESTADO */
if (isset($_GET['estado'])) {
    ExamenManager::cambiarEstado($_GET['id'], $_GET['estado']);
    header("Location: examenes.php");
    exit;
}

/* ELIMINAR */
if (isset($_GET['eliminar'])) {
    ExamenManager::eliminar($_GET['eliminar']);
    header("Location: examenes.php");
    exit;
}

$examenes = ExamenManager::obtenerTodos();
?>

<link rel="stylesheet" href="../../public/assets/css/estilos.css">

<div class="contenedor">
   
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Exámenes</title>
</head>
<body>

<h1>Gestión de Exámenes</h1>
<a href="dashboard.php">⬅ Volver</a>

<hr>

<h3>Nuevo Examen</h3>

<form method="POST">
    <label>Título:</label><br>
    <input type="text" name="titulo" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion"></textarea><br><br>

    <label>Tiempo límite (minutos):</label><br>
    <input type="number" name="tiempo_limite" min="1" required><br><br>

    <button type="submit" name="crear_examen">Crear Examen</button>
</form>

<hr>

<h3>Exámenes Registrados</h3>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Tiempo</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($examenes as $e): ?>
    <tr>
        <td><?= $e['id_examen'] ?></td>
        <td><?= htmlspecialchars($e['titulo']) ?></td>
        <td><?= $e['tiempo_limite'] ?> min</td>
        <td><?= $e['activo'] ? 'Activo' : 'Inactivo' ?></td>
        <td>
            <?php if ($e['activo']): ?>
                <a href="?estado=0&id=<?= $e['id_examen'] ?>"> Desactivar</a>
            <?php else: ?>
                <a href="?estado=1&id=<?= $e['id_examen'] ?>"> Activar</a>
            <?php endif; ?>

            | 
            <a href="?eliminar=<?= $e['id_examen'] ?>"
               onclick="return confirm('¿Eliminar este examen?')">
            Eliminar
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
