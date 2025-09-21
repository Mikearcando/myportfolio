<?php
require_once __DIR__ . '/includes/db.php';
$siteTitle = setting_get($pdo, 'site_title', 'Portfolio van Mike Aarnoutse');
if (!isset($pageTitle)) { $pageTitle = $siteTitle; }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="stylesheet" href="<?= $BASE_URL ?>/style.css">
</head>
<body>
<header>
  <h1><?= htmlspecialchars($siteTitle) ?></h1>
  <nav>
    <ul>
      <li><a href="<?= $BASE_URL ?>/index.php">Home</a></li>
      <li><a href="<?= $BASE_URL ?>/about.php">Over mij</a></li>
      <li><a href="<?= $BASE_URL ?>/portfolio.php">Portfolio</a></li>
      <li><a href="<?= $BASE_URL ?>/contact.php">Contact</a></li>
    </ul>
  </nav>
</header>
<main>
