<?php
class MensajeDeError {
    private $mensaje;

    public function __construct($mensaje){
        $this->mensaje = $mensaje;
    }
    public function mensaje() {
        return $this->mensaje;
    }
}
?>