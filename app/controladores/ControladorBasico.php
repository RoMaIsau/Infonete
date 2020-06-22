<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/UsuarioLogueado.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/helper/Mapeador.php");
abstract class ControladorBasico {

    protected $data;
    protected $usuarioLogueado;
    protected $renderizador;

    public function preAccion() {
        if (isset($_SESSION['usuario'])) {
            $this->usuarioLogueado = unserialize($_SESSION['usuario']);
            $this->data['usuario'] = $this->usuarioLogueado;
        }
    }
}
?>