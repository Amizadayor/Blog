drop database if exists blog;
create database blog;
use blog;

create table roles(
  id int not null primary key auto_increment,
  nombre varchar(255) not null
);

create table usuarios(
  id int not null primary key auto_increment,
  nombre varchar(100) not null,
  email varchar(100) not null,
  password varchar(100) not null,
  rol_id int not null,
  fecha_creacion datetime not null default current_timestamp(),
  foreign key(rol_id) references roles(id) on delete restrict on update cascade
);

create table articulos (
  id int not null primary key auto_increment,
  titulo varchar(255) not null,
  imagen varchar(255) not null,
  texto text not null,
  usuario_id int not null,
  fecha_creacion datetime not null default current_timestamp(),
  foreign key(usuario_id) references usuarios(id) on delete restrict on update cascade
);

create table comentarios (
  id int not null primary key auto_increment,
  comentario text not null,
  usuario_id int not null,
  articulo_id int not null,
  estado int not null,
  fecha_creacion datetime not null default current_timestamp(),
  foreign key(usuario_id) references usuarios(id),
  foreign key(articulo_id) references articulos(id)
);

insert into roles
values (null, "Administrador");
insert into roles
values (null, "Registrado");
insert into usuarios (nombre, email, password, rol_id)
values(
    'Juan Amizaday',
    'juanamizadayo@gmail.com',
    md5('123456'),
    1
  );
insert into usuarios (nombre, email, password, rol_id)
values('Galilea', 'galilea@hotmail.com', md5('1234'), 2);
insert into usuarios (nombre, email, password, rol_id)
values(
    'Anet Sugey',
    'anet12@hotmail.com',
    md5('1234'),
    1
  );
insert into usuarios (nombre, email, password, rol_id)
values(
    'Kevin Darwin',
    'kevin@hotmail.com',
    md5('1234'),
    2
  );
insert into articulos (titulo, imagen, texto, usuario_id)
values(
    'Articulo 1',
    'img1.jpg',
    'Texto del articulo 1',
    1
  );
insert into articulos (titulo, imagen, texto, usuario_id)
values(
    'Articulo 2',
    'img2.jpg',
    'Texto del articulo 2',
    2
  );
insert into articulos (titulo, imagen, texto, usuario_id)
values(
    'Articulo 3',
    'img3.jpg',
    'Texto del articulo 3',
    2
  );
insert into articulos (titulo, imagen, texto, usuario_id)
values(
    'Articulo 4',
    'img4.jpg',
    'Texto del articulo 4',
    3
  );
insert into articulos (titulo, imagen, texto, usuario_id)
values(
    'Articulo 5',
    'img5.jpg',
    'Texto del articulo 5',
    4
  );
insert into articulos (titulo, imagen, texto, usuario_id)
values(
    'Articulo 6',
    'img6.jpg',
    'Texto del articulo 6',
    4
  );
insert into comentarios (comentario, usuario_id, articulo_id, estado)
values('Comentario 1', 2, 2, 0);
insert into comentarios (comentario, usuario_id, articulo_id, estado)
values('Comentario 2', 3, 2, 1);
insert into comentarios (comentario, usuario_id, articulo_id, estado)
values('Comentario 3', 4, 3, 0);
insert into comentarios (comentario, usuario_id, articulo_id, estado)
values('Comentario 4', 2, 3, 1);

create view view_usuarios as
select u.id,
  u.nombre,
  u.email,
  r.nombre as rol,
  u.fecha_creacion
from usuarios u,
  roles r
where u.rol_id = r.id;

create view view_comentarios as
select c.id,
  c.comentario,
  c.usuario_id,
  u.nombre as autor,
  c.articulo_id,
  a.titulo,
  a.usuario_id as prop_art,
  c.estado,
  c.fecha_creacion
from comentarios c
  inner join usuarios u on c.usuario_id = u.id
  inner join articulos a on c.articulo_id = a.id;

create view view_articulos as
select a.id,
  a.titulo,
  a.imagen,
  a.texto,
  a.usuario_id,
  u.nombre as autor,
  a.fecha_creacion
from articulos a,
  usuarios u
where a.usuario_id = u.id;