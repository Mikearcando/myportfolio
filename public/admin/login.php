<?php
require_once __DIR__ . '/_auth.php';

// Eerste run: toon registratieformulier
if (is_first_run($pdo)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $u = trim($_POST['username'] ?? '');
        $p = trim($_POST['password'] ?? '');
        if ($u !== '' && $p !== '') {
            $hash = password_hash($p, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, created_at) VALUES (?, ?, NOW())");
            $stmt->execute([$u, $hash]);
            header('Location: login.php?registered=1');
            exit;
        }
        $err = 'Vul gebruikersnaam en wachtwoord in.';
    }
    ?>
    <!DOCTYPE html>
    <html lang="nl"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Admin setup</title><link rel="stylesheet" href="../style.css"></head>
    <body><main class="contact">
      <h2>Eerste keer instellen</h2>
      <?php if (!empty($err)): ?><div class="alert error"><?= htmlspecialchars($err) ?></div><?php endif; ?>
      <form method="post">
        <input name="username" placeholder="Admin gebruikersnaam" required>
        <input name="password" type="password" placeholder="Admin wachtwoord" required>
        <button type="submit">Maak admin gebruiker</button>
      </form>
    </main></body></html>
    <?php
    exit;
}

// Normale login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username'] ?? '');
    $p = trim($_POST['password'] ?? '');
    $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE username=?");
    $stmt->execute([$u]);
    $row = $stmt->fetch();
    if ($row && password_verify($p, $row['password_hash'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $u;
        header('Location: dashboard.php');
        exit;
    } else {
        $err = 'Onjuiste inloggegevens.';
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Inloggen</title><link rel="stylesheet" href="../style.css"></head>
<body>
<main class="contact">
  <h2>Inloggen</h2>
  <?php if (isset($_GET['registered'])): ?><div class="alert success">Admin aangemaakt. Log nu in.</div><?php endif; ?>
  <?php if (!empty($err)): ?><div class="alert error"><?= htmlspecialchars($err) ?></div><?php endif; ?>
  <form method="post">
    <input name="username" placeholder="Gebruikersnaam" required>
    <input name="password" type="password" placeholder="Wachtwoord" required>
    <button type="submit">Inloggen</button>
  </form>
</main>
</body>
</html>
