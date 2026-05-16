<?php

declare(strict_types=1);

session_start();

// Clear all session data
$_SESSION = [];

// Remove the session cookie (recommended)
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

// Destroy the session
session_destroy();

// Redirect to login (or homepage)
header('Location: login.php');
exit;