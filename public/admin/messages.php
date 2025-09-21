<?php require_once __DIR__ . '/_auth.php'; require_login(); ?>
<?php include __DIR__ . '/_header.php'; ?>
<section>
  <h2>Berichten</h2>
  <?php
    if (isset($_GET['read'])) {
        $pdo->prepare("UPDATE messages SET unread=0 WHERE id=?")->execute([(int)$_GET['read']]);
    }
    $msgs = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchAll();
  ?>
  <?php foreach ($msgs as $m): ?>
    <div class="project" style="margin-bottom:1rem;">
      <h3><?= htmlspecialchars($m['name']) ?> (<?= htmlspecialchars($m['email']) ?>)</h3>
      <p><small><?= htmlspecialchars($m['created_at']) ?> <?= $m['unread'] ? '• Ongelezen' : '' ?></small></p>
      <p><?= nl2br(htmlspecialchars($m['message'])) ?></p>
      <?php if ($m['unread']): ?><p><a href="?read=<?= (int)$m['id'] ?>">Markeer als gelezen</a></p><?php endif; ?>
    </div>
  <?php endforeach; ?>
</section>
<?php include __DIR__ . '/_footer.php'; ?>
