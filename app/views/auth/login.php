<?php
session_start();
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bankmanager/public/css/style.css">
    <title>Login - BankManager</title>
</head>
<body>
    <div class="login-container">
        <h2>Login do Administrador</h2>

        <?php if ($error): ?>
            <p style="color: red; text-align: center;"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="/bankmanager/public/auth/authenticate">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
