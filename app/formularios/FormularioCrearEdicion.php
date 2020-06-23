<?php
class FormularioCrearEdicion extends Formulario {
    private $precio;
    private $idProducto;

    public function obtenerCamposRequeridos() {
        return array("precio");
    }

    public function obtenerTodosLosCampos() {
        return array("precio", "idProducto");
    }

    public function getNombreDeFormulario() {
        return "FormularioCrearEdicion";
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function precio() {
        return $this->precio;
    }

    public function idProducto() {
        return $this->idProducto;
    }
}
?>