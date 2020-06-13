<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/formularios/Formulario.php");


class FormularioDeLogin extends Formulario {

    private $email;
    private $password;

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function obtenerCamposRequeridos() {
        return array("email", "password");
    }

    public function obtenerTodosLosCampos() {
        return array("email", "password");
    }

    public function getNombreDeFormulario() {
        return "FormularioDeLogin";
    }
}
?>