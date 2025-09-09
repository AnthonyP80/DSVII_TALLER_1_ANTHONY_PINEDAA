<?php
function contar_palabras_repetidas($Stexto) {
    $texto = strtolower(trim($Stexto));
    $palabras = explode(" ", $texto);

    $resultado = array();

    foreach ($palabras as $pal) {
        if ($pal != "") {
            if (isset($resultado[$pal])) {
                $resultado[$pal] = $resultado[$pal] + 1;
            } else {
                $resultado[$pal] = 1; 
            }
        }
    }

    return $resultado;
}

function capitalizar_palabras($Stexto) {
    $palabras = explode(" ", trim($Stexto));
    $nuevo = array();

    foreach ($palabras as $p) {
        if ($p != "") {
            $primera = strtoupper(substr($p, 0, 1));
            $resto = strtolower(substr($p, 1));
            $nuevo[] = $primera . $resto;
        }
    }

    $texto_final = implode(" ", $nuevo);
    return $texto_final;
}
?>
