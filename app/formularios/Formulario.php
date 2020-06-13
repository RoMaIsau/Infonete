<?php
abstract class Formulario {
    abstract public function obtenerCamposRequeridos();
    abstract public function obtenerTodosLosCampos();
    abstract public function getNombreDeFormulario();

    public function __toString() {
        return $this->getNombreDeFormulario();
    }

    public function esRequerido($campo) {
        return in_array($campo, $this->obtenerCamposRequeridos());
    }

    public function seDebeMapear($campo) {
        return in_array($campo, $this->obtenerTodosLosCampos());
    }
}
?>