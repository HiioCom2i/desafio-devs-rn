CREATE DATABASE IF NOT EXISTS devs_rn;
USE devs_rn;

-- TABELA: associados
CREATE TABLE associados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    data_filiacao DATE NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABELA: anuidades
CREATE TABLE anuidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ano YEAR NOT NULL UNIQUE,
    valor DECIMAL(10,2) NOT NULL
);

-- TABELA: pagamentos
CREATE TABLE pagamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    associado_id INT NOT NULL,
    anuidade_id INT NOT NULL,
    pago BOOLEAN DEFAULT FALSE,
    data_pagamento TIMESTAMP NULL,

    FOREIGN KEY (associado_id) REFERENCES associados(id),
    FOREIGN KEY (anuidade_id) REFERENCES anuidades(id)
);