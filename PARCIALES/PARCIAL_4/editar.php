<?php
include "database.php";

$id = $_GET["id"];

$stmt = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$producto = $stmt->get_result()->fetch_assoc();

if ($_POST) {
    $nombre = $_POST["nombre"];
    $categoria = $_POST["categoria"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];

    $stmt2 = $conexion->prepare("UPDATE productos SET nombre=?, categoria=?, precio=?, cantidad=? WHERE id=?");
    $stmt2->bind_param("ssdii", $nombre, $categoria, $precio, $cantidad, $id);
    $stmt2->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto</title>
</head>
<body>

<h2>Editar Producto</h2>

<form method="POST">
    Nombre:<br>
    <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>"><br><br>

    Categoría:<br>
    <input type="text" name="categoria" value="<?php echo $producto['categoria']; ?>"><br><br>

    Precio:<br>
    <input type="number" step="0.01" name="precio" value="<?php echo $producto['precio']; ?>"><br><br>

    Cantidad:<br>
    <input type="number" name="cantidad" value="<?php echo $producto['cantidad']; ?>"><br><br>

    <button type="submit">Actualizar</button>
</form>

<br>
<a href="index.php">Volver</a>

</body>
</html>
