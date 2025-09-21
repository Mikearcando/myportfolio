<?php require_once __DIR__ . '/_auth.php'; require_login(); ?>
<?php
$ok = $err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['site_title'] ?? '');
    $about = trim($_POST['about_text'] ?? '');
    try {
        $stmt = $pdo->prepare("INSERT INTO settings (`key`,`value`) VALUES ('site_title',?) ON DUPLICATE KEY UPDATE value=VALUES(value)");
        $stmt->execute([$title]);
        $stmt = $pdo->prepare("INSERT INTO settings (`key`,`value`) VALUES ('about_text',?) ON DUPLICATE KEY UPDATE value=VALUES(value)");
        $stmt->execute([$about]);
        $ok = 'Instellingen opgeslagen.';
    } catch (Exception $e) { $err = 'Opslaan mislukt.'; }
}
$currTitle = setting_get($pdo, 'site_title', 'Portfolio van Mike Aarnoutse');
$currAbout = setting_get($pdo, 'about_text', '');
?>
<?php include __DIR__ . '/_header.php'; ?>
<section class="contact">
  <h2>Instellingen</h2>
  <?php if ($ok): ?><div class="alert success"><?= htmlspecialchars($ok) ?></div><?php endif; ?>
  <?php if ($err): ?><div class="alert error"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <form method="post">
    <input name="site_title" value="<?= htmlspecialchars($currTitle) ?>" placeholder="Site titel" required>
    <textarea name="about_text" rows="8" placeholder="Over mij tekst"><?= htmlspecialchars($currAbout) ?></textarea>
    <button type="submit">Opslaan</button>
  </form>
</section>
<?php include __DIR__ . '/_footer.php'; ?>
