<?php
require_once 'config_sesion.php';
$productos = [
    1 => ['nombre' => 'Laptop', 'precio' => 500.95],
    2 => ['nombre' => 'Mouse', 'precio' => 20],
    3 => ['nombre' => 'Teclado', 'precio' => 30],
    4 => ['nombre' => 'Monitor', 'precio' => 50.02],
    5 => ['nombre' => 'RGB', 'precio' => 30],
];
?>
<html>
<head>
    <title>Productos</title>
</head>
<body>
    <p>Usuario: <?php echo $_SESSION['usuario']; ?> 
       (<a href="logout.php">Salir</a>)
    </p>

    <p><a href="ver_carrito.php">Ver Carrito</a></p>

    <h2>Productos Disponibles:</h2>
    <?php foreach ($productos as $id => $producto): ?>
        <p>
            <?php echo $producto['nombre']; ?> - 
            $<?php echo $producto['precio']; ?>
            <form action="agregar_al_carrito.php" method="post">
                <input type="hidden" name="producto_id" value="<?php echo $id; ?>">
                Cantidad: <input type="number" name="cantidad" value="1" min="1" max="5">
                <input type="submit" value="Agregar">
            </form>
        </p>
    <?php endforeach; ?>
</body>
</html>