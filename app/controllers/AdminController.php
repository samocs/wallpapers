<?php
declare(strict_types=1);

class AdminController
{
    public function __construct(
        private PDO $db,
        private Contact $contact,
        private Wallpaper $wallpaper
    ) {}

    public function handleDeleteContact(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
            $id = (int)($_POST['id'] ?? 0);

            if ($id > 0 && $this->contact->delete($id)) {
                header("Location: /wallpapers/public/templates/admin.php?msg=deleted");
            } else {
                header("Location: /wallpapers/public/templates/admin.php?msg=delete_error");
            }
            exit;
        }
    }

    public function handleUploadWallpapers(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

            $allUploaded = true;

            foreach ($_FILES['image']['name'] as $idx => $name) {
                $file = [
                    'name'     => $_FILES['image']['name'][$idx],
                    'type'     => $_FILES['image']['type'][$idx],
                    'tmp_name' => $_FILES['image']['tmp_name'][$idx],
                    'error'    => $_FILES['image']['error'][$idx],
                    'size'     => $_FILES['image']['size'][$idx],
                ];

                if (!$this->wallpaper->upload($file)) {
                    $allUploaded = false;
                }
            }

            header("Location: admin.php?msg=" . ($allUploaded ? "upload_success" : "upload_error") . "#wallpapers");
            exit;
        }
    }

    public function handleDeleteWallpaper(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_wallpaper'])) {
            $id = (int)$_POST['delete_wallpaper'];

            $stmt = $this->db->prepare("SELECT image_path FROM wallpapers WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $file = $stmt->fetch(PDO::FETCH_OBJ);

            if ($file) {
                $path = __DIR__ . '/../../public/assets/upload/' . $file->image_path;
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $this->wallpaper->delete($id);

            header("Location: admin.php?deleted=1#wallpapers");
            exit;
        }
    }

    public function getMessages(): array
    {
        return $this->contact->all();
    }

    public function getWallpapers(): array
    {
        return $this->wallpaper->all();
    }

    public function getFlashMessage(): string
    {
        if (!isset($_GET['msg'])) return '';

        return match ($_GET['msg']) {
            'upload_success' => '✓ Image uploaded successfully',
            'upload_error'   => '✗ Image upload failed',
            'deleted'        => '✓ Message deleted successfully',
            'delete_error'   => '✗ Error deleting message',
            default          => ''
        };
    }
    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        if (isset($_POST['action']) && $_POST['action'] === 'delete') {
            $this->handleDeleteContact();
        }

        if (isset($_POST['submit'])) {
            $this->handleUploadWallpapers();
        }

        if (isset($_POST['delete_wallpaper'])) {
            $this->handleDeleteWallpaper();
        }
    }
}