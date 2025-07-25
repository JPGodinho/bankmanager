<?php
$areas = $data['areas']; 
require_once __DIR__ . '/../partials/voltar_home.php';
?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="container">
    <h2>Áreas Cadastradas</h2>

    <div class="top-actions">
        <div></div> <a href="/bankmanager/public/area/create" class="btn btn-success">+ Nova Área</a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th class="text-center">Ações</th> </tr>
        </thead>
        <tbody>
            <?php foreach ($areas as $area): ?>
                <tr>
                    <td><?= htmlspecialchars($area['titulo']) ?></td>
                    <td><?= htmlspecialchars($area['descricao']) ?></td>
                    <td class="text-center">
                        <a href="/bankmanager/public/area/edit/<?= $area['id'] ?>" class="btn btn-warning">Editar</a>
                        <a href="/bankmanager/public/area/delete/<?= $area['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta área?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>