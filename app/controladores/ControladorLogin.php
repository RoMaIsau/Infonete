<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/helper/Mapeador.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioDeLogin.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/MensajeDeError.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/UsuarioLogueado.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/excepciones/LoginInvalidoException.php");

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
            try {
                $data["usuario"] = $this->modeloUsuario->login($formularioDeLogin->getEmail(),
                    $formularioDeLogin->getPassword());
                $_SESSION["usuario"] = serialize($data["usuario"]);
                $this->renderizador->redirect("inicio");
            }catch(LoginInvalidoException $e) {
                $data["error"] = new MensajeDeError("Usuario o contraseña inválidos");
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