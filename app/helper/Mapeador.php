<?php


class Mapeador {
    public static function mapearPost($clase) {
        $formulario = new $clase();
        foreach($_POST as $campo => $valor) {
            if ($formulario->seDebeMapear($campo)) {
                self::mapearCampoEn($campo, $valor, $formulario);
                if ($formulario->esRequerido($campo) && empty($valor)) {
                    $formulario->marcarCampoSinCompletar($campo);
                }
            }
        }
        return $formulario;
    }

    private static function mapearCampoEn($campo, $valor, $formulario) {
        $setter = self::crearSetPara($campo);
        if(method_exists($formulario, $setter)) {
            call_user_func(array($formulario, $setter), $valor);
        } else {
            die("No existe el método " . $setter . " en la clase " . $formulario . " pero el campo " . $campo . " está marcado como mapeable");
        }
    }

    private static function crearSetPara($campo) {
        return 'set' . ucfirst($campo);
    }
}