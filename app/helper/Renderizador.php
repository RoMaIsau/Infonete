<?php

class Renderizador {
    private $mustache;

    public function __construct($partialsPathLoader){
        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(array(
            'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialsPathLoader )
        ));
    }

    public function renderizar($contentFile , $data = array()) {
        $contentAsString =  file_get_contents($contentFile);
        return  $this->mustache->render($contentAsString, $data);
    }

    public function redirect($modulo) {
        header("Location: /infonete/" . $modulo);
        exit();
    }
}
?>