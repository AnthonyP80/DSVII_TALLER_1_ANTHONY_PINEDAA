<?php

$usuarios = [
    [
        "id" => 1,
        "username" => "Lu3",
        "password" => "12345",
        "rol" => "profesor",
        "nombre" => "Luis Lopez"
    ],
    [
        "id" => 2,
        "username" => "ter",
        "password" => "abcde",
        "rol" => "estudiante",
        "nombre" => "Ana Martínez"
    ],
    [
        "id" => 3,
        "username" => "Luc",
        "password" => "qwert",
        "rol" => "estudiante",
        "nombre" => "Anthony Pineda"
    ],
    [
        "id" => 4,
        "username" => "Man",
        "password" => "qwert",
        "rol" => "estudiante",
        "nombre" => "Manuela Pérez"
    ],

];

$asignaturas = [
    1 => "Desarrollo de Software",
    2 => "Base de Datos",
    3 => "Civer Seguridad",
    4 => "Redes",
];

$notas = [
    ["estudiante" => 2, "asignatura" => 1, "calificacion" => 95],
    ["estudiante" => 2, "asignatura" => 2, "calificacion" => 88],
    ["estudiante" => 2, "asignatura" => 3, "calificacion" => 88],
    ["estudiante" => 2, "asignatura" => 4, "calificacion" => 70],

    ["estudiante" => 3, "asignatura" => 1, "calificacion" => 76],
    ["estudiante" => 3, "asignatura" => 2, "calificacion" => 90],
    ["estudiante" => 3, "asignatura" => 3, "calificacion" => 85],
    ["estudiante" => 3, "asignatura" => 4, "calificacion" => 75],

    ["estudiante" => 4, "asignatura" => 1, "calificacion" => 65],
    ["estudiante" => 4, "asignatura" => 2, "calificacion" => 85],
    ["estudiante" => 4, "asignatura" => 3, "calificacion" => 63],
    ["estudiante" => 4, "asignatura" => 4, "calificacion" => 71],

];