<?php require_once __DIR__ . '/../partials/voltar_home.php'; ?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="form-box">
    <h2>Novo Aluno</h2>

    <form method="POST" action="/bankmanager/public/aluno/store">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" name="data_nascimento" id="data_nascimento" required>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/bankmanager/public/aluno" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>
