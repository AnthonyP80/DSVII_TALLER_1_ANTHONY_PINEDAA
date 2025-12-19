<?php

require_once 'src/Database.php';

$db = Database::getConnection();
$sql = file_get_contents('database/migrations/001_crear_tablas.sql');

$db->exec($sql);

echo "Migraciones ejecutadas correctamente";
