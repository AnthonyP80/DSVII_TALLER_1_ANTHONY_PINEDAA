<?php
require_once 'config_sesion.php';

$productos = [
    1 => ['nombre' => 'Laptop', 'precio' => 500.00],
    2 => ['nombre' => 'Mouse', 'precio' => 699.99],
    3 => ['nombre' => 'Teclado', 'precio' => 89.99],
    4 => ['nombre' => 'Monitor', 'precio' => 349.99],
    5 => ['nombre' => 'RGB', 'precio' => 129.99]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);
    
    if (!$producto_id || !$cantidad || $cantidad < 1 || $cantidad > 10) {
        $_SESSION['mensaje'] = mostrar_mensaje("Cantidad inválida");
        header("Location: productos.php");
        exit();
    }
    
    if (!isset($productos[$producto_id])) {
        $_SESSION['mensaje'] = mostrar_mensaje("Producto no encontrado");
        header("Location: productos.php");
        exit();
    }
    
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    
    if (isset($_SESSION['carrito'][$producto_id])) {

        $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;

        if ($_SESSION['carrito'][$producto_id]['cantidad'] > 10) {
            $_SESSION['carrito'][$producto_id]['cantidad'] = 10;
            $_SESSION['mensaje'] = mostrar_mensaje("Cantidad máxima permitida: 10 unidades", "error");
        } else {
            $_SESSION['mensaje'] = mostrar_mensaje("Producto actualizado en el carrito", "exito");
        }
    } else {
        // Añadir nuevo producto
        $_SESSION['carrito'][$producto_id] = [
            'nombre' => $productos[$producto_id]['nombre'],
            'precio' => $productos[$producto_id]['precio'],
            'cantidad' => $cantidad
        ];
        $_SESSION['mensaje'] = mostrar_mensaje("Producto añadido al carrito", "exito");
    }
}

// Redirigir de vuelta a la página de productos
header("Location: productos.php");
exit();