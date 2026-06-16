<?php
require_once '../../app/core/App.php';
app::init();
$title = Helper::getPageTitle();
?>

<?php require 'partials/header.php'; ?>

<!-- About Section -->
<section class="about-section">
    <!-- Changed about-container to container so it centers correctly -->
    <div class="container">
        <div class="about-content">
            <h2>our mission</h2>
            <p>
                Sam's Wallpapers started with a simple idea: create beautiful, minimal wallpapers
                that don't distract. We believe in the power of simplicity and the elegance of monochrome design.
            </p>

            <ul class="content-list">
                <li>High-quality 4K and 8K resolution wallpapers</li>
                <li>Minimal monochrome designs for every taste</li>
                <li>Completely free, no subscriptions required</li>
                <li>Compatible with all devices and screen sizes</li>
            </ul>
        </div>

        <div class="table-section">
            <h2>wallpaper categories</h2>
            <table class="comparison-table">
                <thead>
                <tr>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Best For</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Dark</td>
                    <td>Pure black to charcoal shades</td>
                    <td>Productivity, focus</td>
                </tr>
                <tr>
                    <td>Light</td>
                    <td>White to soft gray tones</td>
                    <td>Brightness, clarity</td>
                </tr>
                <tr>
                    <td>Gradient</td>
                    <td>Smooth transitions between shades</td>
                    <td>Modern, balanced look</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="accordion-section">
            <h2>frequently asked questions</h2>
            <div class="accordion">
                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>Are the wallpapers really free?</span>
                        <span class="accordion-icon">+</span>
                    </button>
                    <div class="accordion-content">
                        <p>Yes! All wallpapers are completely free to download and use.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>What resolution are the wallpapers?</span>
                        <span class="accordion-icon">+</span>
                    </button>
                    <div class="accordion-content">
                        <p>Our wallpapers come in 4K (3840x2160) and 8K (7680x4320) resolutions.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <button class="accordion-header">
                        <span>How often are new wallpapers added?</span>
                        <span class="accordion-icon">+</span>
                    </button>
                    <div class="accordion-content">
                        <p>We add new wallpapers to our collection weekly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'partials/footer.php'; ?>