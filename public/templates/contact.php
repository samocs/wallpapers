<?php
declare(strict_types=1);

require __DIR__ . '/../../app/core/App.php';
app::init();

$title = Helper::getPageTitle();

$db = new Database();
$pdo = $db->getConnection();

require __DIR__ . '/../../app/controllers/ContactController.php';

$controller = new ContactController($pdo);

// Bezpečná inicializácia premenných
$success = false;
$error = '';

$result = $controller->handleForm();
if (is_array($result)) {
    $success = $result['success'] ?? false;
    $error = $result['error'] ?? '';
}
?>

<?php require 'partials/header.php'; ?>

<section class="contact-section">
    <div class="contact-container">
        <h1>contact us</h1>
        <p>we'd love to hear from you</p>

        <?php if ($success): ?>
            <p class="success">Message sent successfully.</p>
        <?php elseif (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form class="contact-form" method="post" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Your name"
                        value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                        required
                >
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="your@email.com"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                        required
                >
            </div>

            <div class="form-group">
                <label for="subject">Subject</label>
                <input
                        type="text"
                        id="subject"
                        name="subject"
                        placeholder="What's this about?"
                        value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>"
                        required
                >
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea
                        id="message"
                        name="message"
                        placeholder="Your message..."
                        required
                ><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </div>

            <div class="form-group checkbox">
                <input
                        type="checkbox"
                        id="consent"
                        name="consent"
                        <?= isset($_POST['consent']) ? 'checked' : '' ?>
                        required
                >
                <label for="consent">I agree to the processing of my personal data</label>
            </div>

            <button type="submit" class="form-btn">send message</button>
        </form>

        <div class="contact-info">
            <h3>contact information</h3>
            <p><a href="mailto:hello@obsidianwall.com">hello@obsidianwall.com</a></p>
            <p><a href="tel:+421123456789">+421 123 456 789</a></p>
        </div>
    </div>
</section>

<?php require 'partials/footer.php'; ?>
