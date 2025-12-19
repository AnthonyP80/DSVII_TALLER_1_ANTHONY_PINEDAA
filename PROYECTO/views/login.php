<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="public/assets/css/estilos.css">
</head>
<body>

<div class="card">
    <h2>Iniciar Sesión</h2>

    <?php if ($error): ?>
        <div class="mensaje-error"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['registro']) && $_GET['registro'] === 'ok'): ?>
        <div class="mensaje-exito">Cuenta creada correctamente</div>
    <?php endif; ?>

    <form method="POST">
        <label>Correo</label>
        <input type="email" name="correo" required>

        <label>Contraseña</label>
        <input type="password" name="contrasena" required>

        <button type="submit">Entrar</button>
    </form>

    <a href="views/registro.php">Crear cuenta</a>
</div>

</body>
</html>
