<?php
include "config_sesion.php";   
requireRole("estudiante");      
include "Data_sistema.php";          

$usuarioActual = $_SESSION["usuario"];    
$miID = $usuarioActual["id"];             
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mi Panel - Estudiante</title>
</head>
<body>

<h2>Estudiante, <?php echo $usuarioActual["nombre"]; ?></h2>
<h3>Mis Calificaciones</h3>

<table border="0" cellpadding="10">
    <tr>
        <th>Asignatura</th>
        <th>Calificación</th>
    </tr>

    <?php
    $tieneNotas = false;

    foreach ($notas as $n) {
        if ($n["estudiante"] == $miID) {
            $tieneNotas = true;
            $asignaturaNombre = $asignaturas[$n["asignatura"]];
            ?>
            <tr>
                <td><?php echo $asignaturaNombre; ?></td>
                <td><?php echo $n["calificacion"]; ?></td>
            </tr>
            <?php
        }
    }

    if (!$tieneNotas) {
        echo "<tr>La Estudiante No tienes calificaciones registradas.</tr>";
    }
    ?>

</table>

<br>
<a href="logout.php">Cerrar sesión</a>

</body>
</html>


