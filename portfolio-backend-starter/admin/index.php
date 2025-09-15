<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../lib/auth.php';
require_login();
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<main class="portfolio">
    <h2>Dashboard</h2>
    <p>Ingelogd als <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
    <ul>
        <li><a href="/admin/projects.php">Projecten beheren</a></li>
        <li><a href="/admin/settings.php">Site instellingen</a></li>
        <li><a href="/admin/messages.php">Berichten (contact)</a></li>
        <li><a href="/admin/logout.php">Uitloggen</a></li>
    </ul>
</main>
</body>
</html>
