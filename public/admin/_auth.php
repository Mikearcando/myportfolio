<?php
require_once __DIR__ . '/../includes/db.php';

function require_login() {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

function is_first_run(PDO $pdo): bool {
    $cnt = $pdo->query("SELECT COUNT(*) AS c FROM users")->fetch()['c'] ?? 0;
    return intval($cnt) === 0;
}
