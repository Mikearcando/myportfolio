<?php
require_once __DIR__ . '/includes/db.php';

function redirect($ok = true) {
    global $BASE_URL;
    header('Location: ' . $BASE_URL . '/contact.php?' . ($ok ? 'ok=1' : 'err=1'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect(false);

// Honeypot
if (!empty($_POST['website'])) redirect(true);

$name = trim($_POST['naam'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['bericht'] ?? '');

if ($name === '' || $email === '' || $message === '') redirect(false);

try {
    $stmt = $pdo->prepare("INSERT INTO messages (name, email, message, created_at, unread) VALUES (?, ?, ?, NOW(), 1)");
    $stmt->execute([$name, $email, $message]);
    // Optioneel: hier kan je mail() of PHPMailer-integratie doen
    redirect(true);
} catch (Exception $e) {
    redirect(false);
}
