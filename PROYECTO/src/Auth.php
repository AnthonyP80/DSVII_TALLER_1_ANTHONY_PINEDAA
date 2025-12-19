<?php

require_once __DIR__ . '/Database.php';

class Auth {

public static function login($correo, $contrasena) {
    $db = Database::getConnection();

    $stmt = $db->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id_usuario'],
            'nombre' => $usuario['nombre'],
            'rol' => $usuario['rol']
        ];
        return true;
    }

    return false;
}
public static function registrar($nombre, $correo, $contrasena) {
    $db = Database::getConnection();

    
    $stmt = $db->prepare("SELECT id_usuario FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);

    if ($stmt->fetch()) {
        return false; 
    }

    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $db->prepare(
        "INSERT INTO usuarios (nombre, correo, contrasena, rol)
         VALUES (?, ?, ?, 'usuario')"
    );

    $stmt->execute([$nombre, $correo, $hash]);
    return true;
}



    public static function check() {
        return isset($_SESSION['usuario']);
    }

    public static function isAdmin() {
        return self::check() && $_SESSION['usuario']['rol'] === 'admin';
    }

    public static function logout() {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}
