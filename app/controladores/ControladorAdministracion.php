<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/Rol.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioDeRegistro.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/helper/Mapeador.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/excepciones/EmailEnUsoException.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/MensajeDeError.php");
class ControladorAdministracion extends ControladorBasico {
    private $modeloUsuario;
    private $modeloEdicionesPendientes;

    public function __construct($modeloUsuario, $modeloEdicionesPendientes, $renderizador) {
        $this->modeloUsuario = $modeloUsuario;
        $this->modeloEdicionesPendientes = $modeloEdicionesPendientes;
        $this->renderizador = $renderizador;
    }

    public function index() {
        echo $this->renderizador->renderizar('vistas/administracion.php', $this->data);
    }

    public function altaUsuario() {
        $formulario = new FormularioDeRegistro();
        $roles = $this->modeloUsuario->listarRoles();
        $this->data['roles'] = $roles;
        $this->data['formulario'] = $formulario;
        echo $this->renderizador->renderizar('vistas/altaUsuario.php', $this->data);
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
                    $this->data["error"] = new MensajeDeError("El email ingresado ya esta en uso");
                    $roles = $this->modeloUsuario->listarRoles();
                    $this->data['roles'] = $roles;
                    $this->data['formulario'] = $formulario;
                }
            }

        } else {
            $roles = $this->modeloUsuario->listarRoles();
            $this->data['roles'] = $roles;
            $this->data['formulario'] = $formulario;
        }
        echo $this->renderizador->renderizar($vista, $this->data);
    }

    public function edicionesPendientes() {

        $this->data['ediciones'] = $this->modeloEdicionesPendientes->obtenerEdiciones();
        echo $this->renderizador->renderizar('vistas/administracion/edicionesPendientes.php', $this->data);
    }

    public function aprobarEdicion() {
        $idEdicion = $_POST['idEdicion'];
        $this->modeloEdicionesPendientes->aprobarEdicion($idEdicion);
        $this->renderizador->redirect('administracion');
    }
}
?>