<?php
require_once '../../app/core/App.php';
app::init();
$title = Helper::getPageTitle();
$pdo = (new Database())->getConnection();

$wallpaper = new Wallpaper($pdo);

$wallpapers = $wallpaper->random(4);
?>

<?php require 'partials/header.php'; ?>

<!-- Hero (Fixed Alignment) -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>wallpapers<br>for your screen</h1>
            <p>carefully curated, beautifully minimal</p>
            <a href="gallery.php" class="cta">explore →</a>
        </div>
    </div>
</section>

<!-- Carousel/Slideshow -->
<section class="carousel-section">
    <div class="container">
        <h2>featured collections</h2>

        <div class="carousel">
            <?php foreach ($wallpapers as $index => $row): ?>
                <?php $img = '/../../public/assets/upload/' . htmlspecialchars($row->image_path); ?>

                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="<?= $img ?>" alt="Wallpaper">
                </div>
            <?php endforeach; ?>
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
        <p><a href="gallery.php" class="btn">browse full gallery</a></p>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>ready to upgrade your desktop?</h2>
            <a href="gallery.php" class="btn">start browsing</a>
        </div>
    </div>
</section>

<?php require 'partials/footer.php'; ?>
