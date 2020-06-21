<?php
class TipoProducto {

    private $id;
    private $nombre;

    function __construct($id, $nombre)  {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function id() {
        return $this->id;
    }

    public function nombre() {
        return $this->nombre;
    }

}