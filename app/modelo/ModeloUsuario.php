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
            throw new LoginInvalidoException();
        }
        $roles = $this->obtenerRolesDelUsuario($usuario);
        return new UsuarioLogueado($usuario['id'], $usuario['nombre'], $usuario['apellido'], $usuario['correo'], $roles);
    }

    public function registrar($formularioDeRegistro) {

        $nombre = $formularioDeRegistro->getNombre();
        $apellido = $formularioDeRegistro->getApellido();
        $nombreUsuario = $formularioDeRegistro->getNombreUsuario();
        $email = $formularioDeRegistro->getEmail();
        $contraseniaEncriptada = md5($formularioDeRegistro->getPassword());
        $rol = $formularioDeRegistro->getRol();

        if ($this->validarEmailDisponible($email)) {
            $this->crearUsuario($nombre, $apellido, $nombreUsuario, $email, $contraseniaEncriptada, $rol);
        }   else {
            throw new EmailEnUsoException();
        }
    }

    public function obtenerRolLector() {
        return $this->obtenerRolPorDescripcion("Lector");
    }

    public function listarRoles() {
        $consulta = Consultas::OBTENER_ROLES();
        $resultado = $this->conexion->query($consulta);
        $roles = array();
        for($i = 0; $i < count($resultado); $i++) {
            $rol = $resultado[$i];
            array_push($roles, new Rol($rol['id'], $rol['descripcion']));
        }
        return $roles;
    }

    private function buscarPorCorreoYContrasenia($correo, $password) {
        $contraseniaEncriptada = md5($password);
        $resultado = $this->conexion->query(Consultas::OBTENER_USUARIO_POR_CORREO_Y_PASSWORD($correo, $contraseniaEncriptada));
        return $resultado[0];
    }

    private function crearUsuario($nombre, $apellido, $nombreUsuario, $email, $contrasenia, $idRol) {
        $consulta = Consultas::INSERTAR_USUARIO($nombre, $apellido, $nombreUsuario, $email, $contrasenia);
        $idUsuario = $this->conexion->insert($consulta);
        $this->agregarRolUsuario($idRol, $idUsuario);
    }

    private function obtenerRolPorDescripcion($descripcion) {
        $consulta = Consultas::OBTENER_ROL_POR_DESCRIPCION($descripcion);
        $resultado = $this->conexion->query($consulta);
        return  new Rol($resultado[0]['id'], $resultado[0]['descripcion']);
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
        $consulta = Consultas::OBTENER_ROLES_DE_USUARIO($usuario['id']);
        $resultado = $this->conexion->query($consulta);
        $roles = array();

        for($i = 0; $i < count($resultado); $i++) {
            $rol = $resultado[$i];
            array_push($roles, $rol['rol']);
        }
        return $roles;
    }


}
?>