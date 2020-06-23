<?php
//TODO: Se debe poder georeferenciar la noticia
class FormularioDeRedaccion extends Formulario {
    private $idEdicion;
    private $idSeccion;
    private $titulo;
    private $subtitulo;
    private $contenido;
    private $imagenes;
    private $link;
    private $linkVideo;

    public function obtenerCamposRequeridos() {
        return array("titulo", "subtitulo", "contenido", "imagenes", "seccion");
    }

    public function obtenerTodosLosCampos() {
        return array("titulo", "subtitulo", "contenido", "imagenes", "seccion", "link", "linkVideo", "idEdicion");
    }

    public function setIdEdicion($idEdicion) {
        $this->idEdicion = $idEdicion;
    }

    public function setSeccion($idSeccion) {
        $this->idSeccion = $idSeccion;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setSubtitulo($subtitulo) {
        $this->subtitulo = $subtitulo;
    }

    public function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    public function setLinkVideo($linkVideo) {
        $this->linkVideo = $linkVideo;
    }

    public function getNombreDeFormulario() {
        return "FormularioDeRedaccion";
    }

    public function obtenerCamposDeImagenes() {
        $campos = parent::obtenerCamposDeImagenes();
        array_push($campos, "imagenes");
        return $campos;
    }

    public function agregarImagen($imagen) {
        if (!isset($this->imagenes)) {
            $this->imagenes = array();
        }
        array_push($this->imagenes, $imagen);
    }

    public function idEdicion() {
        return $this->idEdicion;
    }

    public function idSeccion() {
        return $this->idSeccion;
    }

    public function titulo() {
        return $this->titulo;
    }

    public function subtitulo() {
        return $this->subtitulo;
    }

    public function contenido() {
        return $this->contenido;
    }

    public function imagenes() {
        return $this->imagenes;
    }

    public function link() {
        return $this->link;
    }

    public function linkVideo() {
        return $this->linkVideo;
    }
}
?>