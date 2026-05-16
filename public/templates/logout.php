<?php

declare(strict_types=1);

session_start();

$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 3600,
        $p['path'] ?? '/',
        $p['domain'] ?? '',
        (bool)($p['secure'] ?? false),
        (bool)($p['httponly'] ?? true)
    );
}

session_destroy();

header('Location: login.php');
exit;