<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Desarrollador extends Empleado implements Evaluable {
    private string $lenguajePrincipal;
    private string $nivelExperiencia; // Junior, Semi-senior, Senior

    public function __construct(string $nombre, int $idEmpleado, float $salarioBase, string $lenguaje, string $nivel) {
        parent::__construct($nombre, $idEmpleado, $salarioBase);
        $this->lenguajePrincipal = $lenguaje;
        $this->nivelExperiencia = $nivel;
    }

    public function getLenguajePrincipal(): string { return $this->lenguajePrincipal; }
    public function setLenguajePrincipal(string $lenguaje): void { $this->lenguajePrincipal = $lenguaje; }

    public function getNivelExperiencia(): string { return $this->nivelExperiencia; }
    public function setNivelExperiencia(string $nivel): void { $this->nivelExperiencia = $nivel; }

    public function evaluarDesempenio(): string {
        switch (strtolower($this->nivelExperiencia)) {
            case 'senior':
                return "Excelente desempeño";
            case 'semi-senior':
                return "Desempeño bueno";
            default:
                return "Necesita mejorar";
        }
    }
}
