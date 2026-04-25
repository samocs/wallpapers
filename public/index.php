<?php
require __DIR__ . '/../src/functions.php';

$title = page_title('Home');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sam's Wallpapers - Minimal wallpapers collection. Clean design, premium quality.">
    <meta name="keywords" content="wallpapers, minimal, monochrome, clean, simple">
    <meta name="author" content="samocs">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="logo">sam</a>
            <ul class="nav">
                <li><a href="index.php" class="active">home</a></li>
                <li><a href="galeria.php">gallery</a></li>
                <li><a href="o_nas.php">about</a></li>
                <li><a href="kontakt.php">contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero (Fixed Alignment) -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>wallpapers<br>for your screen</h1>
                <p>carefully curated, beautifully minimal</p>
                <a href="galeria.html" class="cta">explore →</a>
            </div>
        </div>
    </section>

    <!-- Carousel/Slideshow -->
    <section class="carousel-section">
        <div class="container">
            <h2>featured collections</h2>
            <div class="carousel">
                <div class="carousel-item active">
                    <img src="img/1.jpg" alt="Collection 1">
                </div>
                <div class="carousel-item">
                    <img src="img/2.jpg" alt="Collection 2">
                </div>
                <div class="carousel-item">
                    <img src="img/3.jpg" alt="Collection 3">
                </div>
            </div>
            <div class="carousel-controls">
                <button class="carousel-prev">❮</button>
                <button class="carousel-next">❯</button>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section class="features">
        <div class="container">
            <h2>why choose sam's</h2>
            <div class="grid-cols-3">
                <div class="feature">
                    <h3>quality</h3>
                    <p>4K and 8K resolution wallpapers designed with precision</p>
                </div>
                <div class="feature">
                    <h3>minimal</h3>
                    <p>clean, simple designs that enhance your workspace</p>
                </div>
                <div class="feature">
                    <h3>free</h3>
                    <p>download unlimited wallpapers at no cost</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Preview -->
    <section class="preview">
        <div class="container">
            <h2>explore more</h2>
            <p><a href="galeria.html" class="btn">browse full gallery</a></p>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>ready to upgrade your desktop?</h2>
                <a href="galeria.html" class="btn">start browsing</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="grid-cols-3">
                <div>
                    <h4>sam's wallpapers</h4>
                    <p>minimal design for modern screens</p>
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