<?php
class ModeloEdicionesEnProceso {
    private $conexion;

    public function __construct($baseDeDatos) {
        $this->conexion = $baseDeDatos;
    }

    public function publicarEdicion($idEdicion) {
        $this->conexion->update(Consultas::ACTUALIZAR_ESTADO_EDICION($idEdicion, EstadoEdicion::PENDIENTE()));
    }
}
?>