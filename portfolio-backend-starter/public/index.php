<?php require_once __DIR__ . '/../partials/header.php'; ?>
<section class="hero">
    <h2><?= htmlspecialchars($S['hero_title'] ?? 'Welkom bij mijn portfolio') ?></h2>
    <p><?= htmlspecialchars($S['hero_subtitle'] ?? 'Webdeveloper | Designer | Creator') ?></p>
</section>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
