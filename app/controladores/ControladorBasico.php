<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/UsuarioLogueado.php");
abstract class ControladorBasico {

    protected $data;
    protected $usuarioLogueado;

    public function preAccion() {
        if (isset($_SESSION['usuario'])) {
            $this->usuarioLogueado = unserialize($_SESSION['usuario']);
            $this->data['usuario'] = $this->usuarioLogueado;
        }
    }

}