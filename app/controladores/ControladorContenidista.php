<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/controladores/ControladorBasico.php");


class ControladorContenidista extends ControladorBasico {

    public function __construct($renderizador) {
        $this->renderizador = $renderizador;
    }

    public function index() {
        echo $this->renderizador->renderizar('vistas/contenidista/index.php', $this->data);
    }
}
?>