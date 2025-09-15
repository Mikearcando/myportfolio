<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/lib/db.php';
verify_csrf();

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name && $email && $message) {
    $stmt = db()->prepare('INSERT INTO messages (name, email, message, created_at) VALUES (:n, :e, :m, :c)');
    $stmt->execute([
        ':n' => $name,
        ':e' => $email,
        ':m' => $message,
        ':c' => date('c')
    ]);
    flash('success', 'Bedankt! Je bericht is ontvangen.');
} else {
    flash('success', 'Vul alle velden in.');
}
header('Location: /contact.php');
