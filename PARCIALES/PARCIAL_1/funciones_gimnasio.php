<?php
function calcular_promocion($antiguedad_meses) {
    $descuento = 0;

    if ($antiguedad_meses < 3) {
        $descuento = 0;
    } else if ($antiguedad_meses >= 3 && $antiguedad_meses <= 12) {
        $descuento = 8;
    } else if ($antiguedad_meses >= 13 && $antiguedad_meses <= 24) {
        $descuento = 12;
    } else {
        $descuento = 20;
    }

    return $descuento;
}
function calcular_seguro_medico($cuota_base) {
    $seguro = $cuota_base * 0.05;
    return $seguro;
}

function calcular_cuota_final($cuota_base, $descuento_porcentaje, $seguro_medico) {
    $monto_desc = ($cuota_base * $descuento_porcentaje) / 100; 
    $cuota_total = $cuota_base - $monto_desc + $seguro_medico; 
    return $cuota_total;
}
?>
