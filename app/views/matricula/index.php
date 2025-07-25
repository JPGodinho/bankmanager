<?php
$matriculas = $data['matriculas'];
require_once __DIR__ . '/../partials/voltar_home.php';
?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="container">
    <h2>Matrículas Realizadas</h2>

    <div class="top-actions">
        <div></div>
        <a href="/bankmanager/public/matricula/create" class="btn btn-success">+ Nova Matrícula</a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Curso</th>
                <th>Data da Matrícula</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matriculas as $matricula): ?>
                <tr>
                    <td><?= htmlspecialchars($matricula['aluno_nome']) ?></td>
                    <td><?= htmlspecialchars($matricula['curso_titulo']) ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($matricula['data_matricula']))) ?></td>
                    <td class="text-center">
                        <a href="/bankmanager/public/matricula/edit/<?= $matricula['id'] ?>" class="btn btn-warning">Editar</a>
                        <a href="/bankmanager/public/matricula/delete/<?= $matricula['id'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta matrícula?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>