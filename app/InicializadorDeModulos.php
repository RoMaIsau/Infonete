<?php
require_once("helper/Renderizador.php");
require_once('third-party/mustache/src/Mustache/Autoloader.php');

class InicializadorDeModulos {

    private $renderizador;

    public function __construct() {
        $this->renderizador = new Renderizador('vistas/partial');
    }

    public function crearControladorHolaMundo() {
        include_once("controladores/ControladorHolaMundo.php");
        return new ControladorHolaMundo($this->renderizador);
    }

    public function crearControladorDefault() {
        return $this->crearControladorHolaMundo();
    }
}
?>