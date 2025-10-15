<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Strict');
ini_set('session.gc_maxlifetime', 3600); // 1 hora de duración máxima
ini_set('session.use_strict_mode', 1);

session_start();

if (!isset($_SESSION['ultima_actividad']) || (time() - $_SESSION['ultima_actividad'] > 300)) {
    session_regenerate_id(true);
    $_SESSION['ultima_actividad'] = time();
}

function sanitizar_entrada($dato) {
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

function validar_numero($numero) {
    return filter_var($numero, FILTER_VALIDATE_FLOAT) !== false;
}

function mostrar_mensaje($mensaje, $tipo = 'error') {
    $clase = ($tipo == 'error') ? 'error' : 'exito';
    return "<div class='mensaje $clase'>".sanitizar_entrada($mensaje)."</div>";
}

echo '<style>
.mensaje {
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
}
.error {
    background-color: #ffebee;
    color: #c62828;
    border: 1px solid #ef9a9a;
}
.exito {
    background-color: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #a5d6a7;
}
</style>';
?>