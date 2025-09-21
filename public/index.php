<?php $pageTitle = "Home | Portfolio van Mike Aarnoutse"; ?>
<?php include __DIR__ . '/header.php'; ?>

<section class="hero">
  <h2>Welkom bij mijn portfolio</h2>
  <p>Webdeveloper | Designer | Creator</p>
</section>

<section class="portfolio">
  <h2>Uitgelichte projecten</h2>
  <div class="project-grid">
    <?php
      $stmt = $pdo->query("SELECT id, title, description, image_path, url FROM projects WHERE visible=1 ORDER BY created_at DESC LIMIT 4");
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
