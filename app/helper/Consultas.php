<?php


class Consultas {

    public static function OBTENER_USUARIO_POR_CORREO_Y_PASSWORD($correo, $password) {
        return <<< SQL
    SELECT * FROM Usuario 
    WHERE correo = '$correo' 
    AND contrasenia = '$password';
SQL;
    }

    public static function OBTENER_ROLES_DE_USUARIO($idUsuario) {
        return <<< SQL
	SELECT UPPER(r.descripcion) as rol
	FROM RolUsuario ru 
	JOIN Rol r on ru.idRol = r.id 
	WHERE ru.idUsuario = $idUsuario;
SQL;
    }

    public static function CONTAR_USUARIOS_CON_CORREO($correo) {
        return <<< SQL
    SELECT COUNT(*) AS usuariosConEmail 
    FROM Usuario WHERE correo = '$correo';
SQL;
    }

    public static function INSERTAR_USUARIO($nombre, $apellido, $nombreUsuario, $email, $contraseniaEncriptada) {
        return <<< SQL
    INSERT INTO Usuario (nombre, apellido, nombreUsuario, correo, contrasenia) 
    VALUES ('$nombre', '$apellido', '$nombreUsuario', '$email', '$contraseniaEncriptada');
SQL;
    }

    public static function OBTENER_ROL_POR_DESCRIPCION($descripcion) {
        return <<< SQL
    SELECT id FROM Rol WHERE descripcion = '$descripcion';
SQL;
    }

    public static function INSERTAR_ROL_USUARIO($idRol, $idUsuario) {
        return <<< SQL
    INSERT INTO RolUsuario (idRol, idUsuario) VALUES ($idRol, $idUsuario);
SQL;
    }
}
?>