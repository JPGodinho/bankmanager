<?php

require_once __DIR__ . '/../core/Auth.php';
Auth::checkLogin();

class MatriculaController extends Controller {
    private $matriculaModel;
    private $alunoModel;
    private $cursoModel;

    public function __construct() {
        $this->matriculaModel = $this->model('Matricula');
        $this->alunoModel = $this->model('Aluno');
        $this->cursoModel = $this->model('Curso');
    }

    public function index() {
        $matriculas = $this->matriculaModel->getAll();
        $this->view('matricula/index', ['matriculas' => $matriculas]);
    }

    public function create() {
        $alunos = $this->alunoModel->getAll();
        $cursos = $this->cursoModel->getAll();

        $this->view('matricula/create', [ 'alunos' => $alunos, 'cursos' => $cursos ]);
    }

    public function store() {
        $aluno_id = $_POST['aluno_id'];
        $curso_id = $_POST['curso_id'];

        $this->matriculaModel->create($aluno_id, $curso_id);
        header('Location: /bankmanager/public/matricula');
        exit;
    }

    public function edit($id) {
        $matricula = $this->matriculaModel->findById($id);
        
        $alunos = $this->alunoModel->getAll();
        $cursos = $this->cursoModel->getAll();

        $this->view('matricula/edit', [ 'matricula' => $matricula, 'alunos' => $alunos, 'cursos' => $cursos ]);
    }

    public function update() {

        $id = $_POST['id'] ?? null;
        $aluno_id = $_POST['aluno_id'] ?? null;
        $curso_id = $_POST['curso_id'] ?? null;

        $this->matriculaModel->update($id, $aluno_id, $curso_id);
        header('Location: /bankmanager/public/matricula');
        exit;
    }

    public function delete($id) {
        $this->matriculaModel->delete($id);
        header('Location: /bankmanager/public/matricula');
        exit;
    }
}
