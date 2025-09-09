<?php
include "operaciones_cadenas.php";

$frases = array (
    "tres por tres es igual a nueve nueve",
    "Hola hola mundo mundo",
    "PHP es un exelente Lenguaje de programacion",
    "La vida te da sorpresas sorpresas te da la vida",
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Procesador Frases</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: auto; }
        th, td { padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        td { border-top: 1px solid #ccc; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Resultado Final</h2>
    <table>
        <tr>
            <th>Frase Original</th>
            <th>Conteo Palabras</th>
            <th>Capitalizada</th>
        </tr>
        <?php
        foreach ($frases as $f) {
            $conteo = contar_palabras_repetidas($f);
            $capi = capitalizar_palabras($f);

            echo "<tr>";
            echo "<td>".$f."</td>";
            echo "<td>";
            foreach ($conteo as $pal => $cant) {
                echo $pal." => ", "[".$cant."]", "<br>";
            }
            echo "</td>";
            echo "<td>".$capi."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
