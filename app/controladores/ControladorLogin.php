<?php
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
        include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/MensajeDeError.php");

        $email = $_POST["email"];
        $contraseniaUsuario = $_POST["password"];

        $data["usuario"] = $this->modeloUsuario->buscarPorCorreoYContrasenia($email,$contraseniaUsuario);

        if (empty($data["usuario"])){
            $data = array("error" => new MensajeDeError("Usuario o contraseña inválidos"));
            $vista = "vistas/login.php";
        } else {
            $vista = "vistas/inicio.php";
        }

        echo $this->renderizador->renderizar($vista, $data);
    }
}
?>