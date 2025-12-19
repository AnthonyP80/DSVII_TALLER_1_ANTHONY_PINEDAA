<?php
session_start();
require_once '../../src/Auth.php';
require_once '../../src/ExamenUsuarioManager.php';

if (!Auth::check()) {
    header("Location: ../../index.php");
    exit;
}

$examenes = ExamenUsuarioManager::obtenerExamenesActivos();

?>

<link rel="stylesheet" href="../../public/assets/css/estilos.css">

<div class="contenedor">
    <div class="card">

        <div class="header">
            <h1>Exámenes Disponibles</h1>
        </div>

        <?php foreach ($examenes as $e): ?>
            <?php
                $yaHecho = ExamenUsuarioManager::yaRealizado(
                    $_SESSION['usuario']['id'],
                    $e['id_examen']
                );
            ?>
            <div style="border:1px solid #ddd; padding:15px; margin-bottom:10px; border-radius:5px;">
                <strong><?= htmlspecialchars($e['titulo']) ?></strong><br>
                Tiempo límite: <?= $e['tiempo_limite'] ?> minutos<br><br>

                <?php if ($yaHecho): ?>
                    <span style="color:red">❌ Ya realizaste este examen</span>
                <?php else: ?>
                    <a class="btn" href="realizar_examen.php?id=<?= $e['id_examen'] ?>">
                        📝 Realizar Examen
                    </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <br>
        <a href="dashboard.php">⬅ Volver</a>

    </div>
</div>
