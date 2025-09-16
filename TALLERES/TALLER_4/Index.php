<?php
require_once 'Empresa.php';

// Crear empleados
$gerente1 = new Gerente("Laura Gómez", 101, 5000, "Marketing");
$desarrollador1 = new Desarrollador("Carlos Pérez", 102, 3500, "PHP", "Senior");
$desarrollador2 = new Desarrollador("Ana Martínez", 103, 3000, "JavaScript", "Junior");

// Asignar bonos
$gerente1->asignarBono(1000);

// Crear empresa y agregar empleados
$empresa = new Empresa();
$empresa->agregarEmpleado($gerente1);
$empresa->agregarEmpleado($desarrollador1);
$empresa->agregarEmpleado($desarrollador2);

// Listar empleados
echo "=== Listado de empleados ===" . PHP_EOL;
$empresa->listarEmpleados();
echo PHP_EOL;

// Calcular nómina
echo "Nómina total: $" . $empresa->calcularNominaTotal() . PHP_EOL . PHP_EOL;

// Evaluar empleados
echo "=== Evaluación de desempeño ===" . PHP_EOL;
$empresa->evaluarEmpleados();
