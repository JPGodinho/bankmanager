<?php

require_once __DIR__ . '/../../config/database.php';

class Curso {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        $sql = "SELECT cursos.*, areas.titulo AS area_nome FROM cursos 
            INNER JOIN areas ON cursos.area_id = areas.id ORDER BY cursos.titulo";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM cursos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($titulo, $descricao, $area_id) {
        $stmt = $this->db->prepare("INSERT INTO cursos (titulo, descricao, area_id) VALUES (?, ?, ?)");
        return $stmt->execute([$titulo, $descricao, $area_id]);
    }

    public function update($id, $titulo, $descricao, $area_id) {
        $stmt = $this->db->prepare("UPDATE cursos SET titulo = ?, descricao = ?, area_id = ? WHERE id = ?");
        return $stmt->execute([$titulo, $descricao, $area_id, $id]);
    }
    
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM cursos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
