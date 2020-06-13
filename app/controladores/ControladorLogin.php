<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/helper/Mapeador.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioDeLogin.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/MensajeDeError.php");

class ControladorLogin {

    private $renderizador;
    private $modeloUsuario;

    public function __construct($modeloUsuario, $renderizador) {
        $this->modeloUsuario = $modeloUsuario;
        $this->renderizador = $renderizador;
    }

    public function index() {
        echo $this->renderizador->renderizar( "vistas/login.php");
    }

    public function ingresar() {

        $formularioDeLogin = Mapeador::mapearPost("FormularioDeLogin");

        $data["usuario"] = $this->modeloUsuario->buscarPorCorreoYContrasenia($formularioDeLogin->getEmail(), $formularioDeLogin->getPassword());

        if (empty($data["usuario"])){
            $data = array("error" => new MensajeDeError("Usuario o contraseña inválidos"));
            $vista = "vistas/login.php";
        } else {
            $vista = "vistas/inicio.php";
            $this->renderizador->redirect("inicio");
        }

        echo $this->renderizador->renderizar($vista, $data);
    }
}
?>