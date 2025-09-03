<?php

const RUTA_JSON = __DIR__ . '/inventario.json';
const UMBRAL_STOCK_BAJO = 5;

function leerInventario(string $ruta): array
{
    if (!file_exists($ruta)) {
        salirConError("No se encontró el archivo: $ruta");
    }

    $contenido = @file_get_contents($ruta);
    if ($contenido === false) {
        salirConError("No se pudo leer el archivo: $ruta");
    }

    $productos = json_decode($contenido, true);

    if (!is_array($productos)) {
        salirConError("El contenido JSON no es un array válido.");
    }

    $productos = array_map(function ($p) {
        return [
            'nombre'   => isset($p['nombre']) ? (string)$p['nombre'] : '',
            'precio'   => isset($p['precio']) ? (float)$p['precio'] : 0.0,
            'cantidad' => isset($p['cantidad']) ? (int)$p['cantidad'] : 0,
        ];
    }, $productos);

    return $productos;
}

function ordenarInventarioPorNombre(array &$productos): void
{
    usort($productos, function ($a, $b) {
        return strcmp(mb_strtolower($a['nombre'], 'UTF-8'), mb_strtolower($b['nombre'], 'UTF-8'));
    });
}

function mostrarResumen(array $productos): void
{
    if (php_sapi_name() === 'cli') {
        echo "Resumen del Inventario (A→Z):\n";
        echo str_repeat('-', 60) . "\n";
        echo sprintf("%-25s | %10s | %10s\n", "Producto", "Precio", "Cantidad");
        echo str_repeat('-', 60) . "\n";
        foreach ($productos as $p) {
            echo sprintf("%-25s | %10.2f | %10d\n", $p['nombre'], $p['precio'], $p['cantidad']);
        }
        echo str_repeat('-', 60) . "\n\n";
        return;
    }

    // HTML
     echo "<h2>Resumen del Inventario (A→Z)</h2>";
     echo "<table border='1' cellspacing='0' cellpadding='6' style='border-collapse:collapse'>";
     echo "<thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th></tr></thead><tbody>";
      foreach ($productos as $p) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($p['nombre']) . "</td>";
        echo "<td>" . number_format($p['precio'], 2, '.', ',') . "</td>";
        echo "<td>" . (int)$p['cantidad'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>"; 
}


function calcularValorTotal(array $productos): float
{
    return array_sum(array_map(function ($p) {
        return (float)$p['precio'] * (int)$p['cantidad'];
    }, $productos));
}

function generarInformeStockBajo(array $productos, int $umbral = UMBRAL_STOCK_BAJO): array
{
    return array_filter($productos, function ($p) use ($umbral) {
        return (int)$p['cantidad'] < $umbral;
    });
}

function guardarInventario(string $ruta, array $productos): bool
{
    $json = json_encode($productos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($ruta, $json) !== false;
}

function salirConError(string $msg): void
{
    if (php_sapi_name() === 'cli') {
        fwrite(STDERR, "[ERROR] $msg\n");
    } else {
        http_response_code(500);
        echo "<p style='color:#b00;font-family:Arial'><strong>Error:</strong> " . htmlspecialchars($msg) . "</p>";
    }
    exit(1);
}


$productos = leerInventario(RUTA_JSON);
ordenarInventarioPorNombre($productos);

if (php_sapi_name() !== 'cli') {
    echo "<!doctype html><html lang='es'><meta charset='utf-8'><title>Inventario</title>";
    echo "<body style='font-family:Arial, sans-serif; padding:20px'>";
    echo "<h1>Sistema de Inventario (JSON)</h1>";
}

mostrarResumen($productos);

$total = calcularValorTotal($productos);
$stockBajo = generarInformeStockBajo($productos, UMBRAL_STOCK_BAJO);

if (php_sapi_name() === 'cli') {
    echo "Valor total del inventario: B/. " . number_format($total, 2, '.', ',') . "\n\n";
    echo "Productos con stock bajo (menos de " . UMBRAL_STOCK_BAJO . "):\n";
    if (empty($stockBajo)) {
        echo "  - No hay productos con stock bajo.\n";
    } else {
        foreach ($stockBajo as $p) {
            echo "  - {$p['nombre']} (cantidad: {$p['cantidad']})\n";
        }
    }
    echo "\n";
} else {
    echo "<h2>Valor total del inventario</h2>";
    echo "<p><strong>B/. " . number_format($total, 2, '.', ',') . "</strong></p>";

    echo "<h2>Informe de productos con stock bajo (menos de " . UMBRAL_STOCK_BAJO . ")</h2>";
    if (empty($stockBajo)) {
        echo "<p>No hay productos con stock bajo.</p>";
    } else {
        echo "<ul>";
        foreach ($stockBajo as $p) {
            echo "<li>" . htmlspecialchars($p['nombre']) . " (cantidad: " . (int)$p['cantidad'] . ")</li>";
        }
        echo "</ul>";
    }

    echo "</body></html>";
}
