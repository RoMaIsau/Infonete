<?php

class BaseDeDatos {

    private $connexion;

    public function __construct($servername, $username, $password, $dbname){
        $this->connexion = mysqli_connect($servername, $username, $password, $dbname)
                or die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
    }

    public function query($sql){
        $result = mysqli_query($this->connexion, $sql);

        $resultAsAssocArray = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $resultAsAssocArray;
    }

    public function __destruct(){
        mysqli_close($this->connexion);
    }

    public static function createDatabaseFromConfig(Configuracion $config){
        return new BaseDeDatos(
            $config->get( "database","servername"),
            $config->get("database","username"),
            $config->get("database","password"),
            $config->get("database","dbname")
        );
    }
}