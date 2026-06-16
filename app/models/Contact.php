<?php
declare(strict_types=1);

class Contact
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function store(string $name, string $email, string $subject, string $message, bool $consent): bool
    {
        $sql = "INSERT INTO contact_messages (name, email, subject, message, consent)
                VALUES (:name, :email, :subject, :message, :consent)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'consent' => $consent ? 1 : 0
        ]);
    }
    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM contact_messages WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}