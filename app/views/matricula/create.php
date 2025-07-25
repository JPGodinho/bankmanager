<?php
$alunos = $data['alunos'];
$cursos = $data['cursos'];
require_once __DIR__ . '/../partials/voltar_home.php';
?>

<link rel="stylesheet" href="/bankmanager/public/css/style.css">

<div class="form-box">
    <h2>Nova Matrícula</h2>

    <form method="POST" action="/bankmanager/public/matricula/store">
        <label for="aluno_id">Aluno:</label>
        <select name="aluno_id" id="aluno_id" required>
            <option value="">Selecione um aluno</option>
            <?php foreach ($alunos as $aluno): ?>
                <option value="<?= $aluno['id'] ?>"><?= htmlspecialchars($aluno['nome']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="curso_id">Curso:</label>
        <select name="curso_id" id="curso_id" required>
            <option value="">Selecione um curso</option>
            <?php foreach ($cursos as $curso): ?>
                <option value="<?= $curso['id'] ?>"><?= htmlspecialchars($curso['titulo']) ?></option>
            <?php endforeach; ?>
        </select>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="/bankmanager/public/matricula" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>