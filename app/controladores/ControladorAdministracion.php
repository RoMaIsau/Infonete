<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/Rol.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioDeRegistro.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/helper/Mapeador.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/excepciones/EmailEnUsoException.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/MensajeDeError.php");



class ControladorAdministracion {
    private $modeloUsuario;
    private $renderizador;

    public function __construct($modeloUsuario, $renderizador) {
        $this->modeloUsuario = $modeloUsuario;
        $this->renderizador = $renderizador;
    }

    public function index() {
        echo $this->renderizador->renderizar('vistas/administracion.php');
    }

    public function altaUsuario() {
        $formulario = new FormularioDeRegistro();
        $roles = $this->modeloUsuario->listarRoles();
        $data['roles'] = $roles;
        $data['formulario'] = $formulario;
        echo $this->renderizador->renderizar('vistas/altaUsuario.php', $data);
    }

    public function registrarUsuario(){
        $formulario = Mapeador::mapearPost("FormularioDeRegistro");
        $vista = 'vistas/altaUsuario.php';

        if (!$formulario->esInvalido()) {

            if ($formulario->contraseniasIguales()) {
                try {
                    $this->modeloUsuario->registrar($formulario);
                    $this->renderizador->redirect("administracion");
                } catch (EmailEnUsoException $e) {
                    $data["error"] = new MensajeDeError("El email ingresado ya esta en uso");
                    $roles = $this->modeloUsuario->listarRoles();
                    $data['roles'] = $roles;
                    $data['formulario'] = $formulario;
                }
            }

        } else {
            $roles = $this->modeloUsuario->listarRoles();
            $data['roles'] = $roles;
            $data['formulario'] = $formulario;
        }
        echo $this->renderizador->renderizar($vista, $data);
    }
}
?>