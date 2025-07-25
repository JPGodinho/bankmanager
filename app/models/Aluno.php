<?php

require_once __DIR__ . '/../../config/database.php';

class Aluno {

    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll($filtro = '') {
        if($filtro) {
            $sql = "SELECT * FROM alunos WHERE nome LIKE :filtro OR email LIKE :filtro ORDER BY nome";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':filtro', '%' . $filtro . '%');
        } else {
            $stmt = $this->db->prepare("SELECT * FROM alunos ORDER BY nome");
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nome, $email, $data_nascimento) {

        $data_nascimento = $data_nascimento ?: null;
        $stmt = $this->db->prepare("INSERT INTO alunos (nome, email, data_nascimento) VALUES (?, ?, ?)");

        return $stmt->execute([$nome, $email, $data_nascimento]);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM alunos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $email, $data_nascimento) {
    $stmt = $this->db->prepare("UPDATE alunos SET nome = ?, email = ?, data_nascimento = ? WHERE id = ?");
    return $stmt->execute([$nome, $email, $data_nascimento, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM alunos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}