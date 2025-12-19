<?php
session_start();

require_once '../../src/Auth.php';

if (!Auth::isAdmin()) {
    header("Location: ../../index.php");
    exit;
}
?>
<link rel="stylesheet" href="../../public/assets/css/estilos.css">

<div class="contenedor">
    <div class="card">

        <div class="header">
            <h1>Panel de Administrador</h1>
        </div>

        <p>Bienvenido, <?= $_SESSION['usuario']['nombre'] ?></p>

        <a class="btn" href="preguntas.php">Banco de Preguntas</a>
        <a class="btn" href="examenes.php">Gestionar Exámenes</a>
        <a class="btn" href="asignar_preguntas.php">Asignar Preguntas</a>
        <a class="btn btn-secundario" href="estadisticas.php">Estadísticas</a>

        <br><br>
        <a href="../../logout.php">Cerrar sesión</a>

    </div>
</div>