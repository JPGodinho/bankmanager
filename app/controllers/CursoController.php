<?php

require_once __DIR__ . '/../core/Auth.php';
Auth::checkLogin();

class CursoController extends Controller {
    private $cursoModel;
    private $areaModel;

    public function __construct() {
        $this->cursoModel = $this->model('Curso');
        $this->areaModel = $this->model('Area');
    }

    public function index() {
        $cursos = $this->cursoModel->getAll();
        $this->view('curso/index', ['cursos' => $cursos]);
    }

    public function create() {
        $areas = $this->areaModel->getAll();
        $this->view('curso/create', ['areas' => $areas]);
    }

    public function store() {
        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $area_id = $_POST['area_id'] ?? null;

        $this->cursoModel->create($titulo, $descricao, $area_id);
        header('Location: /bankmanager/public/curso');
        exit;
    }

    public function edit($id) {
        $curso = $this->cursoModel->findById($id);
        $areas = $this->areaModel->getAll();

        $this->view('curso/edit', [ 'curso' => $curso, 'areas' => $areas ]);
    }

    public function update() {
        $id = $_POST['id'];
        $titulo = $_POST['titulo'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $area_id = $_POST['area_id'] ?? null;

        $this->cursoModel->update($id, $titulo, $descricao, $area_id);
        header('Location: /bankmanager/public/curso');
        exit;
    }

    public function delete($id) {
        $this->cursoModel->delete($id);
        header('Location: /bankmanager/public/curso');
        exit;
    }
}
