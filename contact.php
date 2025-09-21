<?php $pageTitle = "Contact | Mike Aarnoutse"; ?>
<?php include 'header.php'; ?>
        <section class="contact">
            <h2>Contacteer mij</h2>
            <!-- Voor nu blijft het een mailto. In de volgende stap maken we contact_submit.php -->
            <form action="mailto:info@detechnoloog.nl" method="post" enctype="text/plain">
                <input type="text" name="naam" placeholder="Je naam" required>
                <input type="email" name="email" placeholder="Je e-mailadres" required>
                <textarea name="bericht" placeholder="Je bericht..." rows="6" required></textarea>
                <button type="submit">Verzenden</button>
            </form>
        </section>
<?php include 'footer.php'; ?>
