CREATE DATABASE SITEMA;

CREATE TABLE USUARIO(
ID INT NOT NULL AUTO_INCREMENT,
NOME VARCHAR(100) NOT NULL,
LOGIN VARCHAR(100) NOT NULL,
SENHA VARCHAR(100) NOT NULL,
NIVEL VARCHAR(100) NOT NULL,
IDSUPERIOR INT NOT NULL,
SITUACAO INT NOT NULL,
PRIMARY KEY(ID));

INSERT INTO USUARIO(NOME,LOGIN,SENHA,NIVEL,IDSUPERIOR,SITUACAO)
VALUES ('Administrador','nessa',SHA('123456'),1,1,0),
       ('Supervisor','luiz',SHA('123456'),2,1,0),
       ('Operador','tutu',SHA('123456'),3,2,0),
       ('Administrador','rute',SHA('123456'),1,1,1),
       ('Supervisor','judite',SHA('123456'),2,1,1),
       ('Operador','rob',SHA('123456'),3,2,1),
       ('Administrador','sant',SHA('123456'),1,1,0),
       ('Supervisor','eva',SHA('123456'),2,1,0),
       ('Operador','lala',SHA('123456'),3,2,0),
       ('Administrador','lula',SHA('123456'),1,1,1),
       ('Supervisor','xuda',SHA('123456'),2,1,1),
       ('Operador','xuxa',SHA('123456'),3,2,1),
       ('Administrador','xaxa',SHA('123456'),1,1,0),
       ('Supervisor','xaca',SHA('123456'),2,1,0),
       ('Operador','chuva',SHA('123456'),3,2,0),
       ('Administrador','xena',SHA('123456'),1,1,1),
       ('Supervisor','mist',SHA('123456'),2,1,1),
       ('Operador','taragah',SHA('123456'),3,2,1);


UPDATE USUARIO SET
IDSUPERIOR = 1;


select * from usuario;