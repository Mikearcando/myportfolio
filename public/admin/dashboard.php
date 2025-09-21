<?php require_once __DIR__ . '/_auth.php'; require_login(); ?>
<?php include __DIR__ . '/_header.php'; ?>
<section>
  <h2>Welkom, <?= htmlspecialchars($_SESSION['username'] ?? 'admin') ?></h2>
  <p>Kies een onderdeel in het menu om te beheren.</p>
</section>
<?php include __DIR__ . '/_footer.php'; ?>
