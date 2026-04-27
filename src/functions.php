<?php

declare(strict_types=1);

function page_title(string $page, string $site = 'Wallpapers'): string
{
    return "$page | $site";
}

function db(): PDO
{
    $host = '127.0.0.1';
    $dbName = 'wallpapers_schema';
    $user = 'root';
    $password = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host={$host};dbname={$dbName};charset={$charset}";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    return new PDO($dsn, $user, $password, $options);
}

function save_contact_message(
    string $name,
    string $email,
    string $subject,
    string $message,
    bool $consent
): void {
    $sql = 'INSERT INTO contact_messages (name, email, subject, message, consent)
            VALUES (:name, :email, :subject, :message, :consent)';

    $stmt = db()->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message,
        'consent' => $consent ? 1 : 0,
    ]);
}