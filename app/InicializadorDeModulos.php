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
        include_once ("modelo/ModeloUsuario.php");
        $modeloUsuario = new ModeloUsuario($this->baseDeDatos);
        return new ControladorLogin($modeloUsuario, $this->renderizador);
    }

    public function crearControladorRegistro() {
        include_once ("controladores/ControladorRegistro.php");
        include_once ("modelo/ModeloUsuario.php");
        $modeloUsuario = new ModeloUsuario($this->baseDeDatos);
        return new ControladorRegistro($modeloUsuario, $this->renderizador);
    }

    public function crearControladorDefault() {
        return $this->crearControladorHolaMundo();
    }

    public function crearControladorAdministracion() {
        include_once ("controladores/ControladorAdministracion.php");
        include_once ("modelo/ModeloUsuario.php");
        $modeloUsuario = new ModeloUsuario($this->baseDeDatos);
        return new ControladorAdministracion($modeloUsuario, $this->renderizador);
    }
}
?>