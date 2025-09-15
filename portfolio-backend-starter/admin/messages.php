<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/../lib/db.php';
require_login();
$messages = db()->query('SELECT id, name, email, message, created_at FROM messages ORDER BY created_at DESC')->fetchAll();
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Berichten</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<main class="portfolio">
    <h2>Contactberichten</h2>
    <?php foreach ($messages as $m): ?>
        <div style="background:#fff;padding:1rem;border-radius:8px;margin-bottom:1rem;">
            <strong><?= htmlspecialchars($m['name']) ?></strong> (<?= htmlspecialchars($m['email']) ?>)
            <div><small><?= htmlspecialchars($m['created_at']) ?></small></div>
            <p><?= nl2br(htmlspecialchars($m['message'])) ?></p>
        </div>
    <?php endforeach; ?>
    <p><a href="/admin/index.php">Terug naar dashboard</a></p>
</main>
</body>
</html>
