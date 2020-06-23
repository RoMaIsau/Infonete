<?php
class Edicion {
    private $id;
    private $numero;
    private $fecha;
    private $precio;
    private $estado;

    function __construct($id, $numero, $fecha, $precio, $estado) {
        $this->id = $id;
        $this->numero = $numero;
        $this->fecha = $fecha;
        $this->precio = $precio;
        $this->estado = $estado;
    }

    public function id() {
        return $this->id;
    }

    public function numero() {
        return $this->numero;
    }

    public function fecha() {
        return $this->fecha;
    }

    public function precio() {
        return $this->precio;
    }

    public function estado() {
        return $this->estado;
    }
}
?>