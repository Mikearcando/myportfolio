<?php
// config.php
declare(strict_types=1);

define('BASE_PATH', __DIR__);
define('DB_PATH', BASE_PATH . '/data/site.db');
define('SESSION_NAME', 'portfolio_sess');
define('APP_DEBUG', true);

// Create session with secure settings
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => false, // set to true when using HTTPS
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

// CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($_SESSION['csrf_token']) . '">';
}
function verify_csrf(): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(400);
            die('Ongeldige CSRF token.');
        }
    }
}

// Simple flash helper
function flash(string $key, ?string $msg = null) {
    if ($msg !== null) { $_SESSION['flash'][$key] = $msg; return; }
    $val = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $val;
}

// Auth check
function require_login(): void {
    if (empty($_SESSION['user_id'])) {
        header('Location: /admin/login.php');
        exit;
    }
}
