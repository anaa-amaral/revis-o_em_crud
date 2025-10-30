CREATE DATABASE tarefas_db;
USE tarefas_db;

CREATE TABLE usuarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    email VARCHAR(255) NOT NULL
);

CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(100) NOT NULL,
    setor VARCHAR(100) NOT NULL,
    prioridade ENUM('Baixa', 'Média', 'Alta') NOT NULL,
    data_cadastro DATE NOT NULL,
    status_tarefa ENUM('Fazer', 'Fazendo', 'Pronto') NOT NULL,
    usuario_responsavel INT NOT NULL,
    FOREIGN KEY (usuario_responsavel) REFERENCES usuarios(id)
);
