<?php
$alunos = $data['alunos'];
require_once __DIR__ . '/../partials/voltar_home.php';
?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="container">
    <h2>Lista de Alunos</h2>

    <div class="top-actions">
        <form>
            <input type="text" name="busca" id="buscaAlunoInput" placeholder="Buscar por nome ou email" value="<?= $data['filtro'] ?? '' ?>">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <a href="/bankmanager/public/aluno/create" class="btn btn-success">+ Novo Aluno</a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Data de Nascimento</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?= htmlspecialchars($aluno['nome']) ?></td>
                    <td><?= htmlspecialchars($aluno['email']) ?></td>
                    <td><?= date('d/m/Y', strtotime($aluno['data_nascimento'])) ?></td>
                    <td class="text-center">
                        <a href="/bankmanager/public/aluno/edit/<?= $aluno['id'] ?>" class="btn btn-warning">Editar</a>
                        <a href="/bankmanager/public/aluno/delete/<?= $aluno['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este aluno?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="/bankmanager/public/js/alunoFilter.js"></script>
