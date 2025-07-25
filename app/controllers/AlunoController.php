<?php

require_once __DIR__ . '/../core/Auth.php';
Auth::checkLogin();

class AlunoController extends Controller {

    private $alunoModel;

    public function __construct() {

        $this->alunoModel = $this->model('Aluno');
        
    }

    public function index() {
        $filtro = $_GET['busca'] ?? '';
        $alunos = $this->alunoModel->getAll($filtro);
        $this->view('aluno/index', ['alunos' => $alunos, 'filtro' => $filtro]);
    }

    public function create() {
        $this->view('aluno/create');
    }

    public function store() {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $data = $_POST['data_nascimento'] ?? null;

        $this->alunoModel->create($nome, $email, $data);

        header('Location: /bankmanager/public/aluno');
        exit;
    }

    public function edit($id) {
        $aluno = $this->alunoModel->findById($id);
        $this->view('aluno/edit', ['aluno' => $aluno]);
    }

    public function update() {
        $id = $_POST['id'];
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $data = $_POST['data_nascimento'] ?? null;

        $data = $data ?: null;

        $this->alunoModel->update($id, $nome, $email, $data);
        header('Location: /bankmanager/public/aluno');
        exit;
    }

    public function delete($id) {
        $this->alunoModel->delete($id);
        header('Location: /bankmanager/public/aluno');
        exit;
    }


}