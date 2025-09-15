<?php
// lib/auth.php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/db.php';

function login(string $username, string $password): bool {
    $stmt = db()->prepare('SELECT id, password_hash FROM users WHERE username = :u AND active = 1');
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = (int)$user['id'];
        $_SESSION['username'] = $username;
        return true;
    }
    return false;
}

function logout(): void {
    session_destroy();
}

function current_user(): ?array {
    if (empty($_SESSION['user_id'])) return null;
    $stmt = db()->prepare('SELECT id, username FROM users WHERE id = :id');
    $stmt->execute([':id' => $_SESSION['user_id']]);
    return $stmt->fetch() ?: null;
}
