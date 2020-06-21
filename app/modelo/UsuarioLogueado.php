<?php


class UsuarioLogueado {
    private $roles;
    private $correo;
    private $nombre;
    private $apellido;

    public function __construct($nombre, $apellido, $correo, $roles) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->roles = $roles;
    }

    public function nombre() {
        return $this->nombre;
    }

    public function apellido() {
        return $this->apellido;
    }

    public function roles() {
        return $this->roles;
    }
}
?>