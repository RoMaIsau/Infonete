<?php
include_once ("$_SERVER[DOCUMENT_ROOT]/helper/Consultas.php");
class ModeloUsuario {
    private $conexion;

    public function __construct($baseDeDatos) {
        $this->conexion = $baseDeDatos;
    }

    public function login($correo, $contrasenia){
        $usuario = $this->buscarPorCorreoYContrasenia($correo, $contrasenia);

        if (empty($usuario)) {

        }
        $roles = $this->obtenerRolesDelUsuario($usuario);
        return new UsuarioLogueado($usuario[0]['nombre'], $usuario[0]['apellido'], $usuario[0]['correo'], $roles);
    }

    public function registrar($formularioDeRegistro) {

        $nombre = $formularioDeRegistro->getNombre();
        $apellido = $formularioDeRegistro->getApellido();
        $nombreUsuario = $formularioDeRegistro->getNombreUsuario();
        $email = $formularioDeRegistro->getEmail();
        $contraseniaEncriptada = md5($formularioDeRegistro->getPassword());

        if ($this->validarEmailDisponible($email)) {
            $this->crearUsuarioLector($nombre, $apellido, $nombreUsuario, $email, $contraseniaEncriptada);
        }   else {
            throw new EmailEnUsoException();
        }
    }

    private function buscarPorCorreoYContrasenia($correo, $password) {
        $contraseniaEncriptada = md5($password);
        $consulta = Consultas::OBTENER_USUARIO_POR_CORREO_Y_PASSWORD($correo, $contraseniaEncriptada);
        return $this->conexion->query($consulta);
    }

    private function crearUsuarioLector($nombre, $apellido, $nombreUsuario, $email, $contrasenia) {
        $idUsuario = $this->crearUsuario($nombre, $apellido, $nombreUsuario, $email, $contrasenia);
        $idRolLector = $this->obtenerRolLector();
        $this->agregarRolUsuario($idRolLector, $idUsuario);
    }

    private function crearUsuario($nombre, $apellido, $nombreUsuario, $email, $contrasenia) {
        $consulta = Consultas::INSERTAR_USUARIO($nombre, $apellido, $nombreUsuario, $email, $contrasenia);
        return $this->conexion->insert($consulta);
    }

    private function obtenerRolLector() {
        return $this->obtenerRolPorDescripcion("Lector");
    }

    private function obtenerRolPorDescripcion($descripcion) {
        $consulta = Consultas::OBTENER_ROL_POR_DESCRIPCION($descripcion);
        $resultado = $this->conexion->query($consulta);
        return  $resultado[0]['id'];
    }

    private function agregarRolUsuario($idRol, $idUsuario) {
        $consulta = Consultas::INSERTAR_ROL_USUARIO($idRol, $idUsuario);
        $this->conexion->insert($consulta);
    }

    private function validarEmailDisponible($correo) {
        $consulta = Consultas::CONTAR_USUARIOS_CON_CORREO($correo);
        $resultado = $this->conexion->query($consulta);
        return $resultado[0]['usuariosConEmail'] == 0;
    }

    private function obtenerRolesDelUsuario($usuario) {
        $consulta = Consultas::OBTENER_ROLES_DE_USUARIO($usuario[0]['id']);
        return $this->conexion->query($consulta);
    }
}
?>