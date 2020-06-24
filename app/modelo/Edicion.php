<?php
class Edicion {
    private $id;
    private $numero;
    private $fecha;
    private $precio;
    private $estado;
    private $producto;

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

    public function agregarProducto($producto) {
        $this->producto = $producto;
    }

    public function producto() {
        return $this->producto;
    }

    public function puedePublicarse() {
        return $this->estado == EstadoEdicion::EN_PROCESO();
    }

    public function puedeAprobarse() {
        return $this->estado == EstadoEdicion::PENDIENTE();
    }
}
?>