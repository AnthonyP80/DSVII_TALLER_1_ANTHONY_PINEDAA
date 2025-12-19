<?php
session_start();
require_once '../src/Auth.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ok = Auth::registrar(
        trim($_POST['nombre']),
        trim($_POST['correo']),
        trim($_POST['contrasena'])
    );

    if ($ok) {
        header("Location: ../index.php?registro=ok");
        exit;
    } else {
        $mensaje = "❌ El correo ya está registrado";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="../public/assets/css/estilos.css">

<div class="contenedor">
    <div class="card small">

        <div class="header">
            <h1>Crear Cuenta</h1>
        </div>

        <?php if ($mensaje): ?>
            <div class="mensaje-error"><?= $mensaje ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Nombre</label>
            <input type="text" name="nombre" required>

            <label>Correo</label>
            <input type="email" name="correo" required>

            <label>Contraseña</label>
            <input type="password" name="contrasena" required>

            <button type="submit">Registrarse</button>
        </form>

        <br>
        <a href="../index.php">Volver al login</a>
    </div>
</div>

