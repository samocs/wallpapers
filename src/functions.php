<?php
declare(strict_types=1);


function app_config(): array
{
    return [
        'db' => [
            'host' => '127.0.0.1',
            'name' => 'YOUR_DB_NAME',
            'user' => 'YOUR_DB_USER',
            'pass' => 'YOUR_DB_PASS',
            'charset' => 'utf8mb4',
        ],
    ];
}


function session_start_once(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}


function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $cfg = app_config()['db'];

    $dsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        $cfg['host'],
        $cfg['name'],
        $cfg['charset'] ?? 'utf8mb4'
    );

    $pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}


function is_admin_logged_in(): bool
{
    session_start_once();
    return isset($_SESSION['admin']['id']);
}


function require_admin(): void
{
    if (!is_admin_logged_in()) {
        header('Location: /login.php');
        exit;
    }
}


function admin_login(string $username, string $password): bool
{
    session_start_once();

    $stmt = db()->prepare('SELECT id, username, password_hash FROM admins WHERE username = :u LIMIT 1');
    $stmt->execute([':u' => $username]);
    $admin = $stmt->fetch();

    if (!$admin) {
        return false;
    }

    if (!password_verify($password, $admin['password_hash'])) {
        return false;
    }

    // prevent session fixation
    session_regenerate_id(true);

    $_SESSION['admin'] = [
        'id' => (int)$admin['id'],
        'username' => (string)$admin['username'],
    ];

    return true;
}


function admin_logout(): void
{
    session_start_once();
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $p['path'] ?? '/',
            $p['domain'] ?? '',
            (bool)($p['secure'] ?? false),
            (bool)($p['httponly'] ?? true)
        );
    }

    session_destroy();
}


function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}