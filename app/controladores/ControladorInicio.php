<?php


class ControladorInicio {

    private $renderizador;

    public function __construct($renderizador) {
        $this->renderizador = $renderizador;
    }

    public function index() {
        $data = array();
        if (isset($_SESSION['usuario'])) {
            $data['usuario'] = $_SESSION['usuario'];
        }
        echo $this->renderizador->renderizar( "vistas/inicio.php", $data);
    }
}
?>