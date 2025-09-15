<?php require_once __DIR__ . '/../partials/header.php'; ?>
<section class="portfolio">
    <h2>Mijn projecten</h2>
    <div class="project-grid">
        <?php
        require_once __DIR__ . '/../lib/db.php';
        $stmt = db()->query('SELECT id, title, description, image_url FROM projects WHERE visible = 1 ORDER BY created_at DESC');
        foreach ($stmt as $p): ?>
            <div class="project">
                <?php if (!empty($p['image_url'])): ?>
                    <img src="<?= htmlspecialchars($p['image_url']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" style="max-width:100%;border-radius:8px;">
                <?php endif; ?>
                <h3><?= htmlspecialchars($p['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($p['description'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
