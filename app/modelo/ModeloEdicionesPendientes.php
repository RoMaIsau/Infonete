<?php
class ModeloEdicionesPendientes {
    private $conexion;

    public function __construct($baseDeDatos) {
        $this->conexion = $baseDeDatos;
    }

    public function obtenerEdiciones() {
        $resultado = $this->conexion->query(Consultas::OBTENER_EDICIONES_POR_ESTADO(EstadoEdicion::PENDIENTE()));
        $ediciones = array();
        for ($i = 0; $i < count($resultado); $i++) {
            $edicion = $resultado[$i];
            array_push($ediciones, new Edicion($edicion['id'], $edicion['nro'], $edicion['fecha'], $edicion['precio'], $edicion['estado']));
        }
        return $ediciones;
    }

    public function aprobarEdicion($idEdicion) {
        $this->conexion->update(Consultas::ACTUALIZAR_ESTADO_EDICION($idEdicion, EstadoEdicion::PUBLICADA()));
    }
}
?>