<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/Formulario.php");

class FormularioDeRegistro extends Formulario {

    private $nombre;
    private $apellido;
    private $nombreUsuario;
    private $email;
    private $password;
    private $passwordRepetida;

    public function obtenerCamposRequeridos() {
        return array("password", "passwordRepetida");
    }

    public function obtenerTodosLosCampos() {
        return array("nombre", "apellido", "nombreUsuario", "email", "password", "passwordRepetida");
    }

    public function getNombreDeFormulario() {
        return "FormularioDeRegistro";
    }

    public function contraseniasIguales() {
        return $this->password == $this->passwordRepetida;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPasswordRepetida($passwordRepetida) {
        $this->passwordRepetida = $passwordRepetida;
    }

    public function getPasswordRepetida() {
        return $this->passwordRepetida;
    }
}
?>