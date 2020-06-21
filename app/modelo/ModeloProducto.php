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

    private function crearDetalleProducto($idProducto, $precio) {
        $this->conexion->insert(Consultas::INSERTAR_DETALLE_PRODUCTO($precio, $idProducto));
    }
}