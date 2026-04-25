<?php

require __DIR__ . '/../src/functions.php';

$title = page_title('Gallery');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sam's Wallpapers - Gallery of minimal monochrome wallpapers.">
    <meta name="keywords" content="gallery, wallpapers, minimal, monochrome">
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
                <li><a href="index.php">home</a></li>
                <li><a href="galeria.php" class="active">gallery</a></li>
                <li><a href="o_nas.php">about</a></li>
                <li><a href="kontakt.php">contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Gallery -->
    <section class="gallery">
        <div class="container">
            <div class="gallery-header">
                <h1>gallery</h1>
                <p>click any image to enlarge</p>
            </div>

            <!-- Gallery Grid -->
            <div class="gal-grid">
                <div class="gal-item">
                    <img src="img/1.jpg" alt="Wallpaper 1" class="gallery-item-image">
                </div>
                <div class="gallery-item">
                    <img src="img/2.jpg" alt="Wallpaper 2" class="gallery-item-image">
                </div>
                <div class="gallery-item">
                    <img src="img/3.jpg" alt="Wallpaper 3" class="gallery-item-image">
                </div>
                <div class="gallery-item">
                    <img src="img/4.jpg" alt="Wallpaper 4" class="gallery-item-image">
                </div>
                <div class="gallery-item">
                    <img src="img/5.jpg" alt="Wallpaper 5" class="gallery-item-image">
                </div>
                <div class="gallery-item">
                    <img src="img/6.jpg" alt="Wallpaper 6" class="gallery-item-image">
                </div>
                <div class="gallery-item">
                    <img src="img/7.jpg" alt="Wallpaper 7" class="gallery-item-image">
                </div>
                <div class="gallery-item">
                    <img src="img/8.jpg" alt="Wallpaper 8" class="gallery-item-image">
                </div>
                <div class="gallery-item">
                    <img src="img/9.jpg" alt="Wallpaper 9" class="gallery-item-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="grid-cols-3">
                <div>
                    <h4>sam's</h4>
                    <p>minimal wallpapers</p>
                </div>
                <div>
                    <h4>links</h4>
                    <ul class="footer-links">
                        <li><a href="galeria.php">gallery</a></li>
                        <li><a href="o_nas.php">about</a></li>
                        <li><a href="kontakt.php">contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4>contact</h4>
                    <p>hello@samswallpapers.com</p>
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