<?php

function up($pdo) {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS alunos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            data_nascimento DATE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );
    ");
    echo "Migration: Tabela 'alunos' criada com sucesso.\n";
}

function down($pdo) {
    $pdo->exec("DROP TABLE IF EXISTS alunos;");
    echo "Migration: Tabela 'alunos' revertida com sucesso.\n";
}