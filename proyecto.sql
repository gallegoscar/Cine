-- Database: "EjemploCRUD"

-- DROP DATABASE "EjemploCRUD";

CREATE SCHEMA pelicula;

CREATE TABLE pelicula.tbl_obra(
	id int NOT NULL,
	nombre varchar(20) not null,
	descripcion varchar(40) not null,
	primary key (id)	
);

CREATE TABLE pelicula.tbl_director(
	fk_id int not null,
	id_director int NOT NULL,
	nombre varchar (20) not null,
	celular int not null,
	primary key (id_director),
	CONSTRAINT fk_EQ1 FOREIGN KEY(fk_id) REFERENCES pelicula.tbl_obra(id)
);