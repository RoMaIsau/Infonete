<?php

class ModeloUsuario {
    private $conexion;

    public function __construct($baseDeDatos) {
        $this->conexion = $baseDeDatos;
    }

    public function buscarPorCorreoYContrasenia($correo, $password) {
        return $this->conexion->query("SELECT * FROM Usuario WHERE correo = '$correo' AND contrasena = '$password'");
    }

    public function registrar($nombre, $apellido, $usuario, $email,$contraseniaUsuario) {
        return $this->conexion->insert("INSERT INTO Usuario (nombre, apellido, nombreUsuario, correo, contrasenia) 
                VALUES ('$nombre', '$apellido', '$usuario', '$email', '$contraseniaUsuario')");

    }
}
?>