CREATE DATABASE SEDIH;
USE SEDIH;

CREATE TABLE HOTEL(
idHotel int AUTO_INCREMENT PRIMARY KEY ,
nombre varchar(50),
categoria int,
domicilio varchar(100),
capacidad int,
ocupacion int,
ubicacion varchar(100) 
);

CREATE TABLE USUARIOS(
idUsuario int  PRIMARY KEY,
tipo smallint,
nombre varchar(50),
idHotel int,
userPass varchar(40),
CONSTRAINT fk_usuarios_hotel FOREIGN KEY (idHotel) REFERENCES HOTEL(idHotel) 
);

CREATE TABLE REGISTROCLIENTE(
idRegistro int AUTO_INCREMENT,
fechaHRegistro DATETIME,
idHotelProcedencia int ,
motivoVisita varchar(200),
lugarProcedencia varchar(60),
CONSTRAINT fk_registro_hotel FOREIGN KEY (idHotelProcedencia) REFERENCES HOTEL(idHotel),
CONSTRAINT pk_registrocliente PRIMARY KEY(idRegistro,fechaHRegistro)
);
