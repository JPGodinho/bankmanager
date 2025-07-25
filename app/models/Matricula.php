<?php

require_once __DIR__ . '/../../config/database.php';

class Matricula {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        $sql = "SELECT matriculas.id, alunos.nome AS aluno_nome, cursos.titulo AS curso_titulo,matriculas.data_matricula
                FROM matriculas
                INNER JOIN alunos ON matriculas.aluno_id = alunos.id
                INNER JOIN cursos ON matriculas.curso_id = cursos.id
                ORDER BY matriculas.data_matricula DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($aluno_id, $curso_id) {
        $stmt = $this->db->prepare("INSERT INTO matriculas (aluno_id, curso_id) VALUES (?, ?)");
        return $stmt->execute([$aluno_id, $curso_id]);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM matriculas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $aluno_id, $curso_id) {
        $stmt = $this->db->prepare("UPDATE matriculas SET aluno_id = ?, curso_id = ? WHERE id = ?");
        return $stmt->execute([$aluno_id, $curso_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM matriculas WHERE id = ?");
        return $stmt->execute([$id]);
    }
}