<?php


class Rol {
    private $id;
    private $descripcion;

    public function __construct($id, $descripcion) {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }

    public function id() {
        return $this->id;
    }

    public function descripcion() {
        return $this->descripcion;
    }
}
?>