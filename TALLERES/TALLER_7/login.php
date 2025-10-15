<?php
require_once 'config_sesion.php';

// Si ya hay una sesión activa, redirigir a productos


// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <p>
            <label>Usuario:</label><br>
            <input type="text" name="usuario" required>
        </p>
        <p>
            <label>Contraseña:</label><br>
            <input type="password" name="contrasena" required>
        </p>
        <input type="submit" value="Ingresar">
    </form>

    <p>Usuario: admin<br>Contraseña: 1234</p>
</body>
</html>
        