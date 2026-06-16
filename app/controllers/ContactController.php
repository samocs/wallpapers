<?php
declare(strict_types=1);

class ContactController
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function handleForm(): array
    {
        $success = false;
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return compact('success', 'error');
        }

        $name = trim((string) filter_input(INPUT_POST, 'name'));
        $email = trim((string) filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $subject = trim((string) filter_input(INPUT_POST, 'subject'));
        $message = trim((string) filter_input(INPUT_POST, 'message'));
        $consent = isset($_POST['consent']);

        if ($name === '' || $email === '' || $subject === '' || $message === '' || !$consent) {
            $error = 'Please fill in all fields and accept consent.';
            return compact('success', 'error');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address.';
            return compact('success', 'error');
        }

        try {
            $contact = new Contact($this->db);
            $success = $contact->store($name, $email, $subject, $message, $consent);
            if (!$success) {
                $error = 'Failed to save message.';
            }
        } catch (Throwable $e) {
            $error = $e->getMessage();
        }

        return compact('success', 'error');
    }
}