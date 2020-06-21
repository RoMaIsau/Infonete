<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/Formulario.php");
class FormularioAltaProducto extends Formulario {

    private $nombre;
    private $precio;
    private $tipoProducto;

    public function obtenerCamposRequeridos() {
        return array('nombre', 'precio', 'tipoProducto');
    }

    public function obtenerTodosLosCampos() {
        return array('nombre', 'precio', 'tipoProducto');
    }

    public function getNombreDeFormulario() {
        return "FormularioAltaProducto";
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setTipoProducto($tipoProducto) {
        $this->tipoProducto = $tipoProducto;
    }

    public function nombre() {
        return $this->nombre;
    }

    public function precio() {
        return $this->precio;
    }

    public function tipoProducto() {
        return $this->tipoProducto;
    }

}