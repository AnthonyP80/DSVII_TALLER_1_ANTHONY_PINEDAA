<?php
// Incluir archivo de configuración de sesión
require_once 'config_sesion.php';

// Si no hay sesión, ir a login
?>
<html>
<head>
    <title>Carrito</title>
</head>
<body>


    <!-- Mensajes del sistema -->
    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<p>" . $_SESSION['mensaje'] . "</p>";
        unset($_SESSION['mensaje']);
    }
    ?>

    <h2>Tu Carrito:</h2>

    <?php
    // Si hay productos en el carrito
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $total = 0;
        
        // Mostrar cada producto
        foreach ($_SESSION['carrito'] as $id => $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $total += $subtotal;
            ?>
            <p>
                <?php echo $producto['nombre']; ?> - 
                $<?php echo $producto['precio']; ?> x 
                <?php echo $producto['cantidad']; ?> = 
                $<?php echo $subtotal; ?>
                <form action="eliminar_del_carrito.php" method="post" style="display: inline;">
                    <input type="hidden" name="producto_id" value="<?php echo $id; ?>">
                    <input type="submit" value="Quitar">
                </form>
            </p>
            <?php
        }
        
        // Mostrar total y opciones
        echo "<p>Total a pagar: $" . $total . "</p>";
        ?>
        <p>
            <a href="productos.php">Seguir comprando</a> | 
            <a href="checkout.php">Pagar</a>
        </p>
        <?php
    } else {
        echo "<p>No hay productos en el carrito</p>";
        echo "<p><a href='productos.php'>Ir a productos</a></p>";
    }
    ?>
</body>
</html>