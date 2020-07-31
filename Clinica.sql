CREATE DATABASE Clinica;
USE Clinica;
-- DROP DATABASE Clinica;

CREATE TABLE paciente(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR (20) NOT NULL,
    idade CHAR(2) NOT NULL,
    plano VARCHAR (10) NOT NULL,
    telefone VARCHAR (15) NOT NULL
);

CREATE TABLE consultas(
	id INT PRIMARY KEY AUTO_INCREMENT,
    dia date NOT NULL,
    hora time NOT NULL,
    fkPaciente INT NOT NULL,
    fkMedico INT NOT NULL
);

CREATE TABLE medicos(
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR (20) NOT NULL,
    especialidade VARCHAR(20) NOT NULL,
    telefone VARCHAR (15) NOT NULL,
    crm VARCHAR(9) NOT NULL
);

ALTER TABLE consultas ADD CONSTRAINT fkPaciente FOREIGN KEY (fkPaciente) REFERENCES paciente (id);

ALTER TABLE consultas ADD CONSTRAINT fkMedico FOREIGN KEY (fkMedico) REFERENCES medicos (id);

-- SELECT * FROM paciente;
-- SELECT * FROM consultas;
-- SELECT * FROM medicos;