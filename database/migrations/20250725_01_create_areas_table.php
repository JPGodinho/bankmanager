<?php

function up($pdo) {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS areas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(255) NOT NULL,
            descricao TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );
    ");
    echo "Migration: Tabela 'areas' criada com sucesso.\n";
}

function down($pdo) {
    $pdo->exec("DROP TABLE IF EXISTS areas;");
    echo "Migration: Tabela 'areas' revertida com sucesso.\n";
}