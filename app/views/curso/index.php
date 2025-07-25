<?php
$cursos = $data['cursos'];
require_once __DIR__ . '/../partials/voltar_home.php';
?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="container">
    <h2>Cursos Cadastrados</h2>

    <div class="top-actions">
        <div></div>
        <a href="/bankmanager/public/curso/create" class="btn btn-success">+ Novo Curso</a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Área</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cursos as $curso): ?>
                <tr>
                    <td><?= htmlspecialchars($curso['titulo']) ?></td>
                    <td><?= htmlspecialchars($curso['descricao']) ?></td>
                    <td><?= htmlspecialchars($curso['area_nome']) ?></td>
                    <td class="text-center">
                        <a href="/bankmanager/public/curso/edit/<?= $curso['id'] ?>" class="btn btn-warning">Editar</a>
                        <a href="/bankmanager/public/curso/delete/<?= $curso['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este curso?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
