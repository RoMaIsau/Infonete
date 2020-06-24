<?php

class BaseDeDatos {

    private $connexion;

    public function __construct($servername, $username, $password, $dbname){
        $this->connexion = mysqli_connect($servername, $username, $password, $dbname)
                or die("No se pudo conectar a la base de datos: " . mysqli_connect_error());
    }

    public function query($sql){
        $result = mysqli_query($this->connexion, $sql);

        $resultAsAssocArray = array();

        if (isset($result) && $result->num_rows !== 0) {
            $resultAsAssocArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        return $resultAsAssocArray;
    }

    public function obtenerUnUnicoResultado($sql) {
        $resultado = $this->query($sql);
        if (empty($resultado)) {
            die("Se esperaba un resultado pero no llegó ninguno: " . $sql);
        } else if (count($resultado) > 1) {
            die("Se esperaba un resultado pero llegaron: " . count($resultado) . ' ' . $sql);
        }
        return $resultado[0];
    }

    public function insert($sql) {
        if (mysqli_query($this->connexion, $sql) == false) {
            die("Error insertando datos en la consulta : " . $sql . "Error: " . mysqli_error($this->connexion));
        }
        return $this->getLastId();
    }

    private function getLastId() {
        return mysqli_insert_id($this->connexion);
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
