<?php
session_start();
require_once '../../src/Auth.php';

if (!Auth::check()) {
    header("Location: ../../index.php");
    exit;
}
?>
<link rel="stylesheet" href="../../public/assets/css/estilos.css">

<div class="contenedor">
    <div class="card">

        <div class="header">
            <h1>Panel de Usuario</h1>
        </div>

        <p>Bienvenido, <strong><?= $_SESSION['usuario']['nombre'] ?></strong></p>

        <a class="btn" href="examenes.php">🧪 Ver Exámenes</a>

        <br><br>
        <a href="../../logout.php">Cerrar sesión</a>

    </div>
</div>
