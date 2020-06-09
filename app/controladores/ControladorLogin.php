<?php


class ControladorLogin {

    private $renderizador;

    public function __construct($renderizador) {
        $this->renderizador = $renderizador;
    }

    public function index() {
        echo $this->renderizador->renderizar( "vistas/login.php");
    }
}
?>