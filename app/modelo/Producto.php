<?php
class Producto {
    private $id;
    private $nombre;
    private $tipo;
    private $precio;

    function __construct($id, $nombre, $tipo, $precio) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->precio = $precio;
    }

    public function id() {
        return $this->id;
    }

    public function nombre() {
        return $this->nombre;
    }

    public function tipo() {
        return $this->tipo;
    }

    public function precio() {
        return $this->precio;
    }

}