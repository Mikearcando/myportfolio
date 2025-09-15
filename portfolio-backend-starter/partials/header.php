<?php
require_once __DIR__ . '/../lib/db.php';
$settings = db()->query('SELECT key, value FROM settings')->fetchAll();
$S = [];
foreach ($settings as $row) { $S[$row['key']] = $row['value']; }
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($S['site_title'] ?? 'Portfolio') ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<header>
    <h1><?= htmlspecialchars($S['header_title'] ?? 'Portfolio') ?></h1>
    <nav>
        <ul>
            <li><a href="/index.php">Home</a></li>
            <li><a href="/about.php">Over mij</a></li>
            <li><a href="/portfolio.php">Portfolio</a></li>
            <li><a href="/contact.php">Contact</a></li>
        </ul>
    </nav>
</header>
<main>
