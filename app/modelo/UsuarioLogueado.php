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

    public function correo() {
        return $this->correo;
    }

    public function roles() {
        return $this->roles;
    }

    public function esAdministrador() {
        return $this->tieneRol("ADMINISTRADOR");
    }

    public function esLector() {
        return $this->tieneRol("LECTOR");
    }

    private function tieneRol($rolBuscado) {
        $resultado = array_filter($this->roles, function ($valor) use ($rolBuscado) {
           return $rolBuscado == $valor;
        });
        return !empty($resultado);
    }
}
?>