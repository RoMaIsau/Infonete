<?php
abstract class Formulario {

    private $esInvalido = false;
    private $camposInvalidos = array();

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

    public function esInvalido() {
        return $this->esInvalido;
    }

    public function getCamposInvalidos() {
        return $this->camposInvalidos;
    }

    public function marcarCampoSinCompletar($campo) {
        $this->esInvalido = true;
        $error = array('campo' => $campo, 'mensaje' => "Es requerido");
        array_push($this->camposInvalidos, $error);
    }
}
?>