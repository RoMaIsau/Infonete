<?php
class Router {
    public static function ejecutarAccionDeControlador($inicializadorDeModulos, $modulo, $accion) {
        $controlador = self::crearControlador($inicializadorDeModulos, $modulo);
        self::ejecutarAccion($controlador, $accion);
    }

    private static function crearControlador($inicializadorDeModulos, $modulo) {
        $nombreDeControlador = self::crearNombreDeControladorParaModulo($modulo);
        $controladorValido = method_exists($inicializadorDeModulos, $nombreDeControlador) ? $nombreDeControlador : "crearControladorDefault";
        $controlador = call_user_func(array($inicializadorDeModulos, $controladorValido));
        return $controlador;
    }

    private static function crearNombreDeControladorParaModulo($modulo){
        return "crear" . "Controlador" . ucfirst($modulo);
    }

    private static function ejecutarAccion($controlador, $accion){
        self::ejecutarPreAccion($controlador);
        $accionValida = method_exists($controlador, $accion) ? $accion : "index";
        call_user_func(array($controlador, $accionValida));
    }

    private static function ejecutarPreAccion($controlador) {
        $preAccion = "preAccion";
        if (method_exists($controlador, $preAccion)) {
            call_user_func(array($controlador, $preAccion));
        }
    }
}
?>