<?php
class Empleado {
    private string $nombre;
    private int $idEmpleado;
    private float $salarioBase;

    public function __construct(string $nombre, int $idEmpleado, float $salarioBase) {
        $this->setNombre($nombre);
        $this->setIdEmpleado($idEmpleado);
        $this->setSalarioBase($salarioBase);
    }

    // --- Getters y Setters ---
    public function getNombre(): string { return $this->nombre; }
    public function setNombre(string $nombre): void { $this->nombre = trim($nombre); }

    public function getIdEmpleado(): int { return $this->idEmpleado; }
    public function setIdEmpleado(int $id): void { $this->idEmpleado = $id; }

    public function getSalarioBase(): float { return $this->salarioBase; }
    public function setSalarioBase(float $salario): void { $this->salarioBase = $salario; }
}
