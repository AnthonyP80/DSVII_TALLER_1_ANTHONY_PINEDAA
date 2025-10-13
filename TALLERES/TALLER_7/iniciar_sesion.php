<?php
session_start();

$_SESSION['usuario'] = "Anthony";
$_SESSION['rol'] = "admin";

echo "Sesión iniciada para " . $_SESSION['usuario'];
?>