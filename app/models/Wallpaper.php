<?php
declare(strict_types=1);

class Wallpaper
{
    private PDO $db;
    private string $uploadDir;

    public function __construct(PDO $db)
    {
        $this->db = $db;

        $this->uploadDir = __DIR__ . '/../../public/assets/upload/';

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    public function upload(array $file): bool
    {
        if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $imageName = basename($file['name']);
        $tempName  = $file['tmp_name'];

        $ext = pathinfo($imageName, PATHINFO_EXTENSION);
        $name = pathinfo($imageName, PATHINFO_FILENAME);

        $target = $this->uploadDir . $imageName;

        $counter = 1;
        while (file_exists($target)) {
            $newName = $name . '(' . $counter . ').' . $ext;
            $target = $this->uploadDir . $newName;
            $counter++;
        }

        $finalName = basename($target);

        if (!move_uploaded_file($tempName, $target)) {
            return false;
        }

        return $this->store($finalName);

    }

    public function store(string $filename): bool
    {
        $sql = "INSERT INTO wallpapers (image_path) VALUES (:image)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['image' => $filename]);
    }

    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM wallpapers ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM wallpapers WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function random(int $limit = 4): array
    {
        $stmt = $this->db->prepare("
            SELECT * FROM wallpapers
            ORDER BY RAND()
            LIMIT :limit
        ");

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}