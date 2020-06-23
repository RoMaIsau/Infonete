<?php
class ImagenEnServer {

    private $nombre;
    private $ubicacionTemporal;
    private $ubicacion;

    function __construct($nombre, $ubicacionTemporal) {
        $this->nombre = $nombre;
        $this->ubicacionTemporal = $ubicacionTemporal;
    }

    public function guardar($ubicacion) {
        $this->ubicacion = $ubicacion . '/' . $this->nombre;
        move_uploaded_file($this->ubicacionTemporal, $this->ubicacion);
    }

    public function ubicacion() {
        return $this->ubicacion;
    }
}
?>