<?php
class Seccion {

    private $id;
    private $nombre;
    private $idProducto;

    function __construct($id, $nombre, $idProducto) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->idProducto = $idProducto;
    }

    public function id() {
        return $this->id;
    }

    public function nombre() {
        return $this->nombre;
    }

    public function idProducto() {
        return $this->idProducto;
    }
}