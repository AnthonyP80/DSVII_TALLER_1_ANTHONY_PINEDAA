<?php
$archivo = 'datos.json';
$registros = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Resumen</title></head>
<body>
<h1>Resumen de Registros</h1>
<?php if (empty($registros)): ?>
    <p>No hay registros aún.</p>
<?php else: ?>
<table border="1">
    <tr>
        <th>Nombre</th><th>Email</th><th>Edad</th><th>Género</th><th>Intereses</th><th>Foto</th>
    </tr>
    <?php foreach ($registros as $r): ?>
    <tr>
        <td><?= htmlspecialchars($r['nombre']) ?></td>
        <td><?= htmlspecialchars($r['email']) ?></td>
        <td><?= htmlspecialchars($r['edad']) ?></td>
        <td><?= htmlspecialchars($r['genero']) ?></td>
        <td><?= implode(", ", $r['intereses']) ?></td>
        <td><img src="<?= htmlspecialchars($r['foto_perfil']) ?>" width="60"></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
<br><a href="formulario.php">Volver al formulario</a>
</body>
</html>
