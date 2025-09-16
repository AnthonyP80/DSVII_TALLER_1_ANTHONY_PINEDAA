<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Gerente extends Empleado implements Evaluable {
    private string $departamento;
    private float $bono = 0;

    public function __construct(string $nombre, int $idEmpleado, float $salarioBase, string $departamento) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->departamento = $departamento;
    }

    public function getDepartamento(): string { return $this->departamento; }
    public function setDepartamento(string $departamento): void { $this->departamento = $departamento; }

    public function asignarBono(float $monto): void {
        $this->bono += $monto;
    }

    public function getSalarioTotal(): float {
        return $this->getSalarioBase() + $this->bono;
    }

    public function evaluarDesempenio(): string {
        if ($this->bono > 0) {
            return "Excelente desempeño";
        }
        return "Desempeño aceptable";
    }
}
