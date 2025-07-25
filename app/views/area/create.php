<?php require_once __DIR__ . '/../partials/voltar_home.php'; ?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="form-box">
    <h2>Nova Área</h2>

    <form method="POST" action="/bankmanager/public/area/store">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" rows="4" required></textarea>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/bankmanager/public/area" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>