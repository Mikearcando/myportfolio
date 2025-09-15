<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/../lib/db.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    foreach (['site_title','header_title','hero_title','hero_subtitle','about_text','footer_text'] as $k) {
        $v = $_POST[$k] ?? '';
        $stmt = db()->prepare('INSERT INTO settings (key, value) VALUES (:k,:v)
            ON CONFLICT(key) DO UPDATE SET value = excluded.value');
        $stmt->execute([':k'=>$k, ':v'=>$v]);
    }
    flash('success', 'Instellingen opgeslagen');
    header('Location: /admin/settings.php');
    exit;
}

$rows = db()->query('SELECT key, value FROM settings')->fetchAll();
$S = [];
foreach ($rows as $r) { $S[$r['key']] = $r['value']; }
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instellingen</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<main class="portfolio">
    <h2>Site instellingen</h2>
    <?php if ($msg = flash('success')): ?><div class="alert success"><?= htmlspecialchars($msg) ?></div><?php endif; ?>
    <form method="post">
        <?= csrf_field() ?>
        <label>Sitetitel <input type="text" name="site_title" value="<?= htmlspecialchars($S['site_title'] ?? '') ?>"></label>
        <label>Header titel <input type="text" name="header_title" value="<?= htmlspecialchars($S['header_title'] ?? '') ?>"></label>
        <label>Hero titel <input type="text" name="hero_title" value="<?= htmlspecialchars($S['hero_title'] ?? '') ?>"></label>
        <label>Hero ondertitel <input type="text" name="hero_subtitle" value="<?= htmlspecialchars($S['hero_subtitle'] ?? '') ?>"></label>
        <label>Over mij (tekst)
            <textarea name="about_text" rows="6"><?= htmlspecialchars($S['about_text'] ?? '') ?></textarea>
        </label>
        <label>Footer tekst <input type="text" name="footer_text" value="<?= htmlspecialchars($S['footer_text'] ?? '') ?>"></label>
        <button type="submit">Opslaan</button>
    </form>
    <p><a href="/admin/index.php">Terug naar dashboard</a></p>
</main>
</body>
</html>
