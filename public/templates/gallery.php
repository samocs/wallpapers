<?php
require_once '../../app/core/App.php';
require_once '../../app/models/Wallpaper.php'; // updated model
app::init();
$title = Helper::getPageTitle();

// DB connection
$pdo = (new Database())->getConnection();

// Load wallpapers using new unified model
$wallpapers = (new Wallpaper($pdo))->all();
?>
<?php require 'partials/header.php'; ?>
<!-- Gallery -->
<section class="gallery">
    <div class="container">
        <div class="gallery-header">
            <h1>gallery</h1>
            <p>click any image to enlarge</p>
        </div>

        <!-- Gallery Grid -->
        <div class="gal-grid">
            <?php foreach ($wallpapers as $row): ?>
                <div class="gallery-item">
                    <img src="/../../public/assets/upload/<?= htmlspecialchars($row->image_path) ?>"
                         alt="Wallpaper"
                         class="gallery-item-image">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require 'partials/footer.php'; ?>
