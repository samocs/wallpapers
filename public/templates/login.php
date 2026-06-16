<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../../app/core/App.php';
App::init();

$db = (new Database())->getConnection();

require_once __DIR__ . '/../../app/controllers/LoginController.php';

$controller = new LoginController($db);
['error' => $error, 'returnTo' => $returnTo] = $controller->handle();

if (Auth::check()) {
    header("Location: {$returnTo}");
    exit;
}

function e(string $v): string {
    return htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>

    <link rel="stylesheet" href="../assets/css/login_style.css">
</head>
<body>
<main class="auth-container">
    <section class="auth-card">
        <header>
            <h1 class="auth-title">Sign in</h1>
            <p class="auth-subtitle">Use your username and password to continue.</p>
        </header>

        <form class="auth-form" method="post">
            <input type="hidden" name="return_to" value="<?= e($returnTo) ?>">

            <?php if ($error !== ''): ?>
                <div class="auth-error" role="alert"><?= e($error) ?></div>
            <?php endif; ?>

            <label class="auth-label">
                Username
                <input class="auth-input" type="text" name="username" autocomplete="username" required />
            </label>

            <label class="auth-label">
                Password
                <input class="auth-input" type="password" name="password" autocomplete="current-password" required />
            </label>

            <div class="auth-actions">
                <button class="auth-button" type="submit">Login</button>
            </div>
        </form>

        <div class="small-note">
            Admin access only.
        </div>
    </section>
</main>
</body>
</html>
