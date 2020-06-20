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

        if(isset($_SESSION["usuario"])) {
            $this->renderizador->redirect("inicio");
        }
        $data["formularioDeLogin"] = new FormularioDeLogin();
        echo $this->renderizador->renderizar( "vistas/login.php", $data);
    }

    public function ingresar() {

        $formularioDeLogin = Mapeador::mapearPost("FormularioDeLogin");

        $data["formularioDeLogin"] = $formularioDeLogin;
        $vista = "vistas/login.php";

        if (!$formularioDeLogin->esInvalido()) {

            $data["usuario"] = $this->modeloUsuario->login($formularioDeLogin->getEmail(),
                $formularioDeLogin->getPassword());

            if (empty($data["usuario"])){
                $data["error"] = new MensajeDeError("Usuario o contraseña inválidos");
            } else {
                $_SESSION["usuario"] = $data["usuario"];
                $this->renderizador->redirect("inicio");
            }
        }

        echo $this->renderizador->renderizar($vista, $data);
    }

    public function salir() {
        session_destroy();
        $this->renderizador->redirect("inicio");
    }
}
?>