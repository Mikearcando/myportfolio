<?php
require_once __DIR__ . '/../partials/header.php';
?>
<section class="contact">
    <h2>Contacteer mij</h2>
    <?php if ($msg = flash('success')): ?>
        <div class="alert success"><?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <form method="post" action="/public_handle_contact.php">
        <?= csrf_field() ?>
        <input type="text" name="name" placeholder="Je naam" required>
        <input type="email" name="email" placeholder="Je e-mailadres" required>
        <textarea name="message" placeholder="Je bericht..." rows="6" required></textarea>
        <button type="submit">Verzenden</button>
    </form>
</section>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
