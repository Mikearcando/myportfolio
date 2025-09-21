<?php $pageTitle = "Portfolio | Mike Aarnoutse"; ?>
<?php include __DIR__ . '/header.php'; ?>

<section class="portfolio">
  <h2>Mijn projecten</h2>
  <div class="project-grid">
    <?php
      $stmt = $pdo->query("SELECT id, title, description, image_path, url FROM projects WHERE visible=1 ORDER BY created_at DESC");
      foreach ($stmt as $proj):
        $img = $proj['image_path'] ? htmlspecialchars($UPLOAD_URL . '/' . $proj['image_path']) : null;
    ?>
    <div class="project">
      <h3><?= htmlspecialchars($proj['title']) ?></h3>
      <?php if ($img): ?><img src="<?= $img ?>" alt="" style="max-width:100%; border-radius:6px;"><?php endif; ?>
      <p><?= nl2br(htmlspecialchars($proj['description'])) ?></p>
      <?php if ($proj['url']): ?><p><a href="<?= htmlspecialchars($proj['url']) ?>" target="_blank" rel="noopener">Bekijk project</a></p><?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
