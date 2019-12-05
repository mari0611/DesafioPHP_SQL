create database desafio;
use desafio;


create table produtos (
	id int auto_increment primary key not null,
	nome varchar(100) not null,
    descrição varchar (500),
    preço int,
    foto varchar(200) not null,
        
);

create table usuarios (
	id int auto_increment primary key not null,
	nome varchar(100) not null,
    email varchar (100) not null,
    senha int not null
    
);

