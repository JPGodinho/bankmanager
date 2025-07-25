<?php 
$area = $data['area']; 
require_once __DIR__ . '/../partials/voltar_home.php';
?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="form-box">
    <h2>Editar Área</h2>

    <form method="POST" action="/bankmanager/public/area/update">
        <input type="hidden" name="id" value="<?= $area['id'] ?>">

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($area['titulo']) ?>" required>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" rows="4" required><?= htmlspecialchars($area['descricao']) ?></textarea>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/bankmanager/public/area" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>