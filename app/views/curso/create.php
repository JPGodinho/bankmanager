<?php require_once __DIR__ . '/../partials/voltar_home.php'; ?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="form-box">
    <h2>Novo Curso</h2>

    <form method="POST" action="/bankmanager/public/curso/store">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" rows="4" required></textarea>

        <label for="area_id">Área:</label>
        <select name="area_id" id="area_id" required>
            <option value="">Selecione uma área</option>
            <?php foreach ($data['areas'] as $area): ?>
                <option value="<?= $area['id'] ?>"><?= htmlspecialchars($area['titulo']) ?></option>
            <?php endforeach; ?>
        </select>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/bankmanager/public/curso" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
