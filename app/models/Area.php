<?php

require_once __DIR__ . '/../../config/database.php';

class Area {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM areas ORDER BY titulo");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM areas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($titulo, $descricao) {
        $stmt = $this->db->prepare("INSERT INTO areas (titulo, descricao) VALUES (?, ?)");
        return $stmt->execute([$titulo, $descricao]);
    }

    public function update($id, $titulo, $descricao) {
        $stmt = $this->db->prepare("UPDATE areas SET titulo = ?, descricao = ? WHERE id = ?");
        return $stmt->execute([$titulo, $descricao, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM areas WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
