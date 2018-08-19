create database loja;

use loja;

create table categorias(
id integer unsigned auto_increment primary key not null,
nome varchar(255) not null
)engine = InnoDB;

create table produtos(
id Integer unsigned auto_increment primary key not null,
nome varchar(255) not null,
preco double not null,
descricao varchar(255) not null,
usado Integer unsigned not null,
categoria_id Integer unsigned not null,
isbn varchar(255),
tipoProduto varchar(255) not null
foreign key(categoria_id) references categorias(id)
)engine = InnoDB;

insert into categorias (nome) values ("Esporte"), ("Escolar"), ("Mobilidade");

create table usuarios(
id Integer unsigned auto_increment primary key not null,
email varchar(255) not null,
senha varchar(255) not null
)engine = InnoDB;

insert into usuarios (email, senha) values ("teste@teste.com.br", "e10adc3949ba59abbe56e057f20f883e");