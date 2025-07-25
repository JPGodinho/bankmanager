<?php 
$curso = $data['curso']; 
require_once __DIR__ . '/../partials/voltar_home.php';
?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="form-box">
    <h2>Editar Curso</h2>

    <form method="POST" action="/bankmanager/public/curso/update">
        <input type="hidden" name="id" value="<?= $curso['id'] ?>">

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($curso['titulo']) ?>" required>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" rows="4" required><?= htmlspecialchars($curso['descricao']) ?></textarea>

        <label for="area_id">Área:</label>
        <select name="area_id" id="area_id" required>
            <?php foreach ($data['areas'] as $area): ?>
                <option value="<?= $area['id'] ?>" <?= $area['id'] == $curso['area_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($area['titulo']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/bankmanager/public/curso" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
