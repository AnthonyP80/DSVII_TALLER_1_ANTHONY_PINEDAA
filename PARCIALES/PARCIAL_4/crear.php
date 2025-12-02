<?php
include "database.php";

if ($_POST) {
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];

    if ($nombre != "" && $categoria != "" && $precio != "" && $cantidad != "") {

        $stmt = $conexion->prepare("INSERT INTO productos (nombre, categoria, precio, cantidad) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $nombre, $categoria, $precio, $cantidad);
        $stmt->execute();

        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Producto</title>
</head>
<body>

<h2>Agregar Producto</h2>

<form method="POST">
    Nombre:<br>
    <input type="text" name="nombre"><br><br>

    Categoría:<br>
    <input type="text" name="categoria"><br><br>

    Precio:<br>
    <input type="number" step="0.01" name="precio"><br><br>

    Cantidad:<br>
    <input type="number" name="cantidad"><br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href="index.php">Volver</a>

</body>
</html>
