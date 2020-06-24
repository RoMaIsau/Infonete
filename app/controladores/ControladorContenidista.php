<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/controladores/ControladorBasico.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/TipoProducto.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/Producto.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/Seccion.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/Edicion.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/ImagenEnServer.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/modelo/VistaPreviaNoticia.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioAltaProducto.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioAltaSeccion.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioCrearEdicion.php");
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/FormularioDeRedaccion.php");

class ControladorContenidista extends ControladorBasico {

    private $modeloProducto;
    private $modeloNoticias;
    private $modeloEdicionesEnProceso;

    public function __construct($modeloProducto, $modeloNoticias, $modeloEdicionesEnProceso, $renderizador) {
        $this->modeloProducto = $modeloProducto;
        $this->modeloNoticias = $modeloNoticias;
        $this->modeloEdicionesEnProceso = $modeloEdicionesEnProceso;
        $this->renderizador = $renderizador;
    }

    public function index() {

        $idContenidista = $this->usuarioLogueado->id();
        $productos = $this->modeloProducto->obtenerProductosPorUsuario($idContenidista);
        $this->data['productos'] = $productos;

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

    public function editarProducto() {
        $idProducto = $_GET['id'];
        $formulario = new FormularioAltaSeccion();
        $formulario->setIdProducto($idProducto);
        $this->data['formularioSeccion'] = $formulario;
        $this->data['producto'] = $this->modeloProducto->obtenerProductoPorId($idProducto);
        $this->data['secciones'] = $this->modeloProducto->obtenerSeccionesPorProducto($idProducto);
        $this->data['ediciones'] = $this->modeloProducto->obtenerEdicionesPorProducto($idProducto);

        $formularioEdicion = new FormularioCrearEdicion();
        $formularioEdicion->setIdProducto($idProducto);
        $this->data['formularioEdicion'] = $formularioEdicion;
        echo $this->renderizador->renderizar('vistas/contenidista/editarProducto.php', $this->data);
    }

    public function agregarSeccion() {
        $formulario = Mapeador::mapearPost("FormularioAltaSeccion");
        $idProducto = $formulario->idProducto();
        $nombre = $formulario->nombre();

        if (!$formulario->esInvalido()) {

            $this->modeloProducto->agregarSeccionAProducto($nombre, $idProducto);
        }

        $this->renderizador->redirect("contenidista/editarProducto?id=$idProducto");
    }

    public function crearEdicion() {
        $formulario = Mapeador::mapearPost("FormularioCrearEdicion");
        $this->modeloProducto->crearEdicion($formulario->precio(), $formulario->idProducto());
        $this->renderizador->redirect("contenidista/editarProducto?id={$formulario->idProducto()}");
    }

    public function editarEdicion() {
        $idEdicion = $_GET['id'];
        $edicion = $this->modeloProducto->obtenerEdicionPorId($idEdicion);
        $this->data['secciones'] = $this->modeloProducto->obtenerSeccionesPorProducto($edicion->producto()->id());
        $this->data['vistaPreviaNoticias'] = $this->modeloNoticias->obtenerVistaPreviaDeNoticiasPorEdicion($idEdicion);
        $this->data['edicion'] = $edicion;

        echo $this->renderizador->renderizar("vistas/contenidista/editarEdicion.php", $this->data);
    }

    public function redactar() {
        $formulario = Mapeador::mapearPost("FormularioDeRedaccion");
        $this->modeloNoticias->crearNoticia($formulario->idEdicion(), $formulario->idSeccion(), $formulario->titulo(),
            $formulario->subtitulo(), $formulario->contenido(), $formulario->imagenes(), $formulario->link(),
            $formulario->linkVideo());
        echo $this->renderizador->redirect("contenidista/editarEdicion?id={$formulario->idEdicion()}");
    }

    public function publicarEdicion() {
        $idEdicion = $_POST['idEdicion'];
        $this->modeloEdicionesEnProceso->publicarEdicion($idEdicion);
        echo $this->renderizador->redirect("contenidista/editarEdicion?id=$idEdicion");
    }
}
?>