<?php
class ModeloNoticias {
    const UBICACION_IMAGENES = "imagenes";

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