CREATE DATABASE pratica_2_gaucho;
USE pratica_2_gaucho;

CREATE TABLE cliente (
	id_cliente INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(200) NOT NULL,
    cpf CHAR(13) UNIQUE NOT NULL,
    email VARCHAR(200) UNIQUE NOT NULL,
    telefone CHAR(14) UNIQUE NOT NULL
);

CREATE TABLE funcionario (
	id_funcionario INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(200) NOT NULL,
    cpf CHAR(13) UNIQUE NOT NULL,
    email VARCHAR(200) UNIQUE NOT NULL,
    telefone CHAR(14) UNIQUE NOT NULL
);

CREATE TABLE solicitacao (
	id_solicitacao INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	descricao TEXT NOT NULL,
    urgencia VARCHAR(5) NOT NULL,
    status_solicitacao VARCHAR(12) NOT NULL,
    data_abertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    id_cliente_solicitacao INT NOT NULL,
    FOREIGN KEY (id_cliente_solicitacao) REFERENCES cliente (id_cliente),
    id_funcionario_solicitacao INT NULL,
    FOREIGN KEY (id_funcionario_solicitacao) REFERENCES funcionario (id_funcionario)
);