<?php
require_once 'Gerente.php';
require_once 'Desarrollador.php';

class Empresa {
    private array $empleados = [];

    public function agregarEmpleado(Empleado $empleado): void {
        $this->empleados[] = $empleado;
    }

    public function listarEmpleados(): void {
        foreach ($this->empleados as $empleado) {
            $info = $empleado->getNombre() . " (ID: " . $empleado->getIdEmpleado() . ")";
            $info .= " - Salario base: $" . $empleado->getSalarioBase();

            if ($empleado instanceof Gerente) {
                $info .= " - Departamento: " . $empleado->getDepartamento();
            } elseif ($empleado instanceof Desarrollador) {
                $info .= " - Lenguaje: " . $empleado->getLenguajePrincipal();
                $info .= " - Nivel: " . $empleado->getNivelExperiencia();
            }

            echo $info . PHP_EOL;
        }
    }

    public function calcularNominaTotal(): float {
        $total = 0;
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Gerente) {
                $total += $empleado->getSalarioTotal();
            } else {
                $total += $empleado->getSalarioBase();
            }
        }
        return $total;
    }

    public function evaluarEmpleados(): void {
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Evaluable) {
                echo $empleado->getNombre() . " - Evaluación: " . $empleado->evaluarDesempenio() . PHP_EOL;
            } else {
                echo $empleado->getNombre() . " no es evaluable." . PHP_EOL;
            }
        }
    }
}
