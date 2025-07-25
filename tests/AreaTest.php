<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../app/models/Area.php';
require_once __DIR__ . '/../config/database.php';

class AreaTest extends TestCase
{
    private $pdo;
    private $areaModel;

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

            $this->pdo->exec("DELETE FROM areas");

        } catch (PDOException $e) {
            $this->fail("Não foi possível conectar ao banco de dados de teste para AreaTest: " . $e->getMessage());
        }

        $this->areaModel = new Area();
    }

    protected function tearDown(): void
    {
        $this->pdo->exec("DELETE FROM areas");
        $this->pdo = null;
        $this->areaModel = null;
        parent::tearDown();
    }

    public function testCreateArea()
    {
        $titulo = "Biologia";
        $descricao = "Área de estudos da vida.";

        $result = $this->areaModel->create($titulo, $descricao);
        $this->assertTrue($result, "Falha ao criar a área.");

        $stmt = $this->pdo->prepare("SELECT * FROM areas WHERE titulo = ?");
        $stmt->execute([$titulo]);
        $area = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertIsArray($area);
        $this->assertEquals($titulo, $area['titulo']);
        $this->assertEquals($descricao, $area['descricao']);
    }

    public function testFindAreaById()
    {
        $this->areaModel->create("Química", "Estudo da matéria.");
        $stmt = $this->pdo->prepare("SELECT id FROM areas WHERE titulo = 'Química'");
        $stmt->execute();
        $areaId = $stmt->fetchColumn();

        $this->assertNotNull($areaId, "ID da área não encontrado após a criação.");

        $foundArea = $this->areaModel->findById($areaId);

        $this->assertIsArray($foundArea);
        $this->assertEquals($areaId, $foundArea['id']);
        $this->assertEquals("Química", $foundArea['titulo']);
    }

    public function testUpdateArea()
    {
        $this->areaModel->create("Física Original", "Estudo da natureza.");
        $stmt = $this->pdo->prepare("SELECT id FROM areas WHERE titulo = 'Física Original'");
        $stmt->execute();
        $areaId = $stmt->fetchColumn();

        $newTitulo = "Física Atualizada";
        $newDescricao = "Estudo das leis fundamentais do universo.";

        $result = $this->areaModel->update($areaId, $newTitulo, $newDescricao);
        $this->assertTrue($result, "Falha ao atualizar a área.");

        $updatedArea = $this->areaModel->findById($areaId);

        $this->assertEquals($newTitulo, $updatedArea['titulo']);
        $this->assertEquals($newDescricao, $updatedArea['descricao']);
    }

    public function testDeleteArea()
    {
        $this->areaModel->create("Matemática para Deletar", "Estudo de números e formas.");
        $stmt = $this->pdo->prepare("SELECT id FROM areas WHERE titulo = 'Matemática para Deletar'");
        $stmt->execute();
        $areaId = $stmt->fetchColumn();

        $result = $this->areaModel->delete($areaId);
        $this->assertTrue($result, "Falha ao deletar a área.");

        $deletedArea = $this->areaModel->findById($areaId);
        $this->assertFalse($deletedArea, "Área não foi deletada do banco de dados.");
    }

    public function testGetAllAreas()
    {
        $this->areaModel->create("História", "Estudo do passado.");
        $this->areaModel->create("Geografia", "Estudo do espaço terrestre.");

        $allAreas = $this->areaModel->getAll();
        $this->assertCount(2, $allAreas); 
        $this->assertEquals("Geografia", $allAreas[0]['titulo']); 
        $this->assertEquals("História", $allAreas[1]['titulo']);
    }
}