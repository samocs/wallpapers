<?php
declare(strict_types=1);

class LoginController
{
    public function __construct(private PDO $db) {}

    public function handle(): array
    {
        $error = '';

        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];

        $returnTo = $_REQUEST['return_to']
            ?? "{$scheme}://{$host}/wallpapers/public/templates/admin.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim((string)($_POST['username'] ?? ''));
            $password = (string)($_POST['password'] ?? '');

            if (Auth::login($username, $password)) {
                header("Location: {$returnTo}");
                exit;
            }

            $error = 'Invalid username or password.';
        }

        return compact('error', 'returnTo');
    }
}