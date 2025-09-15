<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../lib/auth.php';

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $u = trim($_POST['username'] ?? '');
    $p = trim($_POST['password'] ?? '');
    if (login($u, $p)) {
        header('Location: /admin/index.php');
        exit;
    }
    $error = 'Onjuiste inloggegevens';
}
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inloggen</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<main class="portfolio" style="max-width:420px">
    <h2>Inloggen</h2>
    <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
        <?= csrf_field() ?>
        <input type="text" name="username" placeholder="Gebruikersnaam" required>
        <input type="password" name="password" placeholder="Wachtwoord" required>
        <button type="submit">Log in</button>
    </form>
</main>
</body>
</html>
