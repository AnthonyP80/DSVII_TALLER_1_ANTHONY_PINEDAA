<?php
include "config_sesion.php";
requireRole("profesor");
include "Data_sistema.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel del Profesor</title>
</head>
<body>

<h2>Bienvenido Profesor, <?php echo $_SESSION["usuario"]["nombre"]; ?></h2>
<h3>Lista de Estudiantes y sus Calificaciones</h3>

<table border= "0" cellpadding="10">
    <tr>
        <th>Estudiante</th>
        <th>Asignatura</th>
        <th>Calificación</th>
    </tr>

    <?php
    foreach ($notas as $n) {

        $estudianteNombre = "";
        foreach ($usuarios as $u) {
            if ($u["id"] == $n["estudiante"]) {
                $estudianteNombre = $u["nombre"];
            }
        }
        $asignaturaNombre = $asignaturas[$n["asignatura"]];
        ?>
        <tr>
            <td><?php echo $estudianteNombre; ?></td>
            <td><?php echo $asignaturaNombre; ?></td>
            <td><?php echo $n["calificacion"]; ?></td>
        </tr>
    <?php } ?>
</table>
<br>
<a href="logout.php">Cerrar sesión</a>

</body>
</html>

