<?php

class ControladorHolaMundo {

    private $renderizador;

    public function __construct($renderizador) {
        $this->renderizador = $renderizador;
    }

    public function index() {
        echo $this->renderizador->renderizar( "vistas/holaMundo.php");
    }
}

?>