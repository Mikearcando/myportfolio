<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../lib/auth.php';
require_once __DIR__ . '/../lib/db.php';
require_login();

// Handle create/update/delete
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = $_POST['action'] ?? '';
    if ($action === 'create') {
        $stmt = db()->prepare('INSERT INTO projects (title, description, image_url, visible, created_at) VALUES (:t, :d, :i, :v, :c)');
        $stmt->execute([
            ':t' => trim($_POST['title'] ?? ''),
            ':d' => trim($_POST['description'] ?? ''),
            ':i' => trim($_POST['image_url'] ?? ''),
            ':v' => isset($_POST['visible']) ? 1 : 0,
            ':c' => date('c'),
        ]);
    } elseif ($action === 'update') {
        $stmt = db()->prepare('UPDATE projects SET title=:t, description=:d, image_url=:i, visible=:v WHERE id=:id');
        $stmt->execute([
            ':t' => trim($_POST['title'] ?? ''),
            ':d' => trim($_POST['description'] ?? ''),
            ':i' => trim($_POST['image_url'] ?? ''),
            ':v' => isset($_POST['visible']) ? 1 : 0,
            ':id' => (int)($_POST['id'] ?? 0),
        ]);
    } elseif ($action === 'delete') {
        $stmt = db()->prepare('DELETE FROM projects WHERE id=:id');
        $stmt->execute([':id' => (int)($_POST['id'] ?? 0)]);
    }
    header('Location: /admin/projects.php');
    exit;
}

$projects = db()->query('SELECT * FROM projects ORDER BY created_at DESC')->fetchAll();
?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projecten beheren</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<main class="portfolio">
    <h2>Projecten beheren</h2>
    <section>
        <h3>Nieuw project</h3>
        <form method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="create">
            <input type="text" name="title" placeholder="Titel" required>
            <textarea name="description" placeholder="Beschrijving" rows="4" required></textarea>
            <input type="text" name="image_url" placeholder="Afbeeldings-URL (optioneel)">
            <label><input type="checkbox" name="visible" checked> Zichtbaar</label>
            <button type="submit">Opslaan</button>
        </form>
    </section>
    <section>
        <h3>Bestaande projecten</h3>
        <?php foreach ($projects as $p): ?>
            <form method="post" style="background:#fff;padding:1rem;border-radius:8px;margin-bottom:1rem;">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                <input type="text" name="title" value="<?= htmlspecialchars($p['title']) ?>" required>
                <textarea name="description" rows="3" required><?= htmlspecialchars($p['description']) ?></textarea>
                <input type="text" name="image_url" value="<?= htmlspecialchars($p['image_url']) ?>">
                <label><input type="checkbox" name="visible" <?= $p['visible'] ? 'checked' : '' ?>> Zichtbaar</label>
                <div style="display:flex;gap:0.5rem;">
                    <button type="submit">Bijwerken</button>
                </div>
            </form>
            <form method="post" onsubmit="return confirm('Weet je zeker dat je dit project wilt verwijderen?');">
                <?= csrf_field() ?>
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                <button type="submit">Verwijderen</button>
            </form>
            <hr>
        <?php endforeach; ?>
    </section>
    <p><a href="/admin/index.php">Terug naar dashboard</a></p>
</main>
</body>
</html>
