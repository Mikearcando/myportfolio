<?php
// Gebruik $pageTitle voor de <title>. Als niet gezet, gebruik een fallback.
if (!isset($pageTitle)) { $pageTitle = "Portfolio van Mike Aarnoutse"; }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Mike Aarnoutse</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">Over mij</a></li>
                <li><a href="portfolio.php">Portfolio</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
