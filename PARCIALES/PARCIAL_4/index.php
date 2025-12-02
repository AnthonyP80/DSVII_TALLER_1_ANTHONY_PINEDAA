<?php 
include "database.php";

$sql = "SELECT * FROM productos";
$resultado = $conexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
</head>
<body>

<h2>Lista de productos</h2>
<a href="crear.php">Agregar producto</a>
<br><br>

<table border="1" cellpadding="5">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Categoría</th>
    <th>Precio</th>
    <th>Cantidad</th>
    <th>Acciones</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()) { ?>
<tr>
    <td><?php echo $fila["id"]; ?></td>
    <td><?php echo $fila["nombre"]; ?></td>
    <td><?php echo $fila["categoria"]; ?></td>
    <td><?php echo $fila["precio"]; ?></td>
    <td><?php echo $fila["cantidad"]; ?></td>
    <td>
        <a href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a>
        |
        <a href="eliminar.php?id=<?php echo $fila['id']; ?>">Eliminar</a>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
