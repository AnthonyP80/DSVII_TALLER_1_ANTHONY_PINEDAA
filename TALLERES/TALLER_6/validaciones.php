<?php

function validarNombre($v){ return preg_match('/^[A-Za-z\s]{2,50}$/', $v); }
function validarEmail($v){ return filter_var($v,FILTER_VALIDATE_EMAIL); }
function validarSitio_web($v){ return empty($v) || filter_var($v,FILTER_VALIDATE_URL); }
function validarGenero($v){ return in_array($v,['M','F']); }
function validarIntereses($v){ return is_array($v); }
function validarComentarios($v){ return strlen($v) <= 500; }
function validarFecha_nacimiento($v){
    $ts = strtotime($v);
    return $ts !== false && $ts <= time(); // No futura
}
function validarFotoPerfil($file){
    $permitidos = ['image/jpeg','image/png','image/gif'];
    return in_array($file['type'], $permitidos) && $file['size'] <= 2*1024*1024;
}

?>