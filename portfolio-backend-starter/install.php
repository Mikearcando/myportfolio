<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/lib/db.php';

$pdo = db();
$sql = file_get_contents(__DIR__ . '/migrations/001_init.sql');
$pdo->exec($sql);

// Create default admin if none
$count = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
if ($count === 0) {
    $username = 'admin';
    $password = 'changeme123!';
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, active) VALUES (:u,:p,1)');
    $stmt->execute([':u' => $username, ':p' => $hash]);
    echo "Admin gebruiker aangemaakt: \nGebruikersnaam: $username\nWachtwoord: $password\n";
} else {
    echo "Database al geconfigureerd.\n";
}

echo "Klaar. Verwijder install.php voor de veiligheid.\n";
