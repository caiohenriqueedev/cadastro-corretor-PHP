CREATE DATABASE IF NOT EXISTS corretores_db;

USE corretores_db;

CREATE TABLE IF NOT EXISTS corretores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    creci VARCHAR(20) NOT NULL
);