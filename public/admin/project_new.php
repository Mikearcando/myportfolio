<?php require_once __DIR__ . '/_auth.php'; require_login(); ?>
<?php
$err = $ok = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $desc  = trim($_POST['description'] ?? '');
    $url   = trim($_POST['url'] ?? '');
    $vis   = isset($_POST['visible']) ? 1 : 0;

    $imgName = null;
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
            $err = 'Ongeldig bestandsformaat.';
        } else {
            $imgName = uniqid('img_') . '.' . $ext;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $UPLOAD_DIR . '/' . $imgName)) {
                $err = 'Upload mislukt.';
            }
        }
    }

    if (!$err) {
        $stmt = $pdo->prepare("INSERT INTO projects (title, description, image_path, url, visible, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->execute([$title, $desc, $imgName, $url, $vis]);
        $ok = 'Project aangemaakt.';
    }
}
?>
<?php include __DIR__ . '/_header.php'; ?>
<section class="contact">
  <h2>Nieuw project</h2>
  <?php if ($err): ?><div class="alert error"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <?php if ($ok): ?><div class="alert success"><?= htmlspecialchars($ok) ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <input name="title" placeholder="Titel" required>
    <textarea name="description" placeholder="Beschrijving" rows="6"></textarea>
    <input name="url" placeholder="Project URL (optioneel)">
    <label><input type="checkbox" name="visible" checked> Zichtbaar</label>
    <input type="file" name="image" accept="image/*">
    <button type="submit">Opslaan</button>
  </form>
</section>
<?php include __DIR__ . '/_footer.php'; ?>
