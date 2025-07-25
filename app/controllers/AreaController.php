<?php

require_once __DIR__ . '/../core/Auth.php';
Auth::checkLogin();

class AreaController extends Controller {
    private $areaModel;

    public function __construct() {
        $this->areaModel = $this->model('Area');
    }

    public function index() {
        $areas = $this->areaModel->getAll();
        $this->view('area/index', ['areas' => $areas]);
    }

    public function create() {
        $this->view('area/create');
    }

    public function store() {
        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? null;

        $this->areaModel->create($titulo, $descricao);
        header('Location: /bankmanager/public/area');
        exit;
    }

    public function edit($id) {
        $area = $this->areaModel->findById($id);
        $this->view('area/edit', ['area' => $area]);
    }

    public function update() {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? null;

        $this->areaModel->update($id, $titulo, $descricao);
        header('Location: /bankmanager/public/area');
        exit;
    }

    public function delete($id) {
        $this->areaModel->delete($id);
        header('Location: /bankmanager/public/area');
        exit;
    }
}
