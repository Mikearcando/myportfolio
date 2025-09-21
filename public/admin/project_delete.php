<?php require_once __DIR__ . '/_auth.php'; require_login(); ?>
<?php
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT image_path FROM projects WHERE id=?");
$stmt->execute([$id]);
$row = $stmt->fetch();
if ($row) {
    if (!empty($row['image_path']) && file_exists($UPLOAD_DIR . '/' . $row['image_path'])) {
        @unlink($UPLOAD_DIR . '/' . $row['image_path']);
    }
    $pdo->prepare("DELETE FROM projects WHERE id=?")->execute([$id]);
}
header('Location: projects.php');
exit;
