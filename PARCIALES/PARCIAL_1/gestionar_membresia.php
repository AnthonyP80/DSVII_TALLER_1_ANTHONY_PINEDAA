<?php
include "funciones_gimnasio.php";

$membresias = array(
    "basica" => 80,
    "premium" => 120,
    "vip" => 180,
    "familiar" => 250,
    "corporativa" => 300
);
$miembros = array(
    "Anthony Pineda" => array("tipo" => "premium", "antiguedad" => 8),
    "Luis Peralta" => array("tipo" => "basica", "antiguedad" => 22),
    "Jonathan Ureña" => array("tipo" => "vip", "antiguedad" => 15),
    "Maria Lasso" => array("tipo" => "familiar", "antiguedad" => 9),
    "Jose Moreno" => array("tipo" => "corporativa", "antiguedad" => 10)
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Membresías Gimnasio</title>
</head>
<body>
    <h2>Resumen de Membresías</h2>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Antigüedad</th>
            <th>Cuota Base</th>
            <th>Descuento (%)</th>
            <th>Monto Descuento</th>
            <th>Seguro</th>
            <th>Total</th>
        </tr>
        <?php
        foreach ($miembros as $nombre => $datos) {
            $tipo = $datos["tipo"];
            $antig = $datos["antiguedad"];
            $base = $membresias[$tipo];

            $desc_pct = calcular_promocion($antig);
            $desc_monto = ($base * $desc_pct)/100;
            $seguro = calcular_seguro_medico($base);
            $total = calcular_cuota_final($base, $desc_pct, $seguro);

            echo "<tr>";
            echo "<td>".$nombre."</td>";
            echo "<td>".$tipo."</td>";
            echo "<td>".$antig."</td>";
            echo "<td>$".$base."</td>";
            echo "<td>".$desc_pct."%</td>";
            echo "<td>$".round($desc_monto,2)."</td>";
            echo "<td>$".round($seguro,2)."</td>";
            echo "<td>$".round($total,2)."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
