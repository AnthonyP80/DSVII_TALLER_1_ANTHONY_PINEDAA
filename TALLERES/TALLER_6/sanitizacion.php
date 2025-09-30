<?php
function sanitizarNombre($v){ return filter_var(trim($v), FILTER_SANITIZE_STRING); }
function sanitizarEmail($v){ return filter_var(trim($v), FILTER_SANITIZE_EMAIL); }
function sanitizarFecha_nacimiento($v){ return trim($v); }
function sanitizarSitio_web($v){ return filter_var(trim($v), FILTER_SANITIZE_URL); }
function sanitizarGenero($v){ return trim($v); }
function sanitizarIntereses($v){ return array_map('trim',$v); }
function sanitizarComentarios($v){ return htmlspecialchars(trim($v)); }

