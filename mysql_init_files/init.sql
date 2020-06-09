create table Rol(
id integer AUTO_INCREMENT,
descripcion varchar(50),
primary key(id));

create table Usuario(
id integer AUTO_INCREMENT,
nombreUsuario varchar(50),
contrasenia varchar(50),
nombre varchar(50),
apellido varchar(50),
correo varchar(50),
longitud decimal(9,6),
latitud decimal(9,6),
primary key(id)
);

create table RolUsuario(
idRol integer,
idUsuario integer,
primary key(idRol, idUsuario),
foreign key(idRol) references Rol(id),
foreign key(idUsuario) references Usuario(id));

create table Tipo(
id integer AUTO_INCREMENT,
nombre varchar(50),
primary key(id));

create table Producto(
id integer AUTO_INCREMENT,
nombre varchar(50),
idUsuario integer,
idTipo integer,
primary key(id),
foreign key(idUsuario) references Usuario(id),
foreign key(idTipo) references Tipo(id));

create table Suscripcion(
id integer AUTO_INCREMENT,
fecha date,
estado varchar(50),
idUsuario integer,
idProducto integer,
primary key(id),
foreign key(idUsuario) references Usuario(id),
foreign key(idProducto) references Producto(id));

create table PagoSuscripcion(
id integer AUTO_INCREMENT,
periodo varchar(50),
monto decimal(8,2),
fecha date,
idSuscripcion integer,
primary key(id),
foreign key(idSuscripcion) references Suscripcion(id));

create table Detalle(
id integer AUTO_INCREMENT,
fecha date,
precioMensual decimal(8,2),
idProducto integer,
primary key(id),
foreign key(idProducto) references Producto(id));

create table Seccion(
id integer AUTO_INCREMENT,
nombre varchar(50),
idProducto integer,
primary key(id),
foreign key(idProducto) references Producto(id));

create table Edicion(
id integer AUTO_INCREMENT,
nro integer,
fecha date,
precio decimal(8,2),
idProducto integer,
primary key(id),
foreign key(idProducto) references Producto(id));

create table PagoEdicion(
id integer AUTO_INCREMENT,
fecha date,
monto decimal(8,2),
idUsuario integer,
idEdicion integer,
primary key(id),
foreign key(idUsuario) references Usuario(id),
foreign key(idEdicion) references Edicion(id));

create table Noticia(
id integer AUTO_INCREMENT,
contenido varchar(100),
subtitulo varchar(100),
titulo varchar(100),
linkVideo varchar(100),
longitud decimal(9,6),
latitud decimal(9,6),
link varchar(100),
idEdicion integer,
idSeccion integer,
primary key(id),
foreign key(idEdicion) references Edicion(id),
foreign key(idSeccion) references Seccion(id));

create table Imagen(
id integer AUTO_INCREMENT,
ubicacion varchar(100),
primary key(id)
);

create table ImagenPorNoticia(
idNoticia integer,
idImagen integer,
primary key(idNoticia, idImagen),
foreign key(idNoticia) references Noticia(id),
foreign key(idImagen) references Imagen(id));

insert into Rol(id, descripcion)
values
(1, 'Administrador'),
(2, 'Contenidista'),
(3, 'Lector');

insert into Tipo(id, nombre)
values
(1, 'Diario'),
(2, 'Revista');

INSERT INTO Usuario (id, nombreUsuario, contrasenia, nombre, apellido, correo)
VALUES(1, 'infonete_admin', '4cdcf3c4bb966cce0206560fd2ba3b4a', 'Juan', 'Perez', 'juan.perez@infonete.com.ar');

INSERT INTO RolUsuario(idRol, idUsuario) VALUE (1, 1);
