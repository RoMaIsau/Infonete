<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/helper/Consultas.php");

class ModeloProducto {

    const EDICION_EN_PROCESO = "EN PROCESO";
    const UBICACION_IMAGENES = "imagenes";

    private $conexion;

    public function __construct($baseDeDatos) {
        $this->conexion = $baseDeDatos;
    }

    public function obtenerTiposDeProducto() {
        $tiposDeProducto = array();
        $resultado = $this->conexion->query(Consultas::OBTENER_TIPOS_DE_PRODUCTOS());
        for($i = 0; $i < count($resultado); $i++) {
            $tipoProducto = $resultado[$i];
            array_push($tiposDeProducto, new TipoProducto($tipoProducto['id'], $tipoProducto['nombre']));
        }

        return $tiposDeProducto;
    }

    public function crearProducto($nombre, $precio, $tipoProducto, $idUsuario) {
        $consulta = Consultas::INSERTAR_PRODUCTO($nombre, $tipoProducto, $idUsuario);
        $idProducto = $this->conexion->insert($consulta);
        $this->crearDetalleProducto($idProducto, $precio);
        return $idProducto;
    }

    public function obtenerProductosPorUsuario($idContenidista) {
        $productos = array();
        $resultado = $this->conexion->query(Consultas::OBTENER_PRODUCTOS_POR_USUARIO($idContenidista));
        for($i = 0; $i < count($resultado); $i++) {
            $producto = $resultado[$i];
            array_push($productos, new Producto($producto['id'], $producto['nombre'], $producto['tipo'], $producto['precio']));
        }
        return $productos;
    }

    public function obtenerProductoPorId($idProducto) {
        $resultado = $this->conexion->query(Consultas::OBTENER_PRODUCTO_POR_ID($idProducto));
        $producto = $resultado[0];
        return new Producto($producto['id'], $producto['nombre'], $producto['tipo'], $producto['precio']);
    }

    public function agregarSeccionAProducto($nombre, $idProducto) {
        return $this->conexion->insert(Consultas::INSERTAR_SECCION($nombre, $idProducto));
    }

    public function obtenerSeccionesPorProducto($idProducto) {
        $resultado = $this->conexion->query(Consultas::OBTENER_SECCIONES_POR_PRODUCTO($idProducto));
        $secciones = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $seccion = $resultado[$i];
            array_push($secciones, new Seccion($seccion['id'], $seccion['nombre'], $seccion['idProducto']));
        }

        return $secciones;
    }

    public function obtenerEdicionesPorProducto($idProducto) {
        $resultado = $this->conexion->query(Consultas::OBTENER_EDICIONES_POR_PRODUCTO($idProducto));
        $ediciones = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $edicion = $resultado[$i];
            array_push($ediciones, new Edicion($edicion['id'], $edicion['nro'], $edicion['fecha'], $edicion['precio'], $edicion['estado']));
        }
        return $ediciones;
    }

    public function crearEdicion($precio, $idProducto) {
        $numero = $this->obtenerNumero($idProducto);
        $estado = self::EDICION_EN_PROCESO;
        $this->conexion->insert(Consultas::INSERTAR_EDICION($numero, $precio, $idProducto, $estado));
    }

    private function crearDetalleProducto($idProducto, $precio) {
        $this->conexion->insert(Consultas::INSERTAR_DETALLE_PRODUCTO($precio, $idProducto));
    }

    private function obtenerNumero($idProducto) {
        $numero = 1;
        $resultado = $this->conexion->query(Consultas::OBTENER_NUMERO_MAXIMO_DE_EDICION($idProducto));
        if (!empty($resultado) && isset($resultado[0]['numero'])) {
            $numero = $resultado[0]['numero'] + 1;
        }
        return $numero;
    }

    public function obtenerEdicionPorId($idEdicion) {
        $resultado = $this->conexion->query(Consultas::OBTENER_EDICION_POR_ID($idEdicion));
        $edicion = $resultado[0];

        $producto = new Producto($edicion['idProducto'], $edicion['nombreProducto'], $edicion['tipo'], $edicion['precioProducto']);
        $edicion = new Edicion($edicion['id'], $edicion['nro'], $edicion['fecha'], $edicion['precio'], $edicion['estado']);
        $edicion->agregarProducto($producto);
        return $edicion;
    }

    public function crearNoticia($idEdicion, $idSeccion, $titulo, $subtitulo, $contenido, $imagenes,
        $link, $linkVideo) {

        $idNoticia = $this->conexion->insert(Consultas::INSERTAR_NOTICIA($idEdicion, $idSeccion, $titulo,
            $subtitulo, $contenido, $link, $linkVideo));

        for ($i = 0; $i < count($imagenes); $i++) {
            $imagen = $imagenes[$i];
            $imagen->guardar(self::UBICACION_IMAGENES);
            $this->guardarImagen($idNoticia, $imagen);
        }
    }

    private function guardarImagen($idNoticia, $imagen) {
        $idImagen = $this->conexion->insert(Consultas::INSERTAR_IMAGEN($imagen->ubicacion()));
        $this->conexion->insert(Consultas::INSERTAR_IMAGEN_POR_NOTICIA($idNoticia, $idImagen));
    }
}
?>