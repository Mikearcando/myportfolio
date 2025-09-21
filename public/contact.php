<?php $pageTitle = "Contact | Mike Aarnoutse"; ?>
<?php include __DIR__ . '/header.php'; ?>

<section class="contact">
  <h2>Contacteer mij</h2>
  <?php if (isset($_GET['ok'])): ?>
    <div class="alert success">Bedankt! Je bericht is ontvangen.</div>
  <?php elseif (isset($_GET['err'])): ?>
    <div class="alert error">Er ging iets mis. Probeer het later opnieuw.</div>
  <?php endif; ?>
  <form action="<?= $BASE_URL ?>/contact_submit.php" method="post" novalidate>
    <input type="text" name="naam" placeholder="Je naam" required>
    <input type="email" name="email" placeholder="Je e-mailadres" required>
    <textarea name="bericht" placeholder="Je bericht..." rows="6" required></textarea>
    <!-- Honeypot -->
    <input type="text" name="website" style="display:none">
    <button type="submit">Verzenden</button>
  </form>
</section>

<?php include __DIR__ . '/footer.php'; ?>
