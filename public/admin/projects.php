<?php require_once __DIR__ . '/_auth.php'; require_login(); ?>
<?php include __DIR__ . '/_header.php'; ?>
<section class="portfolio">
  <h2>Projecten</h2>
  <p><a href="project_new.php"><button>Nieuw project</button></a></p>
  <div class="project-grid">
    <?php
      $stmt = $pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
      foreach ($stmt as $proj):
        $img = $proj['image_path'] ? htmlspecialchars($UPLOAD_URL . '/' . $proj['image_path']) : null;
    ?>
    <div class="project">
      <h3><?= htmlspecialchars($proj['title']) ?></h3>
      <?php if ($img): ?><img src="<?= $img ?>" alt="" style="max-width:100%; border-radius:6px;"><?php endif; ?>
      <p><?= nl2br(htmlspecialchars($proj['description'])) ?></p>
      <p>URL: <?= htmlspecialchars($proj['url'] ?: '-') ?></p>
      <p>Zichtbaar: <?= $proj['visible'] ? 'Ja' : 'Nee' ?></p>
      <p>
        <a href="project_edit.php?id=<?= (int)$proj['id'] ?>">Bewerken</a> | 
        <a href="project_delete.php?id=<?= (int)$proj['id'] ?>" onclick="return confirm('Weet je zeker dat je dit project wilt verwijderen?')">Verwijderen</a>
      </p>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php include __DIR__ . '/_footer.php'; ?>
