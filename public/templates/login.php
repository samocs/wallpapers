<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../../app/core/db.php';

$dbInstance = new Database();
$pdo = $dbInstance->getConnection();

function e(string $v): string {
    return htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function redirect(string $to): void {
    header("Location: {$to}");
    exit;
}

$returnTo = isset($_REQUEST['return_to']) ? (string)$_REQUEST['return_to'] : '/admin.php';

if (!empty($_SESSION['admin']['id'])) {
    redirect($returnTo);
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Username and password are required.';
    } else {
        $stmt = $pdo->prepare('SELECT id, username, password_hash FROM admins WHERE username = :u LIMIT 1');
        $stmt->execute([':u' => $username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$admin || !password_verify($password, (string)$admin['password_hash'])) {
            $error = 'Invalid username or password.';
        } else {
            session_regenerate_id(true);
            $_SESSION['admin'] = [
                'id' => (int)$admin['id'],
                'username' => (string)$admin['username'],
            ];
            redirect($returnTo);
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>

    <link rel="stylesheet" href="../../../skriptovacie%20jazyky/semestralna%20praca/public/css/style.css" />

    <style>
        :root{
            --bg:#0f172a;
            --panel:#111827;
            --panel-2:#1f2937;
            --text:#e5e7eb;
            --muted:#9ca3af;
            --primary:#38bdf8;
            --danger:#ef4444;
            --border:#1f2937;
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,Cantarell,"Helvetica Neue",Arial;
            background:var(--bg);
            color:var(--text);
        }

        .auth-container{
            min-height:100svh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:24px;
        }

        .auth-card{
            width:min(420px, 100%);
            background:var(--panel);
            border:1px solid var(--border);
            border-radius:14px;
            padding:20px;
        }

        .auth-title{
            margin:0 0 6px;
            font-size:22px;
            line-height:1.2;
        }

        .auth-subtitle{
            margin:0 0 16px;
            color:var(--muted);
            font-size:14px;
        }

        .auth-form{display:grid;gap:12px}

        .auth-label{
            display:grid;
            gap:6px;
            font-size:14px;
            color:var(--text);
        }

        .auth-input{
            width:100%;
            padding:10px 12px;
            border-radius:10px;
            border:1px solid var(--border);
            background:#0b1220;
            color:var(--text);
            outline:none;
        }
        .auth-input:focus{
            border-color:rgba(56,189,248,.7);
            box-shadow:0 0 0 3px rgba(56,189,248,.15);
        }

        .auth-actions{margin-top:4px;display:grid;gap:10px}

        .auth-button{
            width:100%;
            padding:10px 12px;
            border-radius:10px;
            cursor:pointer;
            border:0;
            background:var(--primary);
            color:#0b1220;
            font-weight:700;
        }

        .auth-error{
            padding:10px 12px;
            border-radius:10px;
            border:1px solid rgba(239,68,68,.35);
            background:rgba(239,68,68,.10);
            color:var(--text);
            font-size:14px;
        }

        .small-note{
            margin-top:12px;
            color:var(--muted);
            font-size:12px;
            text-align:center;
        }

        a{color:var(--primary);text-decoration:none}
        a:hover{text-decoration:underline}
    </style>
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