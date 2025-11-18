<?php
session_start();
include "Data_sistema.php";

if (isset($_SESSION["usuario"])) {
    if ($_SESSION["usuario"]["rol"] === "profesor") {
        header("Location: dashboard_profesor.php");
        exit;
    } else {
        header("Location: dashboard_estudiante.php");
        exit;
    }
}
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (strlen($username) < 3 || !ctype_alnum($username)) {
        $error = "El nombre de usuario debe tener al menos 3 caracteres y solo letras/números.";
    } elseif (strlen($password) < 5) {
        $error = "La contraseña debe tener al menos 5 caracteres.";
    } else {

        $usuario_encontrado = null;
        foreach ($usuarios as $u) {
            if ($u["username"] === $username && $u["password"] === $password) {
                $usuario_encontrado = $u;
                break;
            }
        }

        if ($usuario_encontrado) {
            $_SESSION["usuario"] = $usuario_encontrado;

            if ($usuario_encontrado["rol"] === "profesor") {
                header("Location: dashboard_profesor.php");
                exit;
            } else {
                header("Location: dashboard_estudiante.php");
                exit;
            }
        } else {
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Notas</title>
</head>
<body>

<h2>Secretaria Virtual de Notas UTP</h2>

<form method="POST">
    <label>Nombre de usuario:</label><br>
    <input type="text" name="username"><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Iniciar Sesion</button>
</form>

<?php if ($error != ""): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

</body>
</html>


