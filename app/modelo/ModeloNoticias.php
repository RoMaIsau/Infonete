<?php
class ModeloNoticias {
    private $conexion;

    public function __construct($baseDeDatos) {
        $this->conexion = $baseDeDatos;
    }

    public function obtenerVistaPreviaDeNoticiasPorEdicion($idEdicion) {
        $vistaPrevia = array();
        $noticias = $this->conexion->query(Consultas::OBTENER_NOTICIAS_POR_EDICION($idEdicion));
        for ($i = 0; $i < count($noticias); $i++) {
            $noticia = $noticias[$i];
            $imagen = $this->conexion->obtenerUnUnicoResultado(Consultas::OBTENER_PRIMER_IMAGEN_DE_NOTICIA($noticia['id']));
            array_push($vistaPrevia, new VistaPreviaNoticia($noticia['id'], $noticia['titulo'], $noticia['seccion'], $imagen['ubicacion']));
        }
        return $vistaPrevia;
    }
}
?>