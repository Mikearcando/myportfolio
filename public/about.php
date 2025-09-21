<?php $pageTitle = "Over mij | Portfolio van Mike Aarnoutse"; ?>
<?php include __DIR__ . '/header.php'; ?>

<section>
  <h2>Over mij</h2>
  <p><?= nl2br(htmlspecialchars(setting_get($pdo, 'about_text', 'Ik ben Mike Aarnoutse, een creatieve en gedreven webdeveloper met een passie voor moderne technologie en design.'))) ?></p>
</section>

<?php include __DIR__ . '/footer.php'; ?>
