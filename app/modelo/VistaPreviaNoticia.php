<?php
class VistaPreviaNoticia {
    private $id;
    private $titulo;
    private $seccion;
    private $ubicacion;

    function __construct($id, $titulo, $seccion, $ubicacion) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->seccion = $seccion;
        $this->ubicacion = $ubicacion;
    }

    public function id() {
        return $this->id;
    }

    public function titulo() {
        return $this->titulo;
    }

    public function seccion() {
        return $this->seccion;
    }

    public function ubicacion() {
        return $this->ubicacion;
    }


}