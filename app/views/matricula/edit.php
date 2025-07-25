<?php
$matricula = $data['matricula'];
$alunos = $data['alunos'];
$cursos = $data['cursos'];
require_once __DIR__ . '/../partials/voltar_home.php';
?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="form-box">
    <h2>Editar Matrícula</h2>

    <form method="POST" action="/bankmanager/public/matricula/update">
        <input type="hidden" name="id" value="<?= $matricula['id'] ?>">

        <label for="aluno_id">Aluno:</label>
        <select name="aluno_id" id="aluno_id" required>
            <?php foreach ($alunos as $aluno): ?>
                <option value="<?= $aluno['id'] ?>" <?= $aluno['id'] == $matricula['aluno_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($aluno['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="curso_id">Curso:</label>
        <select name="curso_id" id="curso_id" required>
            <?php foreach ($cursos as $curso): ?>
                <option value="<?= $curso['id'] ?>" <?= $curso['id'] == $matricula['curso_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($curso['titulo']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/bankmanager/public/matricula" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>