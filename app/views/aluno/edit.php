<?php
$aluno = $data['aluno'];
require_once __DIR__ . '/../partials/voltar_home.php';
?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="form-box">
    <h2>Editar Aluno</h2>

    <form method="POST" action="/bankmanager/public/aluno/update">
        <input type="hidden" name="id" value="<?= $aluno['id'] ?>">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?= $aluno['nome'] ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= $aluno['email'] ?>" required>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento" value="<?= $aluno['data_nascimento'] ?>" required>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/bankmanager/public/aluno" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
