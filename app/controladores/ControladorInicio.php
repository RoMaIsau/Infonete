<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/UsuarioLogueado.php");

class ControladorInicio {

    private $renderizador;

    public function __construct($renderizador) {
        $this->renderizador = $renderizador;
    }

    public function index() {
        $data = array();
        if (isset($_SESSION['usuario'])) {
            $data['usuario'] = unserialize($_SESSION['usuario']);
        }
        echo $this->renderizador->renderizar( "vistas/inicio.php", $data);
    }
}
?>