<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/models/Aluno.php';
require_once __DIR__ . '/../config/database.php';

class AlunoTest extends TestCase
{
    private $pdo;
    private $alunoModel;

    protected function setUp(): void
    {
        parent::setUp();

        $host = getenv('MYSQL_HOST') ?: 'localhost';
        $dbName = getenv('MYSQL_DATABASE') ?: 'bankmanager';
        $username = getenv('MYSQL_USER') ?: 'root';
        $password = getenv('MYSQL_PASSWORD') ?: '';

        try {
            $this->pdo = new PDO(
                "mysql:host=" . $host . ";dbname=" . $dbName,
                $username,
                $password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo->exec("DELETE FROM alunos");

        } catch (PDOException $e) {
            $this->fail("Não foi possível conectar ao banco de dados de teste: " . $e->getMessage());
        }

        $this->alunoModel = new Aluno();
    }

    protected function tearDown(): void
    {
        $this->pdo->exec("DELETE FROM alunos");
        $this->pdo = null;
        $this->alunoModel = null;
        parent::tearDown();
    }

    public function testCreateAluno()
    {
        $nome = "Aluno Teste 1";
        $email = "aluno1@teste.com";
        $dataNascimento = "2000-01-01";

        $result = $this->alunoModel->create($nome, $email, $dataNascimento);
        $this->assertTrue($result, "Falha ao criar o aluno.");

        $stmt = $this->pdo->prepare("SELECT * FROM alunos WHERE email = ?");
        $stmt->execute([$email]);
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertIsArray($aluno);
        $this->assertEquals($nome, $aluno['nome']);
        $this->assertEquals($email, $aluno['email']);
        $this->assertEquals($dataNascimento, $aluno['data_nascimento']);
    }

    public function testFindAlunoById()
    {
        $nome = "Aluno Busca";
        $email = "aluno.busca@teste.com";
        $dataNascimento = "1995-05-05";
        $this->alunoModel->create($nome, $email, $dataNascimento);

        $stmt = $this->pdo->prepare("SELECT id FROM alunos WHERE email = ?");
        $stmt->execute([$email]);
        $alunoId = $stmt->fetchColumn();

        $this->assertNotNull($alunoId, "ID do aluno não encontrado após a criação.");

        $foundAluno = $this->alunoModel->findById($alunoId);

        $this->assertIsArray($foundAluno);
        $this->assertEquals($alunoId, $foundAluno['id']);
        $this->assertEquals($nome, $foundAluno['nome']);
        $this->assertEquals($email, $foundAluno['email']);
    }

    public function testUpdateAluno()
    {
        $this->alunoModel->create("Aluno Original", "original@teste.com", "1990-10-10");
        $stmt = $this->pdo->prepare("SELECT id FROM alunos WHERE email = 'original@teste.com'");
        $stmt->execute();
        $alunoId = $stmt->fetchColumn();

        $newName = "Aluno Atualizado";
        $newEmail = "atualizado@teste.com";
        $newDataNascimento = "1991-11-11";

        $result = $this->alunoModel->update($alunoId, $newName, $newEmail, $newDataNascimento);
        $this->assertTrue($result, "Falha ao atualizar o aluno.");

        $updatedAluno = $this->alunoModel->findById($alunoId);

        $this->assertEquals($newName, $updatedAluno['nome']);
        $this->assertEquals($newEmail, $updatedAluno['email']);
        $this->assertEquals($newDataNascimento, $updatedAluno['data_nascimento']);
    }

    public function testDeleteAluno()
    {
        $this->alunoModel->create("Aluno Deletar", "deletar@teste.com", "1980-01-01");
        $stmt = $this->pdo->prepare("SELECT id FROM alunos WHERE email = 'deletar@teste.com'");
        $stmt->execute();
        $alunoId = $stmt->fetchColumn();

        $result = $this->alunoModel->delete($alunoId);
        $this->assertTrue($result, "Falha ao deletar o aluno.");

        $deletedAluno = $this->alunoModel->findById($alunoId);
        $this->assertFalse($deletedAluno, "Aluno não foi deletado do banco de dados.");
    }

    public function testGetAllAlunosWithFilter()
    {
        $this->alunoModel->create("Joao Silva", "joao.s@email.com", "2001-01-01");
        $this->alunoModel->create("Maria Santos", "maria.santos@email.com", "2002-02-02");
        $this->alunoModel->create("Pedro Almeida", "pedro.a@outro.com", "2003-03-03");

        $alunosFiltradosNome = $this->alunoModel->getAll("Joao");
        $this->assertCount(1, $alunosFiltradosNome);
        $this->assertEquals("Joao Silva", $alunosFiltradosNome[0]['nome']);

        $alunosFiltradosEmail = $this->alunoModel->getAll("@outro.com");
        $this->assertCount(1, $alunosFiltradosEmail);
        $this->assertEquals("Pedro Almeida", $alunosFiltradosEmail[0]['nome']);

        $alunosNaoEncontrados = $this->alunoModel->getAll("Inexistente");
        $this->assertCount(0, $alunosNaoEncontrados);

        $todosAlunos = $this->alunoModel->getAll("");
        $this->assertCount(3, $todosAlunos);
    }
}