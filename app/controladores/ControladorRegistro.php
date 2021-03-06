<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/MensajeDeError.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioDeRegistro.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/helper/Mapeador.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/excepciones/EmailEnUsoException.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/UsuarioLogueado.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/Rol.php");

class ControladorRegistro {

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
        $data["formularioRegistro"] = new FormularioDeRegistro();
        $data["rol"] = $this->modeloUsuario->obtenerRolLector();

        echo $this->renderizador->renderizar( "vistas/registro.php", $data);
    }

    public function registrar() {

        $formularioDeRegistro = Mapeador::mapearPost("FormularioDeRegistro");

        $vista = "vistas/registro.php";
        $data["formularioRegistro"] = $formularioDeRegistro;

        if ($formularioDeRegistro->esInvalido() == false) {

            if ($formularioDeRegistro->contraseniasIguales()) {
                try {
                    $this->modeloUsuario->registrar($formularioDeRegistro);
                    $usuario = $this->modeloUsuario->login($formularioDeRegistro->getEmail(),
                        $formularioDeRegistro->getPassword());
                    $_SESSION["usuario"] = serialize($usuario);
                    $this->renderizador->redirect("inicio");
                } catch (EmailEnUsoException $e) {
                    $data["error"] = new MensajeDeError("El email ingresado ya esta en uso");
                }
            } else{
                $data["error"] = new MensajeDeError("Las contraseñas no coinciden");
            }
        }
        echo $this->renderizador->renderizar($vista, $data);
    }
}
?>