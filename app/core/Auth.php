<?php
declare(strict_types=1);

class Auth
{
    public static function login(string $username, string $password): bool
    {
        try {
            $db = (new Database())->getConnection();

            $stmt = $db->prepare("SELECT id, username, password_hash FROM admins WHERE username = :username LIMIT 1");
            $stmt->execute(['username' => $username]);

            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$admin || !password_verify($password, (string)$admin['password_hash'])) {
                return false;
            }

            session_regenerate_id(true);

            $_SESSION['admin'] = [
                'id' => (int)$admin['id'],
                'username' => (string)$admin['username'],
            ];

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    public static function logout(): void
    {
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 3600,
                $params['path'] ?? '/',
                $params['domain'] ?? '',
                (bool)($params['secure'] ?? false),
                (bool)($params['httponly'] ?? true)
            );
        }

        $_SESSION = [];
        session_destroy();
    }

    public static function check(): bool
    {
        return !empty($_SESSION['admin']['id']);
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            Redirect::redirect('login.php');
        }
    }

    public static function id(): ?int
    {
        return $_SESSION['admin']['id'] ?? null;
    }

    public static function username(): ?string
    {
        return $_SESSION['admin']['username'] ?? null;
    }
}
