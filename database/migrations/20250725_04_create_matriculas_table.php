<?php

function up($pdo) {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS matriculas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            aluno_id INT NOT NULL,
            curso_id INT NOT NULL,
            data_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            CONSTRAINT fk_aluno_matricula FOREIGN KEY (aluno_id) REFERENCES alunos(id) ON DELETE CASCADE,
            CONSTRAINT fk_curso_matricula FOREIGN KEY (curso_id) REFERENCES cursos(id) ON DELETE CASCADE
        );
    ");
    echo "Migration: Tabela 'matriculas' criada com sucesso.\n";
}

function down($pdo) {
    $pdo->exec("DROP TABLE IF EXISTS matriculas;");
    echo "Migration: Tabela 'matriculas' revertida com sucesso.\n";
}