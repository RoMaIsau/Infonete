<?php


class FormularioAltaSeccion extends Formulario {
    private $nombre;
    private $idProducto;

    public function obtenerCamposRequeridos() {
        return array('nombre', 'idProducto');
    }

    public function obtenerTodosLosCampos() {
        return array('nombre', 'idProducto');
    }

    public function getNombreDeFormulario() {
        return "FormularioAltaSeccion";
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    public function nombre() {
        return $this->nombre;
    }

    public function idProducto() {
        return $this->idProducto ;
    }

 }
?>