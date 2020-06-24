<?php
require_once("helper/Renderizador.php");
include_once ("helper/BaseDeDatos.php");
include_once ("helper/Configuracion.php");
include_once ("helper/Consultas.php");
include_once ("controladores/ControladorBasico.php");
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
        include_once ("modelo/ModeloEdicionesPendientes.php");
        include_once ("modelo/EstadoEdicion.php");
        include_once ("modelo/Edicion.php");
        $modeloUsuario = new ModeloUsuario($this->baseDeDatos);
        $modeloEdicionesPendientes = new ModeloEdicionesPendientes($this->baseDeDatos);
        return new ControladorAdministracion($modeloUsuario, $modeloEdicionesPendientes, $this->renderizador);
    }

    public function crearControladorContenidista() {
        include_once ("controladores/ControladorContenidista.php");
        include_once ("modelo/ModeloProducto.php");
        include_once ("modelo/ModeloNoticias.php");
        include_once ("modelo/EstadoEdicion.php");
        include_once ("modelo/ModeloEdicionesEnProceso.php");
        $modeloProducto = new ModeloProducto($this->baseDeDatos);
        $modeloNoticias = new ModeloNoticias($this->baseDeDatos);
        $modeloEdicionesEnProceso = new ModeloEdicionesEnProceso(($this->baseDeDatos));
        return new ControladorContenidista($modeloProducto, $modeloNoticias, $modeloEdicionesEnProceso, $this->renderizador);
    }
}
?>