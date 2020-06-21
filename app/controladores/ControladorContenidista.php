<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/controladores/ControladorBasico.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/TipoProducto.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioAltaProducto.php");

class ControladorContenidista extends ControladorBasico {

    private $modeloProducto;

    public function __construct($modeloProducto, $renderizador) {
        $this->modeloProducto = $modeloProducto;
        $this->renderizador = $renderizador;
    }

    public function index() {
        echo $this->renderizador->renderizar('vistas/contenidista/index.php', $this->data);
    }

    public function altaProducto() {
        $this->data['tiposDeProducto'] = $this->modeloProducto->obtenerTiposDeProducto();
        $this->data['formulario'] = new FormularioAltaProducto();
        echo $this->renderizador->renderizar('vistas/contenidista/altaProducto.php', $this->data);
    }

    public function crearProducto() {
        $formulario = Mapeador::mapearPost("FormularioAltaProducto");
        if (!$formulario->esInvalido()) {
            $idProducto = $this->modeloProducto->crearProducto($formulario->nombre(), $formulario->precio(), $formulario->tipoProducto(), $this->usuarioLogueado->id());
            $this->renderizador->redirect("/contenidista/editarProducto?id=$idProducto");

        } else {

            $this->data['formulario'] = $formulario;
            $this->data['tiposDeProducto'] = $this->modeloProducto->obtenerTiposDeProducto();
            echo $this->renderizador->renderizar('vistas/contenidista/altaProducto.php', $this->data);
        }
    }
}
?>