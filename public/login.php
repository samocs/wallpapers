<?php
declare(strict_types=1);
session_start();

$returnTo = isset($_GET['return_to']) ? (string)$_GET['return_to'] : '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>

    <link rel="stylesheet" href="css/style.css" />


    <style>


        .auth-container {
            min-height: 100svh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .auth-card {
            width: min(420px, 100%);
            border-radius: 16px;
            padding: 24px;
        }

        .auth-title {
            margin: 0 0 6px;
            font-size: 22px;
            line-height: 1.2;
        }

        .auth-subtitle {
            margin: 0 0 18px;
            opacity: .75;
            font-size: 14px;
        }

        .auth-form {
            display: grid;
            gap: 12px;
        }

        .auth-label {
            display: grid;
            gap: 6px;
            font-size: 14px;
        }

        .auth-input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
        }

        .auth-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 4px;
        }

        .auth-actions {
            margin-top: 6px;
            display: grid;
            gap: 10px;
        }

        .auth-button {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            cursor: pointer;
        }

        .auth-footer {
            margin-top: 14px;
            font-size: 14px;
            opacity: .8;
            text-align: center;
        }

        .auth-error {
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
<main class="auth-container">
    <section class="auth-card">
        <header>
            <h1 class="auth-title">Sign in</h1>
            <p class="auth-subtitle">Use your email and password to continue.</p>
        </header>

        <!-- Frontend only: point action to your real login handler -->
        <form class="auth-form" method="post" action="login.php">
            <input type="hidden" name="return_to" value="<?= htmlspecialchars($returnTo, ENT_QUOTES, 'UTF-8') ?>">

            <!-- Optional error placeholder (server can inject content here) -->
            <?php if (!empty($_GET['error'])): ?>
                <div class="auth-error" role="alert">
                    <?= htmlspecialchars((string)$_GET['error'], ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <label class="auth-label">
                Email
                <input class="auth-input" type="email" name="email" autocomplete="username" required />
            </label>

            <label class="auth-label">
                Password
                <input class="auth-input" type="password" name="password" autocomplete="current-password" required />
            </label>

            <div class="auth-row">
                <label class="auth-label" style="display:flex;align-items:center;gap:8px;margin:0;">
                    <input type="checkbox" name="remember" value="1" />
                    Remember me
                </label>

                <a href="/forgot-password">Forgot password?</a>
            </div>

            <div class="auth-actions">
                <button class="auth-button" type="submit">Login</button>
            </div>

            <p class="auth-footer">
                Don’t have an account? <a href="/register">Create one</a>
            </p>
        </form>
    </section>
</main>
</body>
</html>