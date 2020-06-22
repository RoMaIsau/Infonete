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

    public static function OBTENER_ROLES() {
        return <<< SQL
    SELECT * FROM Rol;
SQL;
    }

    public static function OBTENER_TIPOS_DE_PRODUCTOS() {
        return <<< SQL
    SELECT * FROM Tipo;
SQL;
    }

    public static function INSERTAR_PRODUCTO($nombre, $tipoProducto, $idUsuario) {
        return <<< SQL
    INSERT INTO Producto (nombre, idUsuario, idTipo) VALUES('$nombre', $idUsuario, $tipoProducto);
SQL;
    }

    public static function INSERTAR_DETALLE_PRODUCTO($precioMensual, $idProducto) {
        return <<< SQL
    INSERT INTO Detalle (fecha, precioMensual, idProducto) VALUES(now(), $precioMensual, $idProducto);
SQL;
    }

    public static function OBTENER_PRODUCTOS_POR_USUARIO($idContenidista){
        return <<< SQL
    SELECT p.id as id, p.nombre as nombre, t.nombre  as tipo, d.precioMensual  as precio FROM Producto p
    JOIN Tipo t ON t.id  = p.idTipo
    JOIN Detalle d ON d.idProducto = p.id
    WHERE p.idUsuario = $idContenidista;
SQL;
    }

    public static function OBTENER_PRODUCTO_POR_ID($idProducto) {
        return <<< SQL
    SELECT p.id as id, p.nombre as nombre, t.nombre  as tipo, d.precioMensual  as precio FROM Producto p
    JOIN Tipo t ON t.id  = p.idTipo
    JOIN Detalle d ON d.idProducto = p.id
    WHERE p.id = $idProducto;
SQL;
    }

    public static function INSERTAR_SECCION($nombre, $idProducto) {
        return <<< SQL
    INSERT INTO Seccion (nombre, idProducto) VALUES ('$nombre', $idProducto);
SQL;
    }

    public static function OBTENER_SECCIONES_POR_PRODUCTO($idProducto) {
        return <<< SQL
    SELECT * FROM Seccion WHERE idProducto = $idProducto;
SQL;
    }
}
?>