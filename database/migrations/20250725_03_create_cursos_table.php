<?php

function up($pdo) {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS cursos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(255) NOT NULL,
            descricao TEXT,
            area_id INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT fk_area_curso FOREIGN KEY (area_id) REFERENCES areas(id) ON DELETE SET NULL
        );
    ");
    echo "Migration: Tabela 'cursos' criada com sucesso.\n";
}

function down($pdo) {
    $pdo->exec("DROP TABLE IF EXISTS cursos;");
    echo "Migration: Tabela 'cursos' revertida com sucesso.\n";
}