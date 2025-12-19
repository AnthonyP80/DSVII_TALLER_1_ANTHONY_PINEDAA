<?php
session_start();

require_once __DIR__ . '/src/Auth.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (Auth::login($_POST['correo'], $_POST['contrasena'])) {
        if (Auth::isAdmin()) {
            header("Location: views/admin/dashboard.php");
        } else {
            header("Location: views/usuario/dashboard.php");
        }
        exit;
    } else {
        $error = "Correo o contraseña incorrectos";
    }
}
require_once 'views/login.php';

if (isset($_GET['registro']) && $_GET['registro'] === 'ok'): ?>
    <p style="color:green">✅ Cuenta creada correctamente, ahora inicia sesión</p>
<?php endif; ?>

