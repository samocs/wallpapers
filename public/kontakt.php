<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contact Sam's Wallpapers for feedback and inquiries.">
    <meta name="keywords" content="contact, feedback, support">
    <meta name="author" content="samocs">
    <title>Contact - Sam's Wallpapers</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="logo">sam</a>
            <ul class="nav">
                <li><a href="index.php">home</a></li>
                <li><a href="galeria.php">gallery</a></li>
                <li><a href="o_nas.php">about</a></li>
                <li><a href="kontakt.php" class="active">contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container">
            <h1>contact us</h1>
            <p>we'd love to hear from you</p>

            <form class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="your@email.com">
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="What's this about?">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Your message..."></textarea>
                </div>

                <div class="form-group checkbox">
                    <input type="checkbox" id="consent" name="consent">
                    <label for="consent">I agree to the processing of my personal data</label>
                </div>

                <button type="button" class="form-btn">send message</button>
            </form>

            <div class="contact-info">
                <h3>contact information</h3>
                <p><a href="mailto:hello@samswallpapers.com">hello@samswallpapers.com</a></p>
                <p><a href="tel:+421123456789">+421 123 456 789</a></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="grid-cols-3">
                <div>
                    <h4>sam's wallpapers</h4>
                    <p>minimal wallpapers for modern screens</p>
                </div>
                <div>
                    <h4>contact</h4>
                    <ul class="footer-links">
                        <li><a href="mailto:hello@samswallpapers.com">hello@samswallpapers.com</a></li>
                        <li><a href="tel:+421123456789">+421 123 456 789</a></li>
                    </ul>
                </div>
                <div>
                    <h4>links</h4>
                    <ul class="footer-links">
                        <li><a href="galeria.html">gallery</a></li>
                        <li><a href="o_nas.html">about</a></li>
                        <li><a href="kontakt.html">contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 sam's wallpapers</p>
        </div>
    </footer>

    <script src="js/app.js"></script>
</body>
</html>