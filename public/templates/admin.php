<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../../app/core/App.php';
App::init();

Auth::requireLogin();

$pdo = (new Database())->getConnection();
$contact = new Contact($pdo);
$wallpaper = new Wallpaper($pdo);

require_once __DIR__ . '/../../app/controllers/AdminController.php';

$controller = new AdminController($pdo, $contact, $wallpaper);

$controller->handleRequest();

$message  = $controller->getFlashMessage();
$messages = $controller->getMessages();
$username = Auth::username();
$wallpapers = $controller->getWallpapers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin_style.css">
</head>

<body>
<div class="layout">

    <aside>
        <div class="brand">Admin Console</div>
    </aside>

    <main>

        <div class="topbar">
            <div class="actions">
                <a class="btn secondary" href="home.php">View site</a>
                <a class="btn danger" href="logout.php">Logout</a>
            </div>
        </div>

        <?php if ($message): ?>
            <div class="<?= strpos($message, '✓') === 0 ? 'message-success' : 'message-error' ?>">
                <?= Helper::e($message) ?>
            </div>
        <?php endif; ?>

        <!-- CONTACT SUBMISSIONS -->
        <div class="section-card">
            <h2>Contact submissions</h2>
            <p class="section-sub">Messages submitted through your contact form.</p>

            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th><th>Name</th><th>Email</th><th>Subject</th>
                        <th>Message</th><th>Consent</th><th>Created</th><th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!$messages): ?>
                        <tr><td colspan="8">No messages found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($messages as $m): ?>
                            <tr>
                                <td><?= (int)$m->id ?></td>
                                <td><?= Helper::e($m->name) ?></td>
                                <td><?= Helper::e($m->email) ?></td>
                                <td><?= Helper::e($m->subject) ?></td>
                                <td><?= nl2br(Helper::e($m->message)) ?></td>
                                <td><?= ((int)$m->consent === 1) ? 'Yes' : 'No' ?></td>
                                <td><?= Helper::e($m->created_at) ?></td>
                                <td>
                                    <form method="POST" action="admin.php" style="display:inline">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= (int)$m->id ?>">
                                        <button type="submit" class="delete-btn"
                                                onclick="return confirm('Delete this message?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- IMAGE MANAGEMENT -->
        <div class="section-card">
            <h2>Image management</h2>
            <p class="section-sub">Manage wallpapers stored in the database.</p>

            <div class="upload-inner">
                <form action="admin.php" method="post" enctype="multipart/form-data" class="upload-form">
                <label class="upload-label">Select Image File:</label>
                    <input type="file" name="image[]" class="upload-input" multiple>
                    <button type="submit" name="submit" class="upload-btn">
                        ⬆ Upload Image
                    </button>
                </form>
            </div>

            <!-- WALLPAPER TABLE -->
            <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Preview</th>
                        <th>Filename</th>
                        <th>Uploaded</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if (empty($wallpapers)): ?>
                        <tr><td colspan="5">No wallpapers uploaded yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($wallpapers as $img): ?>
                            <tr>
                                <td><?= (int)$img->id ?></td>

                                <td>
                                    <img src="/../../public/assets/upload/<?= Helper::e($img->image_path) ?>"
                                         alt="Wallpaper"
                                         style="width:80px; height:auto; border-radius:4px;">
                                </td>

                                <td><?= Helper::e($img->image_path) ?></td>
                                <td><?= Helper::e($img->created_at ?? '') ?></td>

                                <td>
                                    <form method="POST" style="display:inline;"
                                          onsubmit="return confirm('Delete this image?')">
                                        <input type="hidden" name="delete_wallpaper" value="<?= $img->id ?>">
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>
