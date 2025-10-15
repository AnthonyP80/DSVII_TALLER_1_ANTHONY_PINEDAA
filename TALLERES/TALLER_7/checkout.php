<?php
require_once 'config_sesion.php';

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header("Location: productos.php");
    exit();
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    
    if ($nombre && $email) {
        setcookie("ultimo_usuario", $nombre, time() + 86400);
        
        $total = 0;
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        
        $_SESSION['ultima_compra'] = [
            'nombre' => $nombre,
            'email' => $email,
            'total' => $total,
            'carrito' => $_SESSION['carrito']
        ];
        
        unset($_SESSION['carrito']);
        
        header("Location: checkout.php?estado=completado");
        exit();
    }
}

$compra_completada = isset($_GET['estado']) && $_GET['estado'] === 'completado';
?>
<html>
<head>
    <title>Finalizar Compra</title>
</head>
<body>
    <?php if ($compra_completada && isset($_SESSION['ultima_compra'])): ?>
        <h2>¡Compra Exitosa!</h2>
        <p>Nombre: <?php echo $_SESSION['ultima_compra']['nombre']; ?></p>
        <p>Email: <?php echo $_SESSION['ultima_compra']['email']; ?></p>
        
        <h3>Productos comprados:</h3>
        <?php foreach ($_SESSION['ultima_compra']['carrito'] as $producto): ?>
            <p>
                <?php echo $producto['nombre']; ?> - 
                <?php echo $producto['cantidad']; ?> x 
                $<?php echo $producto['precio']; ?> = 
                $<?php echo $producto['precio'] * $producto['cantidad']; ?>
            </p>
        <?php endforeach; ?>
        
        <p><b>Total pagado: $<?php echo $_SESSION['ultima_compra']['total']; ?></b></p>
        <p><a href="productos.php">Volver a la tienda</a></p>

    <?php else: ?>
        <h2>Finalizar Compra</h2>
        
        <h3>Tu pedido:</h3>
        <?php
        $total = 0;
        foreach ($_SESSION['carrito'] as $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $total += $subtotal;
            echo "<p>" . $producto['nombre'] . " - " . 
                 $producto['cantidad'] . " x $" . 
                 $producto['precio'] . " = $" . $subtotal . "</p>";
        }
        echo "<p><b>Total: $" . $total . "</b></p>";
        ?>

        <form method="post">
            <p>
                <label>Nombre:</label><br>
                <input type="text" name="nombre" required 
                       value="<?php echo isset($_COOKIE['ultimo_usuario']) ? $_COOKIE['ultimo_usuario'] : ''; ?>">
            </p>
            <p>
                <label>Email:</label><br>
                <input type="email" name="email" required>
            </p>
            <p>
                <input type="submit" value="Confirmar Compra">
            </p>
        </form>

        <p>
            <a href="ver_carrito.php">← Volver al carrito</a>
        </p>
    <?php endif; ?>
</body>
</html>