<?php
require_once("helper/Renderizador.php");
include_once ("helper/BaseDeDatos.php");
include_once ("helper/Configuracion.php");
require_once('third-party/mustache/src/Mustache/Autoloader.php');

class InicializadorDeModulos {

    private $renderizador;
    private $baseDeDatos;
    private $configuracion;

    public function __construct() {
        $this->renderizador = new Renderizador('vistas/partial');
        $this->configuracion = new Configuracion("configuracion/config.ini");
        $this->baseDeDatos = BaseDeDatos::createDatabaseFromConfig($this->configuracion);
    }

    public function crearControladorHolaMundo() {
        include_once("controladores/ControladorHolaMundo.php");
        return new ControladorHolaMundo($this->renderizador);
    }

    public function crearControladorInicio() {
        include_once ("controladores/ControladorInicio.php");
        return new ControladorInicio($this->renderizador);
    }

    public function crearControladorLogin() {
        include_once ("controladores/ControladorLogin.php");
        return new ControladorLogin($this->renderizador);
    }

    public function crearControladorDefault() {
        return $this->crearControladorHolaMundo();
    }
}
?>