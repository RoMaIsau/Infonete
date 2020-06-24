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
        $path = $ubicacion . '/' . $this->nombre;
        move_uploaded_file($this->ubicacionTemporal, $path);
        $this->ubicacion = '/' . $path;
    }

    public function ubicacion() {
        return $this->ubicacion;
    }
}
?>