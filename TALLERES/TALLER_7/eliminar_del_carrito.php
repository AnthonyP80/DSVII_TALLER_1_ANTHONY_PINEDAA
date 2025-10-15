<?php
require_once 'config_sesion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto_id = filter_input(INPUT_POST, 'producto_id', FILTER_VALIDATE_INT);
    
    if ($producto_id && isset($_SESSION['carrito'][$producto_id])) {
        // Eliminar el producto del carrito
        unset($_SESSION['carrito'][$producto_id]);
        $_SESSION['mensaje'] = mostrar_mensaje("Producto eliminado del carrito", "exito");
        
        // Si el carrito está vacío, eliminarlo completamente
        if (empty($_SESSION['carrito'])) {
            unset($_SESSION['carrito']);
        }
    } else {
        $_SESSION['mensaje'] = mostrar_mensaje("Error al eliminar el producto");
    }
}

header("Location: ver_carrito.php");
exit();