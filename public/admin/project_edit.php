<?php require_once __DIR__ . '/_auth.php'; require_login(); ?>
<?php
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id=?");
$stmt->execute([$id]);
$proj = $stmt->fetch();
if (!$proj) { exit('Project niet gevonden.'); }

$err = $ok = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $desc  = trim($_POST['description'] ?? '');
    $url   = trim($_POST['url'] ?? '');
    $vis   = isset($_POST['visible']) ? 1 : 0;

    $imgName = $proj['image_path'];
    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
            $err = 'Ongeldig bestandsformaat.';
        } else {
            $imgNameNew = uniqid('img_') . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $UPLOAD_DIR . '/' . $imgNameNew)) {
                if ($imgName && file_exists($UPLOAD_DIR . '/' . $imgName)) { @unlink($UPLOAD_DIR . '/' . $imgName); }
                $imgName = $imgNameNew;
            } else {
                $err = 'Upload mislukt.';
            }
        }
    }

    if (!$err) {
        $stmt = $pdo->prepare("UPDATE projects SET title=?, description=?, image_path=?, url=?, visible=?, updated_at=NOW() WHERE id=?");
        $stmt->execute([$title, $desc, $imgName, $url, $vis, $id]);
        $ok = 'Project bijgewerkt.';
        $proj = array_merge($proj, ['title'=>$title,'description'=>$desc,'image_path'=>$imgName,'url'=>$url,'visible'=>$vis]);
    }
}
?>
<?php include __DIR__ . '/_header.php'; ?>
<section class="contact">
  <h2>Project bewerken</h2>
  <?php if ($err): ?><div class="alert error"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <?php if ($ok): ?><div class="alert success"><?= htmlspecialchars($ok) ?></div><?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <input name="title" value="<?= htmlspecialchars($proj['title']) ?>" required>
    <textarea name="description" rows="6"><?= htmlspecialchars($proj['description']) ?></textarea>
    <input name="url" value="<?= htmlspecialchars($proj['url']) ?>">
    <label><input type="checkbox" name="visible" <?= $proj['visible'] ? 'checked' : '' ?>> Zichtbaar</label>
    <p>Huidige afbeelding: <?= $proj['image_path'] ? htmlspecialchars($proj['image_path']) : 'geen' ?></p>
    <input type="file" name="image" accept="image/*">
    <button type="submit">Opslaan</button>
  </form>
</section>
<?php include __DIR__ . '/_footer.php'; ?>
