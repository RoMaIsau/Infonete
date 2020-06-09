<?php
class ControladorRegistro {

    private $renderizador;
    private $modeloUsuario;

    public function __construct($modeloUsuario, $renderizador) {
        $this->modeloUsuario = $modeloUsuario;
        $this->renderizador = $renderizador;
    }

    public function index() {
        echo $this->renderizador->renderizar( "vistas/registro.php");
    }

    public function registrar() {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $usuario = $_POST["usuario"];
        $email = $_POST["email"];
        $contraseniaUsuario = $_POST["password"];

        $data["usuario"] = $this->modeloUsuario->registrar( $nombre, $apellido, $usuario, $email,$contraseniaUsuario);
        echo $this->renderizador->renderizar( "vistas/registro.php");
    }
}
?>