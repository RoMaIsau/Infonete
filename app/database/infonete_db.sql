create database infonete_db;
use infonete_db;
/*drop database infonete_db;*/

create table Rol(
id integer,
descripcion varchar(50),
primary key(id));

create table Usuario(
id integer,
nombre_usuario varchar(50),
contraseña varchar(50),
nombre varchar(50),
apellido varchar(50),
correo varchar(50),
longitud varchar(50),
latitud varchar(50),
primary key(id)
);

create table Tiene_un(
idRol integer,
idUsuario integer,
primary key(idRol , idUsuario),
foreign key(idRol) references Rol(id),
foreign key(idUsuario) references Usuario(id));


create table Tipo(
id integer,
nombre varchar(50),
primary key(id));

create table Producto(
id integer,
nombre varchar(50),
usuario integer,
tipo integer,
primary key(id),
foreign key(usuario) references Usuario(id),
foreign key(tipo) references Tipo(id));

create table Suscripcion(
id integer,
fecha date,
estado varchar(50),
usuario integer,
producto integer,
primary key(id),
foreign key(usuario) references Usuario(id),
foreign key(producto) references Producto(id));

create table Pago_suscripcion(
id integer,
periodo varchar(50),
monto double,
fecha date,
suscripcion integer,
primary key(id),
foreign key(suscripcion) references Suscripcion(id));

create table Detalle(
id integer,
fecha date,
precio_mensual double,
producto integer,
primary key(id),
foreign key(producto) references Producto(id));

create table Seccion(
id integer,
nombre varchar(50),
producto integer,
primary key(id),
foreign key(producto) references Producto(id));

create table Edicion(
id integer,
nro integer,
fecha date,
precio double,
producto integer,
primary key(id),
foreign key(producto) references Producto(id));

create table Pago_edicion(
id integer,
fecha date,
monto double,
usuario integer,
edicion integer,
primary key(id),
foreign key(usuario) references Usuario(id),
foreign key(edicion) references Edicion(id));

create table Noticia(
id integer,
contenido varchar(100),
subtitulo varchar(100),
titulo varchar(100),
link_video varchar(100),
longitud varchar(100),
latitud varchar(100),
link varchar(100),
edicion integer,
seccion integer,
primary key(id),
foreign key(edicion) references Edicion(id),
foreign key(seccion) references Seccion(id));

create table Imagen(
id integer,
ubicacion varchar(100),
primary key(id)
);

create table Posee(
noticia integer,
imagen integer,
primary key(noticia, imagen),
foreign key(noticia) references Noticia(id),
foreign key(imagen) references Imagen(id));

insert into Rol(id , descripcion)
values
(1,'Administrador'),
(2,'Contenidista'),
(3,'Lector');

insert into Tipo(id,nombre)
values
(10,'Diario'),
(20,'Revista');





