<?php

class ModeloUsuario {
    private $conexion;

    public function __construct($baseDeDatos) {
        $this->conexion = $baseDeDatos;
    }

    public function buscarPorCorreoYContrasenia($correo, $password) {
        $contraseniaEncriptada = md5($password);
        $usuario = $this->conexion->query("SELECT * FROM Usuario WHERE correo = '$correo' AND contrasenia = '$contraseniaEncriptada'");

        return $usuario;
    }

    public function registrar($formularioDeRegistro) {

        $nombre = $formularioDeRegistro->getNombre();
        $apellido = $formularioDeRegistro->getApellido();
        $nombreUsuario = $formularioDeRegistro->getNombreUsuario();
        $email = $formularioDeRegistro->getEmail();
        $contraseniaEncriptada = md5($formularioDeRegistro->getPassword());

        if ($this->validarEmailDisponible($email)) {

            $idUsuario = $this->conexion->insert("INSERT INTO Usuario (nombre, apellido, nombreUsuario, correo, contrasenia) 
                VALUES ('$nombre', '$apellido', '$nombreUsuario', '$email', '$contraseniaEncriptada')");

            $resultado = $this->conexion->query("SELECT id FROM Rol WHERE descripcion = 'Lector'");
            $idRol = $resultado[0]['id'];
            $this->conexion->insert("INSERT INTO RolUsuario (idRol, idUsuario) 
            VALUES ($idRol, $idUsuario)");

        }   else {
            throw new EmailEnUsoException();
        }
    }

    private function validarEmailDisponible($email) {
        $resultado = $this->conexion->query("SELECT COUNT(*) AS usuariosConEmail FROM Usuario WHERE correo = '$email'");
        return $resultado[0]['usuariosConEmail'] == 0;
    }
}
?>