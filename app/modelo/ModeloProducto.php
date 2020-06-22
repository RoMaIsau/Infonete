<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/helper/Consultas.php");

class ModeloProducto {

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

    private function crearDetalleProducto($idProducto, $precio) {
        $this->conexion->insert(Consultas::INSERTAR_DETALLE_PRODUCTO($precio, $idProducto));
    }
}